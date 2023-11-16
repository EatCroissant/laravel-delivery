<?php

namespace App\Http\Repository;

use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentRepository
{
    public function getComments($page = 0)
    {
        return Cache::remember("comments:$page", 300,
            fn() => Comment::whereNull('reply_to')->with('comments', 'user')->simplePaginate());
    }
}
