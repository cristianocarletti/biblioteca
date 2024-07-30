<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LivrosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function criar()
    {
        $data = [
            'titulo' => 'Socorro, o Bob Esponja enlouqueceu',
            'ano_publicacao' => '2003'
        ];

        $response = $this->postJson('/api/tests/livros/criar', $data);

        $response->assertStatus(201);
        $this->assertJson(json_encode(['titulo' => 'Socorro, o Bob Esponja enlouqueceu']));
    }

    /** @test */
    public function listar()
    {
        $data = [
            'titulo' => 'Socorro, o Bob Esponja enlouqueceu',
            'ano_publicacao' => '2003'
        ];

        $response = $this->getJson('/api/tests/livros/listar', $data);

        $response->assertStatus(200);
        $this->assertJson(json_encode($data));
    }

    /** @test */
    public function atualizar()
    {
        $data = [
            'id' => '1',
            'titulo' => 'Socorro, o Bob Esponja enlouqueceu',
            'ano_publicacao' => '2003'
        ];

        $response = $this->putJson('/api/tests/livros/atualizar/{id}', $data);

        $response->assertStatus(404);
        $this->assertJson(json_encode($data));
    }

    /** @test */
    public function atualizar_livro_inexistente()
    {
        $data = [
            'id' => '1',
            'titulo' => 'Socorro, o Bob Esponja enlouqueceu',
            'ano_publicacao' => '2003'
        ];

        $response = $this->putJson('/api/tests/livros/atualizar/{id}', $data);

        $response->assertStatus(404);
        $this->assertJson(json_encode($data));
    }

    /** @test */
    public function deletar()
    {
        $data = [
            'id' => '1',
            'titulo' => 'Socorro, o Bob Esponja enlouqueceu',
            'ano_publicacao' => '2003'
        ];

        $response = $this->deleteJson('/api/tests/livros/deletar/{id}', $data);

        $response->assertStatus(404);
        $this->assertJson(json_encode($data));
    }
}
