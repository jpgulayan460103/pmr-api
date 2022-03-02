<?php

namespace Tests\Feature;

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
    public function test_purchase_request()
    {
        $user = User::with('user_offices.office')->where('username','budget')->first();
        Passport::actingAs($user);
        Storage::fake('avatars');
 
        $file = UploadedFile::fake()->image('avatar.jpg');
 
        $response = $this->post('/api/forms/uploads/purchase-request', [
            'avatar' => $file,
        ]);

        // $response->assertStatus(200);
 
        Storage::disk('avatars')->assertExists($file->hashName());
    }
}
//avatars/KCa3fObkSknsd87sN0NbDRrceXH5i0SOQpkhFJ0k.jpg
//avatars/KCa3fObkSknsd87sN0NbDRrceXH5i0SOQpkhFJ0k.jp