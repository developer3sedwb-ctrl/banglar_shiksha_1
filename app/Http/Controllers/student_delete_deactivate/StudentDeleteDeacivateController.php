<?php

namespace App\Http\Controllers\student_delete_deactivate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    StudentMaster,
    ReasonForDeactivationMaster};
use App\Models\student_delete_deactivate\StudentDeactivateModel;
use App\Http\Requests\StoreUserRequestStudentDeactivate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class StudentDeleteDeacivateController extends Controller
{
    public function deactivateStudentView()
    {
        return view('src.modules.student_delete_deactivate.student_deactivated');
    }
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


            $student = $query->first();
            if (!$student) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student not found'
                ], 404);
            }
            $deactivation_reasons = ReasonForDeactivationMaster::where('status', 1)->get();
            return response()->json([
                'status' => 'success',
                'data' => [
                    'student_code'      => $student->student_code,
                    'studentname'       => $student->getAttributes()['studentname'],
                    'dob'               => $student->dob,
                    'guardian_name'     => $student->guardian_name,
                    'current_class'     => $student->currentClass?->name,
                    'current_section'   => $student->currentSection?->name,
                    'cur_roll_number'   => $student->cur_roll_number,
                    'deactivation_reasons' => $deactivation_reasons
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
    public function deactivateStudent(StoreUserRequestStudentDeactivate $request)
    {
        // -------------------------------
        // 1. Validation
        // -------------------------------
        $input= $request->validated();

        DB::beginTransaction();

        try {
            // -------------------------------
            // 2. Insert into tracking table
            // -------------------------------
            StudentDeactivateModel::create([
                'school_code_fk'            => $request->school_code_fk,
                'district_code_fk'          => $request->district_code_fk,
                'circle_code_fk'            => $request->circle_code_fk,
                'cur_class_code_fk'         => $request->cur_class_code_fk,
                'cur_section_code_fk'       => $request->cur_section_code_fk,
                'deactivate_reason_code_fk' => $request->deactivate_reason_code_fk,
                'operation_by'              => Auth::id(),
                'operation_by_stake_cd'     => Auth::user()->stake_cd ?? null,
                'operation_time'            => Carbon::now(),
                'operation_ip'              => $request->ip(),
                'prev_status'               => $request->prev_status,
            ]);

            // -------------------------------
            // 3. Update student master status
            // -------------------------------
            DB::table('bs_student_master')
                ->where('student_code', $request->student_code)
                ->update([
                    'student_status' => 3, // D = Deactivated
                    'update_time'    => Carbon::now(),
                    'update_ip'      => $request->ip(),
                    'update_by'      => Auth::id(),
                ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Student deactivated successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

}
