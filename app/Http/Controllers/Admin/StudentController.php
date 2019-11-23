<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\BaseController;
use App\Contracts\StudentContract;
use App\Models\Course;
use App\Models\Subject;
use App\Models\LibraryClearance;
use App\Models\Fee;
use App\Models\QualityAssurance;
use App\Models\Registration; 
use App\Models\Qrcode as QrcodeModel;

use QRCode;



class StudentController extends BaseController
{
    protected $studentRepository;

    public function __construct(StudentContract $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $students = $this->studentRepository->listStudents();

        $this->setPageTitle('Students', 'List of all Students');
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $students = $this->studentRepository->listStudents('id', 'asc');

        $courses = Course::all();

        $this->setPageTitle('students', 'Create Student');
        return view('admin.students.create', compact('students','courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname'             =>        'required|max:191',
            'middlename'            =>        'max:191',
            'lastname'              =>        'required|max:191',
            'index_no'              =>        'required|unique:students|min:11|max:11|regex:/^ANU\d{8}$/i',
            'nationality'           =>        'required|not_in:0',
            'regular_or_weekend'    =>        'required|boolean',
            'course_id'             =>        'required|Integer|not_in:0',
            'image'                 =>        'mimes:jpg,jpeg,png|max:2000',
        ]);

        $params = $request->except('_token');
        //dd($params);
        $student = $this->studentRepository->createStudent($params);
        
         DB::table('fees')->insert([
            'student_id' => $student['id'],
        ]);

        DB::table('qualityassurances')->insert([
            'student_id' => $student['id'],
        ]);

        DB::table('libraryclearances')->insert([
            'student_id' => $student['id'],
        ]);

        DB::table('halltickets')->insert([
            'student_id' => $student['id'],
            'hallticket_no' => 123456789,

        ]);

       /* $file = 'generated_qrcodes/'.$qrcode->id.'.png';

        $input['qrcode_path'] = $file;

        DB::table('qrcodes')->insert([
            'hallticket_id' => $hallticket['id'],
        ]);

        //generate qrcode
        //save qrcode image in our folder on this site

        $newQrcodeGenerate = QRCode::text('message')
                             ->setSize(6)
                             ->setMargin(4)
                             ->setOutfile($file)
                             ->png();
        
        $newQrcode = QrcodeModel::where('id',$qrcode->id)
                        ->update(['qrcode_path' => $input['qrcode_path'] ]);

        */

        
        
        if (!$student) {
            return $this->responseRedirectBack('Error occurred while creating Student.', 'error', true, true);
        }
        return $this->responseRedirect('admin.students.index', 'Student added successfully' ,'success',false, false);
    }

    public function show($id)
    {
        $targetStudent = $this->studentRepository->findStudentById($id);

        $subjects = Subject::all();
        $registrations = Registration::all();

        $this->setPageTitle('Students', ' Student : '.$targetStudent->student_name);
        
        return view('admin.students.show', compact('targetStudent','subjects','registrations'));
    }

    public function edit($id)
    {
        $targetStudent = $this->studentRepository->findStudentById($id);

        $students = $this->studentRepository->listStudents();

        $courses = Course::all();

        $this->setPageTitle('Students', 'Edit Student : '.$targetStudent->name);
        
        return view('admin.students.edit', compact('students','targetStudent','courses'));
    }

     public function update(Request $request)
    {
        $this->validate($request, [
            'firstname'             =>        'required|max:191',
            'middlename'            =>        'max:191',
            'lastname'              =>        'required|max:191',
            'index_no'              =>        'required|min:11|max:11|regex:/^ANU\d{8}$/i',
            'nationality'           =>        'Integer|not_in:0',
            'regular_or_weekend'    =>        'required|boolean',
            'course_id'             =>        'required|Integer|not_in:0',
            'image'                 =>        'mimes:jpg,jpeg,png|max:2000',
        ]);

        $params = $request->except('_token');
        //dd($params);
        $student = $this->studentRepository->updateStudent($params);
    
        
        if (!$student) {
            return $this->responseRedirectBack('Error occurred while creating Student.', 'error', true, true);
        }
        
        return $this->responseRedirect('admin.students.index', 'Student updated successfully' ,'success',false, false);
    }

    

    public function delete($id)
    {
        $student = $this->studentRepository->deleteStudent($id);

        if (!$student) {
            return $this->responseRedirectBack('Error occurred while deleting student.', 'error', true, true);
        }
        return $this->responseRedirect('admin.students.index', 'Student deleted successfully' ,'success',false, false);
    }
}