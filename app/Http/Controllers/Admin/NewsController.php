<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-17
 * Time: 下午2:49
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
{
    /**
     * News list and search
     */
    public function index()
    {
        if (Input::get('q')!==null){
            $newsModel = new News();
            $news = $newsModel->where('title','like','%'.Input::get('q').'%')->paginate();
        }else{
            $news = News::latest()->paginate();
        }
        return view('admin.news.index', compact('news'));
    }

    /**
     * News delete
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