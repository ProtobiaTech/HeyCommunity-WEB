<?php

namespace App\Http\Controllers\Admin;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TopicController extends Controller
{
    /**
     * Topic list and search
     */
    public function index()
    {
        if (Input::get('q')!==null){
            $TopicModel = new Topic();
            $topics = $TopicModel->where('title','like','%'.Input::get('q').'%')->paginate();
        }else{
            $topics = Topic::latest()->paginate();
        }

        return view('admin.topic.index', compact('topics'));
    }

}
