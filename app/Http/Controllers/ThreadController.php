<?php

namespace App\Http\Controllers;

use App\Thread;
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
}
