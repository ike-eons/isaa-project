<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\QualityAssurance;

class QualityAssuranceController extends BaseController
{
    public function index()
    {
        $qualityassurances = QualityAssurance::all();

        return view('admin.qualityassurances.index',compact('qualityassurances'));
    }
}
