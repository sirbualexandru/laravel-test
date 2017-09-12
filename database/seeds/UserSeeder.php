<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Employer
        $employer_user = User::where('email', '=', 'employer@test.com')->first();
		
        if ($employer_user == null) {
            $employer_user = User::create([
                'id'            => 1,
                'email'         => 'employer@test.com',
                'first_name'    => 'Employer',
                'last_name'     => 'Test',
                'password'      => Hash::make('employer'),
                'address'       => 'Ffordd Yr Ysgol, Fairbourne LL38 2RJ, United Kingdom',
                'phone'         => '(01558) 718378',
                'status'        => User::USER_STATUS_ACTIVE
            ]);

			$employer_user->roles()->attach(Role::where('name', '=', 'employer')->firstOrFail());
        } else {
            $employer_user->roles()->detach();
            $employer_user->roles()->attach(Role::where('name', '=', 'employer')->firstOrFail());
        }

        // Candidate
        $candidate_user = User::where('email', '=', 'candidate@test.com')->first();
        
        if ($candidate_user == null) {
            $candidate_user = User::create([
                'id'            => 2,
                'email'         => 'candidate@test.com',
                'first_name'    => 'Candidate',
                'last_name'     => 'Test',
                'password'      => Hash::make('candidate'),
                'address'       => '12 Selby Cl, Radcliffe, Manchester M26 2PL, United Kingdom',
                'phone'         => '(01341) 667524',
                'wanted_salary' => '2400 euro',
                'experience'    => '3 years',
                'skills_description' => 'Chrome Firefox Add-on NodeJS TeX Package Python Interface GTK Lipsum Rails .NET Groovy Adobe Plugin',
                'status'        => User::USER_STATUS_ACTIVE
            ]);

            $candidate_user->roles()->attach(Role::where('name', '=', 'candidate')->firstOrFail());
        } else {
            $candidate_user->roles()->detach();
            $candidate_user->roles()->attach(Role::where('name', '=', 'candidate')->firstOrFail());
        }

        // Candidate 2
        $candidate2_user = User::where('email', '=', 'candidate2@test.com')->first();
        
        if ($candidate2_user == null) {
            $candidate2_user = User::create([
                'id'            => 3,
                'email'         => 'candidate2@test.com',
                'first_name'    => 'Candidate2',
                'last_name'     => 'Test2',
                'password'      => Hash::make('candidate2'),
                'address'       => '17 Dolar XLK, Kliff, Younex M23 8PL, United Kingdom',
                'phone'         => '(01131) 113322',
                'wanted_salary' => '3300 euro',
                'experience'    => '5 years',
                'skills_description' => 'php NodeJS TeX Package Python Interface GTK Lipsum Rails .NET Groovy Adobe Plugin',
                'status'        => User::USER_STATUS_ACTIVE
            ]);

            $candidate2_user->roles()->attach(Role::where('name', '=', 'candidate')->firstOrFail());
        } else {
            $candidate2_user->roles()->detach();
            $candidate2_user->roles()->attach(Role::where('name', '=', 'candidate')->firstOrFail());
        }
    }
}
