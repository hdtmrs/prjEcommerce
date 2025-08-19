<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbUsuario', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('senha');

            $table->string('telefone')->nullable();
            $table->string('cpf')->unique();
            $table->enum('tipoConta', ['buyer','seller','both'])->default('buyer');
            $table->string('imagemPerfil')->nullable();

            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('cep')->nullable();

            $table->date('aniversario')->nullable();
            $table->string('cnh')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('nomeCompania')->nullable();
            $table->text('bio')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbUsuario');
    }
};
