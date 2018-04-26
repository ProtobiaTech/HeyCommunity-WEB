<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Agent;
use App\User;
use App\Topic;
use App\Activity;
use App\TopicComment;
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
     *  Login
     */
    public function login()
    {
        // if in wechat browser
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return redirect()->route('user.login-by-wechat');
        } else {
            if (Agent::isDesktop()) {
                return redirect()->route('user.login-wechat');
            } else {
                return redirect()->route('user.default-login');
            }
        }
    }

    /**
     *  Signup
     */
    public function signup()
    {
        // if in wechat browser
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return redirect()->route('user.login-by-wechat');
        } else {
            if (Agent::isDesktop()) {
                return redirect()->route('user.login-wechat');
            } else {
                return redirect()->route('user.default-signup');
            }
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        flash('登出成功');
        return back();
    }

    /**
     * Login page with wechat
     */
    public function loginWechat()
    {
        // login by wechat browser
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            return redirect()->route('user.login-by-wechat');
        }

        $token = str_random(10);
        return view('user.login-wechat', compact('token'));
    }

    /**
     * Login page with wechat
     */
    public function loginByWechat(Request $request)
    {
        // login by wechat app
        if (
            !$request->has('token') &&
            session('after-login-redirect-route') &&
            (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false)
        ) {
            $route = session('after-login-redirect-route') ?: 'index';
            return redirect()->route($route);
        }

        //
        // @todo mark this user can be login

        event(new \App\Events\UserLoggedByWechatTransferBroadcast($request->token));

        return view('user.login-by-wechat');
    }

    /**
     * Login transfer handler
     */
    public function loginByWechatHandler(Request $request)
    {
        $this->validate($request, [
            'user_id'       =>      'required|integer',
        ]);

        // @todo validate this user can be login

        Auth::loginUsingId($request->user_id);

        flash('登录成功')->success();
        $route = session('after-login-redirect-route') ?: 'index';
        return redirect()->route($route);
    }

    /**
     * Login page with wechat
     */
    public function loginByWechatSuccess()
    {
        return view('user.login-by-wechat-success');
    }

    /**
     * Default login page
     */
    public function defaultLogin()
    {
        return view('user.default-login');
    }

    /**
     * Default login handler
     */
    public function defaultLoginHandler(Request $request)
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
     * Default sign up page
     */
    public function defaultSignup()
    {
        return view('user.default-signup');
    }

    /**
     * Sign up handler
     */
    public function defaultSignupHandler(Request $request)
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

            return redirect()->back();
        } else {
            return back();
        }
    }

    /**
     * User center
     */
    public function ucenter(Request $request)
    {
        if ($request->is('*ucenter')) {
            return redirect()->route('user.ucenter.my-topics');
        }

        $user = Auth::user();

        $myTopics = Topic::mine()->latest()->paginate();
        $myTopicComments = TopicComment::mine()->latest()->paginate();
        $myActivities = Activity::paginate();

        return view('user.ucenter', compact('user', 'myTopics', 'myTopicComments', 'myActivities'));
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

    /**
     *  User profile
     */
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    /**
     * User profile update
     */
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'nickname'      =>  'required|string',
            'gender'        =>  'required|integer',
            'phone'         =>  'required|string',
            'email'         =>  'required|string',
            'bio'           =>  'required|string',
        ]);

        $user = Auth::user();
        $user->nickname = $request->nickname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($user->save()) {
            flash('更新成功')->success();
            return back();
        } else {
            flash('更新失败')->error()->important();
            return back()->withInput();
        }
    }
}
