<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * News list and search
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $news = News::where('title', 'like', '%' . $request->q . '%')->paginate();
        } else {
            $news = News::latest()->paginate();
        }

        return view('admin.news.index', compact('news'));
    }

    /**
     * News destory
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        News::destroy($request->id);
        flash('操作成功');

        return back();
    }
}
