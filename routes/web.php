<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\SendEmailMailable;
use App\Http\Controllers\SessionCheckController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\PolymorphicRelationshipController;
use App\Http\Controllers\FurnitureSoftDeleteController;
use App\Http\Controllers\UserMobileComapnySOftDeleteController;
use App\Jobs\NewUserWelcomeMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sendMail', function () {
    // return view('welcome');
    // Mail::to('whereHERE@gmail.com')->send(new SendEmailMailable());
    // $mail = Mail::to('where@gmail.com')->send(new SendEmailMailable());
    // dump($mail);

    // dispatch(new NewUserWelcomeMail());
    dispatch(new NewUserWelcomeMail('email@gmail.com'));

    return 'Email sent!';
});

Route::get('session_get',[SessionCheckController::class,'accessSession']);
Route::get('session_get_by_key/{key}',[SessionCheckController::class,'accessSessionByKey']);
Route::get('session_set',[SessionCheckController::class,'storeSession']);
Route::get('session_remove',[SessionCheckController::class,'deleteSession']);
Route::get('session_remove_by_key/{key}',[SessionCheckController::class,'deleteSessionByKey']);
// Route::get('getAuthUser',[SessionCheckController::class,'getAuthUser']);



// ======================== Relation =========================
// Add devices
Route::get('add_devices',[RelationshipController::class,'addDevices']);
// one to one
Route::get('get_device',[RelationshipController::class,'getDevice']);
// one to many
Route::get('get_devices',[RelationshipController::class,'getDevices']);
// belongs to
Route::get('get_user_by_deviceid/{id}',[RelationshipController::class,'getUserByDeviceId']);
// device list of current user
Route::get('showCurrentUserDeviceList',[RelationshipController::class,'showCurrentUserDeviceList'])->name('devicelist');

// Add company
Route::get('add_company',[RelationshipController::class,'addCompany']);
// Get company by user id
// Has One Through
Route::get('get_company_by_userid/{id}',[RelationshipController::class,'getCompanyByUserId']);
// Has Many Through
Route::get('get_all_companies_by_userid/{id}',[RelationshipController::class,'getAllCompaniesByUserId']);

// Many to Many
// belongs to Many
Route::get('belongsToManyCompanyByDevice/{id}',[RelationshipController::class,'belongsToManyCompanyByDevice']);
// belongs to Many
Route::get('belongsToManyDeviceByCompany/{id}',[RelationshipController::class,'belongsToManyDeviceByCompany']);
Route::get('belongsToManyDeviceWithCondition/{id}',[RelationshipController::class,'belongsToManyDeviceByCompanyWithCondition']);
// Add data in pivot table
Route::get('attachDeviceAndComany',[RelationshipController::class,'attachDeviceAndComany']);


// ======================== Polymorphic Relation =========================

Route::get('save_all_data',[PolymorphicRelationshipController::class,'saveAllData']);
// One to One and one to many
Route::get('get_image_by_postid/{id}',[PolymorphicRelationshipController::class,'getImageByPostid']);
Route::get('get_image_by_authorid/{id}',[PolymorphicRelationshipController::class,'getImageByAuthorid']);
Route::get('get_parent_model_by_imageid/{id}',[PolymorphicRelationshipController::class,'getParentModelByImageid']);

// Many to many
Route::get('get_tag_by_post_id/{id}',[PolymorphicRelationshipController::class,'getTagOfPostById']);
Route::get('get_tag_by_author_id/{id}',[PolymorphicRelationshipController::class,'getTagOfAuthorById']);
Route::get('get_post_models_by_tag_id/{id}',[PolymorphicRelationshipController::class,'getPostModelsByTagId']);
Route::get('get_author_models_by_tag_id/{id}',[PolymorphicRelationshipController::class,'getAuthorModelsByTagId']);

Route::get('getdataqueries',[PolymorphicRelationshipController::class,'getdataqueries']);

// SoftDeletes Practice SINGLE TABLE

Route::get('store_furniture',[FurnitureSoftDeleteController::class,'storeFurniture']);
Route::get('delete_furniture',[FurnitureSoftDeleteController::class,'deleteFurniture']);
Route::get('list_furniture_with_trashed',[FurnitureSoftDeleteController::class,'listAllFurnitureWithTrashed']);
Route::get('list_furniture',[FurnitureSoftDeleteController::class,'listAllFurniture']);

// SoftDeletes Practice MULTIPLE TABLE SOFTDELETES USER, MOBILENO AND SOFTCOMAPNY TABLE

Route::get('store_mobile_company_data',[UserMobileComapnySOftDeleteController::class,'storeMobileCompanyData']);

Route::get('list_all_user_mobile_company',[UserMobileComapnySOftDeleteController::class,'listAllMobileCompanyData']);
Route::get('list_user_mobile_company_data',[UserMobileComapnySOftDeleteController::class,'listMobileCompanyData']);

Route::get('all_list_user_mobile_company_data',[UserMobileComapnySOftDeleteController::class,'allListMobileCompanyData']);

Route::get('delete_user_data',[UserMobileComapnySOftDeleteController::class,'deleteUserData']);
Route::get('restore_user_data',[UserMobileComapnySOftDeleteController::class,'restoreUserData']);

