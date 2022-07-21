<?php

namespace App\Http\Controllers;

use App\Models\FirebaseToken;
use App\Repositories\FirebaseTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirebaseTokenController extends Controller
{

    private $firebaseTokenRepository;

    public function __construct(FirebaseTokenRepository $firebaseTokenRepository)
    {
        // $this->middleware('auth:api');
        $this->firebaseTokenRepository = $firebaseTokenRepository;    
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $this->firebaseTokenRepository->deleteUserTokens($user->id);
        $token = $this->firebaseTokenRepository->create([
            'token' => $request->token,
            'user_id' => $user->id,
        ]);
        return $token;
    }

    public function test(Request $request)
    {
        return $this->firebaseTokenRepository->filterUserByOffice(116);
    }
}
