<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\{
    CategoryMaster,
    DistrictMaster,
    ManagementMaster,
    MediumMaster,
    SchoolMaster,
    SchoolClasswiseSection,
    SchoolMedium,
    CircleMaster,
    ClusterMaster,
    SchoolCategoryTypeMaster,
    ManagementAndSchoolCategoryTypeMappingMaster,
    SubdivisionMaster
};


class TeacherManagementController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function teacherAddFrm(){
        try{
        $data = [];
        $pageTitle          = 'SSK/MSK Teacher Add';
        $data['districts']  = DistrictMaster::where('status', 1)->orderBy('name')->get();

        return view('src.teacher_management.teacher_add', compact('data'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Error occurred: '.$e->getMessage());
        }
    }
}