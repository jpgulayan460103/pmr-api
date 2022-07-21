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

        $tokens = $this->firebaseTokenRepository->filterUserByOffice(116);
        // return $tokens;

        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = [
            'registration_ids' => $tokens,
            'data' => [
                'message' => 'asdasd'
            ],
            'notification' => [
                'title' => '1',
                'body' => 'Test Push',
                'icon' => 'push.png',
                'click_action' => 'https://example.com',
            ],
        ];
        $fields = json_encode ( $fields );
    
        $headers = array (
                'Authorization: key=' . "AAAA1Xi__98:APA91bFinn-gbyJBe6cRXkbzfFoIF4q2mF7hepr2XMymytRMZB_AOpE1HVDCghP1Ta-a3W0bUGGaQyQHqO49Sk-3lxQJQ_OksJODbqMaImcsNZNzNPH3PxYO1gMAPjngOovXlS3D8efs",
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
