<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    public $days_hr = ['Pon', 'Uto', 'Sri', 'Čet', 'Pet', 'Sub', 'Ned'];
    public $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December'];

    public function run()
    {
        \App\User::create([
            'name' => 'Kiki',
            'email' => 'kristijan.jurcic@tempusmedia.hr',
            'email_verified_at' => now(),
            'password' => bcrypt('1q2w3e4r5t'),
            'remember_token' => str_random(10),
            'role' => 'admin'
        ]);

        \App\User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('koloDVOR123'),
            'remember_token' => str_random(10),
            'role' => 'admin'
        ]);

        \App\User::create([
            'name' => 'ante',
            'email' => 'ante@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('koloDVOR123'),
            'remember_token' => str_random(10),
            'role' => 'admin'
        ]);

        \App\User::create([
            'name' => 'tablet',
            'email' => 'tablet@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('koloDVOR123'),
            'remember_token' => str_random(10),
            'role' => 'admin'
        ]);

        for($i = 0; $i < 7; $i++){
            \App\Days::create([
                 'day' => $this->days[$i],
                 'day_hr' => $this->days_hr[$i]
                 ]);
        }

        foreach ($this->months as $month) {
            \App\Months::create([
                'month' => $month
            ]);
        }


        //factory(\App\Arrival::class, 10)->create();
        //factory(\App\Departure::class, 10)->create();

        //$this->call(UsersTableSeeder::class);

    }
}
