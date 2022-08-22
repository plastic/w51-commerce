<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoNewsletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_newsletter', function (Blueprint $table) {
            $table->id();
            $table->string('tx_pagina', 255)->nullable();
            $table->string('name')->default(NULL);
            $table->string('email')->unique();
            $table->datetime('dh_cadastro');
            $table->datetime('dh_validacao_email');
            $table->boolean('sincronizado')->default(false);
            $table->enum('st_ativo',['ATIVO', 'INATIVO', 'EXCLUIDO'])->default('INATIVO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('co_newsletter');
    }
}
