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
}
