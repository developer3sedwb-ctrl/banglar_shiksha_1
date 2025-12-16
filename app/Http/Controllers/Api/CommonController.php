<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{
    DistrictMaster,
    BlockMaster,
    CircleMaster,
    ClusterMaster,
    WardMaster,
    SchoolMaster,
    VocationalTradeSectorMaster,
    VocationalJobRoleMaster
};
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getDistrict(Request $request)
    {
        try{
            $data = DistrictMaster::get();        
            return response()->json(['data' => $data]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getBlocksByDistrict(Request $request, $district_id)
    {
        try{
            $blocks = BlockMaster::where('district_id', $district_id)->get();
            return response()->json(['data' => $blocks]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getCircleByDistrict(Request $request, $district_id)
    {
        try{
            $data = CircleMaster::where('district_id', $district_id)->get();
            return response()->json(['data' => $data]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getClusterByDistrict(Request $request, $district_id)
    {
        try{
            $data = ClusterMaster::where('district_id', $district_id)->get();
            return response()->json(['data' => $data]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getWardsByBlock(Request $request, $block_id)
    {
        try{
            $data = WardMaster::where('block_munc_corp_id', $block_id)->get();
            return response()->json(['data' => $data]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getDisecode(Request $request, $ward_id){
        try{
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
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getSubdivisions(Request $request, $district_id)
    {
        try{
            $data = \App\Models\SubdivisionMaster::where('district_id', $district_id)->get();
            return response()->json(['data' => $data]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getSchoolCategoryTypesByManagement(Request $request, $management_id)
    {
        try{
            $subcatids = \App\Models\ManagementAndSchoolCategoryTypeMappingMaster::where('management_id', $management_id)->pluck('school_category_type_id');
            $categoryTypes = \App\Models\SchoolCategoryTypeMaster::whereIn('id',$subcatids)->get();
            return response()->json(['data' => $categoryTypes]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function getSchoolByBlock(Request $request, $block_id){
        try{
            $schoolList = SchoolMaster::get();
            return response()->json(['data' => $schoolList]);
        }
        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }
    public function getVocationalTradeSector(){
        $result = VocationalTradeSectorMaster::where('status', 1)->get();
        return response()->json(['data' => $result]);
    }
    public function getJobRoleByVocationalTradeSector(Request $request)
    {
        $roles = VocationalJobRoleMaster::where('status', 1)
                    ->where('sector_code_fk', $request->sector_id)
                    ->get();

        return response()->json([
            'status' => true,
            'data'   => $roles
        ]);
    }

}
