<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAutorRequest;
use App\Models\Autor;
use App\Helpers\Helper;

class AutoresController extends Controller
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Autor::class;

    /**
     * Array com os dados de retorno
     *
     * @var array
     */
    public $response = [];

    /**
     * Lista de autores
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/autores/listar
     */
    public function index()
    {
        try {
            if( $response = $this->model::all() )

                return response()->json([
                    'success' => true,
                    'message' => 'Lista de autores.',
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
     * Cadastrar autores
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/autores/criar
     * {
     *    "nome": "Maria do Bairro",
     *    "data_nascimento": "07/05/2008"
     * }
     */
    public function store(StoreAutorRequest $request)
    {
        try {

            // Formata data para salvar no banco
            $data_nascimento = Helper::dateSlashToDash( $request->input('data_nascimento') );
            $array = [
                'nome' => $request->input('nome'),
                'data_nascimento' => $data_nascimento,
            ];

            // Busca autor
            $find = Helper::find($this->model, array('column' => 'nome', 'value' => $request->input('nome')));
            
            if( isset($find->id) )

                return response()->json([
                    'success' => true,
                    'message' => 'Autor já existe.',
                    'response' => $find
                ], 409);
            else
            if( $this->response = $this->model::create($array) )
            
                return response()->json([
                    'success' => true,
                    'message' => 'Autor criado com sucesso.',
                    'response' => $this->response
                ], 201);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $response
            ], 500);
        }
    }

    /**
     * Atualizar autores
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/autores/atualizar/2
     * {
     *    "nome": "Maria da Penha",
     *    "data_nascimento": "08/07/2009"
     * }
     */
    public function update(StoreAutorRequest $request, $id)
    {
        try {
            // Formata data para salvar no banco
            $data_nascimento = Helper::dateSlashToDash( $request->input('data_nascimento') );
            $array = [
                'nome' => $request->input('nome'),
                'data_nascimento' => $data_nascimento,
            ];

            // Busca autor
            $find = Helper::find($this->model, array('column' => 'id', 'value' => $id));
            
            if( !isset($find->id) )
                
                return response()->json([
                    'success' => false,
                    'message' => 'Autor não encontrado.',
                    'response' => ''
                ], 404);
            
            if( $find->update($array) )

                // Busca autor
                $response = $this->model::findOrFail($id);

                return response()->json([
                    'success' => true,
                    'message' => 'Autor atualizado com sucesso.',
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
     * Apagar autores
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @example /api/v1/autores/deletar/2
     */
    public function destroy($id)
    {
        try {
            // Busca autor
            $find = Helper::find($this->model, array('column' => 'id', 'value' => $id));
            
            if( !isset($find->id) )

                return response()->json([
                    'success' => false,
                    'message' => 'Autor não encontrado.',
                    'response' => ''
                ], 404);

            if( $response = $find->delete() )

                return response()->json([
                    'success' => true,
                    'message' => 'Autor apagado com sucesso.',
                    'response' => $find
                ], 204);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'response' => $response
            ], 500);
        }
    }
}
