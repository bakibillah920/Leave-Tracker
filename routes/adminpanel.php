<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Application\UsersController;
use App\Http\Controllers\Application\LeaveManagementController;


Route::middleware('auth')->group(function () {

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/get_data', [UsersController::class, 'getData'])->name('users.getdata');
    Route::post('/users/userInfo', [UsersController::class, 'userInfo'])->name('users.userInfo');


    Route::get('/leave/category', [LeaveManagementController::class, 'leaveCategory'])->name('leaveCategory');
    Route::post('/leave/category/store', [LeaveManagementController::class, 'storeleaveCategory'])->name('leaveCategory.store');
    Route::post('/leave/request/store', [LeaveManagementController::class, 'storeleaveRequest'])->name('leaveRequest.store');
    Route::post('/leave/request/update', [LeaveManagementController::class, 'storeleaveRequestUpdate'])->name('leaveRequest.update');
    Route::post('/leave/getRequestDetails', [LeaveManagementController::class, 'getRequestDetails'])->name('leaveRequest.getRequestDetails');
    Route::delete('/leave/category/delete/{id}', [LeaveManagementController::class, 'deleteleaveCategory'])->name('leaveCategory.delete');
    Route::get('/leave/request', [LeaveManagementController::class, 'leaverequest'])->name('leaveRequest');

    Route::get("/leave/manage", [LeaveManagementController::class, "index"])->name("leave.manage.index");
    Route::delete('/leave/request/delete/{id}', [LeaveManagementController::class, 'deleteleaveRequest'])->name('leaveRequest.delete');
    
    Route::post('/leave/manage/getappcat', [LeaveManagementController::class, 'getAppCat'])->name('leaveManage.getappcat');
    Route::post('leave/manage/getEdit', [LeaveManagementController::class, 'getEdit'])->name('leaveManage.getEdit');
    Route::post('/leave/manage/store', [LeaveManagementController::class, 'storeleaveManage'])->name('leaveManage.store');
    Route::post('/leave/manage/update/{leaveId}', [LeaveManagementController::class, 'storeleaveManageUpdate'])->name('leaveManage.update');
    Route::get("/leave/manage/get-data", [LeaveManagementController::class, "getData"])->name("leave.manage.getData");
    Route::get("/leave/reports", [LeaveManagementController::class, "reports"])->name("leave.reports");
    
});
