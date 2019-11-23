<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Fee;

class FeeController extends BaseController
{
    public function index()
    {
        $fees = Fee::all();

        return view('admin.fees.index',compact('fees'));
    }
}
