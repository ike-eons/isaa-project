<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LibraryClearance;

class LibraryClearanceController extends Controller
{
    public function index()
    {
        $libraryclearances = LibraryClearance::all();

        return view('admin.libraryclearances.index',compact('libraryclearances'));
    }
}
