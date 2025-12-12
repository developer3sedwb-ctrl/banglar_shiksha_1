<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;

use App\Models\{
    StudentMaster
};


class StudentManagementController extends Controller
{
    protected $SchoolMapper;
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function studentDeactiveList(Request $request)
    {
        $student_code = $request->student_code ?? null;
        $request->method() == 'POST' ? 
            $data['student_details']   = StudentMaster::where('student_code',$request->student_code)->get() 
            : [];
                
        $data['student_deactive_list']   = StudentMaster::limit(100)->get();
        $data['total']          = StudentMaster::count('student_code');

        return view('src.student_management.student_list', [
                'student_code' => $student_code,
                'data' => $data
            ]);
    }

    public function studentDeactiveSearchList(Request $request)
    {
        // dd($request->student_code, $request->all());
        $data['student_deactive_list']   = StudentMaster::whereNotNull('deleted_at')->get();
        $data['total']          = StudentMaster::whereNotNull('deleted_at')->count('student_code');


        $data['student_details']   = StudentMaster::whereNull('deleted_at')->where('student_code',$request->student_code)->get();
        // dd($data);

        return view('src.student_management.student_list', [
                'data' => $data
            ]);
    }


}