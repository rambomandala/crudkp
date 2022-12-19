<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KosanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kosans')->insert([
            'nama' => 'Abdul halim',
            'jeniskelamin' => 'cowo',
            'notelpon' => '08526626043',
        ]);

    }
}
