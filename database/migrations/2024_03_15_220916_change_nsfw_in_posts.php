<?php

use App\Models\Post;
use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->string('nsfw', 255)->change()->default('sfw');

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
