<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('states')->insert([
            [
                'name'  => "Cundinamarca",
                'id'    => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => "Antioquia",
                'id'    => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => "Santander",
                'id'    => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
