<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post_Categories extends Model
{
    protected $table = "post_category";
    protected $fillable = ['name','slug','parent_category_id'];
    public function parent() {
        return $this->belongsTo(static::class, 'parent_category_id');
    }
}
