<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Moderator']);

        Permission::create(['name' => 'admin.index'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);;
        Permission::create(['name' => 'admin.users.delete'])->assignRole($role1);

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.categories.delete'])->assignRole($role1);

        Permission::create(['name' => 'admin.tags.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.tags.delete'])->assignRole($role1);

        Permission::create(['name' => 'admin.posts.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.status'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.delete'])->assignRole($role1);
    }
}
