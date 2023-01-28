<?php

namespace Modules\Parcels\Tests\Feature\Http\Controllers;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ParcelsControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function testCreateParcelSuccessfully()
    {
        $user = User::where('email', 'sender@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $this->actingAs($user);
        $response = $this->postJson("api/v1/parcels?token=$token", [
            "name" => "Iphone 14 pro max",
            "pick_up_address" => "aswan",
            "drop_off_address" => "cairo"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                "name" => "Iphone 14 pro max",
                "pick_up_address" => "aswan",
                "drop_off_address" => "cairo"
            ]
        ]);
    }

    public function testCreateParcelWithInvalidRequest()
    {
        $user = User::where('email', 'sender@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $this->actingAs($user);
        $response = $this->postJson("api/v1/parcels?token=$token", [
            "drop_off_address" => "cairo"
        ]);
        $response->assertStatus(422);
    }
}
