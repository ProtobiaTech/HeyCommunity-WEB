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
        $this->middleware('guest', ['only' => ['login', 'loginHandler', 'signup', 'signupHandler']]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Login page
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * Login handler
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
            return back()->withInput()->withErrors(['fail' => '手机和密码不正确']);
        }
    }

    /**
     * Sign up page
     */
    public function signup()
    {
        return view('user.signup');
    }

    /**
     * Sign up handler
     */
    public function signupHandler(Request $request)
    {
        $this->validate($request, [
            'nickname'  =>  'required|string',
            'phone'     =>  'required|string|unique:users',
            'password'  =>  'required',
        ]);

        $user = new User;
        $user->nickname     =   $request->nickname;
        $user->phone        =   $request->phone;
        $user->password     =   Hash::make($request->password);
        $user->avatar       =   '/images/user/avatars/default/' . random_int(1, 15) . '.png';

        if ($user->save()) {
            Auth::login($user);

            return redirect('/');
        } else {
            return back();
        }
    }

    /**
     * User center
     */
    public function ucenter()
    {
        $user = Auth::user();
        $myTopics = Topic::mine()->paginate();
        $myActivities = Activity::paginate();

        return view('user.ucenter', compact('user', 'myTopics', 'myActivities'));
    }

    /**
     * User home
     */
    public function uhome($id)
    {
        $user = User::findOrFail($id);
        $myTopics = Topic::where(['user_id' => $user->id])->paginate(10);
        $myActivities = Activity::paginate(12);

        return view('user.uhome', compact('user', 'myTopics', 'myActivities'));
    }
}
