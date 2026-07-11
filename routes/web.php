<?php

use App\Http\Controllers\AddBusController;
use App\Http\Controllers\BusDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentEditController;
use App\Http\Controllers\StudentDeleteController;
use App\Http\Controllers\StudentShowController;
use App\Http\Controllers\AdminRegController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminShowController;
use App\Http\Controllers\SdashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\StudentPhotoUploadController;
use App\Http\Controllers\BusShowController;
use App\Http\Controllers\BusEditController;
use App\Http\Controllers\DDashboardController;
use App\Http\Controllers\DriverRegController;
use App\Http\Controllers\DriverShowController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ShowRouteController;
use App\Http\Controllers\ShowStopsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FeeDetailsContoller;
use App\Http\Controllers\MapController;
use App\Http\Controllers\IpFetchController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolShowController;
use App\Http\Controller\BestController;
use App\Http\Controllers\UserPushController;
use App\Http\Controllers\ApkController;
use Illuminate\Support\Facades\Artisan;


# Index home Page Are Show in the Front of project------------------------------------------------------

Route::get('/clear-all-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Railway Laravel Cache Cleared successfully!";
});
Route::get('/', [HomeController::class, 'index']);
Route::get('/push',[UserPushController::class,'push']);
Route::get('/pushed',[UserPushController::class,'pushed']);
Route::get('/s-push',[UserPushController::class,'s_push']);
Route::get('/s-pushed',[UserPushController::class,'s_pushed']);
Route::get('/hh',[UserPushController::class,'hh']);
Route::get('/notification',[UserPushController::class,'notification']);
Route::get('/noti-count',[UserPushController::class,'noti_count']);
Route::post('/delete-push',[UserPushController::class,'delete_push']);
Route::get('/apk',[ApkController::class,'apk']);
Route::get('/apk-upload',[ApkController::class,'apk-upload']);




# Login Page Are the Login And Include----------------------------------------------------------------
Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'store']);

Route::get('/logout', [LogoutController::class, 'logout']);


# Admin Controller--------------------------------------------------------------------------------

Route::get('/adminreg', [AdminRegController::class, 'adminreg']);
Route::post('/adminreg', [AdminRegController::class, 'store']);
Route::get('/adminshow', [AdminShowController::class, 'show']);


