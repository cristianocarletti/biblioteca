<?php

namespace App\Services;

use App\Models\AutoresLivros;
use App\Models\Livro;

class AutoresLivrosService 
{
    // Busca autores por livro
    public static function getAutoresByLivro($livro_id)
    {
        return \DB::table('livros as l')
            ->join('autores_livros as al', 'al.livro_id', '=', 'l.id')
            ->join('autores as a', 'a.id', '=', 'al.autores_id')
            ->select('a.id', 'a.nome')
            ->where('l.id', $livro_id)
            ->get()
            ->toArray();
    }

    // Busca todos os livros com os autores por livro
    public static function all()
    {
        $autoresLivros = [];
        $livros =  Livro::all();
        
        foreach($livros as $livro) {
            
            $autoresLivros[$livro->id]['livro']['id'] = $livro->id;
            $autoresLivros[$livro->id]['livro']['titulo'] = $livro->titulo;
            $autoresLivros[$livro->id]['livro']['ano_publicacao'] = $livro->ano_publicacao;

            $autores = null;
            $autores = self::getAutoresByLivro($livro->id);
            $autoresLivros[$livro->id]['livro']['autores'] = [];

            if( isset($autores[0]) && !empty($autores[0]) ) { 
              
                foreach($autores as $autor) {
                    $autoresLivros[$livro->id]['livro']['autores'][$autor->id]['id'] = $autor->id;
                    $autoresLivros[$livro->id]['livro']['autores'][$autor->id]['nome'] = $autor->nome;
                }
            } 
        }

        return $autoresLivros;
    }

    // Cadastra os livros com autores
    public static function store($livro_id, $autores_id)
    {
        if( !empty($livro_id) && !empty($autores_id) )

            foreach($autores_id as $autor_id)

                // Cadastra os autores do livro
                AutoresLivros::create(['autores_id' => $autor_id, 'livro_id' => $livro_id]);
    }

    // Apaga os livros com autores por livro
    public static function delete($livro_id)
    {
        if( !empty($livro_id) )

            // Apaga os autores do livros
            return AutoresLivros::where('livro_id', $livro_id)->delete();
    }

    // Atualiza autores por livro e retona os autores
    public static function storeAutores($livro_id, $autores_id)
    {
        $autores = [];

        if( !empty($livro_id) && !empty($autores_id) ) {
                    
            // Apaga os autores do livros
            AutoresLivrosService::delete($livro_id);

            // Cadastra autores
            AutoresLivrosService::store($livro_id, $autores_id);

            // busca e retorna os autores do livro
            $autores = AutoresLivrosService::getAutoresByLivro($livro_id);
        }

        return $autores;
    }
}