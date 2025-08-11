<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model


{
    protected $table = 'tbCars';
    public $timestamps = true;
    
    protected $fillable = [
        'titulo',
        'marca', 
        'modelo', 
        'ano',
        'condicao', 
        'quilometragem', 
        'preco',
        'descricao', 
        'imagem'
    ];
}
