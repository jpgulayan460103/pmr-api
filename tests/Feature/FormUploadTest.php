<?php

namespace Tests\Feature;

use App\Models\FormUpload;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class FormUploadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_purchase_request()
    {
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        Storage::fake('tests');
 
        $file = UploadedFile::fake()->image('avatar.jpg');
 
        $response = $this->post('/api/forms/uploads/purchase_request/1', [
            'file' => $file,
            'meta' => [
                'description' => 'test file'
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_purchase_request()
    {
        $uploaded = FormUpload::first();
        $user = User::with('user_offices.office')->where('username','ict')->first();
        Passport::actingAs($user);
        $response = $this->delete('/api/forms/uploads/purchase_request/'.$uploaded->id);
        $response->assertStatus(200);
    }
}