<?php

use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

function create($className, $attributes = []) {
    return $className::create($attributes);
}

function createRolesAndPermissions() {
    Role::create(['name'=>'admin', 'guard_name' => 'api']);
    Role::create(['name'=>'manager', 'guard_name' => 'api']);
    Role::create(['name'=>'user', 'guard_name' => 'api']);

    $permission = Permission::create(['name' =>'create user', 'guard_name'=>'api']);
    $permission->assignRole('admin');
}



