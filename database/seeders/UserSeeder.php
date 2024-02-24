<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Giovanni',
            'email'    => 'giovanni@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');

        User::factory(50)->create();
    }
}
