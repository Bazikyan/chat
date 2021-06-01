<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(4)->create();

        $users = User::all()->modelKeys();

        $time = now();
        for ($i = 0; $i < 500; $i++, $time->addSecond()) {
            shuffle($users);

            Message::create([
                'message' => Factory::create()->text(20),
                'from_id' => $users[0],
                'to_id' => $users[1],
                'created_at' => $time,
                'updated_at' => $time,
            ]);

            if ($i % 10 === 0) {
                dump($i);
            }
        }
    }
}
