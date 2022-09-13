<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Login;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestController extends Controller
{
    //testing api caching for boost speed
    public function testApiCache(Request $request){
        //$postCount=User::withCount('posts')->get()->toArray();
        //lets use api caching technique of laravel
        $postCount=Cache::remember(
            'user.postcount'.Auth::id(),
            now()->addSeconds(30),
            function (){
                return User::withCount('posts')->get()->toArray();
        });
        dd($postCount);
    }

    //make fast order by query on has many and inverse
    //also order by last login at user
    public function userOrderByHasMany(){
        $users=User::query()
            ->orderByLastLogin()
            ->paginate(10);
        return view('users.list',compact('users'));
    }

    //make fast order by query one relation has one and inverse
    public function userOrderByHasOne(){
        $users=User::query()
            ->orderBy(Post::select('title')
                ->whereColumn('posts.user_id','users.id')
                //->whereColumn('posts.id','users.post_id') //for inverse has one
                ->orderBy('title')
                ->take(1)
            )
            ->with('post')
            ->paginate(10);
        return view('users.list',compact('users'));
    }

    //solution fast order by query with compound index see users migrations
    //Important: it is necessary that order by column order should match with migration index order
    public function userOrderBy(){
        $users=User::query()
                ->select('id','name','email','created_at')
                ->orderBy('name')
                ->orderBy('city')
                ->paginate(10);
        return view('users.list',compact('users'));
    }

    //solution 4, search from multiple column and from multiple tables
    public function searchMultipleScopeSearch(Request $request){
        $posts=Post::query()
            //->select('id','title','desc','user_id')
            //->search(request('search')) //solution 4
            ->searchNew(request('search')) //solution 5
            ->with('user')
            ->get();

        //dd($posts);
        return view('test.list',compact('posts'));
    }

    //solution 3
    //fetch and count multiple status in single query, very important
    public function fetchCountMultipleStatus(){
        $com=Comment::toBase()
            ->selectRaw("COUNT(CASE WHEN status='pending' THEN 1 END) as total_pending")
            ->selectRaw("COUNT(CASE WHEN status='viewed' THEN 1 END) as total_viewed")
            ->selectRaw("COUNT(CASE WHEN status='accepted' THEN 1 END) as total_accepted")
            ->first();

        print_r($com);
        //dd();

        /*$posts=Post::query()
                    ->select('id','title')
                    ->withCount('comments')
                    ->get();
        print_r($posts);*/
    }

    //solution 2
    //optimize queries from N+1 to N, Optimize storage
    //solution getting last record from one to many relation
    public function getLastRecFromRelatedModel(){
        $users=User::query()
            ->select('id','name','email','created_at')
            //->with('login')
            ->withLastLoginAt() //solution 1
            ->withCasts(['last_login_at'=>'datetime'])
            ->orderBy('name')
            ->get();
        print_r($users->toArray());
    }

    //solution 1
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
