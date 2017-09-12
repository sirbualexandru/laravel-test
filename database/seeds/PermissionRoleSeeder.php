<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$users = \App\Models\User::with('roles')->get();

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('permissions')->truncate();
		DB::table('permission_role')->truncate();
		DB::table('roles')->truncate();
		DB::table('role_user')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    	
    	// Create Roles --------------------------
		
		// Employer
		$role_employer = Role::create([
			'name'			=> 'employer',
			'display_name'	=> 'Employer',
			'description'	=> 'Employer Role'
		]);

		// Candidate
		$role_candidate = Role::create([
			'name'			=> 'candidate',
			'display_name'	=> 'Candidate',
			'description'	=> 'Candidate Role'
		]);

        // Create Permissions
        $full_rights = Permission::create([
            'name'          => 'full_rights',
            'display_name'  => 'Full rights',
        ]);

		// Attach
        $role_employer->permissions()->attach($full_rights);

		$login = Permission::create([
			'name'			=> 'login',
			'display_name'	=> 'Login'
		]);

		foreach ($users as $user) {
			foreach ($user->roles as $k => $role) {
				$user = \App\Models\User::findOrFail($user->id);
				if ($k == 0) {
					$user->roles()->detach();
				}
				$user->roles()->attach(Role::where('name', $role->name)->first());
			}
		}
    }
}
