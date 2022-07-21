<?php

namespace App\Http\Controllers;

use App\Models\FirebaseToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirebaseTokenController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        FirebaseToken::where('user_id', $user->id)->delete();
        $token = FirebaseToken::create([
            'token' => $request->token,
            'user_id' => $user->id,
        ]);
        return $token;
    }
}
