<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable =[
      'post_name',
      'post_text'
    ];
}
