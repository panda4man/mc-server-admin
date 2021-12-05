<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'     => 'Andrew Clinton',
                'email'    => 'ddrew.clinton@gmail.com',
                'password' => bcrypt('secret')
            ]
        ];

        collect($users)->each(function ($config) {
            User::firstOrCreate(['email' => $config['email']], $config);
        });
    }
}
