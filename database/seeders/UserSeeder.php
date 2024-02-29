<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $data =  [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '9876548965',
            'password' => Hash::make('12345678'),
            'status'=>1,
            'is_active'=>0,
          
        ];
        User::create($data);
    }
}