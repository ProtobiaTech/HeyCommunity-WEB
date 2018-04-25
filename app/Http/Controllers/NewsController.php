<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * News Index Page
     */
    public function index()
    {
        $news = News::latest()->paginate();

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
