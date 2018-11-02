<?php

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

//Auth::routes();


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/', ['uses' => 'DashboardController@getIndex', 'as' => 'dashboard.index']);
    Route::get('dashboard', ['uses' => 'DashboardController@getIndex', 'as' => 'dashboard.index']);
    Route::get('logout', ['uses' => 'Auth\LoginController@logout', 'as' => 'logout']);
	Route::prefix('logs')->group(function () {
		Route::get('show-all', ['uses' => 'LogController@getShowAll', 'as' => 'log.show-all']);
		Route::get('ajax-data', ['uses' => 'LogController@getAjaxData', 'as' => 'log.get-ajax-data']);
	});
    Route::prefix('users')->group(function () {
        Route::get('show-all', ['middleware' => ['permission:user.show-all'], 'uses' => 'UserController@getShowAll', 'as' => 'user.get-show-all']);
        Route::get('ajax-data', ['middleware' => ['permission:user.show-all'], 'uses' => 'UserController@getAjaxData', 'as' => 'user.get-ajax-data']);
        Route::get('edit/{id}', ['middleware' => ['permission:user.edit'], 'uses' => 'UserController@getEdit', 'as' => 'user.get-edit']);
        Route::post('edit/{id}', ['middleware' => ['permission:user.edit'], 'uses' => 'UserController@postEdit', 'as' => 'user.post-edit']);
        Route::get('add', ['middleware' => ['permission:user.add'], 'uses' => 'UserController@getAdd', 'as' => 'user.get-add']);
        Route::post('add', ['middleware' => ['permission:user.add'], 'uses' => 'UserController@postAdd', 'as' => 'user.post-add']);
        Route::post('move-trash', ['middleware' => ['permission:user.trash'], 'uses' => 'UserController@postMoveTrash', 'as' => 'user.post-move-trash']);
        Route::post('put-back', ['middleware' => ['permission:user.trash'], 'uses' => 'UserController@postPutBack', 'as' => 'user.post-put-back']);
        Route::get('show-trash', ['middleware' => ['permission:user.trash'], 'uses' => 'UserController@getShowTrash', 'as' => 'user.get-show-trash']);
        Route::get('ajax-data-trash', ['middleware' => ['permission:user.trash'], 'uses' => 'UserController@getAjaxDataTrash', 'as' => 'user.get-ajax-data-trash']);
        Route::post('remove-trash', ['middleware' => ['permission:user.remove'], 'uses' => 'UserController@postRemoveTrash', 'as' => 'user.post-remove-trash']);
        Route::get('edit_myself/{id}', ['middleware' => ['ownerMiddleware'], 'uses' => 'UserController@getEdit2', 'as' => 'user.get-edit']);
    });
    Route::group(['prefix' => 'authorized', 'middleware' => ['role:super']], function () {
        Route::get('show-role-user', ['uses' => 'AuthorizedController@getShowRoleUser', 'as' => 'authorized.get-show-role-user']);
        Route::get('ajax-role-user', ['uses' => 'AuthorizedController@getAjaxDataRoleUser', 'as' => 'authorized.get-ajax-data-role-user']);
        Route::get('edit-role-user/{id}', ['uses' => 'AuthorizedController@getEditRoleUser', 'as' => 'authorized.get-edit-role-user']);
        Route::post('edit-role-user/{id}', ['uses' => 'AuthorizedController@postEditRoleUser', 'as' => 'authorized.post-edit-role-admin']);
        Route::get('edit-permission/{id}', ['uses' => 'AuthorizedController@getEditPermission', 'as' => 'authorized.permission-admin']);
        Route::post('edit-permission/{id}', ['uses' => 'AuthorizedController@postEditPermission', 'as' => 'authorized.post-edit-permission']);

        Route::group(['prefix' => 'permission'], function () {
            Route::post('add-permission', ['middleware' => ['permission:user.add'], 'uses' => 'PermissionController@postAddPermission', 'as' => 'authorized.post-add-permission']);
            Route::get('add-permission', ['middleware' => ['permission:user.add'], 'uses' => 'PermissionController@getAddPermission', 'as' => 'authorized.get-add-permission']);
            Route::get('update-permission/{id}', ['uses' => 'PermissionController@getUpdatePermission', 'as' => 'authorized.getUpdatePermission']);
            Route::post('move-trash-permission', ['uses' => 'PermissionController@postMoveTrash', 'as' => 'authorized.post-move-trash-permission']);
            Route::get('ajax-data-trash-permission', ['middleware' => ['permission:user.trash'], 'uses' => 'PermissionController@getAjaxDataTrash', 'as' => 'authorized.get-ajax-data-trash-permission']);
            Route::get('show-trash-permission', ['middleware' => ['permission:user.trash'], 'uses' => 'PermissionController@getShowTrashRole', 'as' => 'authorized.get-show-trash-permission']);
            Route::post('put-back-permission/{id}', ['middleware' => ['permission:user.trash'], 'uses' => 'PermissionController@postPutBack', 'as' => 'authorized.post-put-back-permission']);
            Route::post('remove-trash-permission/{id}', ['middleware' => ['permission:user.remove'], 'uses' => 'PermissionController@postRemoveTrash', 'as' => 'authorized.post-remove-trash-permission']);
            Route::post('post-update-permission/{id}', ['uses' => 'PermissionController@postUpdatePermission', 'as' => 'authorized.postUpdatePermission']);
            Route::get('show-permission', ['uses' => 'PermissionController@getShowPermission', 'as' => 'authorized.get-show-permission']);
            Route::get('ajax-data-permission', ['uses' => 'PermissionController@getAjaxDataPermission', 'as' => 'authorized.get-ajax-data-permission']);
        });

        Route::group(['prefix' => 'role'], function () {
            Route::post('move-trash', ['uses' => 'RoleController@postMoveTrash', 'as' => 'authorized.post-move-trash']);
            Route::get('show-trash-role', ['middleware' => ['permission:user.trash'], 'uses' => 'RoleController@getShowTrashRole', 'as' => 'authorized.get-show-trash-role']);
            Route::get('ajax-data-trash', ['middleware' => ['permission:user.trash'], 'uses' => 'RoleController@getAjaxDataTrash', 'as' => 'authorized.get-ajax-data-trash']);
            Route::post('put-back/{id}', ['middleware' => ['permission:user.trash'], 'uses' => 'RoleController@postPutBack', 'as' => 'authorized.post-put-back']);
            Route::post('remove-trash/{id}', ['middleware' => ['permission:user.remove'], 'uses' => 'RoleController@postRemoveTrash', 'as' => 'authorized.post-remove-trash']);
            Route::get('show-role', ['uses' => 'RoleController@getShowRole', 'as' => 'authorized.get-show-role']);
            Route::get('ajax-data-role', ['uses' => 'RoleController@getAjaxDataRole', 'as' => 'authorized.get-ajax-data-role']);
            Route::get('add', ['middleware' => ['permission:user.add'], 'uses' => 'RoleController@getAdd', 'as' => 'authorized.get-add']);
            Route::post('add', ['middleware' => ['permission:user.add'], 'uses' => 'RoleController@postAdd', 'as' => 'authorized.post-add']);
        });
    });
    /*----------------------------------------------  FDRIVE  ----------------------------------------------------*/
    Route::prefix('fdrive')->group(function () {
        Route::prefix('server')->group(function () {
            Route::get('add', ['uses' => 'Fdrive\ServerController@getAdd', 'as' => 'server.getAdd']);
            Route::post('add', ['uses' => 'Fdrive\ServerController@postAdd', 'as' => 'server.postAdd']);
            Route::get('show-all', ['middleware' => ['permission:server.show-all'], 'uses' => 'Fdrive\ServerController@getShowAll', 'as' => 'fdrive.get-show-all']);
            Route::get('detail/{id}', ['middleware' => ['permission:server.detail'], 'uses' => 'Fdrive\ServerController@getShowDetail', 'as' => 'fdrive.detail']);
            Route::get('ajax-data', ['middleware' => ['permission:server.show-all'], 'uses' => 'Fdrive\ServerController@getAjaxData', 'as' => 'fdrive.get-ajax-data']);
            Route::get('action', ['middleware' => ['permission:server.show-all'], 'uses' => 'Fdrive\ServerController@ActionServer', 'as' => 'fdrive.action']);
        });
    });
    Route::prefix('customer')->group(function () {
        Route::get('show-all', ['middleware' => ['permission:customer.show-all'], 'uses' => 'CustomerController@getShowAll', 'as' => 'customer.get-show-all']);
        Route::get('ajax-data', ['uses' => 'CustomerController@getAjaxData', 'as' => 'customer.get-ajax-data']);
        Route::get('detail/{id}', ['middleware' => ['permission:customer.detail'], 'uses' => 'CustomerController@getDetailCustomer', 'as' => 'customer.detail']);
    });

    Route::prefix('dashboard')->group(function() {
        Route::get('/', ['uses' => 'DashboardController@getIndex']);
        Route::get('bar-chart-servers', ['uses' => 'DashboardController@getDataBarChartServers']);
        Route::get('bar-chart-customers', ['uses' => 'DashboardController@getDataBarChartCustomers']);
    });
});
