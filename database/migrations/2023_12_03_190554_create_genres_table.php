<?php

use App\Models\Genres;
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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
        });
        $genres = [
            'Action',
            'Adventure',
            'Comedy',
            'Crime',
            'Drama',
            'Fantasy',
            'Historical',
            'Historical fiction',
            'Horror',
            'Magical realism',
            'Mystery',
            'Paranoid fiction',
            'Philosophical',
            'Political',
            'Romance',
            'Saga',
            'Satire',
            'Science fiction',
            'Social',
            'Speculative',
            'Thriller',
            'Urban',
            'Western',
            'None'
        ];
        foreach ($genres as $genre) {
            Genres::create([
                'name' => $genre,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
