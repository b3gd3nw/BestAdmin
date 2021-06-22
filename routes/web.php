<?php

use App\Events\MyEvent;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CountryController;
// use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PagesController;
use App\Models\Employee;
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

Route::prefix('/api')->group(function (){
    Auth::routes();

    Route::get('dashboard', [PagesController::class, 'index']);
    Route::post('addincome', [BankController::class, 'store_income'])->name('storeIncome');
    Route::post('addconsumption', [BankController::class, 'store_consumption'])->name('storeConsumption');
    Route::get('csrf', [BankController::class, 'getCsrf']);
    Route::get('employee_data', [App\Http\Controllers\EmployeeController::class, 'index']);
    Route::resource('category', CategoryController::class);
    Route::resource('employee', EmployeeController::class);
    Route::get('getemployes', [App\Http\Controllers\EmployeeController::class, 'getEmployes']);
    Route::get('countries', [CountryController::class, 'fetchAll'])->name('countries');
    Route::post('sendmail', [App\Http\Controllers\EmployeeController::class, 'sendMail'])->name('sendmail');
    // Route::get( 'all_members', [MemberController::class, 'all_members']);
    // Route::resource( 'members', MemberController::class);
    // Route::get('countries', [CountryController::class, 'fetchAll'])->name('countries');

    // Route::group(['middleware' => 'auth'], function () {
    //     Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    //         Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin');

    //         Route::get( 'getphoto/{member}', [MembersController::class, 'getPhoto'])->name('getphoto');
    //         Route::get('deletephoto/{member}', [MembersController::class, 'deletePhoto'])->name('delphoto');
    //         Route::resource('member', MembersController::class);
    //     });
    // });


});

Route::get('/{any}', function (){
    Auth::routes();
    return view('vue_index');
})->where('any', '.*');

// - User routes -
// Route::get('/', function (){
//     Auth::routes();
//     return view('vue_index');
// });
// Route::get('/register', [PagesController::class, 'register']);
// Route::get('/main', [PagesController::class, 'main']);
// // - Admin routes -
// Route::prefix('/admin')->group(function (){
//     Auth::routes();

//     Route::group(['middleware' => 'auth'], function () {
//         Route::get('/', [PagesController::class, 'index'])->name('homeAdmin');
//         Route::get('/employes', [PagesController::class, 'employee'])->name('employeeAdmin');
//         Route::get('/accounting/general', [PagesController::class, 'accounting_general'])->name('generalAdmin');
//         Route::get('/accounting/categories', [PagesController::class, 'accounting_categories'])->name('categoriesAdmin');
// //        Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//     });
// });
// // - Api routes -
// Route::prefix('/api')->group(function (){
//     Route::get('orderby', [App\Http\Controllers\PagesController::class, 'orderBy']);
//     Route::get('countries', [CountryController::class, 'fetchAll'])->name('countries');
//     Route::get('bank', [CountryController::class, 'getAmount'])->name('bank');
//     Route::resource('category', CategoryController::class);
//     Route::resource('employee', EmployeeController::class);
//     Route::post('email-check', [App\Http\Controllers\EmployeeController::class, 'uniqMail'])->name('check_mail');
//     Route::get('send-form', [App\Http\Controllers\EmployeeController::class, 'showSendForm'])->name('showSendForm');
//     Route::get('filterby/{filter?}', [App\Http\Controllers\EmployeeController::class, 'filterBy'])->name('filterBy');
//     Route::post('sendmail', [App\Http\Controllers\EmployeeController::class, 'sendMail'])->name('sendmail');
//     Route::get('income', [BankController::class, 'getIncomePage'])->name('income');
//     Route::get('consumption', [BankController::class, 'getConsumptionPage'])->name('consumption');
//     Route::post('addincome', [BankController::class, 'store_income'])->name('storeIncome');
//     Route::post('addconsumption', [BankController::class, 'store_consumption'])->name('storeConsumption');
//     Route::post('transactions', [BankController::class, 'getCategoriesByMonth'])->name('getTransByMonth');
//     Route::get('consbymonth', [BankController::class, 'getConsumptionByMonth'])->name('getConsByMonth');
// });
