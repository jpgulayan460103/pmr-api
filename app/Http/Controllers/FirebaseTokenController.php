<?php

namespace App\Http\Controllers;

use App\Models\FirebaseToken;
use App\Models\User;
use App\Repositories\FirebaseTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $tokens = $this->firebaseTokenRepository->filterUserByOffice(202);
        // return $tokens;

        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = [
            'registration_ids' => $tokens,
            'data' => [
                'title' => 'Pending Forms',
                'body' => 'A new type of form has been forwarded to your office.',
                'icon' => 'push.png',
                'click_action' => 'https://example.com',
            ],
        ];
        $fields = json_encode ( $fields );
    
        $headers = array (
                'Authorization: key=' . config('services.firebase.cloud_messaging_api'),
                'Content-Type: application/json'
        );
    
        $ch = curl_init ();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
        $result = curl_exec ( $ch );
        echo $result;
        curl_close ( $ch );
    }
}
