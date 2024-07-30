<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmprestimoRequest;
use App\Models\User;
use App\Models\Livro;
use App\Models\Emprestimo;
use App\Helpers\Helper;
use App\Jobs\EnviarEmailJob;

class EmprestimosController extends Controller
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emprestimo::class;

    /**
     * Array com os dados de retorno
     *
     * @var array
     */
    public $response = [];

    /**
     * Lista de empréstimos
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/emprestimos/listar
     */
    public function index()
    {
        try {
            if( $response = $this->model::all() )

                return response()->json([
                    'success' => true,
                    'message' => 'Lista de empréstimos.',
                    'response' => $response
                ], 200);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $response
            ], 500);
        }
    }

    /**
     * Cadastrar empréstimo
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/emprestimo/registrar
     * {
	 *      "user_id": "1",
	 *      "livro_id": "2",
	 *      "data_emprestimo": "10/04/2024",
	 *      "data_devolucao": "10/06/2024",
	 *      "email": "cristianocarletti@gmail.com",
	 *      "nome": "Cristiano Carletti",
	 *      "mensagem": "Teste envio de notificação em fila"
     * }
     */
    public function store(StoreEmprestimoRequest $request)
    {
        try {
            // Busca usuário
            $find = Helper::find(new User, array('column' => 'id', 'value' => $request->input('user_id')));
            
            if( !isset($find->id) )
                
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não encontrado.',
                    'response' => ''
                ], 404);
              
            // Busca livro
            $find = Helper::find(new Livro, array('column' => 'id', 'value' => $request->input('livro_id')));
            
            if( !isset($find->id) )

                return response()->json([
                    'success' => false,
                    'message' => 'Livro não encontrado.',
                    'response' => ''
                ], 404);

            // Formata datas para banco
            $data_emprestimo = Helper::dateSlashToDash( $request->input('data_emprestimo') );
            $data_devolucao = Helper::dateSlashToDash( $request->input('data_devolucao') );

            $array = [
                'user_id' => $request->input('user_id'),
                'livro_id' => $request->input('livro_id'),
                'data_emprestimo' => $data_emprestimo,
                'data_devolucao' => $data_devolucao,
            ];
            
            if( $response = $this->model::create($array) )

                // Prepara dados para enviar email
                $details = [
                    'email' => $request->input('email'),
                    'nome' => $request->input('nome'),
                    'mensagem' => $request->input('mensagem')
                ];
        
                // Dispara email na fila
                EnviarEmailJob::dispatch($details);

                return response()->json([
                    'success' => true,
                    'message' => 'Empréstimo criado com sucesso.',
                    'response' => $response
                ], 201);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $response
            ], 500);
        }
    }
}
