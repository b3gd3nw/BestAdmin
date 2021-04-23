<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PagesController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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

// - User routes -
Route::get('/', function (){
    Auth::routes();
    return \redirect('/admin');
});
Route::get('/register', [PagesController::class, 'register']);
// - Admin routes -
Route::prefix('/admin')->group(function (){
    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [PagesController::class, 'index'])->name('homeAdmin');
        Route::get('/employes', [PagesController::class, 'employee'])->name('employeeAdmin');
        Route::get('/accounting/general', [PagesController::class, 'accounting_general'])->name('generalAdmin');
        Route::get('/accounting/categories', [PagesController::class, 'accounting_categories'])->name('categoriesAdmin');
//        Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

    });
});
// - Api routes -
Route::prefix('/api')->group(function (){
    Route::get('countries', [CountryController::class, 'fetchAll'])->name('countries');
    Route::get('bank', [CountryController::class, 'getAmount'])->name('bank');
    Route::resource('category', CategoryController::class);
    Route::resource('employee', EmployeeController::class);
    Route::get('send-form', [App\Http\Controllers\EmployeeController::class, 'showSendForm'])->name('showSendForm');
    Route::get('filterby/{filter?}', [App\Http\Controllers\EmployeeController::class, 'filterBy'])->name('filterBy');
    Route::post('sendmail', [App\Http\Controllers\EmployeeController::class, 'sendMail'])->name('sendmail');
    Route::get('income', [BankController::class, 'getIncomePage'])->name('income');
    Route::get('consumption', [BankController::class, 'getConsumptionPage'])->name('consumption');
    Route::post('addincome', [BankController::class, 'store_income'])->name('storeIncome');
    Route::post('addconsumption', [BankController::class, 'store_consumption'])->name('storeConsumption');
    Route::post('transactions', [BankController::class, 'getCategoriesByMonth'])->name('getTransByMonth');
    Route::get('consbymonth', [BankController::class, 'getConsumptionByMonth'])->name('getConsByMonth');
});
