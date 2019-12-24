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
        auth()->user()->threads()->create($this->validateRequest());

    	return redirect()->route('threads');
    }

    public function create()
    {
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
