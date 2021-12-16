<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);
    }

    public function ldap_auth(Request $request)
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
                if($info['count'] > 1){
                    break;
                    $fullname = $info[$i]["cn"][0];
                    $firstname = $info[$i]["givenname"][0];
                    $middlename = $info[$i]["initials"][0];
                    $lastname = $info[$i]["sn"][0];
                    $userDn = $info[$i]["distinguishedname"][0];
                    $data = [
                        $fullname,
                        $firstname,
                        $middlename,
                        $lastname,
                        $userDn,
                    ];
                    return $data;
                }
            }
            @ldap_close($ldap);
        } else {
            $msg = "Invalid email address / password";
            return [
                "message" => $msg
            ];
        }

    }
}
