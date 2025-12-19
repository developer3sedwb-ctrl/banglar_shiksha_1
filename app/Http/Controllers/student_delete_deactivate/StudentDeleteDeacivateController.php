<?php

namespace App\Http\Controllers\student_delete_deactivate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentMaster;

class StudentDeleteDeacivateController extends Controller
{
public function searchStudentByStudentCode(Request $request)
{
    try {
        $request->validate([
            'student_code' => ['required', 'digits:14'],
        ]);

        $auth_data = Auth::user()->schoolMaster;
        $student_code = $request->input('student_code');

        $query = StudentMaster::with([
        'currentClass:id,name',
        'currentSection:id,name'    
        ])
    ->select([
        'student_code',
        'studentname',
        'dob',
        'guardian_name',
        'cur_class_code_fk',
        'cur_section_code_fk',
        'cur_roll_number'
    ])
    ->where('district_code_fk', $auth_data->district_code_fk)
    ->where('student_code', $student_code);

    // DEBUG HERE
    // dd($query->toSql(), $query->getBindings());
    // EXECUTE AFTER DEBUG
        $student = $query->first();
        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => [
                'student_code'      => $student->student_code,
                'studentname'       => $student->getAttributes()['studentname'],
                'dob'               => $student->dob,
                'guardian_name'     => $student->guardian_name,
                'current_class'     => $student->currentClass?->name,
                'current_section'   => $student->currentSection?->name,
                'cur_roll_number'   => $student->cur_roll_number
            ]
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
}

    
}
