<?php
namespace App\Http\Controllers\student_info;

use App\Http\Controllers\Controller;
use App\Models\student_info\StudentInfo;
use App\Models\student_info\StudentEnrollmentInfo;
use App\Models\student_info\StudentFacilityAndOtherDetails;
use App\Models\student_info\StudentVocationalDetails;
use App\Models\student_info\StudentEntryDraftTracker;
use App\Models\student_info\StudentContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequestStudentEntry;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\StoreUserRequestStudentFacilityAndOtherDetails;
use App\Http\Requests\StoreUserRequestStudentVocationalDetails;
use Exception;
use App\Http\Requests\StoreUserRequestStudentContactInfo;
use Illuminate\Support\Facades\Schema;


class StudentInfoController extends Controller
{
  public function StoreStudentEntryStoreBasicDetails(StoreUserRequestStudentEntry $request)
{
    DB::beginTransaction();

    try {
        $userId = auth()->id() ?? 1;

        $inputMeta = [
            'school_id_fk' => 1,
            // 'entry_ip'     => request()->ip(),
            // 'update_ip'    => request()->ip(),
            'created_by'   => $userId,
            'updated_by'   => $userId,
        ];

        //   ['school_id_fk' => $inputMeta['school_id_fk']];

        $studentAttrs = [
            'studentname'                          => $request->student_name,
            'studentname_as_per_aadhaar'           => $request->student_name_as_per_aadhaar,
            'gender_code_fk'                       => $request->gender,
            'dob'                                  => $request->dob,
            'fathername'                           => $request->father_name,
            'mothername'                           => $request->mother_name,
            'guardian_name'                        => $request->guardian_name,
            'aadhaar_number'                       => $request->aadhaar_child,
            'mothertonge_code_fk'                  => $request->mother_tongue,
            'social_category_code_fk'              => $request->social_category,
            'religion_code_fk'                     => $request->religion,
            'nationality_code_fk'                  => $request->nationality,
            'blood_group_code_fk'                  => $request->blood_group,
            'bpl_y_n'                              => $request->bpl_beneficiary,
            'bpl_aay_beneficiary_y_n'              => $request->antyodaya_anna_yojana,
            'bpl_no'                               => $request->bpl_number,
            'disadvantaged_group_y_n'              => $request->disadvantaged_group,
            'cwsn_y_n'                             => $request->cwsn,
            'cwsn_disability_type_code_fk'         => $request->type_of_impairment,
            'disability_percentage'                => $request->disability_percentage,
            'out_of_sch_child_y_n'                 => $request->out_of_school,
            'child_mainstreamed'                   => $request->mainstreamed,
            'birth_registration_number'            => $request->birth_reg_no,
            'identification_mark'                  => $request->identification_mark,
            'health_id'                            => $request->health_id,
            'stu_guardian_relationship'            => $request->relationship_with_guardian,
            'guardian_family_income'               => $request->family_income,
            'guardian_qualification'               => $request->guardian_qualifications,
            'stu_height_in_cms'                    => $request->student_height,
            'stu_weight_in_kgs'                    => $request->student_weight,

            // metadata
            'school_id_fk'                         => $inputMeta['school_id_fk'],
            // 'entry_ip'                             => $inputMeta['entry_ip'],
            // 'update_ip'                            => $inputMeta['update_ip'],
            'created_by'                           => $inputMeta['created_by'],
            'updated_by'                           => $inputMeta['updated_by'],
        ];




        $studentInfoData = array_merge($studentAttrs, $inputMeta);

        $basic_info_of_student = StudentInfo::updateOrCreate(
            ['school_id_fk' => $inputMeta['school_id_fk']],
            $studentInfoData
        );

        if ($basic_info_of_student) {
        StudentEntryDraftTracker::updateOrCreate(
            [
                'school_id_fk' => $inputMeta['school_id_fk'],
                'step_number'  => 1,
            ],
            [
                'created_by' => $inputMeta['created_by'],
                'updated_by' => $inputMeta['updated_by'],
            ]
        );
    }

        DB::commit();

        return response()->json([
            'success'    => true,
            'message'    => 'Student saved successfully',
        ], 201);

    } catch (\Throwable $e) {
        DB::rollBack();

        Log::error('Error saving student', [
            'error'   => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Server error while saving student',
            'error'   => $e->getMessage(),
        ], 500);
    }
}





public function storeEnrollmentDetails(StoreEnrollmentRequest $request)
{
    DB::beginTransaction();

    try {
        $userId = auth()->id() ?? 1;

        $inputMeta = [
            'school_id_fk' => 1,
            // 'entry_ip'     => request()->ip(),
            // 'update_ip'    => request()->ip(),
            'created_by'   => $userId,
            'updated_by'   => $userId,
        ];
        // ['school_id_fk' => $inputMeta['school_id_fk']];
        $enrollAttrs = [
        
            'admission_no'              => $request->admission_number,
            'status_pre_year'           => $request->admission_status_prev,
            'prev_class_appeared_exam'  => $request->prev_class_appeared_exam,
            'prev_class_exam_result'    => $request->previous_class_result_examination,
            'prev_class_marks_percent'  => $request->percentage_of_overall_marks,
            'attendention_pre_year'     => $request->no_of_days_attended,

            'pre_class_code_fk'         => $request->previous_class,
            'pre_section_code_fk'       => $request->class_section,
            'pre_stream_code_fk'        => $request->student_stream,
            'pre_roll_number'           => $request->previous_student_roll_no,

            'cur_class_code_fk'         => $request->present_class,
            'academic_year'             => $request->accademic_year,
            'cur_section_code_fk'       => $request->present_section,
            'medium_code_fk'            => $request->school_medium,
            'cur_roll_number'           => $request->present_roll_no,
            'admission_date'            => $request->admission_date_present,

            'admission_type_code_fk'    => $request->admission_type,

            // meta
            'school_id_fk'              => $inputMeta['school_id_fk'],
            // 'entry_ip'                  => $inputMeta['entry_ip'],
            // 'update_ip'                 => $inputMeta['update_ip'],
            'created_by'                => $inputMeta['created_by'],
            'updated_by'                => $inputMeta['updated_by'],
        ];
     $studentEnrollmentInfoData = array_merge($enrollAttrs, $inputMeta);

       $enroll = StudentEnrollmentInfo::updateOrCreate(
        ['school_id_fk' => $inputMeta['school_id_fk']],
            $studentEnrollmentInfoData
        );


        if ($enroll) {
            StudentEntryDraftTracker::updateOrCreate(
                [
                    'school_id_fk' => $inputMeta['school_id_fk'],
                    'step_number'  => 2
                ],
                [
                    'created_by' => auth()->id() ?? 1,
                    'updated_by' => auth()->id() ?? 1
                ]
            );
        }


        DB::commit();

        return response()->json([
            'success'       => true,
            'message'       => 'Enrollment saved successfully',
            // 'enrollment_id' => $enroll->id,
        ], 201);

    } catch (\Illuminate\Database\QueryException $ex) {
        DB::rollBack();

        Log::error('SQL error saving enrollment', [
            'error'   => $ex->getMessage(),
            'trace'   => $ex->getTraceAsString(),
            'request' => $request->all(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Database error while saving enrollment',
            'error'   => $ex->getMessage(),
        ], 500);

    } catch (\Throwable $e) {
        DB::rollBack();

        Log::error('Error saving enrollment', [
            'error'   => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Server error while saving enrollment',
            'error'   => $e->getMessage(),
        ], 500);
    }
}


    // =======================================================
    public function getStudentEntry()
    {
        try {
            $data = [];
            $schoolId = 1;  // <-- get from login or session or URL

            // ---------------------------------------------
            // 1. Load master data (Dropdowns)
            // ---------------------------------------------
        $draft = DB::table('bs_student_entry_draft_tracker')
            ->where('status', 1)
            ->where('school_id_fk', $schoolId)
            ->orderByDesc('step_number')
            ->first();

        // Default step = 1 if no record found
        $data['current_step'] = $draft ? $draft->step_number : 0;
            $data['stateScholarships'] = DB::table('bs_name_and_code_of_state_scholarships_master')
                                            ->where('status', 1)
                                            ->orderBy('id')
                                            ->get();

            $data['centralScholarships'] = DB::table('bs_name_and_code_of_central_scholarships_master')
                                                ->where('status', 1)
                                            ->orderBy('id')
                                            ->get();

            // ---------------------------------------------
            // 2. Load existing facility details (EDIT MODE)
            // ---------------------------------------------

            $facility = StudentFacilityAndOtherDetails::where('school_id_fk', $schoolId)->first();


            if ($facility) {

                $data['facility'] = [
                    // Facilities Provided
                    'facilities_provided_for_the_yeear' => $facility->facilities_provided_y_n,
                    'free_uniforms'                     => $facility->free_uniform_y_n,
                    'free_transport_facility'           => $facility->free_transport_facility_y_n,
                    'free_escort'                       => $facility->free_escort_y_n,
                    'free_host_facility'                => $facility->free_hostel_y_n,
                    'free_bicycle'                      => $facility->free_cycle_y_n,
                    'free_shoe'                         => $facility->free_shoe_y_n,
                    'free_exercise_book'                => $facility->free_exercise_book_y_n,
                    'complete_free_books'               => $facility->complete_set_of_free_books_y_n,

                    // Scholarships
                    'central_scholarship'               => $facility->central_scholarship_rcv_y_n,
                    'central_scholarship_name'          => $facility->central_scholarship_code_fk,
                    'central_scholarship_amount'        => $facility->central_scholarship_amount,

                    'state_scholarship'                 => $facility->state_scholarship_rcv_y_n,
                    'state_scholarship_name'            => $facility->state_scholarship_code_fk,
                    'state_scholarship_amount'          => $facility->state_scholarship_amount,

                    'other_scholarship'                 => $facility->other_scholarship_rcv_y_n,
                    'other_scholarship_amount'          => $facility->other_scholarship_amount,

                    // Gifted fields
                    'child_hyperactive_disorder'        => $facility->screened_for_attention_deficit_hyperactive_disorder_y_n,
                    'stu_extracurricular_activity'      => $facility->extracurricular_activity_involved_y_n,
                    'gifted_math'                       => $facility->gifted_talented_child_in_mathematics,
                    'gifted_language'                   => $facility->gifted_talented_child_in_language,
                    'gifted_science'                    => $facility->gifted_talented_child_in_science,
                    'gifted_technical'                  => $facility->gifted_talented_child_in_technical,
                    'gifted_sports'                     => $facility->gifted_talented_child_in_sports,
                    'gifted_art'                        => $facility->gifted_talented_child_in_art,

                    // Other details
                    'provided_mentors'                  => $facility->provided_mentors_y_n,
                    'whether_participated_nurturance_camp' => $facility->participated_in_nurturance_camps_y_n,
                    'state_nurturance'                  => $facility->state_level_y_n,
                    'national_nurturance'               => $facility->national_level_y_n,
                    'participated_competitions'         => $facility->appeared_state_olympiads_national_level_competition_y_n,
                    'ncc_nss_guides'                    => $facility->participate_in_ncc_nss_scouts_guides_y_n,
                    'rte_free_education'                => $facility->free_education_as_per_rte_act_y_n,
                    'homeless'                          => $facility->child_homeless,
                    'special_training'                  => $facility->special_training_facility_y_n,

                    // Digital
                    'able_to_handle_devices'            => $facility->digital_device_inc_internet_yn,
                    'internet_access'                   => $facility->digital_device_inc_internet_fk,
                ];
            }
            else {
                $data['facility'] = null;   // No saved data
            }
            $vocational = StudentVocationalDetails::where('school_id_fk', $schoolId)->first();

            if ($vocational) {
                $data['vocational'] = [
                    'exposure'               => $vocational->exposure_vocational_activities_y_n,
                    'undertook'              => $vocational->undertake_vocational_course_y_n,

                    'trade_sector'           => $vocational->vocational_trade_sector_code_fk,
                    'job_role'               => $vocational->vocational_job_role_code_fk,

                    'theory_hours'           => $vocational->vocational_class_attended_theory,
                    'practical_hours'        => $vocational->vocational_class_attended_practical,
                    'industry_hours'         => $vocational->vocational_class_attended_industry_training,
                    'field_visit_hours'      => $vocational->vocational_class_attended_field_visit,

                    'appeared_exam'          => $vocational->prev_class_exam_appeared_fk,
                    'marks_obtained'         => $vocational->prev_class_marks_percent_voc,

                    'placement_applied'      => $vocational->applied_for_placement_code_fk,
                    'apprenticeship_applied' => $vocational->applied_for_apprenticeship_code_fk,

                    'nsqf_level'             => $vocational->vocational_nsqf_level_code_fk,
                    'employment_status'      => $vocational->vocational_placement_status_code_fk,
                    'salary_offered'         => $vocational->vocational_salary_offered,
                ];
            } else {
                $data['vocational'] = null;
            }
            // ---------------------------------------------
            // 3. Return view with FULL data
            // ---------------------------------------------
            return view('src.modules.student_entry_update.student_entry', compact('data'));

        }
        catch (\Exception $e) {

            Log::error('Error in getStudentEntry: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Server error while fetching data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
// ==============================================================================================================
    public function storeStudentFacilityAndOtherDetails(StoreUserRequestStudentFacilityAndOtherDetails $request)
    {
        try{
        // ----------------------------------------------
        // Pre-set system fields
        // ----------------------------------------------
        $input = [
            'school_id_fk'       => 1,
            'district_code_fk'   => 4,
            'subdivision_code_fk'=> 45,
            'block_munc_code_fk' => 329,
            'circle_code_fk'     => 115,
            'gs_ward_code_fk'    => 11026,
            'entry_ip'           => request()->ip(),
            'update_ip'          => request()->ip(),
            'created_by'         => auth()->id() ?? 1,
            'updated_by'         => auth()->id() ?? 1,
        ];

        // ----------------------------------------------
        // Validated form fields from Form Request
        // ----------------------------------------------
        $validated = $request->validated();
        $saveData = [
            // Facilities
            'facilities_provided_y_n'              => $validated['facilities_provided_for_the_yeear'],
            'free_uniform_y_n'                     => $validated['free_uniforms'],
            'free_transport_facility_y_n'          => $validated['free_transport_facility'],
            'free_escort_y_n'                      => $validated['free_escort'],
            'free_hostel_y_n'                      => $validated['free_host_facility'],
            'free_cycle_y_n'                       => $validated['free_bicycle'],
            'free_shoe_y_n'                        => $validated['free_shoe'],
            'free_exercise_book_y_n'               => $validated['free_exercise_book'],
            'complete_set_of_free_books_y_n'       => $validated['complete_free_books'],

            // Scholarships
            'central_scholarship_rcv_y_n'          => $validated['central_scholarship'],
            'central_scholarship_code_fk'          => $validated['central_scholarship_name'] ?? null,
            'central_scholarship_amount'           => $validated['central_scholarship_amount'] ?? null,

            'state_scholarship_rcv_y_n'            => $validated['state_scholarship'],
            'state_scholarship_code_fk'            => $validated['state_scholarship_name'] ?? null,
            'state_scholarship_amount'             => $validated['state_scholarship_amount'] ?? null,

            'other_scholarship_rcv_y_n'            => $validated['other_scholarship'],
            'other_scholarship_amount'             => $validated['other_scholarship_amount'] ?? null,

            // Extracurricular
            'screened_for_attention_deficit_hyperactive_disorder_y_n' => $validated['child_hyperactive_disorder'] ?? null,
            'extracurricular_activity_involved_y_n'=> $validated['stu_extracurricular_activity'],
            'gifted_talented_child_in_mathematics' => $validated['gifted_math'] ?? null,
            'gifted_talented_child_in_language'    => $validated['gifted_language'] ?? null,
            'gifted_talented_child_in_science'     => $validated['gifted_science'] ?? null,
            'gifted_talented_child_in_technical'   => $validated['gifted_technical'] ?? null,
            'gifted_talented_child_in_sports'      => $validated['gifted_sports'] ?? null,
            'gifted_talented_child_in_art'         => $validated['gifted_art'] ?? null,

            // Other Details
            'provided_mentors_y_n'                 => $validated['provided_mentors'],
            'participated_in_nurturance_camps_y_n'=> $validated['whether_participated_nurturance_camp'],
            'state_level_y_n'                      => $validated['state_nurturance'] ?? null,
            'national_level_y_n'                   => $validated['national_nurturance'] ?? null,

            'appeared_state_olympiads_national_level_competition_y_n'
                                                => $validated['participated_competitions'],
            'participate_in_ncc_nss_scouts_guides_y_n'
                                                => $validated['ncc_nss_guides'],
            'free_education_as_per_rte_act_y_n'    => $validated['rte_free_education'],

            'child_homeless'                       => $validated['homeless'],
            'special_training_facility_y_n'        => $validated['special_training'],

            // Digital
            'digital_device_inc_internet_yn'       => $validated['able_to_handle_devices'],
            'digital_device_inc_internet_fk'       => $validated['internet_access'],
        ];
        // ----------------------------------------------
        // Merge additional fields
        // ----------------------------------------------
        $data = array_merge($saveData, $input);

        // ----------------------------------------------
        // Save data
        // ----------------------------------------------
         $facility = StudentFacilityAndOtherDetails::updateOrCreate(
        ['school_id_fk' => $input['school_id_fk']],
            $data  // or $data based on your variable
        );

        // ONLY IF the above is successful
        if ($facility) {

            // -------------------------------
            // 2) Update draft tracker table
            // -------------------------------
            StudentEntryDraftTracker::updateOrCreate(
                [
                    'school_id_fk' => $input['school_id_fk'],    // match school
                    'step_number'  => 3
                ],
                [
                    'created_by' => auth()->id() ?? 1,
                    'updated_by' => auth()->id() ?? 1
                ]
            );
        }

        return response()->json([
            'status'  => true,
            'message' => 'Student facilities & other details saved successfully!',
        ],200);
        }
        catch(Exception $ex)
        {
            return response()->json([
                'status'=> false,
                'message' => $ex->getMessage()
            ],500);
        }
    }

    // =================================================================
    public function saveVocationalDetails(StoreUserRequestStudentVocationalDetails $request)
    {
        try {
            $input = [
                'school_id_fk'        => 1,
                'district_code_fk'    => 4,
                'subdivision_code_fk' => 45,
                'block_munc_code_fk'  => 329,
                'circle_code_fk'      => 115,
                'gs_ward_code_fk'     => 11026,
                'entry_ip'            => request()->ip(),
                'update_ip'           => request()->ip(),
                'created_by'          => auth()->id() ?? 1,
                'updated_by'          => auth()->id() ?? 1,
            ];

            $data = $request->validated();

            $save = StudentVocationalDetails::updateOrCreate(
                ['school_id_fk' => $input['school_id_fk']],
                [

                    // YES / NO FLAGS
                    'exposure_vocational_activities_y_n'  => $data['exposure_vocational_activities_y_n'] ?? null,
                    'undertake_vocational_course_y_n'     => $data['undertook_vocational_course'],

                    // FK VALUES
                    'vocational_course_code_fk'           => $data['vocational_course_code_fk'] ?? null,
                    'vocational_trade_sector_code_fk'     => $data['trade_sector'] ?? null,
                    'vocational_job_role_code_fk'         => $data['job_role'] ?? null,

                    // CLASS HOURS
                    'vocational_class_attended_theory'            => $data['theory_hours'] ?? null,
                    'vocational_class_attended_practical'         => $data['practical_hours'] ?? null,
                    'vocational_class_attended_industry_training' => $data['industry_hours'] ?? null,
                    'vocational_class_attended_field_visit'       => $data['field_visit_hours'] ?? null,

                    // EXAM DETAILS
                    'prev_class_exam_appeared_fk'  => $data['appeared_exam'] ?? null,
                    'prev_class_marks_percent_voc' => $data['marks_obtained'] ?? null,

                    // PLACEMENT / APPRENTICESHIP
                    'applied_for_placement_code_fk'      => $data['placement_applied'] ?? null,
                    'applied_for_apprenticeship_code_fk' => $data['apprenticeship_applied'] ?? null,

                    // NSQF / EMPLOYMENT
                    'vocational_nsqf_level_code_fk'      => $data['nsqf_level'] ?? null,
                    'vocational_placement_status_code_fk'=> $data['employment_status'] ?? null,
                    'vocational_salary_offered'          => $data['salary_offered'] ?? null,

                    // SYSTEM FIELDS
                    'entry_ip'   => $input['entry_ip'],
                    'update_ip'  => $input['update_ip'],
                    'created_by' => $input['created_by'],
                    'updated_by' => $input['updated_by'],
                ]
            );
            // ONLY IF the above is successful
            if ($save) {

                // -------------------------------
                // 2) Update draft tracker table
                // -------------------------------
                StudentEntryDraftTracker::updateOrCreate(
                    [
                        'school_id_fk' => $input['school_id_fk'],    // match school
                        'step_number'  => 4
                    ],
                    [
                        'created_by' => auth()->id() ?? 1,
                        'updated_by' => auth()->id() ?? 1
                    ]
                );
            }
            return response()->json([
                'status'  => true,
                'message' => 'Vocational details saved successfully!',
                'data'    => $save
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Server error while saving vocational details',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // =================================================================
    public function resetEntry()
    {
        try {
            $schoolId = 1; // Should come from session/login

            $updateData = [
                'status' => 0,
                'deleted_at' => now()
            ];
            // Soft delete + deactivate Facility records
            StudentFacilityAndOtherDetails::where('school_id_fk', $schoolId)
                ->update($updateData);

            // Soft delete + deactivate Vocational records
            StudentVocationalDetails::where('school_id_fk', $schoolId)
                ->update($updateData);
            StudentInfo::where('school_id_fk', $schoolId)
                ->update($updateData);
            StudentEnrollmentInfo::where('school_id_fk', $schoolId)
                ->update($updateData);

            // Soft delete + deactivate Draft Tracker
            StudentEntryDraftTracker::where('school_id_fk', $schoolId)
                ->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Previous entry has been soft deleted and marked inactive.'
            ]);

        } catch (\Exception $e) {

            Log::error("Reset Entry Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unable to reset entry.',
            ], 500);
        }
    }

    // =====================================================================================
        //Section Aziza end date:01-12-2025
        public function storeStudentContactDetails(StoreUserRequestStudentContactInfo $request)
        {
        DB::beginTransaction();

        try {
            $model = new StudentContactInfo();

            // ---- Student contact fields (map incoming names -> DB columns) ----
            $model->stu_country_code_fk      = $request->student_country;
            $model->stu_contact_address      = $request->student_address;
            $model->stu_contact_district     = $request->student_district;
            $model->stu_contact_panchayat    = $request->student_panchayat;
            $model->stu_police_station       = $request->student_police_station;
            $model->stu_mobile_no            = $request->student_mobile;
            $model->stu_state_code_fk        = $request->student_state;
            $model->stu_contact_habitation   = $request->student_locality;
            $model->stu_contact_block        = $request->student_block;
            $model->stu_post_office          = $request->student_post_office;
            $model->stu_pin_code             = $request->student_pincode;
            $model->stu_email                = $request->student_email;

            // address_equal may come from request or default — only set if present
            if ($request->filled('address_equal')) {
                $model->address_equal = $request->address_equal;
            }

            // ---- Guardian contact fields ----
            $model->guardian_country_code_fk = $request->guardian_country;
            $model->guardian_contact_address = $request->guardian_address;
            $model->guardian_contact_district= $request->guardian_district;
            $model->guardian_contact_panchayat = $request->guardian_panchayat;
            $model->guardian_police_station  = $request->guardian_police_station;
            $model->guardian_mobile_no       = $request->guardian_mobile;
            $model->guardian_state_code_fk   = $request->guardian_state;
            $model->guardian_contact_habitation = $request->guardian_locality;
            $model->guardian_contact_block   = $request->guardian_block;
            $model->guardian_post_office     = $request->guardian_post_office;
            $model->guardian_pin_code        = $request->guardian_pincode;
            $model->guardian_email           = $request->guardian_email;

            // ---- System fields ----
            $model->status    = $request->get('status', 1);
            $model->entry_ip  = $request->ip();
            $model->created_by = auth()->id() ?? 1;

            $model->save();

            DB::commit();

            return response()->json([
                'success'    => true,
                'message'    => 'Student contact info saved successfully',
                'student_id' => $model->id,
                'data'       => $model,
            ], 201);

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Error saving student contact info', [
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Server error while saving student contact info',
                'error'   => $e->getMessage(),
            ], 500);
        }
        }


}
