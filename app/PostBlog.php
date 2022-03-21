<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostBlog extends Model
{
    protected $fillable = ['title', 'description', 'author',];
}
