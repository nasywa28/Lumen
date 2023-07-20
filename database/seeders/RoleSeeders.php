<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cache roles dan permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();


Permission::create(['name' => 'view posts']);
Permission::create(['name' => 'create posts']);
Permission::create(['name' => 'edit posts']);
Permission::create(['name' => 'delete posts']);
Permission::create(['name' => 'publish posts']);
Permission::create(['name' => 'unpublish posts']);

//buat admin role
$adminRole = Role::create([
'name' => 'admin',
'guard_name' => 'web'
]);
$adminRole->givePermissionTo('view posts');
$adminRole->givePermissionTo('create posts');
$adminRole->givePermissionTo('edit posts');
$adminRole->givePermissionTo('delete posts');

//buat user Role
$userRole = Role::create([
'name' => 'user',
'guard_name' => 'web'
]);
$userRole->givePermissionTo('view posts');

    }
}
