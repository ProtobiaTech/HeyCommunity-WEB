<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    /**
     * News Index Page And Search
     */
    public function index()
    {
        if (Input::get('q')!==null) {
            $newsModel = new News();
            $news = $newsModel->where('title', 'like', '%'.Input::get('q').'%')->paginate();
        } else {
            $news = News::latest()->paginate();
        }

        return view('news.index', compact('news'));
    }

    /**
     * Show A News
     */
    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('news.show', compact('news'));
    }
}
