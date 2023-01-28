<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Bikers\Entities\Biker;
use Modules\Senders\Entities\Sender;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $senders = Sender::factory(5)->create();
        $bikers = Biker::factory(10)->create();
        User::factory()->create([
            'morph_user_type' => Sender::class,
            'morph_user_id' => $senders[0]->id,
            'email' => 'sender@test.com'
        ]);

        User::factory()->create([
            'morph_user_type' => Biker::class,
            'morph_user_id' => $bikers[0]->id,
            'email' => 'biker@test.com'
        ]);
        for($i = 1; $i < 5; $i++) {
            User::factory()->create([
                'morph_user_type' => Sender::class,
                'morph_user_id' => $senders[$i]->id,
                'email' => 'sender_'.$i.'@test.com'
            ]);
        }
        for($i = 1; $i < 10; $i++) {
            User::factory()->create([
                'morph_user_type' => Biker::class,
                'morph_user_id' => $bikers[$i]->id,
                'email' => 'biker_'.$i.'@test.com'
            ]);
        }
    }
}
