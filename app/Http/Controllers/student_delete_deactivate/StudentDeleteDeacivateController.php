<?php

namespace App\Http\Controllers\student_delete_deactivate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student_search\StudentSearchModel;
use App\Models\student_delete_deactivate\StudentDeactivateModel;
use Illuminate\Support\Facades\Auth;
class StudentDeleteDeacivateController extends Controller
{
    public function searchStudentByStudentCode(Request $request)
    {
        try{
            $input =  $request->validate([
                'student_code' => 'required|string|max:20',
            ]);
            $looged_in_user = Auth::user()->user_id;
            dd($looged_in_user);
            $student_code = $request->input('student_code');

            $student = StudentSearchModel::where('student_code', $student_code)->first();

            if ($student) {
                return response()->json(['status' => 'success', 'data' => $student]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Student not found']);
            }
        }
        catch( \Illuminate\Validation\ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => 'Validation failed', 'errors' => $e->errors()]);
        }
        catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
}
