<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoresLivros extends Model
{
    use HasFactory;

    protected $table = 'autores_livros';

    protected $fillable = [
        'autores_id',
        'livro_id',
    ];
}
