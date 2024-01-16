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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('show_discord')->default(true);
            $table->boolean('show_email')->default(false);
            $table->string('email')->nullable();
            $table->boolean('show_twitter')->default(false);
            $table->string('twitter')->nullable();
            $table->boolean('show_reddit')->default(false);
            $table->string('reddit')->nullable();
            $table->boolean('show_telegram')->default(false);
            $table->string('telegram')->nullable();
            $table->boolean('show_other')->default(false);
            $table->string('other')->nullable();
            $table->boolean('show_pronouns')->default(false);
            $table->string('pronouns')->nullable();
            $table->boolean('show_location')->default(false);
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('show_website')->default(false);
            $table->string('website')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
