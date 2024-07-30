<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLivroRequest;
use App\Models\Livro;
use App\Helpers\Helper;
use App\Services\AutoresLivrosService;

class LivrosController extends Controller
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Livro::class;

    /**
     * Array com os dados de retorno
     *
     * @var array
     */
    public $response = [];

    /**
     * Lista de livros
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/livros/listar
     */
    public function index()
    {
        try {
            if( $this->response = AutoresLivrosService::all() ) {

                return response()->json([
                    'success' => true,
                    'message' => 'Lista de livros.',
                    'response' => $this->response
                ], 201);
            }

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $this->response
            ], 500);
        }
    }

    /**
     * Cadastrar livros
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/livros/criar
     * {
     *    "titulo": "Bob Esponja surtando na fenda do bikini",
     *    "ano_publicacao": "2008",
     *    "autores_id": [
     *       "1",
     *       "2"
     *     ]
     * }
     */
    public function store(StoreLivroRequest $request)
    {
        try {
            $array = [
                'titulo' => $request->input('titulo'),
                'ano_publicacao' => $request->input('ano_publicacao'),
            ];

            // Busca livro
            $find = Helper::find($this->model, array('column' => 'titulo', 'value' => $request->input('titulo')));
            
            if( isset($find->id) )
            
                return response()->json([
                    'success' => true,
                    'message' => 'Livro já existe.',
                    'response' => $this->response
                ], 409);
            else
            if( $this->response = $this->model::create($array) )
            {
                $livros_id = $request->input('livros_id');

                // Cadastra os livros do livro
                if( !empty($livros_id) )
                    $this->response['livros'] = AutoresLivrosService::storeAutores($this->response->id, $livros_id);

                return response()->json([
                    'success' => true,
                    'message' => 'Livro criado com sucesso.',
                    'response' => $this->response
                ], 201);
            }

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $this->response
            ], 500);
        }
    }

    /**
     * Atualizar livros
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/livros/atualizar/2
     * {
     *    "titulo": "Bob Esponja surtando na fenda do bikini (Parte 2)",
     *    "ano_publicacao": "2010",
     *    "autores_id": [
     *       "1",
     *       "2"
     *       "3"
     *     ]
     * }
     */
    public function update(StoreLivroRequest $request, $id)
    {
        try {
            $array = [
                'titulo' => $request->input('titulo'),
                'ano_publicacao' => $request->input('ano_publicacao'),
            ];

            // Busca livro
            $find = Helper::find($this->model, array('column' => 'id', 'value' => $id));
            
            if( !isset($find->id) )
            
                return response()->json([
                    'success' => false,
                    'message' => 'Livro não encontrado.',
                    'response' => ''
                ], 404);
            
            // Atualiza o livro
            if( $find->update($array) )
            {
                $livros_id = $request->input('livros_id');

                // Busca livro
                $this->response = Helper::find($this->model, array('column' => 'id', 'value' => $id));

                // Cadastra os livros do livro
                if( !empty($livros_id) )
                    $this->response['livros'] = AutoresLivrosService::storeAutores($this->response->id, $livros_id);
            }

            return response()->json([
                'success' => true,
                'message' => 'Livro atualizado com sucesso.',
                'response' => $this->response
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $this->response
            ], 500);
        }
    }

    /**
     * Apagar livros
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/livros/deletar/2
     */
    public function destroy($id)
    {
        try {
            $find = Helper::find($this->model, array('column' => 'id', 'value' => $id));
            
            if( !isset($find->id) )

                return response()->json([
                    'success' => false,
                    'message' => 'Livro não encontrado.',
                    'response' => ''
                ], 404);

            if( $this->response = $find->delete() )

                return response()->json([
                    'success' => true,
                    'message' => 'Livro apagado com sucesso.',
                    'response' => $find
                ], 201);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $this->response
            ], 500);
        }
    }
}
