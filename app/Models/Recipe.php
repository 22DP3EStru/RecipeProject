<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
}
public function up()
{
    Schema::create('recipes', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->text('ingredients');
        $table->text('instructions');
        $table->unsignedBigInteger('user_id');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}