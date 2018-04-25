<?php

namespace App\Http\Controllers\Admin;

use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    /**
     * edit
     */
    public function edit()
    {
        $system = System::first();
        return view('admin.system.edit', compact('system'));
    }

    /**
     * update
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'site_title'            =>      'required|string',
            'site_subheading'       =>      'required|string',
            'site_keywords'         =>      'required|string',
            'site_description'      =>      'nullable|string',
            'site_analytic_code'    =>      'nullable|string',
        ]);

        $data = $request->except('_token');

        $system = System::first();

        if ($system->update($data)) {
            flash('操作成功')->success();
            return back();
        } else {
            flash('操作失败')->error();
            return back()->withInput();
        }
    }
}
