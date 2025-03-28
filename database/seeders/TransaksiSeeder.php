<?php

namespace Database\Seeders;

use App\Models\TransaksiModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransaksiModel::create([
            'no_transaksi' => '123122',
        ]);
    }
}
