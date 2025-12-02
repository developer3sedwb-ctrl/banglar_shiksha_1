<?php
namespace App\Http\Controllers\student_info;

use App\Http\Controllers\Controller;
use App\Models\student_info\StudentInfo;
use App\Models\student_info\StudentFacilityAndOtherDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequestStudentEntry;
use App\Http\Requests\StoreUserRequestStudentFacilityAndOtherDetails;
use Exception;


class StudentInfoController extends Controller
{
 public function store(StoreUserRequestStudentEntry $request)
    {

        DB::beginTransaction();
// dd($request->all());
        try {
            $student = new StudentInfo();

            $student->studentname = $request->student_name;
            $student->studentname_as_per_aadhaar = $request->student_name_as_per_aadhaar;
            $student->gender_code_fk = $request->gender;
            $student->dob = $request->dob;

            $student->fathername = $request->father_name;
            $student->mothername = $request->mother_name;
            $student->guardian_name = $request->guardian_name;

            $student->aadhaar_number = $request->aadhaar_child;

            $student->mothertonge_code_fk = $request->mother_tongue;
            $student->social_category_code_fk = $request->social_category;
            $student->religion_code_fk = $request->religion;
            $student->nationality_code_fk = $request->nationality;
            $student->blood_group_code_fk = $request->blood_group;
            $student->bpl_y_n = $request->bpl_beneficiary;

            $student->bpl_aay_beneficiary_y_n =  $request->antyodaya_anna_yojana;
            $student->bpl_no =  $request->bpl_number;
            

            $student->disadvantaged_group_y_n = $request->disadvantaged_group;


            $student->cwsn_y_n = $request->cwsn; // if cwsn is yes then only type of impairment
            $student->cwsn_disability_type_code_fk = $request->type_of_impairment;
            $student->disability_percentage = $request->disability_percentage;

            $student->out_of_sch_child_y_n = $request->out_of_school;
            $student->child_mainstreamed = $request->mainstreamed;

            $student->birth_registration_number = $request->birth_reg_no;
            $student->identification_mark = $request->identification_mark;
            $student->health_id = $request->health_id;

            $student->stu_guardian_relationship = $request->relationship_with_guardian;
            $student->guardian_family_income = $request->family_income;
            $student->guardian_qualification = $request->guardian_qualifications;

            $student->stu_height_in_cms = $request->student_height;
            $student->stu_weight_in_kgs = $request->student_weight;

            $student->created_by = auth()->id() ?? 1;

            $student->save();

            DB::commit();

            return response()->json([
                'success'   => true,
                'message'   => 'Student saved successfully',
                'student_id'=> $student->id,
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




















    //Section Aziza start date:01-12-2025
    public function getStudentEntry__()
    {
        try {
            // Load master data
            $stateScholarships = DB::table('bs_name_and_code_of_state_scholarships_master')
                                ->orderBy('id')
                                ->get();
            $centralScholarships = DB::table('bs_name_and_code_of_central_scholarships_master')
                                    ->orderBy('id')
                                    ->get();
            $data['stateScholarships'] = $stateScholarships;
            $data['centralScholarships'] = $centralScholarships;

            // Return view with data
            return view('src.modules.student_entry_update.student_entry_ap', compact('data'));
        } 
        catch (\Exception $e) {

            Log::error('Error in StudentInfoController@getStudentEntry: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Server error while fetching student data',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function getStudentEntry()
{
    try {
        $data = [];

        // ---------------------------------------------
        // 1. Load master data (Dropdowns)
        // ---------------------------------------------
        $data['stateScholarships'] = DB::table('bs_name_and_code_of_state_scholarships_master')
                                        ->orderBy('id')
                                        ->get();

        $data['centralScholarships'] = DB::table('bs_name_and_code_of_central_scholarships_master')
                                          ->orderBy('id')
                                          ->get();


        // ---------------------------------------------
        // 2. Load existing facility details (EDIT MODE)
        // ---------------------------------------------
        $schoolId = 1;  // <-- get from login or session or URL

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

        // ---------------------------------------------
        // 3. Return view with FULL data
        // ---------------------------------------------
        return view('src.modules.student_entry_update.student_entry_ap', compact('data'));

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
        StudentFacilityAndOtherDetails::updateOrCreate(
            ['school_id_fk' => $input['school_id_fk']],   // <-- Adjust this to correct column
            $data
        );

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


    //Section Aziza end date:01-12-2025


}
