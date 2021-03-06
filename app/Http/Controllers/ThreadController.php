<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;

class ThreadController extends Controller
{
    public function index(Category $category, ThreadFilters $filters)
    {

        $threads = Thread::latest();

        if ($category->exists) {
            $threads->where('category_id', $category->id);
        }

        $threads = $threads->filter($filters)->get();

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    public function create()
    {
        $this->authorize('create', Thread::class);
        
        return view('threads.create');
    }


    public function store(Thread $thread, User $user)
    {
        $this->authorize('create', $thread);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $user->threads()->create($data);

    	return redirect('/threads')
            ->with('flash', 'Your thread has been successfully created!');
    }

    public function show($category, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }
    
    public function destroy($category, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();
        
        return redirect('threads');
    }
}