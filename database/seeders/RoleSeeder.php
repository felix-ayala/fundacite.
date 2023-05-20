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
        $rol_admin =Role::create([
                        'name' => 'Administrador'
                    ]);
        
        $rol_user  =Role::create([
                        'name' => 'Transcriptor'
                    ]);

        Permission::create([
            'name' => 'home',
            'description' => 'Ver dashboard'
        ])->syncRoles([$rol_admin,$rol_user]);

        // MODULO DE USUARIOS
        Permission::create([
            'name' => 'users.index',
            'description' => 'Ver Listado de Usuarios'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'users.edit',
            'description' => 'Editar Usuario'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'users.update',
            'description' => 'Actualizar Usuario'
        ])->syncRoles([$rol_admin]);
        
        // MODULO DE ROL
        Permission::create([
            'name' => 'roles.index',
            'description' => 'Ver Listado de Roles'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'roles.create',
            'description' => 'Crear Rol'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'roles.edit',
            'description' => 'Editar Rol'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'roles.update',
            'description' => 'Actualizar Rol'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'roles.destroy',
            'description' => 'Eliminar Rol'
        ])->syncRoles([$rol_admin]);
        
        // MODULO DE PERMISOS
        Permission::create([
            'name' => 'permissions.index',
            'description' => 'Ver Listado de Permisos'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'permissions.create',
            'description' => 'Crear Permiso'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'permissions.edit',
            'description' => 'Editar Permiso'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'permissions.update',
            'description' => 'Actualizar Permiso'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'permissions.destroy',
            'description' => 'Eliminar Permiso'
        ])->syncRoles([$rol_admin]);

        // MODULO DE BIENES
        Permission::create([
            'name' => 'bienes.index',
            'description' => 'Ver Listado de Bienes'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'bienes.create',
            'description' => 'Crear bien'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'bienes.edit',
            'description' => 'Editar Bien'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'bienes.update',
            'description' => 'Actualizar Bien'
        ])->syncRoles([$rol_admin]);
       
        Permission::create([
            'name' => 'bienes.destroy',
            'description' => 'Eliminar Bien'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        // MODULO DE UBICACIONES
        Permission::create([
            'name' => 'ubicaciones.index',
            'description' => 'Ver Listado de Ubicaciones'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'ubicaciones.create',
            'description' => 'Crear Ubicación'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'ubicaciones.edit',
            'description' => 'Editar Ubicación'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'ubicaciones.update',
            'description' => 'Actualizar Ubicación'
        ])->syncRoles([$rol_admin]);
       
        Permission::create([
            'name' => 'ubicaciones.destroy',
            'description' => 'Eliminar Ubicación'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        // MODULO DE CATEGORIAS
        Permission::create([
            'name' => 'categorias.index',
            'description' => 'Ver Listado de Categorias'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'categorias.create',
            'description' => 'Crear Categoria'
        ])->syncRoles([$rol_admin]);
        
        Permission::create([
            'name' => 'categorias.edit',
            'description' => 'Editar Categoria'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'categorias.update',
            'description' => 'Actualizar Categoria'
        ])->syncRoles([$rol_admin]);
       
        Permission::create([
            'name' => 'categorias.destroy',
            'description' => 'Eliminar Categoria'
        ])->syncRoles([$rol_admin,$rol_user]);
       
        // MODULO DE MOVIMIENTOS
        Permission::create([
            'name' => 'movimientos.index',
            'description' => 'Ver Listado de Movimientos'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'movimientos.create',
            'description' => 'Crear Movimiento'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'movimientos.edit',
            'description' => 'Editar Movimiento'
        ])->syncRoles([$rol_admin,$rol_user]);
        
        Permission::create([
            'name' => 'movimientos.update',
            'description' => 'Actualizar Movimiento'
        ])->syncRoles([$rol_admin,$rol_user]);
       
        Permission::create([
            'name' => 'movimientos.destroy',
            'description' => 'Eliminar Movimiento'
        ])->syncRoles([$rol_admin]);
    }
}
