<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
    //phpinfo();
    return view('welcome', array('title' => 'WhoopMe'));
    //var_dump(Auth::user());
});

/*------------ Routes to be removed later ------------*/
//Refresh Database (Need dump-autoload to Recognize new seeder classes))
Route::get('/refreshdatabase', function () {
    if (is_callable('shell_exec') &&
        false === stripos(ini_get('disable_functions'), 'shell_exec')) {
        shell_exec('composer dump-autoload');
    }
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed');
});
//Add dummy data
Route::get('/adddummydata', function () {
    Artisan::call('db:seed');
});

//Migrate new db changes
Route::get('/migrate', function () {
    Artisan::call('migrate');
});

//List Routes
Route::get('/list/api/routes', function () {
    $apiRoutes = [];
    /** @var \Illuminate\Routing\Route $route */
    foreach (Route::getRoutes()->getIterator() as $route) {
        if (substr($route->uri(), 0, 3) === 'api') {
            $apiRoutes [$route->uri()] = [
                'method' => implode(',', $route->methods()),
                'function' => $route->getAction()['uses']
            ];
        }
    }
    dd($apiRoutes);
});

//Lists all database data
Route::get('/list/all/models','TestController@listModels');
/*------------ Routes to be removed later ------------*/

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

// without authentication
Route::any('sign_up', array('as' => 'user-signup', 'uses' => 'Front\UserAuthenticateController@anySignup'));
Route::any('sign_in', array('as' => 'user-signin', 'uses' => 'Front\UserAuthenticateController@anySignin'));
Route::any('sign_up_success', array('as' => 'user-signup-success', 'uses' => 'Front\UserAuthenticateController@anySignUpSuccess'));

//with authentication
Route::group(array('prefix' => 'user', 'middleware' => 'auth'), function () {
    Route::any('dashboard', array('as' => 'user-dashboard', 'uses' => 'Front\UserAuthenticateController@anyDashboard'));

    Route::get('invite', array('as' => 'user-invite', 'uses' => 'Front\InviteController@getInvite'));

    Route::get('verify', array('as' => 'user-verify', 'uses' => 'Front\VerifyController@getVerify'));

    Route::get('verify/now', array('as' => 'user-verify-now', 'uses' => 'Front\VerifyController@getVerifyNow'));

    Route::get('verify/now/post', array('as' => 'user-verify-now-post', 'uses' => 'Front\VerifyController@getVerifyNowPost'));

    Route::get('verify/code', array('as' => 'user-verify-code', 'uses' => 'Front\VerifyController@getVerifyCode'));

    Route::any('category/list/with/deals_unlocked/count', array('as' => 'category-list-with-deal-unlocked-count', 'uses' => 'Front\UserUnlockDealController@category_list_with_deal_unlocked_count'));

    Route::any('category/list/with/deals_locked/count', array('as' => 'category-list-with-deal-locked-count', 'uses' => 'Front\UserlockDealController@category_list_with_deal_locked_count'));

    Route::any('category/{category_id}/deals_locked/list', array('as' => 'category-deal-locked-list', 'uses' => 'Front\UserlockDealController@category_deals_locked_list'));

    Route::any('category/{category_id}/deals_unlocked/list', array('as' => 'category-deals_unlocked-list', 'uses' => 'Front\UserUnlockDealController@category_deals_unlocked_list'));

    Route::any('logout', array('as' => 'user-logout', 'uses' => 'Front\UserAuthenticateController@anyLogout'));
});


/*------------ ADMIN ROUTES ------------*/
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


//Route::get('/login', array('as' => 'login', 'uses' => 'Admin\UserController@getLogin'));
Route::get('/login', array('as' => 'login', 'uses' => 'Front\UserAuthenticateController@anyLogin'));
Route::get('/admin', array('as' => 'admin.login', 'uses' => 'Admin\UserController@getLogin'));
Route::post('/admin', array('as' => 'admin', 'uses' => 'Admin\UserController@postLogin'));

Route::get('/admin', array('as' => 'admin.login', 'uses' => 'Admin\UserController@getLogin'));
Route::post('/admin', array('as' => 'admin', 'uses' => 'Admin\UserController@postLogin'));


