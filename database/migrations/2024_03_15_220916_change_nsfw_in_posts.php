<?php

use App\Models\Post;
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
        Schema::table('posts', function (Blueprint $table) {
          $table->string('nsfw', 255)->change()->default('sfw');
          foreach (Post::all() as $post) {
              $post->nsfw = 'sfw';
              $post->save();
          }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('nsfw', 255)->change()->default(false);
            foreach (Post::all() as $post) {
                $post->nsfw = false;
                $post->save();
            }
        });
    }
};
