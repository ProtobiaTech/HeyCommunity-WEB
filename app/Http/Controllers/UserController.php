<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
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

    /**
     * User Home
     */
    public function uhome($id)
    {
        $user = User::findOrFail($id);
        $myTopics = Topic::where(['user_id' => $user->id])->paginate(10);
        $myActivities = Activity::paginate(12);

        return view('user.uhome', compact('user', 'myTopics', 'myActivities'));
    }
}
