<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@inventory.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin12345!'),
                'role' => 'Admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'owner@inventory.test'],
            [
                'name' => 'Owner',
                'password' => Hash::make('Owner12345!'),
                'role' => 'Owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@inventory.test'],
            [
                'name' => 'Staff',
                'password' => Hash::make('Staff12345!'),
                'role' => 'Staff',
            ]
        );
    }
}
