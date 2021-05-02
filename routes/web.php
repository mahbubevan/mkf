<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

// user Routes

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// admin ROutes
Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('password/confirm', [App\Http\Controllers\Admin\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [App\Http\Controllers\Admin\Auth\ConfirmPasswordController::class, 'confirm']);
    Route::post('password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    Route::get('/user-list', [App\Http\Controllers\Admin\UserController::class, 'list'])->name('user.list');

    Route::get('/company-account', [App\Http\Controllers\Admin\CompanyAccountController::class, 'company_account'])->name('company.account');
    Route::post('/company-account/bal-add', [App\Http\Controllers\Admin\CompanyAccountController::class, 'company_account_add'])->name('company.account.add_bal');
    Route::post('/company-account/bal-sub', [App\Http\Controllers\Admin\CompanyAccountController::class, 'company_account_sub'])->name('company.account.sub_bal');

    Route::get('/setting', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
    Route::patch('/setting-update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('setting.update');

    Route::get('/transaction-list', [App\Http\Controllers\Admin\TransactionController::class, 'transaction_list'])->name('transaction.list');

    Route::get('/sale-list', [App\Http\Controllers\Admin\SaleController::class, 'list'])->name('sale.list');
    Route::get('/sale-create', [App\Http\Controllers\Admin\SaleController::class, 'create'])->name('sale.create');
    Route::post('/sale-store', [App\Http\Controllers\Admin\SaleController::class, 'store'])->name('sale.store');

    Route::get('/fabric-list', [App\Http\Controllers\Admin\FabricController::class, 'list'])->name('fabric.list');
    Route::get('/fabric-create', [App\Http\Controllers\Admin\FabricController::class, 'create'])->name('fabric.create');
    Route::post('/fabric-store', [App\Http\Controllers\Admin\FabricController::class, 'store'])->name('fabric.store');

    Route::get('/accesories-list', [App\Http\Controllers\Admin\AccesoriesController::class, 'list'])->name('accesories.list');
    Route::get('/accesories-create', [App\Http\Controllers\Admin\AccesoriesController::class, 'create'])->name('accesories.create');
    Route::post('/accesories-store', [App\Http\Controllers\Admin\AccesoriesController::class, 'store'])->name('accesories.store');
    Route::get('/accesories-name', [App\Http\Controllers\Admin\AccesoriesController::class, 'name'])->name('accesories.name');
    Route::post('/accesories-name-store', [App\Http\Controllers\Admin\AccesoriesController::class, 'name_store'])->name('accesories.name.store');
    Route::post('/accesories-name-update', [App\Http\Controllers\Admin\AccesoriesController::class, 'name_update'])->name('accesories.name.update');

    Route::get('/get-production-code', [App\Http\Controllers\Admin\ProductionController::class, 'get_production_code'])->name('get.production.code');
    Route::get('/production-list', [App\Http\Controllers\Admin\ProductionController::class, 'list'])->name('production.list');
    Route::get('/production-create', [App\Http\Controllers\Admin\ProductionController::class, 'create'])->name('production.create');
    Route::post('/production-store', [App\Http\Controllers\Admin\ProductionController::class, 'store'])->name('production.store');
    Route::get('/production-show/{production}', [App\Http\Controllers\Admin\ProductionController::class, 'show'])->name('production.show');
    Route::post('/production-partial/completed', [App\Http\Controllers\Admin\ProductionController::class, 'partial'])->name('production.partial');
    Route::post('/production-full/completed', [App\Http\Controllers\Admin\ProductionController::class, 'full'])->name('production.full');

    Route::get('/employee-list', [App\Http\Controllers\Admin\EmployeeController::class, 'list'])->name('employee.list');
    Route::get('/employee-create', [App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee-store', [App\Http\Controllers\Admin\EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee-show/{employee}', [App\Http\Controllers\Admin\EmployeeController::class, 'show'])->name('employee.show');
    Route::post('/employee-delete', [App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::post('/employee-salary-update/{employee}', [App\Http\Controllers\Admin\EmployeeController::class, 'salary_update'])->name('employee.update.salary');
    Route::post('/employee-type-update/{employee}', [App\Http\Controllers\Admin\EmployeeController::class, 'type_update'])->name('employee.update.type');
    Route::post('/employee-status-update/{employee}', [App\Http\Controllers\Admin\EmployeeController::class, 'status_update'])->name('employee.update.status');

    Route::get('/inventory-list', [App\Http\Controllers\Admin\InventoryController::class, 'list'])->name('inventory.list');
    Route::get('/inventory-create', [App\Http\Controllers\Admin\InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/inventory-store', [App\Http\Controllers\Admin\InventoryController::class, 'store'])->name('inventory.store');

    Route::get('/stock-list', [App\Http\Controllers\Admin\StockController::class, 'list'])->name('stock.list');
    Route::get('/stock-create', [App\Http\Controllers\Admin\StockController::class, 'create'])->name('stock.create');
    Route::post('/stock-store', [App\Http\Controllers\Admin\StockController::class, 'store'])->name('stock.store');

    Route::get('/external-expense-list', [App\Http\Controllers\Admin\ExternalController::class, 'external_expense_list'])->name('external.expense.list');
    Route::get('/external-expense-create', [App\Http\Controllers\Admin\ExternalController::class, 'external_expense_create'])->name('external.expense.create');
    Route::post('/external-expense-store', [App\Http\Controllers\Admin\ExternalController::class, 'external_expense_store'])->name('external.expense.store');
    Route::get('/external-income-list', [App\Http\Controllers\Admin\ExternalController::class, 'external_income_list'])->name('external.income.list');
    Route::get('/external-income-create', [App\Http\Controllers\Admin\ExternalController::class, 'external_income_create'])->name('external.income.create');
    Route::post('/external-income-store', [App\Http\Controllers\Admin\ExternalController::class, 'external_income_store'])->name('external.income.store');
});


Route::get('/phpinfo', function () {
    return phpinfo();
});
