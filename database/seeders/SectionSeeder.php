<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sections')->insert([
            'section_name' => 'Admin',
            'section_slug' => 'admin',
            'status' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'HR',
            'section_slug' => 'hr',
            'status' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Accounts',
            'section_slug' => 'accounts',
            'status' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'IT',
            'section_slug' => 'it',
            'status' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Marketing',
            'section_slug' => 'marketing',
            'status' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name' => 'Store',
            'section_slug' => 'store',
            'status' => 1,
        ]);
    }
}
