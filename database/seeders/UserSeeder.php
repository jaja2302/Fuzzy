<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Liza',
            'email' => 'liza@example.com',
            'username' => 'liza',
            'password' => Hash::make('1234'),
        ]);
        
        $this->command->info('User Liza berhasil dibuat dengan password: 1234');
    }
}
