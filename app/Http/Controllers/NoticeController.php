<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Notice index page
     */
    public function index()
    {
        $notices = Notice::mine()->latest()->paginate();

        return view('notice.index', compact('notices'));
    }

    /**
     * Notice Check
     */
    public function check(Request $request)
    {
        $this->validate($request, [
            'page'      =>  'integer|required_without:id',
            'id'        =>  'integer|required_without:page',
        ]);

        if ($request->page) {
            $notices = Notice::mine()->latest()->paginate(null, ['*'], 'page', $request->page);

            if ($notices->items()) {
                $noticeIds = $notices->pluck('id');
                Notice::whereIn('id', $noticeIds)->update(['is_read' => true]);
            }
        } elseif  ($request->id) {
            Notice::whereIn('id', [$request->id])->update(['is_read' => true]);
        }

        return back();
    }
}