Route::group(array('prefix' => 'admin', 'middleware' => ['auth', 'admin']), function () {
    //for logged in users
    Route::group(['middleware' => 'auth'], function () {

        //Change Password
        Route::get('/user/changepassword', array('as' => 'user.changepassword', 'uses' => 'Admin\UserController@editPassword'));
        Route::post('/user/changepassword', array('as' => 'user.changepassword', 'uses' => 'Admin\UserController@updatePassword'));

        //Logout
        Route::get('/logout', array('as' => 'logout', 'uses' => 'Admin\UserController@getLogout'));

        //Dashboard
        Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'Admin\DashboardController@index'));

        /*------------------ User Management -----------------*/
        Route::get('/user/list', array('as' => 'user.list', 'uses' => 'UserController@index'));
        Route::get('/user/view/{id}', array('as' => 'user.view', 'uses' => 'UserController@show'));
        /*------------------ User Management -----------------*/


        /*------------------ Category Management -----------------*/
        //List Categories
        Route::get('/category/list', array('as' => 'category.list', 'uses' => 'Admin\CategoryController@index'));
        Route::get('/category/add', array('as' => 'category.add', 'uses' => 'Admin\CategoryController@create'));
        Route::post('/category/add', array('as' => 'category.add', 'uses' => 'Admin\CategoryController@store'));
        Route::get('/category/destroy/{id}', 'Admin\CategoryController@destroy');
        Route::get('/category/edit/{id}', array('as' => 'category.edit', 'uses' => 'Admin\CategoryController@edit'));
        Route::post('/category/{id}', array('as' => 'category.update', 'uses' => 'Admin\CategoryController@update'));
        Route::post('/category/edit/deleteImage', array('as' => 'category.deleteImage', 'uses' => 'Admin\CategoryController@deleteImage'));
        /*------------------ Category Management -----------------*/

        /*------------------ Sub Category (Deal) Management -----------------*/
        //List Deals
        Route::get('/deal/list', array('as' => 'deal.list', 'uses' => 'Admin\SubCategoryController@index'));
        Route::get('/deal/add', array('as' => 'deal.add', 'uses' => 'Admin\SubCategoryController@create'));
        Route::post('/deal/add', array('as' => 'deal.add', 'uses' => 'Admin\SubCategoryController@store'));
        Route::get('/deal/destroy/{id}', 'Admin\SubCategoryController@destroy');
        Route::get('/deal/edit/{id}', array('as' => 'deal.edit', 'uses' => 'Admin\SubCategoryController@edit'));
        Route::post('/deal/{id}', array('as' => 'deal.update', 'uses' => 'Admin\SubCategoryController@update'));
        Route::post('/deal/edit/deleteImage', array('as' => 'deal.deleteImage', 'uses' => 'Admin\SubCategoryController@deleteImage'));
        /*------------------ Sub Category (Deal) Management -----------------*/


        /*------------------ Service Provider Management -----------------*/
        //List Service Provider
        Route::get('/service-provider/list', array('as' => 'provider.list', 'uses' => 'Admin\ServiceProviderController@index'));
        Route::get('/service-provider/add', array('as' => 'provider.add', 'uses' => 'Admin\ServiceProviderController@create'));
        Route::post('/service-provider/add', array('as' => 'provider.add', 'uses' => 'Admin\ServiceProviderController@store'));
        Route::get('/service-provider/destroy/{id}', 'Admin\ServiceProviderController@destroy');
        Route::get('/service-provider/edit/{id}', array('as' => 'provider.edit', 'uses' => 'Admin\ServiceProviderController@edit'));
        Route::post('/service-provider/{id}', array('as' => 'provider.update', 'uses' => 'Admin\ServiceProviderController@update'));
        Route::post('/service-provider/edit/deleteImage', array('as' => 'provider.deleteImage', 'uses' => 'Admin\ServiceProviderController@deleteImage'));
        Route::post('/service-provider/edit/deleteVideo', array('as' => 'provider.deleteVideo', 'uses' => 'Admin\ServiceProviderController@deleteVideo'));
        Route::post('/service-provider/add/getDeals', array('as' => 'provider.getDeals', 'uses' => 'Admin\ServiceProviderController@getDeals'));
        Route::post('/service-provider/edit/getDeals', array('as' => 'provider.getDeals', 'uses' => 'Admin\ServiceProviderController@getDeals'));
        /*------------------ Service Provider Management -----------------*/

        /*------------------ Message Center -----------------*/
        Route::resource('welcome_messages', 'Admin\Message\WelcomeMessageController');
        Route::resource('global_messages', 'Admin\Message\GlobalMessageController');
        Route::resource('wizard_messages', 'Admin\Message\WizardMessageController');
        Route::put('/admin/welcome_messages/sort_update', array(
            'as' => 'message_center.sort_update',
            'uses' => 'Admin\Message\MessageController@sortUpdate'
        ));
        Route::put('/admin/welcome_messages/status_update', array(
            'as' => 'message_center.status_update',
            'uses' => 'Admin\Message\MessageController@statusUpdate'
        ));
        /*------------------ Message Center -----------------*/

        /*------------------ Boost Code Providers -----------------*/
        Route::post('/boost_code_providers/create', array('as' => 'boost_code_providers.add', 'uses' => 'Admin\BoostCodeProviders@store'));
        Route::get('/boost_code_providers/edit/{id}', array('as' => 'boost_code_providers.edit', 'uses' => 'Admin\BoostCodeProviders@edit'));
        Route::post('/boost_code_providers/{id}', array('as' => 'boost_code_providers.update', 'uses' => 'Admin\BoostCodeProviders@update'));
        Route::resource('boost_code_providers', 'Admin\BoostCodeProviders');
        /*------------------ Boost Code Providers -----------------*/

        /*------------------ Quote Message -----------------*/
        Route::get('/quote-messages/list', array('as' => 'quote-messages.list', 'uses' => 'Admin\Message\QuoteMessageController@index'));
        Route::get('/quote-messages/add', array('as' => 'quote-messages.add', 'uses' => 'Admin\Message\QuoteMessageController@create'));
        Route::post('/quote-messages/add', array('as' => 'quote-messages.add', 'uses' => 'Admin\Message\QuoteMessageController@store'));
        Route::get('/quote-messages/destroy/{id}', 'Admin\Message\QuoteMessageController@destroy');
        Route::get('/quote-messages/edit/{id}', array('as' => 'quote-messages.edit', 'uses' => 'Admin\Message\QuoteMessageController@edit'));
        Route::post('/quote-messages/{id}', array('as' => 'quote-messages.update', 'uses' => 'Admin\Message\QuoteMessageController@update'));
        /*------------------ Quote Message -----------------*/
    });
});
/*------------ ADMIN ROUTES ------------*/