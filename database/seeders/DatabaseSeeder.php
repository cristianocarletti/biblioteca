<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'name' => 'Super Usuário',
            'email' => 'super@usuario.com',
            'email_verified_at' => date('Y-m-d'),
            'password' => Hash::make('12345678'), // Password is hashed here
            'super' => true,
            'remember_token' => Str::random(10),
        ];

        $user = User::factory()->create($array);
    }
}
