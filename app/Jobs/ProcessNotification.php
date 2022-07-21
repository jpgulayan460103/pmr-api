<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message;
    public $receivers;
    public $notification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    public function __construct($message, $receivers, $notification)
    {
        $this->message = [
            "message" => "asdasdasd"
        ];
        $this->receivers = $receivers;
        $this->notification = [
            'title' => '1',
            'body' => 'Test Push',
            'icon' => 'push.png',
            'click_action' => 'https://example.com',
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = [
            'registration_ids' => $this->receivers,
            'data' => $this->message,
            'notification' => $this->notification,
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
    
        $result = curl_exec($ch);
        echo $result;
        curl_close ( $ch );
    }
}
