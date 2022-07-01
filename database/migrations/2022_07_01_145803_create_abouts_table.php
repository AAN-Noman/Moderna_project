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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('line')->nullable();
            $table->string('line2')->nullable();
            $table->string('line3')->nullable();
            $table->longText('description2')->nullable();
            $table->text('photo')->nullable();
            $table->integer('fact')->nullable();
            $table->integer('fact2')->nullable();
            $table->integer('fact3')->nullable();
            $table->integer('fact4')->nullable();
            $table->integer('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('abouts');
    }
};
