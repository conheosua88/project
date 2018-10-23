<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post_New_Categories extends Model
{
    protected $table = "post_new_category";
    protected $fillable = ['name','slug'];
}
