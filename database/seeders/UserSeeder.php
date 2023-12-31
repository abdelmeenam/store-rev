<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Abdelmonem Mohamed',
        //     'email' => 'abdelmeenam@gmail.com',
        //     'password' => Hash::make('123'),
        //     'phone_number' => '01064313821'
        // ]);


        User::create([
            'name' => 'soso sayed',
            'email' => 'soso@gmail.com',
            'password' => Hash::make('123'),
            'phone_number' => '06555'
        ]);


    }
}
