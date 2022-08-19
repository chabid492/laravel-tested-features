<?php

namespace Database\Seeders;

use App\Models\Login;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ucount=10;
        for ($i=0; $i < $ucount; $i++){
            $user=new User();
            $user->name=Str::random(5);
            $user->email=strtolower(Str::random(5)).'@'.'gmail.com';
            $user->password=Hash::make(12345678);
            $user->save();

            for ($k=0; $k<($i*3); $k++){
                $login=new Login();
                $login->user_id=$user->id;
                $login->ip_address=mt_rand(1,192).'.'.mt_rand(1,168).'.'.mt_rand(1,100).'.'.mt_rand(1,50);
                $login->save();

                $user->last_login_at=$login->id;
                $user->save();
            }

            for ($j=0; $j < 850; $j ++){
                $post=new Post();
                $post->user_id=$user->id;
                $post->title=Str::random(10);
                $post->desc=Str::random(30);
                $post->topic=Str::random(5);
                $post->category=Str::random(8);
                $post->save();
            }
        }
    }
}
