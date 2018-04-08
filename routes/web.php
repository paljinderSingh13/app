<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|three type of domain
	1 site admin  admin
	2 main site no sub 
	3 org dynamic

*/

use Illuminate\Support\Facades\Session;
Auth::routes();
Route::domain('opd.com')->group(function(){
    Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){
        Route::get('logout',[ 'uses'=>'Auth\LoginController@logout']);
        Route::get('login',[ 'uses'=>'Auth\LoginController@showLoginForm']);
        Route::post('login',[ 'uses'=>'Auth\LoginController@login']);
        Route::group(['middleware'=>'auth.admin'], function(){
            Route::get('module',[ 'as'=>'module.list', 'uses'=>'ModuleController@module']);
            Route::post('module/save',[ 'as'=>'module.save', 'uses'=>'ModuleController@save']);

        });
    });

    Route::match(['get','post'],'organization-signup',['as'=>'create.org', 'uses'=>'Create\OrganizationController@create']);
    Route::get('/', function () {return view('welcome'); });
});

//Route::domain('{subdomain}.abc.com')->group(function(){
Route::group(['middleware'=>'domain.check', ], function(){
        Route::post('patient_login', ['as'=>'patient.login', 'uses'=>'Auth\LoginController@login']);
        Route::get('/', ['uses'=>'Organization\Front\HomeController@view'] );
        Route::get('/opd-detail/{id}', ['as'=>'opd.detail' ,'uses'=>'Organization\Front\HomeController@opd_detail'] );
        // Route::group(['namespace'=>'Organization'],function(){
            Route::post('appointment-save', ['as'=>'appointment.save', 'uses'=>"Organization\Front\AppointmentController@save"]);
        // });
         
    Route::group(['prefix'=>'admin', 'namespace'=>'Organization' ], function(){


        Route::get('logout',[ 'uses'=>'Auth\LoginController@logout']);
        Route::get('login',[ 'uses'=>'Auth\LoginController@showLoginForm']);
        Route::post('login',[ 'uses'=>'Auth\LoginController@login']);
        Route::group(['middleware'=>'auth.org'], function(){
        Route::get('/dashboard',['uses'=>'DashboardController@dashboard'])->name('org.dashboard');
        Route::get('/permissons/{id}',[ 'middleware'=>'role', 'as'=>'role.permisson', 'uses'=>'Admin\PermissonController@permisson']);
        Route::post('/permissons/save',[ 'as'=>'permisson.save', 'uses'=>'Admin\PermissonController@save']);

        Route::post('/save/role',['as'=>'role.save', 'uses'=>'RoleController@save']);
        Route::get('/role/delete/{id}',['uses'=>'RoleController@delete']);

        Route::post('shift/save',['as'=>'shift.save', 'uses'=>'ShiftController@save']);
        Route::get('/shift/delete/{id}',['uses'=>'ShiftController@delete']);

        Route::any('/opds/{id?}',[ 'as'=>'opd', 'uses'=>'OpdController@list']);
        Route::post('opd/save',['as'=>'opd.save', 'uses'=>'OpdController@save']);
        Route::get('/opd/delete/{id}',['uses'=>'OpdController@delete']);
           // Route::get('/role/edit/{id}',['as'=>'edit.role', 'uses'=>'Organization\RoleController@list']);
/*doctors */
        Route::post('doctor/save', ['as'=>'dr.save', 'uses'=>'DoctorController@save']);
        Route::get('doctor/delete/{id}', ['as'=>'dr.delete', 'uses'=>'DoctorController@delete']);

        Route::group(['middleware'=>'role'], function(){

            Route::get('doctors', ['as'=>'dr', 'uses'=>'DoctorController@list']);
    /*role*/Route::any('/roles/{id?}',[ 'as'=>'role', 'uses'=>'RoleController@list']);


            Route::any('/shifts/{id?}',[ 'as'=>'shift', 'uses'=>'ShiftController@list']);
            Route::any('/opds/{id?}',[ 'as'=>'opd', 'uses'=>'OpdController@list']);


        });

        });

        });
    });
//});



// Route::group(['domain'=>'{subdomain}.abc.com'],function () {
//     Route::group(['middleware'=>'domain.check'], function($subdomain){
//         Route::group(['prefix'=>'admin'], function(){
//             Route::get('/', function(){echo "404 hello"; });

//             Route::get('/dashboard',['uses'=>'Organization\DashboardController@dashboard'])->name('org.dashboard');
//         Route::get('logout',['as'=>'org.logout', 'uses'=>'Organization\Auth\LoginController@logout']);
//         Route::get('login',['as'=>'org.login', 'uses'=>'Organization\Auth\LoginController@showLoginForm']);
//         Route::post('login',['as'=>'org.login.post', 'uses'=>'Organization\Auth\LoginController@login']);
//         });
//     });
// });

// Route::get('{domain}/login',['uses'=>'Create\OrganizationController@set_domain']);

    Auth::routes();
  Route::get('/home', 'HomeController@index' );

