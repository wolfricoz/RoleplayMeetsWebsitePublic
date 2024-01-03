<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['user', 'patron', 'moderator', 'admin'];
        foreach ($roles as $role) {
        try {

                Role::create(['name' => $role]);

        } catch (\Throwable $th) {

        }
        }

        $user = User::find(188647277181665280);
        $user->assignRole('admin');

        $role = Role::findByName('admin');
        $role->givePermissionTo(Permission::all());
    }
}
