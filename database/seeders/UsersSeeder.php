<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("users")
            ->insert([
                "name"=>"Kirill",
                "email"=>"mrcaxapov@gmail.com",
                "password"=>Hash::make("admin123")
            ]);
    }
}
