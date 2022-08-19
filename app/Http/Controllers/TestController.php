<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //optimize queries from N+1 to N, Optimize storage
    //solution getting last record from one to many relation
    public function index(){
        $users=User::query()
            ->select('id','name','email','created_at')
            //->with('login')
            ->withLastLoginAt() //solution 1
            ->withCasts(['last_login_at'=>'datetime'])
            ->orderBy('name')
            ->get();
        print_r($users->toArray());
    }

    //optimize queries, and Ram consuming
    //solution speed up
    public function getPosts(){
        $posts=Post::query()
            ->select('id','user_id','title','created_at')
            ->with('user:id,name')
            ->latest('created_at')
            ->get()
            ->groupBy(function ($post){
               $post->created_at->year;
            });
        print_r($posts->toArray());
    }
}
