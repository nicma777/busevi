<?php

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
        \App\User::create([
            'name' => 'Kiki',
            'email' => 'kristijan.jurcic@tempusmedia.hr',
            'email_verified_at' => now(),
            'password' => bcrypt('1q2w3e4r5t'),
            'remember_token' => str_random(10),
        ]);

     factory(\App\Arrival::class, 200)->create();
 factory(\App\Departure::class, 200)->create();

       //$this->call(UsersTableSeeder::class);

    }
}
