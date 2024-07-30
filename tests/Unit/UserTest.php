<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $faker = Factory::create();

        $password = Hash::make('12345678');
        $email = Str::uuid().'.'.$faker->safeEmail;
        
        $data = [
            'name' => 'Bob Esponja Calça Quadrada',
            'email' => 'bob@esponja.com',
            'email_verified_at' => date('Y-m-d'),
            'password' => $password,
            'password_confirmation' => $password,
            'super' => false,
            'remember_token' => Str::random(10),
        ];
        
        $user = User::create($data)->toArray();
   
        unset($user['id']);
        $user['password'] = $password;
        $user['password_confirmation'] = $password;
        //dd($user);
        
        $response = $this->postJson('/api/tests/registrar', $data);

        $response->assertStatus(201);
        $this->assertJson(json_encode(['name' => 'Bob Esponja Calça Quadrada']));
    }
}
