<?php

namespace App\Http\Controllers;

use App\Models\FirebaseToken;
use App\Models\User;
use App\Repositories\ActivityLogBatchRepository;
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
            (new ActivityLogBatchRepository())->startBatch();
            activity('user_login')
            ->causedBy($user)
            ->withProperties(
                [
                    "attributes" => [
                        'user_device' => $result->device->type,
                        'user_os' => $result->os->toString(),
                        'user_browser' => $result->browser->name . ' ' . $result->browser->version->toString(),
                        'user_ip' => $_SERVER['REMOTE_ADDR'],
                    ]
                ]
            )
            ->log('User login');
            (new ActivityLogBatchRepository())->endCustomBatch('user_login', $user);
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
            
            (new ActivityLogBatchRepository())->startBatch();
            activity('user_logout')
            ->causedBy($user)
            ->withProperties(
                [
                    "attributes" => [
                        'user_device' => $result->device->type,
                        'user_os' => $result->os->toString(),
                        'user_browser' => $result->browser->name . ' ' . $result->browser->version->toString(),
                        'user_ip' => $_SERVER['REMOTE_ADDR'],
                    ]
                ]
            )
            ->log('User logout');
            (new ActivityLogBatchRepository())->endCustomBatch('user_logout', $user);
            $this->authRepository->revokeExistingTokens($user);
            FirebaseToken::where('user_id', $user->id)->delete();
        }
    }

    public function refreshToken(Request $request)
    {
        return $this->authRepository->refreshToken($request);
    }

}
 