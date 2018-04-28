<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Activities list and search
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $activities = Activity::where('title', 'like', '%' . $request->q . '%')->paginate();
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
