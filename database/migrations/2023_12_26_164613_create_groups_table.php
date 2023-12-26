<?php

use App\Models\groups;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->unique();
            $table->boolean('access_dashboard')->default(false);
            $table->boolean('manage_posts')->default(false);
            $table->boolean('manage_users')->default(false);
            $table->boolean('manage_rules')->default(false);
            $table->boolean('manage_genres')->default(false);
            $table->boolean('manage_groups')->default(false);
            $table->boolean('manage_roles')->default(false);
            $table->boolean('is_patron')->default(false);


        });
        groups::create([
            'name' => 'default',
            'access_dashboard' => false,
            'manage_posts' => false,
            'manage_users' => false,
            'manage_rules' => false,
            'manage_genres' => false,
            'manage_groups' => false,
            'manage_roles' => false,
            'is_patron' => false,
        ]);
        groups::create([
            'name' => 'Admin',
            'access_dashboard' => true,
            'manage_posts' => true,
            'manage_users' => true,
            'manage_rules' => true,
            'manage_genres' => true,
            'manage_groups' => true,
            'manage_roles' => true,
            'is_patron' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
