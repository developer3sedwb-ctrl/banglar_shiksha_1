<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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


class SchoolManagementController extends Controller
{
    protected $SchoolMapper;
    public function __construct()
    {
        // $this->middleware('auth');
        $this->SchoolMapper = new SchoolMaster();
    }

    /**
     * Show School List page
     */
    //added by Aziza Parvin 25-11-2025
    public function schoolSearchRedirect(Request $request)
    {
        $district = $request->district_id ? Crypt::encrypt($request->district_id) : null;
        $management = $request->management_id ? Crypt::encrypt($request->management_id) : null;

        return redirect()->route('school.list', [$district, $management]);
    }


    public function schoolList(Request $request)
    {
        try {
            $district_id = null;
            $management_id = null;

            // Get parameters from request
            $districtid = $request->districtid;
            $managementid = $request->managementid;
            $per_page = $request->per_page ?? 20; // Default to 20 per page

            // Decrypt district ID if provided
            if (!is_null($districtid) && $districtid !== 'null' && $districtid !== '') {
                try {
                    $district_id = Crypt::decrypt($districtid);
                } catch (\Throwable $e) {
                    $district_id = null;
                }
            }

            // Decrypt management ID if provided
            if (!is_null($managementid) && $managementid !== 'null' && $managementid !== '') {
                try {
                    $management_id = Crypt::decrypt($managementid);
                } catch (\Throwable $e) {
                    $management_id = null;
                }
            }

            // Get filter data
            $data['districts'] = DistrictMaster::where('status', 1)->select('id', 'name')->orderBy('name')->get();
            $data['school_managements'] = ManagementMaster::where('status', 1)->select('id', 'name')->orderBy('name')->get();

            // Get paginated school list with eager loading


            $query = SchoolMaster::with(['district', 'block', 'ward', 'management'])
                ->where('status', 1);

            // Apply district filter if provided
            if ($district_id) {
                $query->where('district_code_fk', $district_id);
            }

            // Apply management filter if provided
            if ($management_id) {
                $query->where('school_management_code_fk', $management_id);
            }

            // Apply search if provided
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('school_name', 'LIKE', "%{$search}%")
                        ->orWhere('schcd', 'LIKE', "%{$search}%")
                        ->orWhereHas('district', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        });
                });
            }

            // Order and paginate
            $data['school_list'] = $query->orderBy('school_name')
                ->paginate($per_page)
                ->withQueryString(); // This preserves all query parameters


                    // Prepare filters array for view
            $filters = [
                'district_id' => $district_id,
                'management_id' => $management_id,
                'search' => $request->search ?? '',
                'per_page' => $per_page,
                'districtid_param' => $districtid,
                'managementid_param' => $managementid,
            ];
            // return $data;
            return view('src.school_management.school_list', [
                'data' => $data,
                'filters' => $filters, // Add this line
                'selected_district_id' => $district_id,
                'selected_management_id' => $management_id,
                'districtid_param' => $districtid,
                'managementid_param' => $managementid,
                'search_param' => $request->search,
                'per_page' => $per_page,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }
    //added by Aziza Parvin 25-11-2025

    /**
     * Show School Search page
     */
    public function schoolSearch(Request $request, $schcd = null)
    {
        try {
            $data       = [];
            $disecode   = $request->method() === 'POST' ? $request->post('schcd', null) : $schcd;
            if ($disecode) {
                $data = $this->schoolDetails($disecode);
            }
            return view('src.school_management.school_search', compact('data', 'disecode'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show School Details page
     */
    public function schoolDetails($school_id)
    {
        try {
            $data = [];
            if ($school_id) {
                $data['school']             = SchoolMaster::with([
                    'district',
                    'block',
                    'ward',
                    'subDivision',
                    'mediums',
                    'classwiseSections'
                ])->where('schcd', $school_id)->first(); //->toArray();
            }

            if (!empty($data['school']) && $data['school']) {
                $data['high_classes']       = config('constants.high_classes');
                $data['low_classes']        = config('constants.low_classes');

                $data['mediums']            = MediumMaster::where('status', 1)->get();
                $data['school_categories']  = CategoryMaster::where('status', 1)->orderBy('name')->get();
                $data['school_managements'] = ManagementMaster::where('status', 1)->orderBy('name')->get();

                $data['districts']          = DistrictMaster::where('status', 1)->orderBy('name')->get();
                $data['subDivision']        = SubdivisionMaster::where('district_id', $data['school']->district_code_fk)->get();
                $data['circles']            = CircleMaster::where('district_id', $data['school']->district_code_fk)->get();
                $data['clusters']           = ClusterMaster::where('district_id', $data['school']->district_code_fk)->get();

                $subcatids = \App\Models\ManagementAndSchoolCategoryTypeMappingMaster::where('management_id', $data['school']->school_management_code_fk)->pluck('school_category_type_id');
                $data['school_management_category_types'] = \App\Models\SchoolCategoryTypeMaster::whereIn('id', $subcatids)->get();
            }

            return $data;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function schoolContactData(Request $request, $districtid = null)
    {
        try {
            $newtype        = '';
            $title          = '';
            $headertitle    = '';
            $itemList       = [];
            $itemWiseCnt    = [];
            if (!$districtid) {
                $newtype    = 'district';
                $tbltitle   = 'District List';
                $itemList   = DistrictMaster::where('status', 1)->orderBy('name')->get();
            } else {
                $newtype    = 'circle';
                $tbltitle   = 'Circle List';
                $itemList   = CircleMaster::where('district_id', $districtid)->where('status', 1)->orderBy('name')->get();
            }

            if (!$districtid) {
                $title          = 'District wise school opening survey progress monitoring report';
                $itemWiseCnt    = SchoolMaster::select('district_code_fk', DB::raw('COUNT(id) as total'))
                    ->groupBy('district_code_fk')
                    ->pluck('total', 'district_code_fk');


                $itemWiseCnt = DB::table('bs_school_master as s')
                    ->join('bs_district_master as d', 'd.id', '=', 's.district_code_fk')
                    ->select(
                        'd.id',
                        'd.name',
                        DB::raw('SUM(CASE WHEN s.school_category_code_fk = 1 THEN 1 ELSE 0 END) AS total_primary'),
                        DB::raw('SUM(CASE WHEN s.school_category_code_fk > 1 THEN 1 ELSE 0 END) AS total_secondary')
                    )
                    ->whereNull('s.deleted_at')
                    ->groupBy('d.id', 'd.name')
                    ->orderBy('d.id')
                    ->get()
                    ->keyBy('id')   // <-- makes array indexed by district_id
                    ->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name,
                            'total_primary' => (int)$item->total_primary,
                            'total_secondary' => (int)$item->total_secondary,
                        ];
                    })
                    ->toArray();
                // dd($itemWiseCnt);
            } else {
                $districrData   = DistrictMaster::find($districtid);
                $title          = 'Circle wise school opening survey progress monitoring report of ' . ucfirst($districrData->name) . ' district';
                $itemWiseCnt    = DB::table('bs_school_master as s')
                    ->join('bs_district_master as d', 'd.id', '=', 's.circle_code_fk')
                    ->select(
                        'd.id',
                        'd.name',
                        DB::raw('SUM(CASE WHEN s.school_category_code_fk = 1 THEN 1 ELSE 0 END) AS total_primary'),
                        DB::raw('SUM(CASE WHEN s.school_category_code_fk > 1 THEN 1 ELSE 0 END) AS total_secondary')
                    )
                    ->whereNull('s.deleted_at')
                    ->groupBy('d.id', 'd.name')
                    ->orderBy('d.id')
                    ->get()
                    ->keyBy('id')   // <-- makes array indexed by district_id
                    ->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name,
                            'total_primary' => (int)$item->total_primary,
                            'total_secondary' => (int)$item->total_secondary,
                        ];
                    })
                    ->toArray();
            }

            return view('src.school_management.school_contact_details', compact(
                'title',
                'tbltitle',
                'districtid',
                'newtype',
                'itemList',
                'itemWiseCnt'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function schoolInfrastructureSurvey(Request $request, $districtid = null)
    {
        try {
            $newtype        = '';
            $title          = '';
            $headertitle    = '';
            $itemList       = [];
            $itemWiseCnt    = [];
            if (!$districtid) {
                $newtype    = 'district';
                $tbltitle   = 'District List';
                $itemList   = DistrictMaster::where('status', 1)->orderBy('name')->get();
            } else {
                $newtype    = 'circle';
                $tbltitle   = 'Circle List';
                $itemList   = CircleMaster::where('district_id', $districtid)->where('status', 1)->orderBy('name')->get();
            }

            if (!$districtid) {
                $title          = 'District wise school opening survey progress monitoring report';
                $itemWiseCnt    = [];
            } else {
                $districrData   = DistrictMaster::find($districtid);
                $title          = 'Circle wise school opening survey progress monitoring report of ' . ucfirst($districrData->name) . ' district';
                $itemWiseCnt    = [];
            }

            return view('src.school_management.school_infrastructure_survey', compact(
                'title',
                'tbltitle',
                'districtid',
                'newtype',
                'itemList',
                'itemWiseCnt'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function schoolContactDataCircle(Request $request, $circleid = null)
    {
        try {
            $newtype    = 'school';
            $title      = 'School wise school opening survey progress monitoring report of BELIATORE circle';
            $tbltitle   = 'School List';
            $schoolList = SchoolMaster::with(['school_category'])->where('circle_code_fk', $circleid)->orderBy('school_name')->get();

            return view('src.school_management.school_infrastructure_survey_school', compact(
                'title',
                'tbltitle',
                'circleid',
                'newtype',
                'schoolList'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function schoolInfrastructureSurveyCircle(Request $request, $circleid = null)
    {
        try {
            $newtype    = 'school';
            $title      = 'School wise school opening survey progress monitoring report of BELIATORE circle';
            $tbltitle   = 'School List';
            $schoolList = [];

            return view('src.school_management.school_infrastructure_survey_school', compact(
                'title',
                'tbltitle',
                'circleid',
                'newtype',
                'schoolList'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }




    public function schoolAddFrm()
    {
        try {
            $data = [];
            $data['high_classes']           = config('constants.high_classes');
            $data['districts']              = DistrictMaster::where('status', 1)->orderBy('name')->get();
            $data['school_categories']      = CategoryMaster::where('status', 1)->orderBy('name')->get();
            $data['school_managements']     = ManagementMaster::where('status', 1)->orderBy('name')->get();
            $data['mediums']                = MediumMaster::where('status', 1)->get();

            return view('src.school_management.school_add', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show Add School page
     */
    public function schoolAdd(Request $request)
    {
        // dd('here', $request->all());

        try {
            // 1. VALIDATION
            // ---------------------------
            $validated = $request->validate([
                'school_dise_code'          => 'nullable|string|max:11',
                'school_name'               => 'required|string|max:255',
                'school_establishment_year' => 'required|integer|min:1950|max:' . date('Y'),

                'school_location'           => 'required|integer',
                'high_class'                => 'required|integer',
                'low_class'                 => 'required|integer',

                'school_uniform_status'     => "required|integer", //uniform_status
                'school_student_lock_status' => 'required|integer', //school_status

                'school_type'               => 'required',
                'school_category_type'      => 'required|integer|exists:bs_school_category_type_master,id',

                'school_management'         => 'required|integer|exists:bs_management_master,id',
                'sch_cat_type_code_fk'      => 'required|integer|exists:bs_school_category_type_master,id',

                'district_id'               => 'required|integer|exists:bs_district_master,id',
                'block_id'                  => 'required|integer|exists:bs_block_munc_corp_master,id',
                'ward_id'                   => 'nullable|integer|exists:bs_gs_ward_master,id',
                'circle_id'                 => 'required|integer|exists:bs_circle_master,id',
                'cluster_id'                => 'required|integer|exists:bs_cluster_master,id',
                'sub_division'              => 'required|integer|exists:bs_subdivision_master,id',

                // arrays
                'schooL_class_sections'     => 'required|array',
                'schooL_class_sections.*'   => 'required|integer',

                'school_mediums'            => 'required|array',
                'school_mediums.*'          => 'required|integer|exists:bs_medium_master,id',
            ]);

            // ---------------------------
            // 2. FORMAT INPUT DATA
            // ---------------------------
            $inpdata = [
                'schcd'                         => $validated['school_dise_code'],
                'school_name'                   => $validated['school_name'],
                'ac_year'                       => date('Y'),
                'establishment_year'            => $validated['school_establishment_year'],

                'rurb_code_fk'                  => $validated['school_location'],
                'high_class'                    => $validated['high_class'],
                'low_class'                     => $validated['low_class'],
                'uniform_status'                => $validated['school_uniform_status'],
                'student_lock_status'           => $validated['school_student_lock_status'],

                'school_type_code_fk'          => $validated['school_type'],
                'school_category_code_fk'      => $validated['school_category_type'],

                'school_management_code_fk'     => $validated['school_management'],
                'sch_cat_type_code_fk'          => $validated['sch_cat_type_code_fk'],

                'district_code_fk'              => $validated['district_id'],
                'block_munc_corp_code_fk'       => $validated['block_id'],
                'gs_ward_code_fk'               => $validated['ward_id'] ?? null,
                'circle_code_fk'                => $validated['circle_id'],
                'cluster_code_fk'               => $validated['cluster_id'],
                'subdiv_code_fk'                => $validated['sub_division'],
            ];

            // ---------------------------
            // 3. CREATE SCHOOL MASTER
            // ---------------------------
            $school_details = SchoolMaster::create($inpdata);

            if (!$school_details) {
                //dd('Error occurred while adding school. Please try again.');
                return back()->with('error', 'Error occurred while adding school. Please try again.');
            }

            // ---------------------------
            // 4. INSERT CLASSWISE SECTIONS
            // ---------------------------
            foreach ($validated['schooL_class_sections'] as $class_code => $no_of_section) {
                SchoolClasswiseSection::create([
                    'school_code_fk'  => $school_details->id,
                    'class_code_fk'   => $class_code,
                    'no_of_section' => $no_of_section,
                ]);
            }

            // ---------------------------
            // 5. INSERT MEDIUMS
            // ---------------------------
            foreach ($validated['school_mediums'] as $medium_code) {
                SchoolMedium::create([
                    'school_code_fk' => $school_details->id,
                    'medium_code_fk' => $medium_code,
                ]);
            }




            // dd(459, $inpdata, $school_details->toArray(), $request->all());
            // ---------------------------
            // 6. SUCCESS RESPONSE
            // ---------------------------
            return redirect()->back()->with('success', 'School added successfully. Dise Code : ' . $validated['school_dise_code']);
        } catch (\Exception $e) {
            dd('Error occurred: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function schoolUpdate(Request $request)
    {
        try {
            // 1. VALIDATION
            // ---------------------------
            $validated = $request->validate([
                'school_dise_code'          => 'nullable|string|max:11|exists:bs_school_master,schcd',
                'school_name'               => 'required|string|max:255',
                'school_establishment_year' => 'required|integer|min:1950|max:' . date('Y'),

                'school_location'           => 'required|integer',
                'high_class'                => 'required|integer',
                'low_class'                 => 'required|integer',

                'school_uniform_status'     => "required|integer",
                'school_student_lock_status' => 'required|integer',

                'school_type'               => 'required',
                'school_category_type'      => 'required|integer|exists:bs_school_category_type_master,id',

                'school_management'         => 'required|integer|exists:bs_management_master,id',
                'sch_cat_type_code_fk'      => 'required|integer|exists:bs_school_category_type_master,id',

                'circle_id'                 => 'required|integer|exists:bs_circle_master,id',
                'cluster_id'                => 'required|integer|exists:bs_cluster_master,id',
                'sub_division'              => 'required|integer|exists:bs_subdivision_master,id',

                // arrays
                'schooL_class_sections'     => 'required|array',
                'schooL_class_sections.*'   => 'required|integer',

                'school_mediums'            => 'required|array',
                'school_mediums.*'          => 'required|integer|exists:bs_medium_master,id',
            ]);


            $inpdata = [
                'school_name'                   => $validated['school_name'],
                'establishment_year'            => $validated['school_establishment_year'],

                'rurb_code_fk'                  => $validated['school_location'],
                'high_class'                    => $validated['high_class'],
                'low_class'                     => $validated['low_class'],
                'uniform_status'                => $validated['school_uniform_status'],
                'student_lock_status'           => $validated['school_student_lock_status'],

                'school_type_code_fk'          => $validated['school_type'],
                'school_category_code_fk'      => $validated['school_category_type'],

                'school_management_code_fk'     => $validated['school_management'],
                'sch_cat_type_code_fk'          => $validated['sch_cat_type_code_fk'],

                'circle_code_fk'                => $validated['circle_id'],
                'cluster_code_fk'               => $validated['cluster_id'],
                'subdiv_code_fk'                => $validated['sub_division'],
            ];

            $school_details = SchoolMaster::where('schcd', $request->post('school_dise_code'))->first();

            if (!$school_details) {
                return redirect()->back()->with('error', 'Error occurred: School details not found.');
            }

            // History data need to move to backup table before update
            $school_class_sections  = SchoolClasswiseSection::where('school_code_fk', $school_details->id)->get();
            $school_mediums         = SchoolMedium::where('school_code_fk', $school_details->id)->get();

            SchoolClasswiseSection::where('school_code_fk', $school_details->id)->delete();
            SchoolMedium::where('school_code_fk', $school_details->id)->delete();


            // Update School Master
            SchoolMaster::where('schcd', $request->post('school_dise_code'))->update($inpdata);

            // 4. INSERT CLASSWISE SECTIONS
            foreach ($validated['schooL_class_sections'] as $class_code => $no_of_section) {
                SchoolClasswiseSection::create([
                    'school_code_fk'  => $school_details->id,
                    'class_code_fk'   => $class_code,
                    'no_of_section' => $no_of_section,
                ]);
            }

            // 5. INSERT MEDIUMS
            foreach ($validated['school_mediums'] as $medium_code) {
                SchoolMedium::create([
                    'school_code_fk' => $school_details->id,
                    'medium_code_fk' => $medium_code,
                ]);
            }


            return redirect()->route('school.search', $request->post('school_dise_code'))
                ->with('success', 'School updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    //Added by Aziza Parvin 24-11-2025 Start
    public function schoolDetailsBySchoolId($id)
    {
        try {
            $school_id = decrypt($id);
            // dd($school_id);
            $data = $this->SchoolMapper->getSchoolDetailsById($school_id);
            return view('src.school_management.school_details', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }
    //Added by Aziza Parvin 24-11-2025 End



}
