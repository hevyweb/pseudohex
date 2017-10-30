<?php

use \App\Models\Permission;
use \App\Models\Role;
use \App\Models\User;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Config;
use \Illuminate\Support\Facades\Hash;

/**
 * This is a seeder:
 * 1. creates 2 users. The first one is a regular user, the other one - is admin.
 * 2. Creates 2 roles
 * 3. Creates 2 permissions. (don't know why. Just in case)
 * @reRunnable true
 * @created 25.10.2017
 * @author Dmytro Dzyuba <joomsend@gmail.com>
 *
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fade();

        $viewPermission = $this->createPermissionView();
        $editPermission = $this->createPermissionEdit();

        $adminRole = $this->createAdminRole();
        $adminRole->attachPermissions([$viewPermission, $editPermission]);

        $managerRole = $this->createManagerRole();
        $managerRole->attachPermission($viewPermission);

        /**
         * Create dummy user as a first user in our database to prevent accidental SQL injection
         */
        $defaultUser = new User([
            'id' => 1,
            'name' => 'Ello',
            'email' => 'test@gmail.com',
            'password' => Hash::make('random_string')
        ]);
        $defaultUser->save();

        Log::debug('Created new user with id  "' . $defaultUser->id . '".');

        /**
         * Create admin user
         */
        $adminUser = new User([
            'id' => 2,
            'name' => ADMIN_NAME,
            'email' => ADMIN_EMAIL,
            'password' => Hash::make(ADMIN_PASSWORD)
        ]);
        $adminUser->save();

        Log::debug('Created new admin with id  "' . $adminUser->id . '".');

        $adminUser->attachRole($adminRole);
    }

    /**
     * Remove all users, roles and permissions.
     */
    public function fade()
    {
        $rolesTable             = Config::get('entrust.roles_table');
        $permissionsTable       = Config::get('entrust.permissions_table');
        $userTable              = (new User())->getTable();

        DB::statement('DELETE FROM `' . $userTable . '` WHERE `id` IN (1, 2)');
        Log::debug('Deleted 2 initial users.');

        DB::statement('DELETE FROM `' . $rolesTable . '` WHERE `id` IN (1, 2)');
        Log::debug('Deleted 2 initial roles.');

        DB::statement('DELETE FROM `' . $permissionsTable . '` WHERE `id` IN (1, 2)');
        Log::debug('Deleted 2 initial permissions.');
    }

    /**
     * Add record for the administrator role
     *
     * @return Role administrator role
     */
    protected function createAdminRole()
    {
        $role = new Role([
            'id' => 2,
            'name' => 'admin',
            'description' => 'User is allowed to manage and edit other user',
            'display_name' => 'User Administrator'
        ]);
        $role->save();

        Log::debug('Created "admin" role with Id "' . $role->id . '".');
        return $role;
    }

    /**
     * Add record for the manager role
     *
     * @return Role manager role
     */
    protected function createManagerRole()
    {
        $role = new Role([
            'id' => 1,
            'name' => 'manager',
            'description' => 'User is the owner of a given project',
            'display_name' => 'Project Owner'
            ]);
        $role->save();

        Log::debug('Created "manager" role with Id "' . $role->id . '".');
        return $role;
    }

    /**
     * Add record for the view permission
     *
     * @return Permission view permission
     */
    protected function createPermissionView()
    {
        $permission = new Permission([
            'id' => 2,
            'name' => 'view-admin',
            'description' => 'View admin pages',
            'display_name' => 'View Admin'
        ]);
        $permission->save();

        Log::debug('Created permission "view" with Id "' . $permission->id . '".');
        return $permission;
    }

    /**
     * Add record for edit permission
     *
     * @return Permission edit permission
     */
    protected function createPermissionEdit()
    {
        $permission = new Permission([
            'id' => 1,
            'name' => 'edit-user',
            'description' => 'Edit admin pages',
            'display_name' => 'Edit admin'
        ]);
        $permission->save();
        
        Log::debug('Created permission "edit" with Id "' . $permission->id . '".');
        return $permission;
    }
}