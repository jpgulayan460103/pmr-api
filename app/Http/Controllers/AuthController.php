<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request['username'])->first();
        $authenticator =  $this->authRepository->authenticate($request, $user);
        if($authenticator['error_code'] == "no_user"){
            $ldap_auth = $this->authRepository->ldap_auth($request);
            $ldap_auth['error_code'] = $authenticator['error_code'];
            return response()->json($ldap_auth, $ldap_auth['status_code']);
        }
        if($authenticator['status'] == "ok"){
            $this->authRepository->revoke_existing_tokens($user);
            $token = $this->authRepository->getAccessToken($request->only('username', 'password'), $user); // with refresh token
            return response()->json($token);   
        }
        return response()->json($authenticator, $authenticator['status_code']);
    }

    public function ad_login(Request $request)
    {
        $ldap_auth = $this->authRepository->ldap_auth($request);
        return response()->json($ldap_auth, $ldap_auth['status_code']);
    }

}
 