<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tag";
    public $timestamps = false;
    protected $fillable = ['name','slug'];
    public function tag_tintuc(){
        return $this->hasMany(Tag_Post::class);
    }
    public function tours(){
        return $this->belongsToMany(Post::class,'tag_post');
    }
}
