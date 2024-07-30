<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutoresTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function criar()
    {
        $data = [
            'nome' => 'Bob Esponja Calça Quadrada',
            'data_nascimento' => '1999-10-01'
        ];

        $response = $this->postJson('/api/tests/autores/criar', $data);

        $response->assertStatus(201);
        $this->assertJson(json_encode(['nome' => 'Bob Esponja Calça Quadrada']));
    }

    /** @test */
    public function listar()
    {
        $data = [
            'nome' => 'Bob Esponja Calça Quadrada',
            'data_nascimento' => '1999-10-01'
        ];

        $response = $this->getJson('/api/tests/autores/listar', $data);

        $response->assertStatus(200);
        $this->assertJson(json_encode($data));
    }

    /** @test */
    public function atualizar()
    {
        $data = [
            'id' => '1',
            'nome' => 'Bob Esponja Calça Quadrada',
            'data_nascimento' => '1999-10-01'
        ];

        $response = $this->putJson('/api/tests/autores/atualizar/{id}', $data);

        $response->assertStatus(404);
        $this->assertJson(json_encode($data));
    }

    /** @test */
    public function atualizar_autor_inexistente()
    {
        $data = [
            'id' => '1',
            'nome' => 'Bob Esponja Calça Quadrada',
            'data_nascimento' => '1999-10-01'
        ];

        $response = $this->putJson('/api/tests/autores/atualizar/{id}', $data);

        $response->assertStatus(404);
        $this->assertJson(json_encode($data));
    }

    /** @test */
    public function deletar()
    {
        $data = [
            'id' => '1',
            'nome' => 'Bob Esponja Calça Quadrada',
            'data_nascimento' => '1999-10-01'
        ];

        $response = $this->deleteJson('/api/tests/autores/deletar/{id}', $data);

        $response->assertStatus(404);
        $this->assertJson(json_encode($data));
    }
}
