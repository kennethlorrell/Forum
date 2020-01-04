<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
    	$activities = $user->activities()->latest()->with('activable')->get()->groupBy(
    		fn($activity) => $activity->created_at->format('Y-m-d')
    	);

    	return view('profiles.show', compact('user', 'activities'));
    }
}
