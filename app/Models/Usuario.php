<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = "tbUsuario";

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'telefone',
        'cpf',
        'tipoConta',
        'imagemPerfil',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'aniversario',
        'cnh',
        'cnpj',
        'nomeCompania',
        'bio'
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'aniversario' => 'date',
    ];
}
