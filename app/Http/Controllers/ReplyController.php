<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Thread;

class ReplyController extends Controller
{
    public function store($categoryId, Reply $reply, Thread $thread)
    {
    	$this->authorize('create', Reply::class);

        $this->validate(request(), ['body' => 'required']);

    	$reply->create([
            'body' => request('body'),
            'thread_id' => $thread->id,
            'owner_id' => auth()->id(),
        ]);

    	return redirect($thread->path());
    }
}
