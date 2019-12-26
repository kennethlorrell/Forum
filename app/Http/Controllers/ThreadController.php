<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
    	$threads = Thread::all();

        return view('threads.index', compact('threads'));
    }
    
    public function view($categoryId, Thread $thread)
    {
    	return view('threads.view', compact('thread'));
    }
    public function store(Thread $thread)
    {
        $this->authorize('create', Thread::class);

        $thread->create($this->validateRequest());

    	return redirect('/threads');
    }
    public function create(User $user)
    {
        $this->authorize('create', Thread::class);
        
        return view('threads.create');
    }
    protected function validateRequest()
    {
    	return request()->validate([
    		'title' => 'required',
    		'description' => 'required',
    	]);
    }
}
