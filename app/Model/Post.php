<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";
    protected $fillable = ['title','slug','image','departure_location','trip_time','vehicle','departure_time','tour_schedule','price','rules','regulations','category_id'];
    public function parent_travel(){
        return $this->belongsTo(Post_Categories::class,'category_id');
    }
    public function tag_tour_id(){
        return $this->hasMany(Tag_Post::class);
    }
}
