<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{
    DistrictMaster,
    BlockMaster,
    CircleMaster,
    ClusterMaster,
    WardMaster,
    SchoolMaster
};
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getDistrict(Request $request)
    {
        $data = DistrictMaster::get();        
        return response()->json(['data' => $data]);
    }

    public function getBlocksByDistrict(Request $request, $district_id)
    {
        $blocks = BlockMaster::where('district_id', $district_id)->get();
        return response()->json(['data' => $blocks]);
    }

    public function getCircleByDistrict(Request $request, $district_id)
    {
        $data = CircleMaster::where('district_id', $district_id)->get();
        return response()->json(['data' => $data]);
    }

    public function getClusterByDistrict(Request $request, $district_id)
    {
        $data = ClusterMaster::where('district_id', $district_id)->get();
        return response()->json(['data' => $data]);
    }

    public function getWardsByBlock(Request $request, $block_id)
    {
        $data = WardMaster::where('block_munc_corp_id', $block_id)->get();
        return response()->json(['data' => $data]);
    }

    public function getDisecode(Request $request, $ward_id){
        $disecode = null;
        $wardData = WardMaster::where('id', $ward_id)->first();
        if($wardData && $wardData->schcd){
            $schcd = trim($wardData->schcd ?? null);
            $schoolData = SchoolMaster::whereRaw("CAST(schcd AS TEXT) LIKE ?", [$schcd.'%'])->orderBy('schcd', 'DESC')->first();
            if($schoolData){
                $lastSchcd = $schoolData->schcd;
                $disecode = str_pad((int)$lastSchcd + 1, strlen($lastSchcd), '0', STR_PAD_LEFT);
            }
            else{
                $disecode = $wardData->schcd . '01';
            }
        }
        $data = ['disecode' => $disecode];
        return response()->json(['data'=>$data]);
    }

    public function getSubdivisions(Request $request, $district_id)
    {
        $data = \App\Models\SubdivisionMaster::where('district_id', $district_id)->get();
        return response()->json(['data' => $data]);
    }

    public function getSchoolCategoryTypesByManagement(Request $request, $management_id)
    {
        $categoryTypes = \App\Models\SchoolCategoryTypeMaster::whereIn(
            'id',
            \App\Models\ManagementAndSchoolCategoryTypeMappingMaster::where('school_management_code_pk', $management_id)->pluck('school_category_type_code_pk')
        )->get();

        return response()->json(['data' => $categoryTypes]);
    }

    public function getSchoolByBlock(Request $request, $block_id){
        $schoolList = SchoolMaster::get();
        return response()->json(['data' => $schoolList]);
    }
}
