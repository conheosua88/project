<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post_New extends Model
{
    protected $table = "post_new";
    protected $fillable = ['title','slug','image','content','view','category_new_id'];
    public function parent_new(){
        return $this->belongsTo(Post_New_Categories::class,'category_new_id');
    }
}
