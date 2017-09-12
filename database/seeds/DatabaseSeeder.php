<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(PermissionRoleSeeder::class);
		$this->call(UserSeeder::class);

        $timeNow = Carbon::now()->format('Y-m-d H:i:s');

        $testCategories = [
            1 => 'Web, Mobile & Software Dev',
            2 => 'IT & Networking',
            3 => 'Design & Creative',
            4 => 'Admin Support',
            5 => 'Writing'
        ];

        // Add test Categories
        foreach ($testCategories as $catKey => $catName) {
            $category = Category::where('id', '=', $catKey)->first();
            
            if ($category == null) {
                DB::table('categories')->insert([
                    'id'            => $catKey,
                    'name'          => $catName,
                    'created_at'    => $timeNow,
                    'updated_at'    => $timeNow
                ]);
            }
        }

        // Jobs
        DB::table('jobs')->insert([
            [
                'user_id'       => 1,
                'category_id'   => 1,
                'name'          => 'PHP Developer',
                'experience'    => '5 years',
                'salary'        => '2200 euro',
                'description'   => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'created_at'    => $timeNow,
                'updated_at'    => $timeNow
            ],
            [
                'user_id'       => 1,
                'category_id'   => 3,
                'name'          => 'Photoshop Designer',
                'experience'    => '7 years',
                'salary'        => '3200 euro',
                'description'   => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'created_at'    => $timeNow,
                'updated_at'    => $timeNow
            ],
            [
                'user_id'       => 1,
                'category_id'   => 1,
                'name'          => 'Android Developer',
                'experience'    => '3 years',
                'salary'        => '1400 euro',
                'description'   => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                'created_at'    => $timeNow,
                'updated_at'    => $timeNow
            ],
        ]);
    }
}
