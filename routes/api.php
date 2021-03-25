<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {
    // Get Logged in user details
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::get('/user/test', function (Request $request) {
        return response()->json(['name' => 'test']);
    });
});

// User Registration
Route::post('/user/register', 'Auth\RegisterController@registerWithApi');

// User Login
Route::post('/user/login', 'Auth\LoginController@loginWithApi');

// User Logout
Route::get('/user/logout', 'Auth\LoginController@logoutWithApi');

// Get Logged in user information
Route::get('/user/info', 'UserController@information');

// Update user address
Route::put('/user/address', 'UserController@updateAddress');

// User send password reset link
Route::post('/user/resetpassword', 'Auth\ForgotPasswordController@sendResetLinkEmail');

// User Request for home button code by postal address
Route::post('/user/home_button/request_code/by_post', 'Api\HomeButtonController@requestCodeByPost');

// Delete yourself from the Home button
Route::delete('/user/home_button/', 'Api\HomeButtonController@deleteYourself');

/** ================ Invitation Api Start ================ */
//Send Invitation
Route::post('user/invitation', 'Api\InvitationController@sendInvitation');

//Accept Invitation / Active home button / verify address by entering code which got by postal address
Route::post('user/code/verify', 'Api\InvitationController@verifyAndAcceptInvitation');
/** ================ Invitation Api End ================ */

/** ================ Profile Update Api Start ================ */
//Profile Update api with action
Route::put('user/profile/{action}', 'Api\ProfileController@updateProfile');
/** ================ Profile Update Api End ================ */

/** ================ Home Screen after login Start ================ */
//get total number of deals unlocked by the user home button
Route::get('/user/home_button/deals/unlocked/count', 'Api\DealController@homeButtonTotalDealUnlocked');

//get total number of deals to unlock
Route::get('/user/home_button/deals/to_unlock/count', 'Api\DealController@homeButtonTotalDealsAvailableToUnlock');

//get users linked to home button
Route::get('user/home_button/family', 'Api\HomeButtonController@getFamily');

/** ================ Home Screen after login End ================ */


/** ================ List all locked deals screen Start ================ */
// Get category list with count of deals to lock
Route::get('/category/list/with/deals_locked/count', 'Api\CategoryController@listWithDealsLockedCount');

// Get List of locked deals with details for each category
Route::get('/category/{category}/deals_locked/list', 'Api\DealController@lockedDealListByCategory');

// Unlock a deal
Route::post('/deal/unlock', 'Api\DealController@unlockDeal');

//Use a deal
Route::post('/deal/{deal_id}/used', 'Api\DealController@useDeal');

//List Used Deals (Order List Page)
Route::get('/deals/used/list', 'Api\DealController@listUsedDeals');

/** ================ List all locked deals screen End ================ */


/** ================ List unlocked deals screen Start ================ */
// Get category list with count of deals unlocked
Route::get('/category/list/with/deals_unlocked/count', 'Api\CategoryController@listWithDealsUnLockedCount');

// Get List of unlocked deals with details for each category
Route::get('/category/{category}/deals_unlocked/list', 'Api\DealController@unlockedDealListByCategory');

/** ================ List all locked deals screen End ================ */


/** ================ Brands/service providers screen Start ================ */
// Get List of Brands with details of a deal
Route::get('/deal/{deal}/brand/list', 'Api\ProviderController@getListByDeal');

// Seearch a service provider
Route::get('/brand/search', 'Api\ProviderController@search');

// Get a provider details
Route::get('/brand/{provider}', 'Api\ProviderController@detail');

/** ================ Brands/service providers screen End ================ */


/** ================ Search someones whoop button/Boost code providers screen Start ================ */
// Seearch a someone's whoop button/boost code providers (non city)
Route::get('/someones_whoop_button/search', 'Api\BoostCodeProviderController@search');

// Get a someone's whoop button/boost code provider details (non city)
Route::get('/someones_whoop_button/{provider}', 'Api\BoostCodeProviderController@detail');

// Tap someone's whoop button or city whoop button to add code 
Route::post('/tap_whoop_button', 'Api\BoostCodeProviderController@tapWhoopButton');

//get users save boost codes
Route::get('user/boost_codes', 'Api\BoostCodeProviderController@getUserCodes');

// Use a boost code
Route::put('/use_boost_code', 'Api\BoostCodeProviderController@useBoostCode');

/** ================ Search someones whoop button/Boost code providers screen End ================ */


/** ================ City Buttons Start ================ */
// Get City button list
Route::get('/city/list', 'Api\BoostCodeProviderController@getCityList');

// Get a City button detail
Route::get('/city/{name}', 'Api\BoostCodeProviderController@getCityDetail');

/** ================ City Buttons End ================ */


/** ================ Message Center Start ================ */
Route::get('/message_center/global/message/hello', 'Api\GlobalMessageController@getHelloMessage');
Route::get('/message_center/global/message/service_provider',
    'Api\GlobalMessageController@getServiceProviderMessage');

Route::get('/message_center/wizard/message/list', 'Api\WizardMessageController@getWizardMessageList');

Route::get('/message_center/deal/list', 'Api\DealController@getDealList');

Route::get('/message_center/event/list', 'Api\ProfileController@getEventList');

Route::get('/message_center/category/list', 'Api\CategoryController@getCategoryList');

Route::get('/message_center/service_provider/{providerId}', 'Api\ProviderController@getDetail');

Route::get('/message_center/service_providers/available', 'Api\ProviderController@getAvailableServiceProviders');
/** ================ Message Center End ================ */



/** ================ Appoinment Start ================ */
// book online 
Route::Post('/book_online', 'Api\AppointmentController@bookOnline');
/** ================ Appointment End ================ */