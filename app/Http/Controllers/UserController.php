<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Topic;
use App\Activity;

class UserController extends Controller
{
    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * User Center
     */
    public function ucenter()
    {
        $user = Auth::user();
        $myTopics = Topic::mine()->paginate();
        $myActivities = Activity::paginate();

        return view('user.ucenter', compact('user', 'myTopics', 'myActivities'));
    }
}
