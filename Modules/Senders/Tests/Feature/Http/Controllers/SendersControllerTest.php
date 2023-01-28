<?php

namespace Modules\Senders\Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Parcels\Entities\Parcel;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class SendersControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testSenderAbleToSeeParcel()
    {
        $parcel = Parcel::factory()->create();
        $user = User::where('email', 'sender@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $this->actingAs($user);
        $response = $this->getJson("api/v1/senders/parcels/1?token=$token");
        $response->assertStatus(202);
        $response->assertJson([
            "id" => $parcel->id,
            "name" => $parcel->name,
            "pick_up_address" => $parcel->pick_up_address,
            "drop_off_address" => $parcel->drop_off_address,
            "status" => $parcel->status,
        ]);
    }
}
