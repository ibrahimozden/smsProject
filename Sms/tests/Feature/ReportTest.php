<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Report;
use App\Models\User;
use \Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReportTest extends TestCase
{
    /**
     * Authenticate user.
     *
     * @return void
     */
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
        Log::info(2, [$response->getContent()]);

        // Determine whether the login is successful and receive token 
        $response->assertStatus(200);

        $this->assertArrayHasKey('token', $response->json());
        
        return JWTAuth::parseToken()->testLogin();
        
    }

    /**
     * test create sms.
     *
     * @return void
     */
    public function test_create_sms()
    {
        $token = $this->testLogin();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/reports', [
            'number' => 'Test report',
            'message' => 'test-sku',

        ]);

        //Write the response in laravel.log
        Log::info(3, [$response->getContent()]);

        $response->assertStatus(200);
    }


    /**
     * test find report.
     *
     * @return void
     */
    /*public function test_find_report()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/reports/9');

        //Write the response in laravel.log
        Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }*/

    /**
     * test get all reports.
     *
     * @return void
     */
    /*public function test_get_all_report()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/reports');

        //Write the response in laravel.log
        Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    } */

    /**
     * test delete reports.
     *
     * @return void
     */
    /*public function test_delete_report()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('DELETE', 'api/delete/7');

        //Write the response in laravel.log
        Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }*/
}
