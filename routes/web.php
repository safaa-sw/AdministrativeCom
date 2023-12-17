<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransStatusController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\TransTypeController;
use App\Http\Controllers\SecretController;
use App\Http\Controllers\ImportanceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;


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

/** For Localization */
Route::get('locale/{locale}', function ($locale){
    session()->put('locale', $locale);
    return redirect()->back();
});

/** Routes For administrative Commincation Home Page */
Route::get('/', function () {
    return redirect()->route('transaction');
});
Route::get('/transaction', [App\Http\Controllers\HomeController::class, 'transaction'])->name('transaction');
/********************************************************************************************************* */


/** Routes For User */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    
    Route::resource('profiles',ProfileController::class);
    
    Route::resource('transactions',TransactionController::class);

    //User Profile Routes
    route::get('profile/{id}', [UserController::class, 'showProfile'])->name('profile');
    route::post('profile/{id}', [UserController::class, 'storeProfile'])->name('profile.store');

    // Inside Transaction
    route::get('transactions/inside/create', [TransactionController::class, 'createInside'])->name('inside/create');
    route::post('transactions/inside/store', [TransactionController::class, 'storeInside'])->name('inside/store');
    route::get('user/transactions/out', [TransactionController::class, 'userTransactionout'])->name('user/transactions/out');
    route::get('user/transactions/in', [TransactionController::class, 'userTransactionIn'])->name('user/transactions/in');
    route::get('user/transactions/processing', [TransactionController::class, 'userTranProcessing'])->name('user/transactions/processing');
    route::post('transaction/referr', [TransactionController::class, 'transactionReferr'])->name('transaction/referr');
    route::get('transaction/recieve/{id}', [TransactionController::class, 'transactionRecieve'])->name('transaction/recieve');
    route::get('transaction/processed/{id}', [TransactionController::class, 'transactionProcessed'])->name('transaction/processed');
    route::post('transaction/giveOpinion', [TransactionController::class, 'transactionGiveOpinion'])->name('transaction/giveOpinion');
    route::get('transaction/close/{id}', [TransactionController::class, 'transactionClose'])->name('transaction/close');

    //connected transaction routes
    route::get('transaction/connected/{id}', [TransactionController::class, 'transactionConnect'])->name('transaction/connected'); 
    route::post('transaction/connectedStore/{id}', [TransactionController::class, 'transactionConnectStore'])->name('transaction/connectedStore');
    route::delete('transaction/disconnect/{id}', [TransactionController::class, 'transactionDisConnect'])->name('transaction/disconnect');  

    //files transaction routes
    route::get('transaction/file/{id}', [TransactionController::class, 'transactionFile'])->name('transaction/file'); 
    route::post('transaction/fileStore/{id}', [TransactionController::class, 'transactionFileStore'])->name('transaction/fileStore');
    route::delete('transaction/fileDetach/{id}', [TransactionController::class, 'transactionFileDetach'])->name('transaction/fileDetach');  

    //tracked transaction routes
    route::get('transaction/tracked', [TransactionController::class, 'transactionTrack'])->name('transaction/tracked');
    route::post('transaction/trackedSearch', [TransactionController::class, 'transactionSearch'])->name('transaction/trackedSearch');    



});



/********************************************************************************************************* */


/** Routes For Admin */
Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin/home');
    Route::get('/login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin/login');
    Route::post('/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin/login');
    Route::post('/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin/logout');

    Route::middleware('auth:admin')->group(function () {
    //Route::resource('trans/status',TransStatusController::class);
    Route::resource('organizations',OrganizationController::class);
    Route::resource('departments',DepartmentController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('operations',OperationController::class);
    Route::resource('actions',ActionController::class);
    //Route::resource('transTypes',TransTypeController::class);
    //Route::resource('secrets',SecretController::class);
    //Route::resource('importances',ImportanceController::class);


    //transaction types
    route::get('transTypes', [TransTypeController::class, 'index'])->name('transTypes.index');
    route::post('transTypes/store', [TransTypeController::class, 'store'])->name('transTypes.store');
    route::post('transTypes/update', [TransTypeController::class, 'update'])->name('transTypes.update');

    //transaction status
    route::get('transStatus', [TransStatusController::class, 'index'])->name('transStatus.index');
    route::post('transStatus/store', [TransStatusController::class, 'store'])->name('transStatus.store');
    route::post('transStatus/update', [TransStatusController::class, 'update'])->name('transStatus.update');

    //transaction secret degree
    route::get('secrets', [SecretController::class, 'index'])->name('secrets.index');
    route::post('secrets/store', [SecretController::class, 'store'])->name('secrets.store');
    route::post('secrets/update', [SecretController::class, 'update'])->name('secrets.update');

    
    //transaction importance degree
    route::get('importances', [ImportanceController::class, 'index'])->name('importances.index');
    route::post('importances/store', [ImportanceController::class, 'store'])->name('importances.store');
    route::post('importances/update', [ImportanceController::class, 'update'])->name('importances.update');

    //users
    route::get('users', [UserController::class, 'index'])->name('users.index');
    route::post('users/store', [UserController::class, 'store'])->name('users.store');
    route::post('users/update', [UserController::class, 'update'])->name('users.update');

    //Roles
    route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    route::post('roles/update', [RoleController::class, 'update'])->name('roles.update');

    //Departments
    route::get('departments', [DepartmentController::class, 'index'])->name('department.index');
    route::post('departments/store', [DepartmentController::class, 'store'])->name('department.store');
    route::post('departments/update', [DepartmentController::class, 'update'])->name('department.update');

    //Operations
    route::get('operations', [OperationController::class, 'index'])->name('operation.index');
    route::post('operations/store', [OperationController::class, 'store'])->name('operation.store');
    route::post('operations/update', [OperationController::class, 'update'])->name('operation.update');

        
    });
});
/********************************************************************************************************* */
