<?php

namespace Database\Seeders;

use App\Models\Login;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BlukUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {
            $user = new User();
            $user->name = Str::random(5);
            $user->email = strtolower(Str::random(5)) . '@' . 'gmail.com';
            $user->city = Str::random(4);
            $user->password = Hash::make(12345678);
            $user->save();

        }
    }
}
