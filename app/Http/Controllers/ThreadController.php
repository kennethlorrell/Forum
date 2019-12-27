<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use App\Category;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index(Category $category)
    {
        if ($category->exists) {
            $threads = $category->threads()->latest()->get();
        } else {
            $threads = Thread::all();
        }

        return view('threads.index', compact('threads'));
    }
    
    public function view($categoryId, Thread $thread)
    {
    	return view('threads.view', compact('thread'));
    }

    public function store(Thread $thread)
    {
        $this->authorize('create', Thread::class);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data['owner_id'] = auth()->id();

        $thread->create($data);

    	return redirect('/threads');
    }

    public function create(User $user)
    {
        $this->authorize('create', Thread::class);
        
        return view('threads.create');
    }
}
