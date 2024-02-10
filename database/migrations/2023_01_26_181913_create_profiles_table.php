<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('photo', 255)->nullable(); 
            $table->string('profession', 60)->nullable(); 
            $table->string('about', 255)->nullable(); 
            $table->string('twitter', 100)->nullable(); 
            $table->string('linkedin', 100)->nullable();
            $table->string('facebook', 100)->nullable();


            # Primera forma 
            $table->unsignedBigInteger('user_id')->unique(); # Para crear un entero grande sin signo y que sea único
            $table->foreign('user_id') # Para establecer la relación 
                ->references('id') # El campo de referencia
                ->on('users') # La tabla de referencia
                ->onDelete('cascade') # Método: si se elmina el usuario, se elimina el perfil
                ->onUpdate('cascade'); # Método

            # Segunda forma: usando convenciones
            # $table -> foreignId('user_id')->constrained(); # Es lo mismo que lo anterior pero más corta. 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
