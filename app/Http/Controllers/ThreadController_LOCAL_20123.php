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
    
    public function view($categoryId, Thread $thread)
    {
    	return view('threads.view', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(5),
        ]);
    }

    public function store(Thread $thread)
    {
        // REWRITE

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
