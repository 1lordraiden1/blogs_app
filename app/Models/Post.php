<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

    /* protected $table = 'test';

    protected $primaryKey = 'post_id'; */

    public function postCoolComments()
    {
        return $this->hasMany(Comment::class, 'post_id')->with('user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isPostOwner()
    {
        if ($this->user_id == auth()->user()->id) {
            return true;
        }
        return false;
    }

}
