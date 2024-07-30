<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $table = 'emprestimos';

    protected $fillable = [
        'user_id',
        'livro_id',
        'data_emprestimo',
        'data_devolucao',
    ];

    public function usuario()
    {
        return $this->haOne(Usuario::class);
    }

    public function livro()
    {
        return $this->haOne(Livro::class);
    }
}
