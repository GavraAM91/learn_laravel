<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Gavra Maheswara',
            'username' => 'Gavra',
            'email' => 'gavramaheswara07@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        //get admin role
        $admin->assignRole('admin');

        $penulis = User::create([
            'name' => 'user1',
            'username' => 'user1',
            'email' => 'user1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        //get penulis role
        $penulis->assignRole('penulis');

        //create 5 user random (dummy data)
        // User::factory(5)->create();
    }
}
