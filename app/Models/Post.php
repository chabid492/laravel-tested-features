<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    //solution 5, search from multiple scopes
    public function scopeSearchNew($query, string $term = null){
        //desc
        //wherein
            //derived table
                //find post by title and desc
                //union
                //find related user

        $query->whereIn('id',function ($query) use ($term){
            $query->select('id')
                ->from(function ($query) use ($term){
                    $query->select('id')
                        ->from('posts')
                        ->where('title','like',$term)
                        ->orWhere('desc','like',$term)
                        ->union(
                            $query->newQuery()
                            ->select('user_id')
                            ->from('posts')
                            ->join('users','users.id','=','posts.user_id')
                            ->where('users.name','like',$term)
                        );
                },'matches');
        });
    }

    //solution 4, search from multiple scopes
    public function scopeSearch($query, string $term = null){

        //for index search on related user table
        //$query->join('users','users.id','posts.user_id');

        //collect(explode(' ',$term))->filter()->each(function ($term) use ($query){
        collect(str_getcsv($term,' ','"'))->filter()->each(function ($term) use ($query){
            //$term='%'.$term.'%';
            $term=$term.'%'; //remove wildcard % if use index on sql column
            $query->where('title','like',$term)
                ->orWhere('desc','like',$term)
                //->orWhere('users.name','like',$term);
                /*->orWhereIn('user_id',function ($query) use ($term){
                    $query->select('id')
                        ->from('users')
                        ->where('name','like',$term);
                });*/

                ->orWhereIn('user_id',User::query()
                    ->where('name','like',$term)
                    ->pluck('id')
                );
        });
    }
}
