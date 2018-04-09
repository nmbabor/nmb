<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|--------------------------------------------------------------------------
|	Super Admin Middleware = admin
|-----------------------------------
|	Modarator Middleware = modarator
|
*/

Route::get('engin-change',function(){
	$tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
           foreach ($table as $key => $value)
                $accounting[]=$value;
           DB::statement('ALTER TABLE ' . $value . ' ENGINE = InnoDB'); 
        }
            return $accounting;
});

Route::get('/','HomeController@index');
Route::get('/search-key','SearchController@autoComplete');
Route::get('/search','SearchController@search');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin','HomeController@login');
Route::group(['middleware'=>['auth']],function(){
	
	Route::group(['middleware'=>['modarator']],function(){

		Route::get('dashboard','DashboardController@index');

		Route::group(['middleware'=>['admin']],function(){
			Route::resource('users','UsersController');
			Route::resource('others-info','OthersInfoController');
			Route::get('other/about','OthersInfoController@about');
			Route::resource('menu','MenuController');
			Route::get('page-menu','MenuController@page');
			Route::resource('sub-menu','SubMenuController');
			Route::resource('sub-sub-menu','SubSubMenuController');
			Route::resource('social-links','SocialController');
			Route::resource('business-category','CategoryController');
			Route::resource('category','CategoryController');
			Route::resource('sub-category','SubCategoryController');
			Route::resource('last-step-catageory','LastStepCategoryController');
			Route::resource('brand','BrandController');
			Route::resource('post-field','PostFieldController');
			Route::resource('division-town','DivisionTownController');
			Route::resource('area','AreaController');

			Route::resource('pages','PagesController');
			Route::resource('manage-faq','ManageFaqController');
			Route::resource('manage-ad','ManageAdController');
			Route::get('published-ad','ManageAdController@published');
			Route::get('unpublished-jobs','ManageAdController@jobs');
			Route::get('published-jobs','ManageAdController@publishedJobs');
			Route::resource('manage-business','ManageBusinessController');
			Route::get('pending-business','ManageBusinessController@pending');
			Route::post('change-password',['as'=>'password','uses'=>'UsersController@password']);
			Route::get('change-password','UsersController@changePass');
			Route::get('my-profile','UsersController@profile');
			Route::resource('manage-eshop','EshopManageController');
			Route::resource('banner-manager','AdManagerController');
			Route::get('banner-serial/{id}','AdManagerController@serial');

		});/*Super Admin*/


	});/*Modarator*/

	Route::resource('ad-post','AdPostController');
	Route::get('ad-post/{id}/{title?}','AdPostController@show');
	Route::get('loadSubCat/{id}','AdPostController@loadSubCat');
	Route::get('loadLastCat/{id}','AdPostController@loadLastCat');
	Route::get('loadArea/{id}','AdPostController@loadArea');
	Route::get('profile','ProfileController@profile')->name('profile');
	Route::post('profile-update','ProfileController@updateProfile');
	Route::post('changePassword','ProfileController@changePassword');
	Route::get('my-ads','ProfileController@myAds');
	Route::get('pending-ads','ProfileController@pendingAds');
	Route::get('job-post','JobDashboardController@index');
	Route::get('applicants/{status}/{link}','JobDashboardController@applicants');
	Route::get('loadResume/{id}/{post}','JobDashboardController@loadCv');
	Route::post('application-status','JobDashboardController@status');
	/*CV Making*/
	Route::resource('resume','UserCvController');
	Route::post('resume-objective/{id}','UserCvController@updateObjective');
	Route::get('resume-education','UserCvController@education');
	Route::post('resume-education','UserCvController@updateEducation');
	Route::get('resume-employment','UserCvController@employment');
	Route::post('resume-employment','UserCvController@updateEmployment');
	Route::get('resume-training','UserCvController@training');
	Route::post('resume-training','UserCvController@updateTraining');
	Route::get('resume-language','UserCvController@language');
	Route::post('resume-language','UserCvController@updateLanguage');
	Route::post('resume-delete','UserCvController@delete');
	
	
Route::get('user-info','AuthController@userInfo');
Route::resource('business-account','BusinessAccountController');
Route::get('loadSubCategory/{id}','BusinessAccountController@loadSubCat');
Route::resource('eshop','EshopController');


Route::get('job-apply/{id}','AdController@jobApply');


});
Route::get('login','AuthController@login');
Route::get('signup','AuthController@register');
/*Single Ad Show*/
Route::get('ad/{link}','AdController@show');
/*All Ad show*/
Route::get('ads','AdController@index');
/*Division Wise Ad show*/
Route::get('ads/{div_link}','AdController@divisionWise');
/*Category Wise Ad show*/
Route::get('ads/{div_link}/{cat_link}','AdController@categoryWise');
/*Sub Category Wise Ad show*/
Route::get('ads/{div_link}/{cat_link}/{sub_id}','AdController@subCategoryWise');
/*last Step Category Wise Ad show*/
Route::get('ads/{div_link}/{cat_link}/{sub_id}/{last_id}','AdController@lastCategoryWise');
Route::get('faq','HomeController@faq');
Route::get('business/cat/{link}','BusinessController@category');
Route::get('business/{cat_id}/{sub_id}','BusinessController@index');
Route::get('business/{link}','BusinessController@show');
Route::get('business-directory-in-bangladesh','BusinessController@all');
Route::get('business-directory','BusinessController@directory');

/*Verify Email*/
Route::get('verify-email/{email}/{verifyToken}','AuthController@varifyEmailDone')->name('verify-email');
Route::get('page/{link}','PageViewController@show');
Route::get('{cat_link}',function($link){
	return redirect("ads/bangladesh/$link");
});

