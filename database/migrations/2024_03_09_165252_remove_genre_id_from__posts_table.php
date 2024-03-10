<?php

use App\Models\Genres;
use App\Models\Post;
use App\Models\Tags;
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
      foreach (Post::all() as $post) {
        Tags::create([
          'name' => Genres::find($post->genre_id)->name,
          'post_id' => $post->id,
          'genre_id' => $post->genre_id
        ]);

      }
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->foreignId('genre_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
        });
    }
};