# Students Register And Show------------------------------------------------------------- 
Route::get('/student', [StudentController::class, 'student']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/studentshow', [StudentShowController::class, 'shows']);
Route::post('/studentedit', [StudentEditController::class, 'show']);
Route::get('/studentedit', [StudentEditController::class, 'shows']);
Route::post('/studentedit1', [StudentEditController::class, 'change']);
Route::get('/studentedit1', [StudentEditController::class, 'changes']);
Route::post('studentdelete', [StudentDeleteController::class, 'delete']);
Route::get('studentdelete', [StudentDeleteController::class, 'deletes']);
Route::match(['post','get'],'/s-profileshow',[StudentShowController::class, 'sprofileshow']);


// Dashboard of control Panel
Route::get('/s-dashboard', [SdashboardController::class, 'sdashboard']);
Route::get('/a-dashboard', [AdashboardController::class, 'adashboard']);
Route::get('/d-dashboard', [DDashboardController::class, 'ddashboard']);

Route::get('/s-fee-details', [SdashboardController::class, 'sfee_details']);



Route::get('/error', [ErrorController::class, 'error']);

Route::post('/sphotoupload', [StudentPhotoUploadController::class, 'upload']);
Route::post('/sphotouploads', [StudentPhotoUploadController::class, 'uploads']);
Route::post('/sphotochange', [StudentPhotoUploadController::class, 'sphotochange']);
Route::post('/sphotochanges', [StudentPhotoUploadController::class, 'sphotochanges']);


Route::get('/addbus',[AddBusController::class,'show']);
Route::post('/addbus',[AddBusController::class,'store']);
Route::post('/phone-fetch',[AddBusController::class,'fetch_phone']);


Route::get('/busshow',[BusShowController::class,'show']);

Route::post('/busedit',[BusEditController::class,'edit']);
Route::post('/busedit1',[BusEditController::class,'save']);
Route::post('/busdelete',[BusEditController::class,'delete']);

Route::get('/driverreg',[DriverRegController::class,'show']);
Route::post('/driverreg',[DriverRegController::class,'store']);

Route::get('/drivershow',[DriverShowController::class,'show']);
Route::post('/driverdelete',[DriverShowController::class,'delete']);
Route::post('driveredit',[DriverShowController::class,'editshow']);
Route::post('driveredit1',[DriverShowController::class,'change']);

Route::get('/addroute',[RouteController::class,'show']);
Route::post('/addroute',[RouteController::class,'store']);
Route::get('/showroute',[ShowRouteController::class,'show']);
Route::post('/editroute',[ShowRouteController::class,'edit']);
Route::post('/route-edits',[ShowRouteController::class,'save']);
Route::post('/delete-route',[ShowRouteController::class,'delete']);


Route::get('/show-stops',[ShowStopsController::class,'show']);
Route::get('/add-stop',[ShowStopsController::class,'add']);
Route::post('/add-stops',[ShowStopsController::class,'save']);
Route::post('/edit-stop',[ShowStopsController::class,'edit']);
Route::post('/edit-stops',[ShowStopsController::class,'edits']);
Route::post('/delete-stop',[ShowStopsController::class,'delete']);
Route::post('/stop-one-show',[ShowStopsController::class,'oneShow']);
Route::post('/id-fetch',[ShowStopsController::class,'id_fetch']);


Route::post('/bus-details',[BusDetailsController::class,'busdetails']);
Route::post('/assign-bus',[BusDetailsController::class,'assignbus']);
Route::post('/assign-buss',[BusDetailsController::class,'assignbuss']);
Route::post('/stop-fetch',[BusDetailsController::class,'stop_fetch']);
Route::post('/bus-fetch',[BusDetailsController::class,'bus_fetch']);

Route::get('/add-depart',[DepartmentController::class,'add_depart']);
Route::post('/add-departs',[DepartmentController::class,'store']);
Route::get('/show-depart',[DepartmentController::class,'show']);
Route::post('/edit-depart',[DepartmentController::class,'edit']);
Route::post('/edit-departs',[DepartmentController::class,'edits']);
Route::post('/delete-depart',[DepartmentController::class,'delete']);
Route::post('/t-fetch',[BusDetailsController::class,'t_fetch']);
Route::post('/d-drop',[BusDetailsController::class,'drop_bus']);
Route::post('/fetch-b',[DDashboardController::class,'fetch_b']);
Route::post('/fetch-s',[DDashboardController::class,'fetch_s']);
Route::post('/fee-details',[FeeDetailsContoller::class,'fee_details']);
Route::post('/deposits',[FeeDetailsContoller::class,'deposits']);
Route::post('/deposit-fee',[FeeDetailsContoller::class,'deposit_fee']);

Route::get('/add-fee',[FeeDetailsContoller::class,'add_fee']);
Route::post('/add-fees',[FeeDetailsContoller::class,'add_fees']);
Route::get('/show-fee',[FeeDetailsContoller::class,'show_fee']);
Route::post('/fee-edit',[FeeDetailsContoller::class,'fee_edit']);
Route::post('/fee-edits',[FeeDetailsContoller::class,'fee_edits']);
Route::post('/fee-delete',[FeeDetailsContoller::class,'fee_delete']);
Route::post('/total-fee-fetch',[FeeDetailsContoller::class,'total_fee_fetch']);
Route::post('/fees-edit',[FeeDetailsContoller::class,'fees_edit']);
Route::post('/fees-edits',[FeeDetailsContoller::class,'fees_edits']);
Route::post('/fees-delete',[FeeDetailsContoller::class,'fees_delete']);

Route::get('/bus-location', [MapController::class, 'getBusLocation']);
Route::get('/maps',[MapController::class,'maps']);

Route::get('/stop-location', [MapController::class,'getStops']);
Route::get('/ip-fetch',[IpFetchController::class,'ip_fetch']);



Route::get('/school-reg',[SchoolController::class,'school_reg']);
Route::post('/school-regs',[SchoolController::class,'school_regs']);
Route::get('/school-dashboard',[SchoolController::class,'school_dashboard']);
Route::get('/show-school',[SchoolShowController::class,'show']);
Route::post('/school-delete',[SchoolShowController::class,'school_delete']);
Route::post('/school-edit',[SchoolShowController::class,'school_edit']);
Route::post('/school-edits',[SchoolShowController::class,'school_edits']);
Route::post('/school-profile',[SchoolShowController::class,'school_profile']);









