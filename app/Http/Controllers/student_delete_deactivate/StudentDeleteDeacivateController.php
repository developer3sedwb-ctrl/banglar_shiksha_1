<?php

namespace App\Http\Controllers\student_delete_deactivate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    StudentMaster,
    ReasonStudentDeactivationMaster};
use App\Models\student_delete_deactivate\StudentDeactivateModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class StudentDeleteDeacivateController extends Controller
{
    // =========================Deactivated Students View & Deactivate Student Start==========================
    public function deactivateStudentView()
    {
        try {
            $deactive_students = StudentDeactivateModel::query()
                ->with([
                    // Student basic info (LIMIT COLUMNS)
                    'studentInfo:student_code,studentname,dob,guardian_name,cur_roll_number',

                    // Deactivation reason (LIMIT COLUMNS)
                    'deleteReason:id,name',
                    'currentClass:id,name',
                    'currentSection:id,name',
                ])
                ->where('status', 1)
                ->get();
                

            return view(
                'src.modules.student_delete_deactivate.student_deactivated',
                compact('deactive_students')
            );

        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
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
                ->where('student_code', $student_code)
                ->where('status', 1);
            $student = $query->first();
            if (!$student) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student not found'    
                ], 200);
            }
            $deactivation_reasons = ReasonStudentDeactivationMaster::where('status', 1)->get();
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
    public function deactivateStudent(Request $request)
    {
        DB::beginTransaction();

        try {
            // -------------------------------
            // 1. Validated input
            // -------------------------------
            $data = $request->validate(
                [
                    'student_code' => 'required|string|size:14',
                    'deactivate_reason_code_fk' => 'required|integer|exists:bs_reason_student_deactivation_master,id'
                    ]
            );

            // -------------------------------
            // 2. Fetch student master (single source of truth)
            // -------------------------------
            $auth_data = Auth::user()->schoolMaster;
            $student = DB::table('bs_student_master')
                ->where('district_code_fk', $auth_data->district_code_fk)
                ->where('student_code', $data['student_code'])
                ->lockForUpdate()
                ->first();

            if (!$student) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            // -------------------------------
            // 3. Insert into tracking table
            // -------------------------------
            StudentDeactivateModel::create([
                'student_code'              => $student->student_code,
                'school_code_fk'            => $student->school_code_fk,
                'district_code_fk'          => $student->district_code_fk,
                'circle_code_fk'            => $student->circle_code_fk,
                'cur_class_code_fk'         => $student->cur_class_code_fk,
                'cur_section_code_fk'       => $student->cur_section_code_fk,
                'deactivate_reason_code_fk' => $data['deactivate_reason_code_fk'],
                'operation_by'              => Auth::id(),
                'operation_by_stake_cd'     => Auth::user()->stake_cd ?? null,
                'operation_time'            => now(),
                'operation_ip'              => $request->ip(),
                'prev_status'               => $student->status,
            ]);

            // -------------------------------
            // 4. Update student master
            // -------------------------------
            DB::table('bs_student_master')
                ->where('student_code', $data['student_code'])
                ->where('district_code_fk', $student->district_code_fk)
                ->update([
                    'status' => 3, // Deactivated
                    'updated_at'    => now(),
                    'update_ip'      => $request->ip(),
                    'updated_by'      => Auth::id(),
                ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Student deactivated successfully',
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    // =========================Deactivated Students View & Deactivate Student End==========================
    // =========================Deleted Students View & Delete Student Start================================
    public function deletedStudentView()
    {
        try {
            $deactive_students = StudentDeactivateModel::query()
                ->with([
                    // Student basic info (LIMIT COLUMNS)
                    'studentInfo:student_code,studentname,dob,guardian_name,cur_roll_number',

                    // Deactivation reason (LIMIT COLUMNS)
                    'deleteReason:id,name',
                    'currentClass:id,name',
                    'currentSection:id,name',
                ])
                ->where('status', 1)
                ->get();
                

            return view(
                'src.modules.student_delete_deactivate.student_delete',
                compact('deleted_students')
            );

        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function deleteStudent(Request $request)
    {
        DB::beginTransaction();

        try {
            // -------------------------------
            // 1. Validated input
            // -------------------------------
            $data = $request->validate(
                [
                    'student_code' => 'required|string|size:14',
                    'deactivate_reason_code_fk' => 'required|integer|exists:bs_reason_student_deactivation_master,id'
                    ]
            );

            // -------------------------------
            // 2. Fetch student master (single source of truth)
            // -------------------------------
            $auth_data = Auth::user()->schoolMaster;
            $student = DB::table('bs_student_master')
                ->where('district_code_fk', $auth_data->district_code_fk)
                ->where('student_code', $data['student_code'])
                ->lockForUpdate()
                ->first();

            if (!$student) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            // -------------------------------
            // 3. Insert into tracking table
            // -------------------------------
            StudentDeactivateModel::create([
                'student_code'              => $student->student_code,
                'school_code_fk'            => $student->school_code_fk,
                'district_code_fk'          => $student->district_code_fk,
                'circle_code_fk'            => $student->circle_code_fk,
                'cur_class_code_fk'         => $student->cur_class_code_fk,
                'cur_section_code_fk'       => $student->cur_section_code_fk,
                'deactivate_reason_code_fk' => $data['deactivate_reason_code_fk'],
                'operation_by'              => Auth::id(),
                'operation_by_stake_cd'     => Auth::user()->stake_cd ?? null,
                'operation_time'            => now(),
                'operation_ip'              => $request->ip(),
                'prev_status'               => $student->status,
            ]);

            // -------------------------------
            // 4. Update student master
            // -------------------------------
            DB::table('bs_student_master')
                ->where('student_code', $data['student_code'])
                ->where('district_code_fk', $student->district_code_fk)
                ->update([
                    'status' => 3, // Deactivated
                    'updated_at'    => now(),
                    'update_ip'      => $request->ip(),
                    'updated_by'      => Auth::id(),
                ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Student deactivated successfully',
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    // =========================Deleted Students View & Delete Student Ens==================================


}
