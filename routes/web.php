<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\AccessControl\ModuleController;
use App\Http\Controllers\student_info\StudentInfoController;
// use App\Http\Controllers\AccessControl\PermissionController;
// use App\Http\Controllers\AccessControl\RoleController;
use App\Http\Controllers\{
    SchoolManagementController,
    StudentManagementController,
    TeacherManagementController,
    SiController,
};

// SSO Authentication Routes
Route::middleware(['prevent.back'])->group(function () {
    Route::get('/sso/callback', [SSOController::class, 'callback'])->name('sso.callback');
    Route::get('/sso/login', [SSOController::class, 'login'])->name('sso.login');
    Route::post('/sso/logout-callback', [SSOController::class, 'logoutCallback'])->name('sso.logout.callback');
    Route::post('/sso/logout', [SSOController::class, 'logout'])->name('sso.logout');
});

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/health', [SSOController::class, 'health'])->name('health');

// Protected routes (require SSO authentication - both web and API)
Route::middleware(['sso.auth', 'prevent.back'])->group(function () {

    // For change password
    Route::post('/change-password', [SSOController::class, 'changePassword'])->name('change.password');
    // For updating phone to UDIN
    Route::post('/api/update-phone-udin', [SSOController::class, 'updatePhoneUdin'])->middleware('auth');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Impersonation routes
        Route::get('/users/{user}/impersonate', [UserController::class, 'impersonate'])->name('users.impersonate');
        Route::post('/users/stop-impersonate', [UserController::class, 'stopImpersonate'])->name('users.stop-impersonate');

        // User Management
        Route::resource('users', UserController::class);
        Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');

        // Role Management
        Route::resource('roles', RoleController::class);

        // Permission Management
        Route::resource('permissions', PermissionController::class);
        Route::post('permissions/bulk-action', [PermissionController::class, 'bulkAction'])->name('permissions.bulk-action');
    });

    // User Profile routes
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::put('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');
    Route::post('/settings/password', [DashboardController::class, 'changePassword'])->name('settings.password');

    // marge route



    Route::post('/student/store', [StudentInfoController::class, 'store'])
        ->name('student.store');


    Route::post(
        '/student/store_student_entry_basic_details',
        [StudentInfoController::class, 'StoreStudentEntryStoreBasicDetails']
    )->name('student.store_student_entry_basic_details');

    Route::post(
        '/student/store_enrollment_details',
        [StudentInfoController::class, 'storeEnrollmentDetails']
    )->name('student.store_enrollment_details');



    Route::post(
        '/student/store_student_entry_contact_details',
        [StudentInfoController::class, 'storeStudentContactDetails']
    )->name('student.store_student_entry_contact_details');


    //      Route::post('/student/basic/store', [StudentInfoController::class, 'storeBasic'])->name('student.basic.store');
    // Route::post('/student/enrollment/store', [StudentInfoController::class, 'storeEnrollment'])->name('student.enrollment.store');


    Route::view('/student-edit', 'src.modules.student_entry_update.Student_edit')
        ->name('student.edit');

    Route::view('/student-basic-details-update', 'src.modules.student_entry_update.Student_update_basic_details')
        ->name('student.update_basic_details');

    Route::view(
        '/update-aadhar',
        'src.modules.student_entry_update.update_student_aadhar'
    )->name('student.update_aadhar');



    // routes/web.php
    // routes/web.php
    Route::view('/student-list', 'src.modules.student_information.student_list')
        ->name('student_list.list');

    Route::view('/enrollment-report', 'src.modules.student_information.enrollment_report')
        ->name('enrollment_report.report');

    Route::view('/uniform-scms/dashboard', 'src.modules.uniform_scms.dashboard_uniform_scms')
        ->name('uniform_scms.dashboard');


    Route::view(
        '/uniform-scms/uniform-delivery-status-1st-set',
        'src.modules.uniform_scms.uniform_delivery_status_1st_set'
    )->name('uniform_scms.uniform_delivery_status_1st_set');



    // Route for the Student Delete page
    Route::view(
        '/student/delete',
        'src.modules.student_delete_deactivate.student_delete'
    )->name('student_delete');

    // Route for the Enrollment Deactivate page
    // (If the blade file is different for this view, change the view string accordingly)
    Route::view(
        '/student/student-deactivate',
        'src.modules.student_delete_deactivate.student_deactivated'
    )->name('student_deactivated');

    Route::view(
        '/employee-management/employee-list',
        'src.modules.employee_management.employee_list'
    )->name('employee_list');

    Route::view(
        '/school-management/bs-udise',
        'src.modules.school_management.bs_udise'
    )->name('bs_udise');


    Route::view(
        '/reports/beneficiary_verification_status_report',
        'src.modules.reports.beneficiary_verification_status_report'
    )->name('beneficiary_verification_status_report');



    Route::get('/student-bulk-upload', function () {
        return view('src.modules.student_entry_update.student_bulk_upload');
    })->name('student.bulk.upload');



    /* Protected Routes */



    /* Protected Routes */
    // Route::resource('roles', RoleController::class);
    // Route::resource('modules', ModuleController::class);
    // Route::resource('permissions', PermissionController::class);
    // Route::get('/submodules/{module}', [ModuleController::class, 'submodules'])->name('submodules');
    // Route::get('/submodules/{module}/edit', [ModuleController::class, 'submoduleEdit'])->name('submodules.edit');
    // Route::get('/submodules/{module}/create', [ModuleController::class, 'submoduleCreate'])->name('submodules.create');


    Route::get('/student-list/deactive', [StudentManagementController::class, 'studentDeactiveList'])->name('student.deactivelist');
    Route::post('/student-list/deactive', [StudentManagementController::class, 'studentDeactiveSearchList'])->name('student.deactiveSearchList');

    Route::get('/add-school', [SchoolManagementController::class, 'schoolAddFrm'])->name('school.addfrm');
    Route::get('/school-add', [SchoolManagementController::class, 'schoolAddFrm'])->name('school.addform');
    Route::post('/school-add', [SchoolManagementController::class, 'schoolAdd'])->name('school.add');
    Route::post('/school-update', [SchoolManagementController::class, 'schoolUpdate'])->name('school.update');
    Route::get('/school-list/{district?}/{management?}', [SchoolManagementController::class, 'schoolList'])->name('school.list');
    Route::get('/school-list-result', [SchoolManagementController::class, 'schoolSearchRedirect'])
        ->name('school.search.redirect');
    Route::get('/school-search/{schcd?}', [SchoolManagementController::class, 'schoolSearch'])->name('school.search');
    Route::post('/school-search', [SchoolManagementController::class, 'schoolSearch'])->name('school.search1');
    Route::get('/school-details/{id}', [SchoolManagementController::class, 'schoolDetailsBySchoolId'])->name('school.details');

    Route::controller(SchoolManagementController::class)
        ->prefix('school-infrastructure-survey')
        ->name('school.infrastructureSurvey.')
        ->group(function () {
            Route::get('/', 'schoolInfrastructureSurvey')->name('index');
            Route::get('/district/{districtid}', 'schoolInfrastructureSurvey')->name('district');
            Route::get('/circle/{circleid}', 'schoolInfrastructureSurveyCircle')->name('circle');
        });

    Route::controller(SchoolManagementController::class)
        ->prefix('school-contact-details')
        ->name('school.contactDetails.')
        ->group(function () {
            Route::get('/', 'schoolContactData')->name('index');
            Route::get('/district/{districtid}', 'schoolContactData')->name('district');
            Route::get('/circle/{circleid}', 'schoolContactDataCircle')->name('circle');
        });

    Route::get('/teacher-add', [TeacherManagementController::class, 'teacherAddFrm'])->name('teacher.addfrm');
    Route::post('/teacher-add', [TeacherManagementController::class, 'teacherAddFrm'])->name('teacher.addData');

    /* UnProtected Routes */
    Route::get('/modules/{moduleId}/submodules', [ModuleController::class, 'submoduleListData'])->name('modules.submodules');
    Route::get('/dynamic/menu', [PermissionController::class, 'dynamicMenu'])->name('dynamic.menu');

    Route::prefix('api')->group(function () {
        Route::get('/district', [CommonController::class, 'getDistrict'])->name('api.get.district');
        Route::get('/educational_district', [CommonController::class, 'educationalDistrict'])->name('api.get.educational_district');
        Route::get('/blocks/{district_id}', [CommonController::class, 'getBlocksByDistrict'])->name('api.get.blocks_by_district');
        Route::get('/circles/{district_id}', [CommonController::class, 'getCircleByDistrict'])->name('api.get.circles_by_district');
        Route::get('/clusters/{district_id}', [CommonController::class, 'getClusterByDistrict'])->name('api.get.cluster_by_district');
        Route::get('/wards/{block_id}', [CommonController::class, 'getWardsByBlock'])->name('api.get.wards_by_block');

        Route::get('/subdivisions/{district_id}', [CommonController::class, 'getSubdivisions'])->name('api.get.subdivisions');
        Route::get('/management-school-category-types/{management_id}', [CommonController::class, 'getSchoolCategoryTypesByManagement'])->name('api.get.management_school_category_types');
        Route::get('/getdisecode/{ward_id}', [CommonController::class, 'getDisecode'])->name('api.get.disecode');

        Route::get('/school/block/{block_id}', [CommonController::class, 'getSchoolByBlock'])->name('api.get.schoolByBlock');

        Route::get('/get-vocational-trade-sector', [CommonController::class, 'getVocationalTradeSector'])->name('get.vocational.trade.sector');
        Route::post('/get-vocational-job-role-by-trade-sector', [CommonController::class, 'getJobRoleByVocationalTradeSector'])->name('get.jobrole.by_vocational_trade.sector');
    });





    //SI Routes by Aziza Parvin Start
    Route::prefix('si')->group(function () {
        Route::get('/dashboard', [SiController::class, 'dashboard'])->name('si.dashboard');
        Route::get('/total-madrasah-school-recognized', [SiController::class, 'totalMadrasahSchoolRecognized'])->name('si.total_madrasah_school_recognized');
        Route::get('/total-madrasah-shiksha-kendra', [SiController::class, 'totalMadrasahShikshaKendra'])->name('si.total_madrasah_shiksha_kendra');
        Route::get('/total-school', [SiController::class, 'totalSchool'])->name('si.total_school');
        Route::get('/total-ssk-and-msk-school', [SiController::class, 'totalSskAndMskSchool'])->name('si.total_sssk_and_msk_school');
        Route::get('/total-students', [SiController::class, 'totalStudents'])->name('si.total_students');
        Route::get('/total-teacher', [SiController::class, 'totalTeacher'])->name('si.total_teacher');
        Route::get('/school-class-gender-wise-enrollment', [SiController::class, 'schoolClassGenderWiseEnrollmentReport'])->name('si.school_class_gender_wise_enrollment_report');
    });
    Route::prefix('hoi')->group(function () {
    // routes/web.php
        Route::get('/student-entry', [StudentInfoController::class, 'getStudentEntry'])->name('student.entry');
        Route::post('/save-student-facility-and-other-details', [StudentInfoController::class, 'storeStudentFacilityAndOtherDetails'])->name('hoi.student.facility');
        Route::post('/save-student-vocational-details', [StudentInfoController::class, 'saveVocationalDetails'])->name('save.vocational.details');
        Route::delete('/student-entry/reset', [StudentInfoController::class, 'resetEntry'])->name('student.entry.reset');
    });

    // Route::get('/test-error', function () {
    //     // wrong SQL to trigger QueryException
    //     DB::select("SELECT * FORM schools");
    // });

    //SI Routes by Aziza Parvin End




    // ===========Password Reset HOI====================

    // example

});

// Fallback route
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
