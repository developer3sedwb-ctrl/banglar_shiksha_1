<?php
namespace App\Http\Controllers\student_info;

use App\Http\Controllers\Controller;
use App\Models\student_info\StudentInfo;
use App\Models\student_info\StudentEnrollmentInfo;
use App\Models\student_info\StudentContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequestStudentEntry;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\StoreUserRequestStudentContactInfo;
use Illuminate\Support\Facades\Schema;


class StudentInfoController extends Controller
{
    public function StoreStudentEntryStoreBasicDetails(StoreUserRequestStudentEntry $request)
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


    public function storeEnrollmentDetails(StoreEnrollmentRequest $request)
    {
        
        DB::beginTransaction();
        // dd($request->all());
        // Log::info('Enrollment request data:', $request->all());
        // if (Schema::hasColumn('bs_student_enrollment_details_temp', 'cur_class_code_fk')) {
        //  Log::info('Column exists: cur_class_code_fk');
        // } else {
        //     Log::warning('Column MISSING: cur_class_code_fk — check your migration or column name.');
        // }

        try {
            $enroll = new StudentEnrollmentInfo();
        // ---- Admission basic ----
        $enroll->admission_no            = $request->admission_number;
        // ---- Previous Year Data ----
        $enroll->status_pre_year         = $request->admission_status_prev;
        $enroll->prev_class_appeared_exam = $request->prev_class_appeared_exam;
        $enroll->prev_class_exam_result   = $request->previous_class_result_examination;
        $enroll->prev_class_marks_percent = $request->percentage_of_overall_marks;
        $enroll->attendention_pre_year    = $request->no_of_days_attended;

        $enroll->pre_class_code_fk        = $request->previous_class;
        $enroll->pre_section_code_fk      = $request->class_section;
        $enroll->pre_stream_code_fk       = $request->student_stream;
        $enroll->pre_roll_number          = $request->previous_student_roll_no;

        // ---- Present Class ----
        $enroll->cur_class_code_fk        = $request->present_class;
        $enroll->academic_year            = $request->accademic_year;
        $enroll->cur_section_code_fk      = $request->present_section;
        $enroll->medium_code_fk           = $request->school_medium;
        $enroll->cur_roll_number          = $request->present_roll_no;
        $enroll->admission_date          = $request->admission_date_present;
      
        $enroll->admission_type_code_fk   = $request->admission_type;

        // ---- Required foreign keys ----
        // $enroll->school_id_fk             = session('current_school_id') ?? 1;
        // $enroll->created_by               = Auth::id();
        // $enroll->updated_by               = Auth::id();
         $enroll->created_by = auth()->id() ?? 1;
         $enroll->save();

            DB::commit();

            return response()->json([
                'success'   => true,
                'message'   => 'Student saved successfully',
                'student_id'=> $enroll->id,
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
