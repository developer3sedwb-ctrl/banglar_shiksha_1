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
            $user = Auth::user();
            $roleName = optional($user->roles()->first())->name;
            // dd($roleName);
            $query = StudentDeactivateModel::query()
                ->with([
                    'studentInfo:student_code,studentname,dob,guardian_name,cur_roll_number',
                    'deleteReason:id,name',
                    'currentClass:id,name',
                    'currentSection:id,name',
                ]);
            if (in_array($roleName, ['School Admin', 'HOI Primary'])) {
                // School user → only their school
                $userSchool = $user->schoolMaster;
                $query->where('school_code_fk', $userSchool->id)
                ->where('status', 1);

            } elseif ($roleName === 'Cirlcle') {
                // Circle officer → district + circle
                $query->where('district_code_fk', $user->district_code_fk ?? 23)
                    ->where('circle_code_fk', $user->circle_code_fk ?? 52)
                    ->where('status', 3);

            } elseif ($roleName === 'District Officer') {
                // District officer → district only
                $query->where('district_code_fk', $user->district_code_fk ?? 23);
            }
            // dd($query);
            $deactive_students = $query->get();

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
            $user = Auth::user();
            $roleName = optional($user->roles()->first())->name;
            $userSchool = $user->schoolMaster;

            // -------------------------------
            // Validation
            // -------------------------------
            $request->validate([
                'student_code'    => ['required', 'digits:14'],
                'search_purpose'  => ['required'], // 1=Deactivate, 2=Delete
            ]);

            $student_code   = $request->student_code;
            $searchPurpose  = (int) $request->search_purpose;

            // -------------------------------
            // Base query
            // -------------------------------
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
                    'cur_roll_number',
                    'status'
                ])
                ->where('student_code', $student_code);

            // =================================================
            // ROLE BASED FILTERING
            // =================================================

            // -------------------------------
            // HOI / SCHOOL ADMIN
            // -------------------------------
            if (in_array($roleName, ['School Admin', 'HOI Primary']) && $userSchool) {

                $query->where('school_code_fk', $userSchool->school_code_fk)
                    ->where('status', 1);

                // -------------------------------
                // SI (CIRCLE OFFICER)
                // -------------------------------
            } elseif ($roleName === 'Cirlcle') {

                $query->where('district_code_fk', $user->district_code_fk ?? 23)
                    ->where('circle_code_fk', $user->circle_code_fk ?? 52)
                    ->where('status', 2) // Sent to SI
                    ->where(function ($q) use ($searchPurpose) {

                        // 🔹 Deactivate
                        if ($searchPurpose === 1) {
                            $q->whereExists(function ($sub) {
                                $sub->select(DB::raw(1))
                                    ->from('bs_student_activate_deactivate_track')
                                    ->whereColumn(
                                        'bs_student_activate_deactivate_track.student_code',
                                        'bs_student_master.student_code'
                                    );
                            });
                        }

                        // 🔹 Delete
                        if ($searchPurpose === 2) {
                            $q->whereExists(function ($sub) {
                                $sub->select(DB::raw(1))
                                    ->from('bs_student_delete_track')
                                    ->whereColumn(
                                        'bs_student_delete_track.student_code',
                                        'bs_student_master.student_code'
                                    );
                            });
                        }
                    });

                // -------------------------------
                // DISTRICT OFFICER
                // -------------------------------
            } elseif ($roleName === 'District Officer') {

                $query->where('district_code_fk', $user->district_code_fk)
                    ->whereIn('status', [1, 2]);
            }
            // dd($query);

            $student = $query->first();


            if (!$student) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Student not found or not pending for selected action'
                ], 200);
            }

            // -------------------------------
            // Response
            // -------------------------------
            return response()->json([
                'status' => 'success',
                'data'   => [
                    'student_code'    => $student->student_code,
                    'studentname'     => $student->studentname,
                    'dob'             => $student->dob,
                    'guardian_name'   => $student->guardian_name,
                    'current_class'   => $student->currentClass?->name,
                    'current_section' => $student->currentSection?->name,
                    'cur_roll_number' => $student->cur_roll_number,
                    'status'          => $student->status,
                    'search_purpose'  => $searchPurpose,
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function deactivateStudent(Request $request)
    {
        try {
            DB::beginTransaction();

            // -------------------------------
            // 1. Validate input
            // -------------------------------
            $data = $request->validate([
                'student_code' => 'required|string|size:14',
                'deactivate_reason_code_fk' => 'required|integer|exists:bs_reason_student_deactivation_master,id',
            ]);

            $user = Auth::user();
            $roleName = optional($user->roles()->first())->name;
            $userSchool = $user->schoolMaster;

            // -------------------------------
            // 2. Build student query (ROLE BASED)
            // -------------------------------
            $studentQuery = DB::table('bs_student_master')
                ->where('student_code', $data['student_code'])
                ->lockForUpdate();

            // SCHOOL USER
            if (in_array($roleName, ['School Admin', 'HOI Primary']) && $userSchool) {
                $studentQuery->where('school_code_fk', $userSchool->id);

                // CIRCLE OFFICER
            } elseif ($roleName === 'Cirlcle') {
                $studentQuery->where('district_code_fk', $user->district_code_fk ?? 23)
                    ->where('circle_code_fk', $user->circle_code_fk ?? 52);

                // DISTRICT OFFICER
            } elseif ($roleName === 'District Officer') {
                $studentQuery->where('district_code_fk', $user->district_code_fk ?? 23);
            }

            $student = $studentQuery->first();

            if (!$student) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Student not found or access denied',
                ], 404);
            }

            // -------------------------------
            // 3. Insert into deactivate tracking table
            // -------------------------------
            StudentDeactivateModel::create([
                'student_code'              => $student->student_code,
                'school_code_fk'            => $student->school_code_fk,
                'district_code_fk'          => $student->district_code_fk,
                'circle_code_fk'            => $student->circle_code_fk,
                'cur_class_code_fk'         => $student->cur_class_code_fk,
                'cur_section_code_fk'       => $student->cur_section_code_fk,
                'deactivate_reason_code_fk' => $data['deactivate_reason_code_fk'],
                'operation_by'              => $user->id,
                'operation_by_stake_cd'     => $user->stake_cd ?? null,
                'operation_time'            => now(),
                'operation_ip'              => $request->ip(),
                'prev_status'               => $student->status,
            ]);

            // -------------------------------
            // 4. Update student master
            // -------------------------------
            DB::table('bs_student_master')
                ->where('student_code', $student->student_code)
                ->update([
                    'status'       => 3, // Deactivated
                    'updated_at'   => now(),
                    'update_ip'    => $request->ip(),
                    'updated_by'   => $user->id,
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
            $user = Auth::user();
            $roleName = optional($user->roles()->first())->name;
            $userSchool = $user->schoolMaster;

            // ----------------------------------
            // Base query
            // ----------------------------------
            $query = StudentDeleteTrackModel::query()
                ->with([
                    'studentInfo:student_code,studentname,dob,guardian_name,cur_roll_number',
                ])
                ->where('status', 1);

            // ----------------------------------
            // ROLE BASED FILTERING
            // ----------------------------------

            // SCHOOL USER (HOI / School Admin)
            if (in_array($roleName, ['School Admin', 'HOI Primary']) && $userSchool) {

                $query->where('school_code_fk', $userSchool->id);

                // CIRCLE OFFICER
            } elseif ($roleName === 'Cirlcle') { // keep typo if role name exists like this

                $query->where('district_code_fk', $user->district_code_fk ?? 23)
                    ->where('circle_code_fk', $user->circle_code_fk ?? 52)
                    ->where('delete_reject_status', 3);

                // DISTRICT OFFICER
            } elseif ($roleName === 'District Officer') {

                $query->where('district_code_fk', $user->district_code_fk ?? 23);
            }

            // ----------------------------------
            // Execute
            // ----------------------------------
            $deleted_students = $query->get();

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

    public function deleteStudent_bkp(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = $request->validate([
                'student_code'          => 'required|string|size:14',
                'delete_reason_code_fk' => 'required|integer|exists:bs_student_delete_reason,id',
            ]);
            $user = Auth::user();
            $userRole = $user->roles()->first();
            $roleName = $userRole ? $userRole->name : null;

            // ===============================
            // Determine user role types
            // ===============================
            $user_role_info = [
                'is_super_admin' => $roleName === 'Super Admin',
                'is_hoi_primary' => $roleName === 'HOI Primary',
                'is_school_admin' => $roleName === 'School Admin',
                'is_circle_officer' => $roleName === 'Cirlcle', // Note: typo in role name 'Circle'
                'is_district_officer' => $roleName === 'District Officer', // Add if you have this role
                'is_school_user' => $roleName === 'School Admin' || $roleName === 'HOI Primary',
            ];

            // ===============================
            // Get user's school information if available
            // ===============================
            $userSchool = $user->schoolMaster ?? null;
            $isSchoolUser = $user_role_info['is_school_user'] && $userSchool ? true : false;

            // For circle officers, get their circle
            $userCircle = null;
            if ($user_role_info['is_circle_officer']) {
                $userCircle = $user ?? null;
            }

            // ===============================
            // Filter parameters - Set defaults based on role
            // ===============================
            $district_id = null;
            $subdivision_id = null;
            $circle_id = null;
            $management_id = null;
            $school_id = null;

            // Role-based restrictions
            if ($user_role_info['is_school_user'] && $userSchool) {
                // School users (HOI Primary, School Admin) - restrict to their school
                $district_id = $userSchool->district_code_fk;
                $circle_id = $userSchool->circle_code_fk;
                $subdivision_id = $userSchool->subdivision_code_fk;
                $school_id = $userSchool->id;
                $management_id = $userSchool->school_management_code_fk;
            } elseif ($user_role_info['is_circle_officer'] && $userCircle) {
                // Circle officers - restrict to their circle
                $circle_id = $userCircle->id ?? 66;
                $circle_id = 66;
                $district_id = $userCircle->district_id ?? 1;
                $district_id = 1;
            }
            // --------------------------------
            // 1. Lock student row
            // --------------------------------
            $student = DB::table('bs_student_master')
                ->where('district_code_fk', $userSchool->district_code_fk)
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
    public function deleteStudent(Request $request)
    {
        try {
            DB::beginTransaction();

            // ---------------------------------
            // 1. Validate input
            // ---------------------------------
            $data = $request->validate([
                'student_code'          => 'required|string|size:14',
                'delete_reason_code_fk' => 'nullable|integer|exists:bs_student_delete_reason,id',
                'delete_reject_status'  => 'nullable|integer|in:1,2,3',
            ]);

            $user = Auth::user();
            $roleName = optional($user->roles()->first())->name;
            $userSchool = $user->schoolMaster;

            // ---------------------------------
            // 2. Fetch student (ROLE BASED)
            // ---------------------------------
            $studentQuery = DB::table('bs_student_master')
                ->where('student_code', $data['student_code'])
                ->lockForUpdate();

            if ($roleName === 'HOI Primary' && $userSchool) {
                $studentQuery->where('school_code_fk', $userSchool->id);
            } elseif ($roleName === 'Cirlcle') {
                $studentQuery->where('district_code_fk', $user->district_code_fk ?? 23)
                    ->where('circle_code_fk', $user->circle_code_fk ?? 52);
            }

            $student = $studentQuery->first();

            if (!$student) {
                DB::rollBack();
                return response()->json([
                    'status'  => false,
                    'message' => 'Student not found or access denied',
                ], 404);
            }

            // =================================================
            // CASE 1️⃣ : HOI → SEND DELETE REQUEST TO SI
            // =================================================
            if ($roleName === 'HOI Primary') {

                DB::table('bs_student_master')
                    ->where('student_code', $student->student_code)
                    ->update([
                        'status'      => 2, // Sent to SI
                        'updated_at'  => now(),
                        'update_ip'   => $request->ip(),
                        'updated_by'  => $user->id,
                    ]);

                StudentDeleteTrackModel::create([
                    'district_code_fk'      => $student->district_code_fk,
                    'circle_code_fk'        => $student->circle_code_fk,
                    'school_code_fk'        => $student->school_code_fk,
                    'student_code'          => $student->student_code,
                    'student_name'          => $student->studentname,
                    'delete_reason_code_fk' => $data['delete_reason_code_fk'],
                    'prev_delete_status'    => $student->status,
                    'delete_reject_status'  => 1, // Requested
                    'entry_ip'              => $request->ip(),
                    'enter_by'              => $user->id,
                    'enter_by_stake_cd'     => $user->stake_cd ?? null,
                    'created_at'            => now(),
                ]);

                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Delete request sent to SI',
                ]);
            }

            // =================================================
            // CASE 2️⃣ : SI REJECTS DELETE
            // =================================================
            if ($roleName === 'Cirlcle' && $data['delete_reject_status'] == 2) {

                DB::table('bs_student_master')
                    ->where('student_code', $student->student_code)
                    ->update([
                        'status'      => 1, // Active
                        'updated_at'  => now(),
                        'update_ip'   => $request->ip(),
                        'updated_by'  => $user->id,
                    ]);

                StudentDeleteTrackModel::create([
                    'district_code_fk'      => $student->district_code_fk,
                    'circle_code_fk'        => $student->circle_code_fk,
                    'school_code_fk'        => $student->school_code_fk,
                    'student_code'          => $student->student_code,
                    'student_name'          => $student->studentname,
                    'delete_reason_code_fk' => $data['delete_reason_code_fk'],
                    'prev_delete_status'    => 2,
                    'delete_reject_status'  => 2, // Rejected
                    'entry_ip'              => $request->ip(),
                    'enter_by'              => $user->id,
                    'enter_by_stake_cd'     => $user->stake_cd ?? null,
                    'created_at'            => now(),
                ]);

                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Delete request rejected and student restored',
                ]);
            }

            // =================================================
            // CASE 3️⃣ : SI APPROVES DELETE
            // =================================================
            if ($roleName === 'Cirlcle' && $data['delete_reject_status'] == 3) {

                // -------- ARCHIVE
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

                // -------- TRACK
                StudentDeleteTrackModel::create([
                    'district_code_fk'      => $student->district_code_fk,
                    'circle_code_fk'        => $student->circle_code_fk,
                    'school_code_fk'        => $student->school_code_fk,
                    'student_code'          => $student->student_code,
                    'student_name'          => $student->studentname,
                    'delete_reason_code_fk' => $data['delete_reason_code_fk'],
                    'prev_delete_status'    => $student->status,
                    'delete_reject_status'  => 3, // Approved
                    'entry_ip'              => $request->ip(),
                    'enter_by'              => $user->id,
                    'enter_by_stake_cd'     => $user->stake_cd ?? null,
                    'created_at'            => now(),
                ]);

                // -------- HARD DELETE
                DB::table('bs_student_master')
                    ->where('student_code', $student->student_code)
                    ->delete();

                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Student permanently deleted',
                ]);
            }

            DB::rollBack();
            return response()->json([
                'status'  => false,
                'message' => 'Invalid operation',
            ], 400);
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
