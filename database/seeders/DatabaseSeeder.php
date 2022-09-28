<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0942033019',
            'address' => 'Yorkeshire, Leeds',
            'gender' => 'male',
            'password' => Hash::make('admin301120'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '09989749300',
            'address' => 'Maine Road, Liverpool',
            'gender' => 'male',
            'password' => Hash::make('user301120'),
            'role' => 'user',
        ]);
    }
}
