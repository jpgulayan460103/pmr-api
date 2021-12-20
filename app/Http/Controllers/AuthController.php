<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
        return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
        }

        $user = User::where('username', $request['username'])->firstOrFail();

        // $token = $user->createToken('authToken'); //without refresh token
        Token::where('user_id', $user->id)->update(['revoked' => true]);
        $token = $this->getAccessToken($request->only('username', 'password')); // with refresh token
        return response()->json($token);
        return response()->json([
            'access_token' => $token['access_token'],
            'token_type' => 'Bearer',
        ]);
    }

    public function ldap_auth()
    {
        $adServer = config('services.ad.host');

        $ldap = ldap_connect($adServer);
        $username = config('services.ad.user');
        $password = config('services.ad.password');

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
                    $fullname = $info[$i]["cn"][0];
                    $firstname = $info[$i]["givenname"][0];
                    $middlename = $info[$i]["initials"][0];
                    $lastname = $info[$i]["sn"][0];
                    $userDn = $info[$i]["distinguishedname"][0];
                    $data = [
                        "status" => "ok",
                        "data" => [
                            'fullname' => $fullname,
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'lastname' => $lastname,
                            'userDn' => $userDn,
                            'message' => "Successfully Logged in",
                        ]
                    ];
                    return $data;
                
            }
            @ldap_close($ldap);
        } else {
            $msg = "Invalid email address / password";
            return [
                "status" => "error",
                "data" => [
                    'message' => $msg
                ]
            ];
        }

    }

    public function getAccessToken($credentials)
    {
        $oauth = DB::table('oauth_clients')->where('id',2)->first();
        $response = Http::asForm()->post(config('services.passport.endpoint'), [
            'grant_type' => 'password',
            'client_id' => $oauth->id,
            'client_secret' => $oauth->secret,
            'username' => $credentials['username'],
            'password' => $credentials['password'],
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
            'refresh_token' => $request->refresh_token,
        ]);
        
        return $response->json();
    }
}
