<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Post::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $roles = ['User', 'Patron', 'Moderator', 'Admin'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        $permissions = ['access_dashboard', 'manage_posts', 'manage_users', 'manage_rules', 'manage_genres', 'manage_groups', 'manage_roles', 'manage_settings', 'is_patron'];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role = Role::findByName('Admin');
        $role->givePermissionTo(Permission::all());
    }
}
