<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'level' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0822777777',
            'address' => 'Kampung Jawa',
            'division_id' => 1,
            'photo' => 'default.jpg',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name' => 'Song Kang',
            'level' => 'kepala_kantor',
            'email' => 'songkang@gmail.com',
            'phone' => '082277123456',
            'address' => 'Kampung Jawa Depan',
            'division_id' => 2,
            'photo' => 'default.jpg',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
        ]);
    }
}
