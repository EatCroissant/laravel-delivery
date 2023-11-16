<?php

namespace App\Http\Controllers;

use App\Http\Repository\CommentRepository;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        dd(Comment::where('reply_to', null)->with(['comments'])->get()->toArray());
        return app(CommentRepository::class)->getComments($request->get('page', 0));
    }


    public function store(CreateCommentRequest $request)
    {
        if(!Session::isStarted()){
            Session::start();
        }
        if ($user = Session::get('user')) {
            $user = User::find($user['id']);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email
            ]);
            Session::put('user', $user->toArray());
            Session::save();
        }
        $comment = ['text' => $request->text, 'user_id' => $user->id];
        if($request->get('reply_to')){
            $comment['reply_to'] = $request->get('reply_to');
        }

        $comment = Comment::create($comment);

        return response()->json(['result' => 'true', 'data' => $comment]);
    }
}
