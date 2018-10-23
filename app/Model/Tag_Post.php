<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag_Post extends Model
{
    protected $table = "tag_post";
    protected $fillable = ['tag_id','post_id'];
}
