<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->date('release_date');
            $table->integer('length');
            $table->longText('description');
            $table->string('mpaa_rating');
            $table->string('image')->nullable();

            $table->string('genre');
            $table->string('genre1')->nullable();
            $table->string('genre2')->nullable();

            $table->string('director');

            $table->string('performer');
            $table->string('performer1')->nullable();
            $table->string('performer2')->nullable();

            $table->string('language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
