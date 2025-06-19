<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Hammam Admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Hammam Approver',
                'email' => 'approver@example.com',
                'role' => 'approver',
                'password' => bcrypt('password123'),
            ],
        ];

        foreach ($userData as $data) {
            User::create($data);
        }
    }
}
