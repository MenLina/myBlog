<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'tbl_posts';

    protected $fillable = ['title', 'tag', 'content', 'image'];

    public function comments()
    {
        return $this->hasMany(tbl_comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
