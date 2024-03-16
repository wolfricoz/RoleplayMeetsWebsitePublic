<?php

use App\Models\Settings;
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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('nsfw', 255)->default('sfw')->change();
            foreach (Settings::all() as $setting) {
                $setting->nsfw = 'sfw';
                $setting->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('nsfw', 255)->default(false)->change();
            foreach (Settings::all() as $setting) {
                $setting->nsfw = false;
                $setting->save();
            }
        });
    }
};
