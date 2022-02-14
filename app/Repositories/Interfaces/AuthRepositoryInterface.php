<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface AuthRepositoryInterface{    
    public function revokeExistingTokens(User $user);
    public function authenticate(Request $request, $user);
    public function ldapAuth(Request $request);
    public function getAccessToken($credentials, User $user);
    public function refreshToken(Request $request);
}