<?php

use App\Http\Controllers\AfspraakenController;
use App\Http\Controllers\AfsprakenPerPatientController;
use App\Http\Controllers\EmployeeAfsprakenController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlachtenController;
use App\Http\Controllers\PatientenController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/profile/edit/{id}', [EditProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}', [EditProfileController::class, 'update'])->name('profile.update');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/employee/home', [App\Http\Controllers\HomeController::class, 'employeeHome'])->name('employee.home')->middleware('is_employee');


//Klachten
Route::get('/klachten', [KlachtenController::class, 'index'])->name('klachten')->middleware('is_employee');
Route::get('/klacht/create', [KlachtenController::class, 'create'])->name('klacht.create')->middleware('is_employee');
Route::POST('/klacht/store', [KlachtenController::class, 'store'])->name('klacht.store')->middleware('is_employee');
Route::get('/klacht/edit/{id}', [KlachtenController::class, 'edit'])->name('klacht.edit')->middleware('is_employee');
Route::put('/klacht/update/{id}', [KlachtenController::class, 'update'])->name('klacht.update')->middleware('is_employee');
Route::delete('/klacht/delete/{id}', [KlachtenController::class, 'destroy'])->name('klacht.delete')->middleware('is_employee');



//Afspraken
Route::get('/afspraaken', [AfspraakenController::class, 'index'])->name('afspraken');
Route::get('/afspraak/create', [AfspraakenController::class, 'create'])->name('afspraak.create');
Route::POST('/afspraak/store', [AfspraakenController::class, 'store'])->name('afspraak.store');
Route::get('/afspraak/edit/{id}', [AfspraakenController::class, 'edit'])->name('afspraak.edit');
Route::put('/afspraak/update/{id}', [AfspraakenController::class, 'update'])->name('afspraak.update');
Route::delete('/afspraak/delete/{id}', [AfspraakenController::class, 'destroy'])->name('afspraak.delete');

//Doctors
Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors')->middleware('is_employee');
Route::get('/doctor/create', [DoctorsController::class, 'create'])->name('doctor.create')->middleware('is_employee');
Route::POST('/doctor/store', [DoctorsController::class, 'store'])->name('doctor.store')->middleware('is_employee');
Route::get('/doctor/edit/{id}', [DoctorsController::class, 'edit'])->name('doctor.edit')->middleware('is_employee');
Route::PUT('/doctor/update/{id}', [DoctorsController::class, 'update'])->name('doctor.update')->middleware('is_employee');
Route::delete('/doctor/delete/{id}', [DoctorsController::class, 'destroy'])->name('doctor.delete')->middleware('is_employee');

//Employee Afspraken
Route::get('/employee/afspraaken', [EmployeeAfsprakenController::class, 'index'])->name('employee.afspraken')->middleware('is_employee');
Route::get('/employee/afspraak/create', [EmployeeAfsprakenController::class, 'create'])->name('employee.afspraak.create')->middleware('is_employee');
Route::POST('/employee/afspraak/store', [EmployeeAfsprakenController::class, 'store'])->name('employee.afspraak.store')->middleware('is_employee');
Route::get('/employee/afspraak/edit/{id}', [EmployeeAfsprakenController::class, 'edit'])->name('employee.afspraak.edit')->middleware('is_employee');
Route::put('/employee/afspraak/update/{id}', [EmployeeAfsprakenController::class, 'update'])->name('employee.afspraak.update')->middleware('is_employee');
Route::delete('/employee/afspraak/delete/{id}', [EmployeeAfsprakenController::class, 'destroy'])->name('employee.afspraak.delete')->middleware('is_employee');


//Patienten
Route::get('/patienten', [PatientenController::class, 'index'])->name('patienten')->middleware('is_employee');
Route::get('/patient/create', [PatientenController::class, 'create'])->name('patient.create')->middleware('is_employee');
Route::POST('/patient/store', [PatientenController::class, 'store'])->name('patient.store')->middleware('is_employee');
Route::get('/patient/edit/{id}', [PatientenController::class, 'edit'])->name('patient.edit')->middleware('is_employee');
Route::put('/patient/update/{id}', [PatientenController::class, 'update'])->name('patient.update')->middleware('is_employee');
Route::delete('/patient/delete/{id}', [PatientenController::class, 'destroy'])->name('patient.delete')->middleware('is_employee');

//Afspraken Per Patient
Route::get('/afspraken/per/patient', [AfsprakenPerPatientController::class, 'index'])->name('afspraken.per.patient')->middleware('is_employee');

//klachten Per Patient
Route::get('/klachten/per/patient', [PatientenController::class, 'klachtenPerPatient'])->name('klachten.per.patient')->middleware('is_employee');

//Patienten Per Klacht
Route::get('/patienten/per/klacht', [PatientenController::class, 'patientenPerKlacht'])->name('patienten.per.klacht')->middleware('is_employee');
