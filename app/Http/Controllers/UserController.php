<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Student;
use App\Models\User;

class UserController extends BaseController
{
    
    public function __construct()
    {
        $this->middleware('auth')
                ->except('index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $index_no = $user->index_no;

        
        $student = Student::where('index_no',$index_no)
                            ->first();
        
       if($student != null)
       {
          // dd($student->libraryclearance->clearance);
           return view('auth.clearance',compact('user','student'));
       }else{
           return view('auth.validation',compact('user'));
       }
           
       
    }

    public function print($id,$student)
    {
        $user = User::findOrFail($id);
        $student = Student::findOrFail($student);

        return view('auth.hallticket',compact('user','student'));
    }
}
