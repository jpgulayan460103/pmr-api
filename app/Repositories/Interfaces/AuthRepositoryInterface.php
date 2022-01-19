<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface AuthRepositoryInterface{    
    public function revoke_existing_tokens(User $user);
    public function authenticate(Request $request, $user);
    public function ldap_auth(Request $request);
    public function getAccessToken($credentials, User $user);
    public function refreshToken(Request $request);
}