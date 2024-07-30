<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Emprestimo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmprestimosTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function registrar()
    {
        $data = [
            'user_id' => '1',
            'livro_id' => '1',
            'data_emprestimo' => date('Y-m-d'),
            'data_devolucao' => date("Y-m-d", strtotime(date('Y-m-d')." +1 month")),
            'nome' => 'Bob Esponja Calça Quadrada',
            'email' => 'bob@esponja.com',
            'mensagem' => 'surtando na fenda do bikini',
        ];

        $response = $this->postJson('/api/tests/emprestimos/registrar', $data);

        $response->assertStatus(201);
        $this->assertJson(json_encode(['user_id' => '1', 'livro_id' => '1']));
    }

    /** @test */
    public function listar()
    {
        $data = [
            'user_id' => '1',
            'livro_id' => '1',
            'data_emprestimo' => date('Y-m-d'),
            'data_devolucao' => date("Y-m-d", strtotime(date('Y-m-d')." +1 month")),
            'nome' => 'Bob Esponja Calça Quadrada',
            'email' => 'bob@esponja.com',
            'mensagem' => 'surtando na fenda do bikini',
        ];

        $response = $this->getJson('/api/tests/emprestimos/listar', $data);

        $response->assertStatus(200);
        $this->assertJson(json_encode($data));
    }
}
