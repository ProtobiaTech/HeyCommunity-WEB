<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-17
 * Time: 下午4:18
 */

namespace App\Http\Controllers\Admin;


use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ActivityController extends Controller
{
    /**
     * Activities list and search
     */
    public function index()
    {
        if (Input::get('q')!==null) {
            $activityModel = new Activity();
            $activities = $activityModel->where('title', 'like', '%'.Input::get('q').'%')->paginate();
        } else {
            $activities = Activity::latest()->paginate();
        }

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Activities delete
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        Activity::destroy($request->id);
        flash('操作成功');

        return back();
    }
}
