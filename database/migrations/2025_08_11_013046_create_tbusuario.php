<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbUsuario', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('senha');

            // Campos recomendados
            $table->string('phone')->nullable();
            $table->string('cpf')->unique();
            $table->enum('type_account', ['buyer','seller','both'])->default('buyer');
            $table->string('profile_image')->nullable();

            // Endereço (opcional)
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('cep')->nullable();

            // Outros opcionais
            $table->date('birthdate')->nullable();
            $table->string('cnh')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('company_name')->nullable();
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
