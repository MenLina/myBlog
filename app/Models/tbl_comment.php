<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_comment extends Model
{
    use HasFactory;
    protected $table = 'tbl_comments';

    protected $fillable = ['user_id', 'post_id', 'author', 'email', 'url', 'content', 'status'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
