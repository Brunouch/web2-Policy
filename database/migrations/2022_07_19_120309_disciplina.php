<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Disciplina extends Migration
{
    
    public function up()
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('carga');
            $table->unsignedBigInteger('curso_id')
            ->references('id')->on('cursos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        
        Schema::dropIfExists('disciplinas');
    }
}
