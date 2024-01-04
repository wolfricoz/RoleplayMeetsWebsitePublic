<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['access_dashboard', 'manage_posts', 'manage_users', 'manage_rules', 'manage_genres', 'manage_groups', 'manage_roles', 'manage_settings', 'is_patron', 'create_posts', 'edit_posts', 'delete_posts'];
        foreach ($permissions as $permission) {
            if (Permission::where('name', '=', $permission)->exists()) {
                continue;
            }
            Permission::create(['name' => $permission]);
            Role::findByName('Admin')->givePermissionTo($permission);
        }
    }
}
