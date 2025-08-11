<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbCars', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('ano');
            $table->enum('condicao', ['new','used'])->default('used');
            $table->integer('quilometragem')->nullable();
            $table->decimal('preco', 12, 2);
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbCars');
    }
};
