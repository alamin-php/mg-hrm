<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designations')->insert([
            'desig_name' => 'CFO',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'GM',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'DGM',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'AGM',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Sr. Manager',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Manager',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Asst. Manager',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Asst. Manager',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Sr. Executive',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Executive',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Sr. Officer',
            'status' => 1,
        ]);
        DB::table('designations')->insert([
            'desig_name' => 'Officer',
            'status' => 1,
        ]);
    }
}
