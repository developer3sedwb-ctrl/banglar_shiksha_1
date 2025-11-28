<?php

namespace App\Http\Controllers;
use App\Models\{
    ManagementMaster
};
use Illuminate\Http\Request;
class SiController extends Controller
{

    public function __construct()
    {
        $this->path = 'src.SI';

        // $this->managements = Cache::store('redis')->remember('management_list', 3600, function () {
        //     return ManagementMaster::where('status', 1)->orderBy('name')->get();
    }
    public function dashboard()
    {
        $data = [
            'user_role' => 'Sub Inspector of Schools',
            'user_circle' => 'Amdanga Circle',
        ];
        return view($this->path . '.dashboard')->with('data', $data);
    }
    public function totalMadrasahSchoolRecognized()
    {
        $data = [
            'user_role' => 'Sub Inspector of Schools',
            'user_circle' => 'Amdanga Circle',
        ];
        return view($this->path . '.total_madrasah_school_recognized')->with('data', $data);
    }
    public function totalMadrasahShikshaKendra()
    {
        $data = [
            'user_role' => 'Sub Inspector of Schools',
            'user_circle' => 'Amdanga Circle',
        ];
        return view($this->path . '.total_madrasah_shiksha_kendra')->with('data', $data);
    }
    public function totalSchool()
    {
        try {
            $data = [
                'user_role'          => 'Sub Inspector of Schools',
                'user_circle'        => 'Amdanga Circle'
            ];
            $data['school_managements'] =  ManagementMaster::where('status', 1)->orderBy('name')->get();

            return view($this->path . '.total_school')->with('data', $data);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function totalSskAndMskSchool()
    {
        $data = [
            'user_role' => 'Sub Inspector of Schools',
            'user_circle' => 'Amdanga Circle',
        ];
        return view($this->path . '.total_ssk_and_msk_school')->with('data', $data);
    }
    public function totalStudents()
    {
        try
        {
            $data = [
                'user_role' => 'Sub Inspector of Schools',
                'user_circle' => 'Amdanga Circle',
            ];
            $data['school_managements'] =  ManagementMaster::where('status', 1)->orderBy('name')->get();       
            $data['social_categories'] = config('constants.social_category');       
            return view($this->path . '.total_students')->with('data', $data);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }

    }
    public function totalTeacher()
    {
        $data = [
            'user_role' => 'Sub Inspector of Schools',
            'user_circle' => 'Amdanga Circle',
        ];
        return view($this->path . '.total_teacher')->with('data', $data);
    }
    public function schoolClassGenderWiseEnrollmentReport()
    {
        try {
            $data = [
                'user_role'          => 'Sub Inspector of Schools',
                'user_circle'        => 'Amdanga Circle'
            ];
            $data['school_managements'] =  ManagementMaster::where('status', 1)->orderBy('name')->get();

            return view($this->path . '.scholol_class_gender_wise_enrollment_report')->with('data', $data);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
