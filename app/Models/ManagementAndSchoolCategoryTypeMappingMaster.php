<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagementAndSchoolCategoryTypeMappingMaster extends Model
{
    use SoftDeletes;

    protected $table = 'bs_management_and_school_category_type_mapping_master';

    protected $primaryKey = 'id';

    protected $fillable = [
        'management_id',
        'school_category_type_id',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Relationship: Management
     * management_id → id in ManagementMaster
     */
    public function management()
    {
        return $this->belongsTo(ManagementMaster::class, 'management_id', 'id');
    }

    /**
     * Relationship: School Category Type
     * school_category_type_id → id (or code?) in SchoolCategoryTypeMaster
     */
    public function categoryType()
    {
        return $this->belongsTo(SchoolCategoryTypeMaster::class, 'school_category_type_id', 'id');
    }
}














// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class ManagementAndSchoolCategoryTypeMappingMaster extends Model
// {
//     // protected $connection = 'pgsql2'; 
//     protected $table = 'bs_management_and_school_category_type_mapping_master';
//     protected $primaryKey = 'mapping_code_pk';
//     public $timestamps = false;

//     protected $fillable = [
//         'school_management_code_pk',
//         'school_category_type_code_pk',
//         'active_date_from',
//         'active_date_to',
//         'delete_status',
//         'update_ip',
//         'update_time',
//         'update_by',
//     ];

//     protected $casts = [
//         'mapping_code_pk' => 'integer',
//         'school_management_code_pk' => 'integer',
//         'school_category_type_code_pk' => 'integer',
//         'active_date_from' => 'datetime',
//         'active_date_to' => 'datetime',
//         'update_time' => 'datetime',
//     ];

//     // Relationships
//     public function management()
//     {
//         return $this->belongsTo(ManagementMaster::class, 'school_management_code_pk', 'id');
//     }

//     public function categoryType()
//     {
//         return $this->belongsTo(SchoolCategoryTypeMaster::class, 'school_category_type_code_pk', 'code');
//     }
// }
