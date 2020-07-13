<?php

use Illuminate\Database\Seeder;

class CorretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('correts')->insert([
            'name' => 'MAGLIANO S.A. CCVM',
            'id_corretora' => '1',
          ]);
    }
}
