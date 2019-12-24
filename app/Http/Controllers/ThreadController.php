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
    
    public function view(Thread $thread)
    {
    	return view('threads.view', compact('thread'));
    }

    public function store()
    {
        $this->authorize('create', $this);

        $user->threads->create($this->validateRequest());

    	return redirect('/threads');
    }

    public function create()
    {
        $this->authorize('create', $this);

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
