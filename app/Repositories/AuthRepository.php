<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;

class AuthRepository implements AuthRepositoryInterface
{

    public function revokeExistingTokens(User $user)
    {
        Token::where('user_id', $user->id)->update(['revoked' => true]);
    }

    public function authenticate(Request $request, $user)
    {
        if($user == null){
            return [
                'status' => 'error',
                'message' => "Invalid login details",
                'status_code' => 422,
                'error_code' => 'no_user',
            ];
        }

        if($user->is_active != 1){
            return [
                'status' => 'error',
                'message' => "Account is disabled, please contact administrator.",
                'status_code' => 422,
                'error_code' => 'account_disabled',
            ];
        }

        if($user->account_type == "app_account"){
            if (!Auth::guard('web')->attempt($request->only('username', 'password'))) {
                return [
                    'status' => 'error',
                    'message' => "Invalid login details",
                    'status_code' => 422,
                    'error_code' => 'invalid_password',
                ];
            }
            return [
                'status' => 'ok',
                'message' => "Successfully Logged in",
                'status_code' => 200,
                'error_code' => 'success',
            ];
        }
        return $this->ldapAuth($request);
    }



    public function ldapAuth(Request $request)
    {
        $adServer = config('services.ad.host');

        $ldap = ldap_connect($adServer);
        $username = $request['username'];
        $password = $request['password'];
        
        $ldaprdn = config('services.ad.domain_1') . "\\" . $username;

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $bind = @ldap_bind($ldap, $ldaprdn, $password);

        if ($bind) {
            $filter="(sAMAccountName=$username)";
            $result = ldap_search($ldap,"DC=".config('services.ad.domain_1').",DC=".config('services.ad.domain_2'),$filter);
            $info = ldap_get_entries($ldap, $result);
            for ($i=0; $i<$info["count"]; $i++)
            {
                if($info['count'] > 1)
                    break;
                    $fullname = isset($info[$i]["cn"][0]) ? ucwords($info[$i]["cn"][0]) : "";
                    $firstname = isset($info[$i]["givenname"][0]) ? ucwords($info[$i]["givenname"][0]) : "";
                    $middlename = isset($info[$i]["initials"][0]) ? ucwords($info[$i]["initials"][0]) : "";
                    $lastname = isset($info[$i]["sn"][0]) ? ucwords($info[$i]["sn"][0]) : "";
                    $userDn = isset($info[$i]["distinguishedname"][0]) ? $info[$i]["distinguishedname"][0] : "";
                    $email_address = isset($info[$i]["mail"][0]) ? $info[$i]["mail"][0] : "";
                    $data = [
                        "status" => "ok",
                        "status_code" => 200,
                        'message' => "Successfully Logged in",
                        "error_code" => "success",
                        "data" => [
                            'fullname' => $fullname,
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'lastname' => $lastname,
                            'user_dn' => $userDn,
                            'username' => $username,
                            'email_address' => $email_address,
                        ]
                    ];
                    return $data;
                
            }
            @ldap_close($ldap);
        } else {
            return [
                "status" => "error",
                "status_code" => 422,
                "message" => "Invalid AD login details",
                'error_code' => 'ad_account_error',
            ];
        }

    }

    public function getAccessToken($credentials, User $user)
    {
        $password = $user->type == "app_account" ? $credentials['password'] : config('services.ad.default_password');
        $oauth = DB::table('oauth_clients')->where('id',2)->first();
        $response = Http::asForm()->post(config('services.passport.endpoint'), [
            'grant_type' => 'password',
            'client_id' => $oauth->id,
            'client_secret' => $oauth->secret,
            'username' => $credentials['username'],
            'password' => $password,
            'scope' => '',
        ]);
        
        return $response->json();
    }

    public function refreshToken(Request $request)
    {
        $oauth = DB::table('oauth_clients')->where('id',2)->first();
        $response = Http::asForm()->post(config('services.passport.endpoint'), [
            'grant_type' => 'refresh_token',
            'client_id' => $oauth->id,
            'client_secret' => $oauth->secret,
            'refresh_token' => $request['refresh_token'],
        ]);
        
        return $response->json();
    }
}
