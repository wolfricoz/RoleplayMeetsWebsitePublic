<?php

use App\Models\Post;
use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      foreach (Post::all() as $post) {
        $post->nsfw = 'sfw';
        $post->save();
      }
      foreach (Settings::all() as $setting) {
        $setting->nsfw = 'sfw';
        $setting->save();
      }
      Permission::create(['name' => 'bypass_auto_mod']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
