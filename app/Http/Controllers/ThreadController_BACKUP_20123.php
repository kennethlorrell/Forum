<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use App\Category;
use Illuminate\Http\Request;
<<<<<<< HEAD
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
=======

class ThreadController extends Controller
{
    public function index(Category $category)
    {
        if ($category->exists) {
            $threads = $category->threads()->latest()->get();
        } else {
            $threads = Thread::all();
>>>>>>> 50a52cc1bbe26b095e93a7841465cfc55260751d
        }

        return view('threads.index', compact('threads'));
    }
    
    public function view($categoryId, Thread $thread)
    {
<<<<<<< HEAD
    	return view('threads.view', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(5),
        ]);
=======
    	return view('threads.view', compact('thread'));
>>>>>>> 50a52cc1bbe26b095e93a7841465cfc55260751d
    }

    public function store(Thread $thread)
    {
<<<<<<< HEAD
        // REWRITE

        $this->authorize('create', Thread::class);

=======
        $this->authorize('create', Thread::class);
>>>>>>> 50a52cc1bbe26b095e93a7841465cfc55260751d
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
