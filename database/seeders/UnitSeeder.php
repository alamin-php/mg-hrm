<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            'unit_name' => 'Mamun Group',
            'unit_slug' => 'mamun-group',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'RM Jute Diversification Mills Ltd',
            'unit_slug' => 'rm-jute-diversification-mills-ltd',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'RM Geotex Ltd',
            'unit_slug' => 'rm-geotex-ltd',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'RM Carpet Ltd',
            'unit_slug' => 'rm-carpet-ltd',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'RM Polytex Ltd',
            'unit_slug' => 'rm-polytex-ltd',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'Fun Paradise Ltd',
            'unit_slug' => 'fun-paradise-ltd',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'Mamun Poultry And Hatchery Ltd',
            'unit_slug' => 'mamun-poultry-and-hatchery-ltd',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'The Rajbari Hatchery',
            'unit_slug' => 'the-rajbari-hatchery',
            'status' => 1,
        ]);
        DB::table('units')->insert([
            'unit_name' => 'Mamun Tradin Company',
            'unit_slug' => 'mamun-trading-company',
            'status' => 1,
        ]);
    }
}
