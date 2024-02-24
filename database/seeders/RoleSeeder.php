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

        Permission::create(['name' => 'admin.index',
                            'description' => 'Ver administrador'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.roles.index',
                            'description' => 'Ver roles'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.create',
                            'description' => 'Crear roles'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.edit',
                            'description' => 'Editar roles'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.delete',
                            'description' => 'Eliminar roles'])->assignRole($role1);

        Permission::create(['name' => 'admin.users.index',
                            'description' => 'Ver ususarios'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit',
                            'description' => 'Añadir roles a usuarios'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.delete',
                            'description' => 'Eliminar usuarios'])->assignRole($role1);

        Permission::create(['name' => 'admin.categories.index',
                            'description' => 'Ver categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create',
                            'description' => 'Crear categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.edit',
                            'description' => 'Editar categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.delete',
                            'description' => 'eliminar categorías'])->assignRole($role1);

        Permission::create(['name' => 'admin.tags.index',
                            'description' => 'Ver etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.create',
                            'description' => 'Crear etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.edit',
                            'description' => 'Editar etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.delete',
                            'description' => 'Eliminar etiquetas'])->assignRole($role1);

        Permission::create(['name' => 'admin.posts.index',
                            'description' => 'Ver posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create',
                            'description' => 'Crear posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit',
                            'description' => 'Editar posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.status',
                            'description' => 'Validar posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.delete',
                            'description' => 'Eliminar posts'])->assignRole($role1);
    }
}
