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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('value'); 
            $table->string('description', 255); 
            
            # Relación con User
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); 

            # Relación con Artículo
            $table->unsignedBigInteger('article_id'); 
            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->onDelete('cascade'); 

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
        Schema::dropIfExists('comments');
    }
};
