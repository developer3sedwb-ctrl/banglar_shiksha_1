<?php
namespace App\Http\Controllers\student_info;

use App\Http\Controllers\Controller;
use App\Models\student_info\StudentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequestStudentEntry;


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
            $student->disadvantaged_group_y_n = $request->disadvantaged_group;
            $student->cwsn_y_n = $request->cwsn;
            $student->out_of_sch_child_y_n = $request->out_of_school;

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

}
