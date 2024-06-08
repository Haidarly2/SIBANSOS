<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_bansos' => 2,
                'id_warga' => 5,
                'pendapatan' => 4, 
                'status_rumah' => 3, 
                'pln' => 4, 
                'pdam' => 5, 
                'status_kesehatan' => 4,
                'status' => 'Diterima',
            ],
            [
                'id_bansos' => 2,
                'id_warga' => 6,
                'pendapatan' => 2, 
                'status_rumah' => 2, 
                'pln' => 3, 
                'pdam' => 3, 
                'status_kesehatan' => 2, 
                'status' => 'Diterima', 
            ],
            [
                'id_bansos' => 2,
                'id_warga' => 7,
                'pendapatan' => 1, 
                'status_rumah' => 1, 
                'pln' => 2, 
                'pdam' => 1, 
                'status_kesehatan' => 4, 
                'status' => 'Diterima',
            ],
        ];
    
        DB::table('m_penerima')->insert($data);
    }
    

    
    
}
