<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Validation\UnauthorizedException;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //make Permission
        ModelsPermission::create(['name' => 'tambah-user']);
        ModelsPermission::create(['name' => 'edit-user']);
        ModelsPermission::create(['name' => 'hapus-user']);
        ModelsPermission::create(['name' => 'lihat-user']);

        ModelsPermission::create(['name' => 'tambah-tulisan']);
        ModelsPermission::create(['name' => 'edit-tulisan']);
        ModelsPermission::create(['name' => 'hapus-tulisan']);
        ModelsPermission::create(['name' => 'lihat-tulisan']);

        //make roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'penulis']);

        //insert permission into role admin
        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');
        $roleAdmin->givePermissionTo('lihat-user');
        // $roleAdmin->givePermissionTo([
        //     'tambah-user',
        //     'edit-user',
        //     'hapus-user',
        //     'lihat-user',
        // ]);

        $roleAdmin = Role::findByName('penulis');
        $roleAdmin->givePermissionTo('tambah-tulisan');
        $roleAdmin->givePermissionTo('edit-tulisan');
        $roleAdmin->givePermissionTo('hapus-tulisan');
        $roleAdmin->givePermissionTo('lihat-tulisan');
    }
    

}
