<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WhichBrowser\Parser;

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
            $ldap_auth = $this->authRepository->ldapAuth($request);
            $ldap_auth['error_code'] = $authenticator['error_code'];
            return response()->json($ldap_auth, $ldap_auth['status_code']);
        }
        if($authenticator['status'] == "ok"){
            $result = new Parser($_SERVER['HTTP_USER_AGENT']);
            activity('user_login')
            ->causedBy($user)
            ->withProperties(
                [
                    [
                        'label' => "Device Type",
                        'key' => "user_device",
                        'old' => $result->device->type,
                        'new' => "",
                    ],
                    [
                        'label' => "Device OS",
                        'key' => "user_os",
                        'old' => $result->os->toString(),
                        'new' => "",
                    ],
                    [
                        'label' => "Browser",
                        'key' => "user_browser",
                        'old' => $result->browser->name . ' ' . $result->browser->version->toString(),
                        'new' => "",
                    ],
                    [
                        'label' => "User IP Address",
                        'key' => "user_ip",
                        'old' => $_SERVER['REMOTE_ADDR'],
                        'new' => "",
                    ],
                ]
            )
            ->log('User login');
            $this->authRepository->revokeExistingTokens($user);
            $token = $this->authRepository->getAccessToken($request->only('username', 'password'), $user); // with refresh token
            return response()->json($token);   
        }
        return response()->json($authenticator, $authenticator['status_code']);
    }

    public function adLogin(Request $request)
    {
        $ldap_auth = $this->authRepository->ldapAuth($request);
        return response()->json($ldap_auth, $ldap_auth['status_code']);
    }

    public function logout()
    {
        if(Auth::check()){
            $user = Auth::user();
            $result = new Parser($_SERVER['HTTP_USER_AGENT']);
            $this->authRepository->revokeExistingTokens($user);
            activity('user_logout')
            ->causedBy($user)
            ->withProperties(
                [
                    [
                        'label' => "Device Type",
                        'key' => "user_device",
                        'old' => $result->device->type,
                        'new' => "",
                    ],
                    [
                        'label' => "Device OS",
                        'key' => "user_os",
                        'old' => $result->os->toString(),
                        'new' => "",
                    ],
                    [
                        'label' => "Browser",
                        'key' => "user_browser",
                        'old' => $result->browser->name . ' ' . $result->browser->version->toString(),
                        'new' => "",
                    ],
                    [
                        'label' => "User IP Address",
                        'key' => "user_ip",
                        'old' => $_SERVER['REMOTE_ADDR'],
                        'new' => "",
                    ],
                ]
            )
            ->log('User logout');
        }
    }

    public function refreshToken(Request $request)
    {
        return $this->authRepository->refreshToken($request);
    }

}
 