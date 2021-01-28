<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cities')->insert([
            [
                'name'          => 'Chia',
                'id'            => 1,
                'state_id'      => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name'          => 'Bogota',
                'id'            => 2,
                'state_id'      => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name'          => 'Medellin',
                'id'            => 3,
                'state_id'      => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name'          => 'Bucaramanga',
                'id'            => 4,
                'state_id'      => 3,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
