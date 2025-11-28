<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolMaster extends Model
{
    use SoftDeletes;

    protected $table = 'bs_school_master';

    protected $primaryKey = 'id';

    protected $fillable = [
        'school_code',
        'schcd',
        'school_name',
        'ac_year',
        'establishment_year',
        
        'rurb_code_fk',
        'high_class',
        'low_class',
        'uniform_status',
        'student_lock_status',

        'school_type_code_fk',
        'school_category_code_fk',

        'school_management_code_fk',
        'sch_cat_type_code_fk',

        'district_code_fk',
        'block_munc_corp_code_fk',
        'gs_ward_code_fk',
        'circle_code_fk',
        'cluster_code_fk',
        'subdiv_code_fk',
    ];

    public function school_category(){
        return $this->belongsTo(CategoryMaster::class, 'school_category_code_fk', 'id');
    }

    public function management(){
        return $this->belongsTo(ManagementMaster::class, 'school_management_code_fk', 'id');
    }

    public function district()
    {
        return $this->belongsTo(DistrictMaster::class, 'district_code_fk', 'id');
    }

    public function block()
    {
        return $this->belongsTo(BlockMaster::class, 'block_munc_corp_code_fk', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(WardMaster::class, 'gs_ward_code_fk', 'id');
    }

    public function circle()
    {
        return $this->belongsTo(CircleMaster::class, 'circle_code_fk', 'id');
    }

    public function cluster()
    {
        return $this->belongsTo(ClusterMaster::class, 'cluster_code_fk', 'id');
    }

    public function subDivision()
    {
        return $this->belongsTo(SubdivisionMaster::class, 'subdiv_code_fk', 'id');
    }

    public function mediums()
    {
        return $this->belongsToMany(
                MediumMaster::class,
                'bs_school_medium',
                'school_code_fk',      // foreign key on pivot table
                'medium_code_fk'       // related key on pivot table
            )
            ->withTimestamps()
            ->withPivot('deleted_at');
    }

    // Relationship: One School → Many Classwise Sections
    public function classwiseSections()
    {
        return $this->hasMany(
            SchoolClasswiseSection::class,
            'school_code_fk',   // FK on bs_school_classwise_section
            'id'                // PK on bs_school_master
        );
    }
    
    //Added by Aziza Parvin 24-11-2025 Start
    public function getAllSchools($district_id = null, $management_id = null)
    {
        try {
            $query = $this->with(['management', 'district']);
            if (!empty($district_id)) {
                $query->where('district_code_fk', $district_id);
            }
            if (!empty($management_id)) {
                $query->where('school_management_code_fk', $management_id);
            }
            return $query->get();
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getSchoolDetailsById($id)
    {
        try{
            return $this->with([
                'school_category',
                'management',
                'district',
                'block',
                'ward',
                'subDivision',
                'mediums',
                'classwiseSections',
                'circle',
                'cluster'
            ])
            ->findOrFail($id);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }

    }

    //Added by Aziza Parvin 24-11-2025 End

}


/*


class SchoolMaster extends Model
{
    use HasFactory;
    protected $connection = 'pgsql2';
    // Table name
    protected $table = 'ep_school_master';

    // Primary key
    protected $primaryKey = 'school_code_pk';

    // Auto-incrementing primary key
    public $incrementing = true;

    // PostgreSQL uses bigint for this key
    protected $keyType = 'int';

    // Disable timestamps (no created_at / updated_at)
    public $timestamps = false;

    // Fillable columns (for mass assignment)
    protected $fillable = [
        'schcd',
        'school_name',
        'ac_year',
        'state_code_fk',
        'district_code_fk',
        'block_munc_corp_code_fk',
        'circle_code_fk',
        'cluster_code_fk',
        'gs_ward_code_fk',
        'panchayat_code_fk',
        'assembly_constituency_code_fk',
        'parliamentary_constituency_code_fk',
        'city_code_fk',
        'rurb_code_fk',
        'school_category_code_fk',
        'school_management_code_fk',
        'school_type_code_fk',
        'low_class_code_fk',
        'high_class_code_fk',
        'medium_code_fk1',
        'medium_code_fk2',
        'medium_code_fk3',
        'medium_code_fk4',
        'language_code_fk1',
        'language_code_fk2',
        'language_code_fk3',
        'latdeg',
        'latmin',
        'latsec',
        'londeg',
        'lonmin',
        'lonsec',
        'establishment_year',
        'recog_year_primary',
        'recog_year_secondary',
        'recog_year_hs',
        'year_upgrd_pri_to_upri',
        'year_upgrd_upri_to_sec',
        'year_upgrd_sec_to_hsec',
        'delete_status',
        'entry_ip',
        'entry_time',
        'enter_by',
        'enter_by_stake_cd',
        'update_ip',
        'update_time',
        'update_by',
        'update_by_stake_cd',
        'pin_code',
        'recog_year_upri',
        'other_medium_name',
        'active_date_from',
        'active_date_to',
        'school_unique_code',
        'new_school_status',
        'subdiv_code_fk',
        'village_code_fk',
        'edu_district_code_fk',
        'gmba_status',
        'dise_code',
        'sch_cat_type_code_fk',
        'secondary_affiliation_board_code_fk',
        'council_affiliation_board_code_fk',
        'secondary_exam_name_fk',
        'council_exam_name_fk',
        'subdivision_code_fk',
        'hs_council_index_no_old',
        'secondary_board_index_no',
        'hs_council_index_no',
        'curriculum_followed_fk',
        'other_curriculum_followed',
        'noc_upload_status',
        'school_status',
        'uniform_status',
        'sl_no',
    ];
}
*/