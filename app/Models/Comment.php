<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'post_id', 'user_id'];


    /* public function getUserById($id)
    {
        return $this->where('user_id', $id)->first();
    } */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function isCommentOwner()
    {
        if ($this->user_id === auth()->user()->id) {
            return true;
        }
        return false;
    }

    public function isPostOwner()
    {
        if ($this->post()->get()->first()->user_id === auth()->user()->id) {
            return true;
        }
        return false;
    }



}
