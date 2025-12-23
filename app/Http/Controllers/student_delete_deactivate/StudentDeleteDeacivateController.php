<?php

namespace App\Http\Controllers\student_delete_deactivate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    StudentMaster,
    StudentDeleteArchive
};
use App\Models\student_delete_deactivate\StudentDeactivateModel;
use App\Models\student_delete_deactivate\StudentDeleteTrackModel;
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
        $deleted_students = StudentDeleteTrackModel::query()
            ->with([
                'studentInfo:student_code,studentname,dob,guardian_name,cur_roll_number'
            ])
            ->where('status', '1')   // 🔥 FIX HERE
            ->get();

        // dd($deleted_students);

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

        try {
            DB::beginTransaction();

            $data = $request->validate([
                'student_code'          => 'required|string|size:14',
                'delete_reason_code_fk' => 'required|integer|exists:bs_student_delete_reason,id',
            ]);
            $authData = Auth::user()->schoolMaster;

            // --------------------------------
            // 1. Lock student row
            // --------------------------------
            $student = DB::table('bs_student_master')
                ->where('district_code_fk', $authData->district_code_fk)
                ->where('student_code', $data['student_code'])
                ->lockForUpdate()
                ->first();

            if (!$student) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            // --------------------------------
            // 2. Archive FULL ROW (ALL FIELDS)
            // --------------------------------
            // if hoi deletes student
            DB::table('bs_student_master')
            ->where('student_code', $data['student_code'])
            ->where('district_code_fk', $student->district_code_fk)
            ->update([
                'status' => 2, // Deactivated
                'updated_at'    => now(),
                'update_ip'      => $request->ip(),
                'updated_by'      => Auth::id(),
            ]);

            // if SI deletes student

            DB::statement("
                INSERT INTO bs_student_delete_archive (
                    district_code_fk,
                    subdivision_code_fk,
                    circle_code_fk,
                    gs_ward_code_fk,
                    academic_year,
                    student_code,
                    studentname,
                    studentname_as_per_aadhaar,
                    school_code_fk,
                    gender_code_fk,
                    dob,
                    fathername,
                    mothername,
                    guardian_name,
                    aadhaar_number,
                    mothertonge_code_fk,
                    social_category_code_fk,
                    religion_code_fk,
                    bpl_y_n,
                    bpl_no,
                    bpl_aay_beneficiary_y_n,
                    disadvantaged_group_y_n,
                    cwsn_y_n,
                    cwsn_disability_type_code_fk,
                    disability_percentage,
                    nationality_code_fk,
                    out_of_sch_child_y_n,
                    child_mainstreamed,
                    blood_group_code_fk,
                    birth_registration_number,
                    identification_mark,
                    health_id,
                    stu_guardian_relationship,
                    guardian_family_income,
                    stu_height_in_cms,
                    stu_weight_in_kgs,
                    guardian_qualification,
                    stu_country_code_fk,
                    stu_contact_address,
                    stu_contact_district,
                    stu_contact_panchayat,
                    stu_police_station,
                    stu_mobile_no,
                    stu_state_code_fk,
                    stu_contact_habitation,
                    stu_contact_block,
                    stu_post_office,
                    stu_pin_code,
                    stu_email,
                    address_equal,
                    guardian_country_code_fk,
                    guardian_state_code_fk,
                    guardian_contact_address,
                    guardian_contact_habitation,
                    guardian_contact_district,
                    guardian_contact_block,
                    guardian_contact_panchayat,
                    guardian_post_office,
                    guardian_police_station,
                    guardian_pin_code,
                    guardian_mobile_no,
                    guardian_email,
                    admission_no,
                    admission_date,
                    status_pre_year,
                    prev_class_appeared_exam,
                    prev_class_exam_result,
                    prev_class_marks_percent,
                    attendention_pre_year,
                    pre_roll_number,
                    pre_class_code_fk,
                    pre_section_code_fk,
                    pre_stream_code_fk,
                    cur_class_code_fk,
                    cur_section_code_fk,
                    cur_stream_code_fk,
                    cur_roll_number,
                    medium_code_fk,
                    admission_type_code_fk,
                    bank_ifsc,
                    stu_bank_acc_no,
                    status,
                    entry_ip,
                    update_ip,
                    created_by,
                    updated_by,
                    deleted_at,
                    created_at,
                    updated_at
                )
                SELECT
                    district_code_fk,
                    subdivision_code_fk,
                    circle_code_fk,
                    gs_ward_code_fk,
                    academic_year,
                    student_code,
                    studentname,
                    studentname_as_per_aadhaar,
                    school_code_fk,
                    gender_code_fk,
                    dob,
                    fathername,
                    mothername,
                    guardian_name,
                    aadhaar_number,
                    mothertonge_code_fk,
                    social_category_code_fk,
                    religion_code_fk,
                    bpl_y_n,
                    bpl_no,
                    bpl_aay_beneficiary_y_n,
                    disadvantaged_group_y_n,
                    cwsn_y_n,
                    cwsn_disability_type_code_fk,
                    disability_percentage,
                    nationality_code_fk,
                    out_of_sch_child_y_n,
                    child_mainstreamed,
                    blood_group_code_fk,
                    birth_registration_number,
                    identification_mark,
                    health_id,
                    stu_guardian_relationship,
                    guardian_family_income,
                    stu_height_in_cms,
                    stu_weight_in_kgs,
                    guardian_qualification,
                    stu_country_code_fk,
                    stu_contact_address,
                    stu_contact_district,
                    stu_contact_panchayat,
                    stu_police_station,
                    stu_mobile_no,
                    stu_state_code_fk,
                    stu_contact_habitation,
                    stu_contact_block,
                    stu_post_office,
                    stu_pin_code,
                    stu_email,
                    address_equal,
                    guardian_country_code_fk,
                    guardian_state_code_fk,
                    guardian_contact_address,
                    guardian_contact_habitation,
                    guardian_contact_district,
                    guardian_contact_block,
                    guardian_contact_panchayat,
                    guardian_post_office,
                    guardian_police_station,
                    guardian_pin_code,
                    guardian_mobile_no,
                    guardian_email,
                    admission_no,
                    admission_date,
                    status_pre_year,
                    prev_class_appeared_exam,
                    prev_class_exam_result,
                    prev_class_marks_percent,
                    attendention_pre_year,
                    pre_roll_number,
                    pre_class_code_fk,
                    pre_section_code_fk,
                    pre_stream_code_fk,
                    cur_class_code_fk,
                    cur_section_code_fk,
                    cur_stream_code_fk,
                    cur_roll_number,
                    medium_code_fk,
                    admission_type_code_fk,
                    bank_ifsc,
                    stu_bank_acc_no,
                    status,
                    entry_ip,
                    update_ip,
                    ?,              -- created_by
                    ?,              -- updated_by
                    NOW(),          -- deleted_at (FIXED)
                    created_at,
                    updated_at
                FROM bs_student_master
                WHERE student_code = ?
                AND district_code_fk = ?
            ", [
                Auth::id(),
                Auth::id(),
                $student->student_code,
                $student->district_code_fk,
            ]);


            // --------------------------------
            // 3. Insert delete track (audit)
            // --------------------------------
            StudentDeleteTrackModel::create([
                'district_code_fk'      => $student->district_code_fk,
                'circle_code_fk'        => $student->circle_code_fk,
                'school_code_fk'        => $student->school_code_fk,
                'student_code'          => $student->student_code,
                'student_name'          => $student->studentname,
                'delete_reason_code_fk' => $data['delete_reason_code_fk'],
                'prev_delete_status'    => $student->status,
                'entry_ip'              => $request->ip(),
                'enter_by'              => Auth::id(),
                'enter_by_stake_cd'     => Auth::user()->stake_cd ?? null,
                'created_at'            => now(),
            ]);

            // --------------------------------
            // 4. HARD DELETE
            // --------------------------------
            DB::table('bs_student_master')
                ->where('student_code', $student->student_code)
                ->where('district_code_fk', $student->district_code_fk)
                ->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Student archived and permanently removed'
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // =========================Deleted Students View & Delete Student Ens==================================


}
