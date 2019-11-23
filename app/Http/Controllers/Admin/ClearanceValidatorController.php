<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClearanceValidator;

class ClearanceValidatorController extends Controller
{
    public function index()
    {
        $clearancevalidator = ClearanceValidator::all()->first();
   
        return view('admin.clearancevalidators.index',compact('clearancevalidator'));
        // return response()->json($clearancevalidator);
    }

    // public function index()
    // {
    //     if (request()->wantsJson()) {
    //     $clearancevalidator = ClearanceValidator::all()->first();

    //     return response()->json($clearancevalidator);
    //     }
    //     return 'You shall not see this in the browser';
    // }

}
