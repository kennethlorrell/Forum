<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Thread;

class ReplyController extends Controller
{
    public function store(Reply $reply, Thread $thread)
    {
    	$this->authorize('create', Reply::class);

    	$attributes = $this->validateRequest();
    	$attributes['thread_id'] = $thread->id;
    	$attributes['owner_id'] = auth()->id();

    	$reply->create($attributes);

    	return redirect($thread->path());
    }

    protected function validateRequest()
    {
    	return request()->validate([
    		'body' => 'required',
    	]);
    }
}
