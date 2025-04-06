<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'superadmin@superadmin.com', // Change this to any email you'd like
            'name' => 'SuperAdmin',
            'password' => Hash::make('11111111'),
            'role_id' => 1
        ]);
    }
}
