<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@dinamika.ac.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'bio' => 'Administrator DINAMIKA Forum',
        ]);

        // Create test user
        User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'user@dinamika.ac.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'bio' => 'Mahasiswa Teknik Informatika',
        ]);

        // Create additional test users
        User::factory(10)->create();
    }
}
