<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

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
Route::group(['middleware'=>['web']],function(){

    Route::get('/', 'HomeController@home');


    //TEMPLATE
    Route::get('/template','TemplateController@template');
    Route::get('/ctemplate','TemplateController@ctemplate');
    Route::any('/ctemplate-feedback','TemplateController@feedback');
    Route::any('/ctemplate-feedback-input','TemplateController@feedbackInput');

    //PERSONAL PROFILE
    Route::any('/pProfile','pProfileController@pProfile');
    Route::any('pProfile_input','pProfileController@input');

    Route::any('login','loginController@login');
    Route::any('login-signIn','loginController@signIn');
    Route::any('login-register','loginController@register');
    Route::any('login-forgotPassword','loginController@forgotPassword');
    Route::any('login-getResetPassword','loginController@getResetPassword');
    Route::any('login-resetPassword/{id}','loginController@resetPassword');
    Route::any('login-savePassword','loginController@savePassword');

    Route::group(['prefix'=>'club','namespace'=>'Club'],function(){
        //CLUB
        Route::get('/','ClubController@club');
        Route::any('/club-input-like','ClubController@inputLike');
        Route::any('/club-input-comment','ClubController@inputComment');

        //ACTIVITY
        Route::get('activity','ActivityController@activity');
        Route::get('rActivity/{id}','ActivityController@rActivity');
        Route::get('aActivity/{id}','ActivityController@aActivity');
        Route::any('aActivity-input/{id}','ActivityController@input');
        Route::get('pActivity/{id}','ActivityController@pActivity');

        //MEDIA
        Route::get('media','MediaController@media');
        Route::get('picture/{id?}','MediaController@picture');
        Route::get('video/{id?}','MediaController@video');

        //MANAGEMENT SYSTEM
        Route::group(['namespace'=>'CMS'],function(){
            Route::get('cms','CMSController@CMS');

            //post
            Route::get('cmsPost','CMSPostController@CMSPost');
            Route::any('cmsPost-input','CMSPostController@input');
            Route::any('cmsPost-editGet','CMSPostController@editGet');
            Route::any('cmsPost-editSave','CMSPostController@editSave');
            Route::any('cmsPost-delete','CMSPostController@delete');

            //advertisement
            Route::get('cmsAdvertisement','CMSAdvertisementController@CMSAdvertisement');
            Route::any('cmsAdvertisement-input','CMSAdvertisementController@input');
            Route::any('cmsAdvertisement-delete','CMSAdvertisementController@delete');

            //activity
            Route::get('cmsActivity','CMSActivityController@CMSActivity');
            Route::any('cmsActivity-input','CMSActivityController@input');
            Route::any('cmsActivity-editGet','CMSActivityController@editGet');
            Route::any('cmsActivity-editSave','CMSActivityController@editSave');
            Route::any('cmsActivity-delete','CMSActivityController@delete');
            Route::any('cmsActivity-getResponse','CMSActivityController@getResponse');
            Route::any('cmsActivity-updateResponse','CMSActivityController@updateResponse');
            Route::any('cmsActivity-checkResponse','CMSActivityController@checkResponse');
            Route::any('cmsActivity-getActivity','CMSActivityController@getActivity');
            Route::any('cmsActivity-getFeedback','CMSActivityController@getFeedback');

            //media
            Route::get('cmsMedia','CMSMediaController@CMSMedia');
            Route::any('cmsMedia-getActivity','CMSMediaController@getActivity');
            Route::any('cmsMedia-upload/{c}','CMSMediaController@upload');
            Route::any('cmsMedia-inputMedia/{c}','CMSMediaController@inputMedia');
            Route::any('cmsMedia-input/{c}','CMSMediaController@input');
            Route::any('cmsMedia-deleteMedia/{c}','CMSMediaController@deleteMedia');


            Route::get('cmsMember','CMSMemberController@CMSMember');

        });
    });
});
