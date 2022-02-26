<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use \Illuminate\Support\Facades\Log;

class AuthTest extends TestCase
{

    public function testRegister()
    {
        $response = $this->json('POST', '/api/register', [
            'name'  =>  $name = 'Test',
            'email'  =>  $email = 'test@example.com',
            'password'  =>  $password = '123456789',
        ]);

        //Write the response in laravel.log
        Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    public function testLogin()
    {

        // Simulated landing
        $response = $this->json('POST', 'api/login', [
            'email' => 'test@example.com',
            'password'  =>   '123456789',
        ]);

        //Write the response in laravel.log
        Log::info(1, [$response->getContent()]);

        // Determine whether the login is successful and receive token 
        $response->assertStatus(200);

        $this->assertArrayHasKey('token', $response->json());
        
    }

}
