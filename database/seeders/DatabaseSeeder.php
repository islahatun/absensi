<?php

namespace Database\Seeders;

use App\Models\company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        \App\Models\departement::create([
            'name_departement'	=> 'Aset',
            ]);

        \App\Models\company::create([
            'name'  => 'PT ISLAHATUN NUFUSI',
            'email'  => 'islahatunnufusi07@gmail.com',
            'address'   => 'Jl. Raya Serang-Pandeglang',
            'latitude'  => '-6.22322',
            'longitude' => '106.13025',
            'radius_km' => 0.5,
            'time_in'   =>'08:00',
            'time_out'  => '17:00'
        ]);

    }
}
