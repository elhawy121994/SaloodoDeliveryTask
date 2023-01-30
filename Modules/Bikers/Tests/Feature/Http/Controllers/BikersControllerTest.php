<?php

namespace Modules\Bikers\Tests\Feature\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Parcels\Entities\Parcel;
use Modules\Parcels\Exceptions\AlreadyPickedParcelException;
use Modules\Parcels\LookUps\ParcelStatusLookUp;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class BikersControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function testBikerAbleToSeeListOfParcels()
    {
        $parcels = Parcel::factory(20)->create();
        $user = User::where('email', 'biker@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $this->actingAs($user);
        $response = $this->getJson("api/v1/bikers/parcels/pick?token=$token");
        $response->assertJson(['meta' => ['current_page' => 1, 'per_page' => 15, 'total' => 20]]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'links',
                'meta'
            ]);
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(
            [
                "id" => $responseData['data'][0]['id'],
                "name" => $responseData['data'][0]['name'],
                "pick_up_address" => $responseData['data'][0]['pick_up_address'],
                "drop_off_address" => $responseData['data'][0]['drop_off_address'],
            ],
            [
                "id" => $parcels[0]->id,
                "name" => $parcels[0]->name,
                "pick_up_address" => $parcels[0]->pick_up_address,
                "drop_off_address" => $parcels[0]->drop_off_address,
            ]);
    }

    public function testPickParcel()
    {
        $parcel = Parcel::factory()->create();
        $user = User::where('email', 'biker@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $this->actingAs($user);
        $pickUpTime = Carbon::now()->format('Y-m-d H:i:s');
        $response = $this->patchJson("api/v1/bikers/parcels/pick/$parcel->id?token=$token", [
            'pick_up_at' => $pickUpTime
        ]);
        $response->assertStatus(202);
        $parcel = Parcel::find($parcel->id);

        $this->assertEquals($parcel->status, ParcelStatusLookUp::SHIPPED);
        $this->assertEquals($parcel->pickupDetails->pick_up_at, $pickUpTime);
    }

    public function testCanNotPickParcelAlreadyPicked()
    {
        $parcel = Parcel::factory()->create([
            'status' => ParcelStatusLookUp::SHIPPED
        ]);
        $user = User::where('email', 'biker@test.com')->first();
        $token = JWTAuth::fromUser($user);
        $this->actingAs($user);
        $response = $this->patchJson("api/v1/bikers/parcels/pick/$parcel->id?token=$token", [
            'pick_up_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $response->assertStatus(422);
        $response->assertJson(['message' => __('infrastructure::translate.NotAvailableAnyMore')]);
    }

    public function testDropOffParcel()
    {
        $parcel = Parcel::factory()->create(['status' => ParcelStatusLookUp::SHIPPED]);

        $user = User::where('email', 'biker@test.com')->first();

        $parcel->pickupDetails()->create([
            'biker_id' => $user->morph_user_id,
            'pick_up_at' => Carbon::now()->sub('1 hour')
        ]);

        $token = JWTAuth::fromUser($user);
        $this->actingAs($user);
        $pickUpTime = Carbon::now()->format('Y-m-d H:i:s');

        $response = $this->patchJson("api/v1/bikers/parcels/drop-off/$parcel->id?token=$token", [
            'delivered_at' => $pickUpTime
        ]);

        $response->assertStatus(202);
        $response->assertJson(['message' => 'Updated Successfully']);
        $parcel = Parcel::find($parcel->id);

        $this->assertEquals($parcel->status, ParcelStatusLookUp::DELIVERED);
        $this->assertEquals($parcel->pickupDetails->delivered_at, $pickUpTime);
    }
}
