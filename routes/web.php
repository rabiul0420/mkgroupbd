<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Website Part
Route::get('/','HomePageController@index')->name('home');
Route::get('service/{id}','HomePageController@service');
Route::get('sister-concern/{id}','HomePageController@sister_concern');
Route::get('contact-us','HomePageController@contact_us');
Route::get('about-us','HomePageController@about_us');
Route::get('mission-vission','HomePageController@mission_vission');
Route::get('why-choose-us','HomePageController@why_choose_us');
Route::get('our-commitment','HomePageController@our_commitment');
Route::get('services','HomePageController@services');
Route::post('send-contact-message','HomePageController@storeMessage')->name('send-contact-message');


// Admin part
Route::namespace('Admin')->group(function() {
    Route::get('admin','AdminLoginController@showLoginForm')->name('admin');
    Route::post('admin-login','AdminLoginController@adminLogin')->name('admin-login');
    Route::as('admin.')->middleware(['auth','has_permission'])->group(function() {
        Route::get('profile','BasicController@profile')->name('profile');
        Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
        Route::view('home','admin.home')->name('home');
        Route::get('website-settings','BasicController@websiteSettings')->name('website-settings');
        Route::put('update-website-settings','BasicController@updateWebsiteSettings')->name('update-website-settings');
        Route::resource('products','ProductController');
        Route::resource('invoices','InvoiceController');
        Route::resource('faqs','FaqController');
        Route::resource('clients','ClientController');
        Route::resource('sister-concerns','SisterConcernController');
        Route::resource('our-services','ServiceController');
        Route::resource('pages','PageController');
        Route::resource('payment-methods','PaymentMethodController');
        Route::resource('expense-categories','ExpenseCategoryController');
        Route::resource('expense-list','ExpenseController');
        Route::resource('income-sectors','IncomeSectorController');
        Route::resource('incomes','IncomeController');
        Route::resource('to-do-list','ToDoController');
        Route::get('user-wise-to-do','ToDoController@userWiseToDo')->name('user-wise-to-do');
        Route::get('update-to-do','ToDoController@updateToDo')->name('update-to-do');
        Route::resource('employee-designations','EmployeeDesignationController');
        Route::resource('employees','EmployeeController');
        Route::resource('event-categories','EventCategoryController');
        Route::resource('events','EventController');
        Route::resource("task-list",'TaskController');
        Route::view('task-calendar','admin.task.task_calendar')->name('task-calendar');
        Route::get('my-tasks','TaskController@taskList')->name('my-tasks');
        Route::get('date-wise-tasks','TaskController@dateWiseTasks')->name('date-wise-tasks');
        Route::get('asset-list','BasicController@assetList')->name('asset-list');
        Route::get('edit-asset','BasicController@editAsset')->name('edit-asset');
        Route::put('update-asset','BasicController@updateAsset')->name('update-asset');
        Route::resource('work-orders','WorkOrderController');

        // Reports
        Route::get('expense-reports','ReportController@expenseReport')->name('expense-reports');
        Route::get('income-reports','ReportController@incomeReport')->name('income-reports');
        Route::get('profit-reports','ReportController@profitReport')->name('profit-reports');

        Route::get('notifications','BasicController@notifications')->name('notifications');

        Route::get('logout',function() {
            $user = Auth::user();
            $user->last_logout_time = now();
            $user->online_status = false;
            $user->save();
            Auth::logout();
            Session::reflash();
            return redirect()->route('home');
        })->name('logout');
    });
});
