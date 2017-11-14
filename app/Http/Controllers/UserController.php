<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Topic;
use App\Activity;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['logout']]);
        $this->middleware('guest', ['only' => ['login', 'loginHandler']]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /*
     * Login Page
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * Login Handler
     */
    public function loginHandler(Request $request)
    {
        $this->validate($request, [
            'phone'     =>      'required|integer',
            'password'  =>      'required|string',
        ]);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->back();
        } else {
            return back()->withInput()->withErrors(['fail' => trans('dashboard.The phone or password is incorrect')]);
        }
    }

    /**
     *
     */
    public function getSignup()
    {
        return view('auth.signup');
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
