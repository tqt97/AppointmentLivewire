<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Livewire\Admin\Appointments\CreateAppointmentForm;
use App\Http\Livewire\Admin\Appointments\EditAppointmentForm;
use App\Http\Livewire\Admin\Appointments\ListAppointments;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Livewire\Admin\Settings\UpdateSetting;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\Analytics;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)->name('dashboard');
Route::get('users', ListUsers::class)->name('users');
route::get('appointments', ListAppointments::class)->name('appointments');
route::get('appointments/create', CreateAppointmentForm::class)->name('appointments.create');
route::get('appointments/{appointment}/edit', EditAppointmentForm::class)->name('appointments.edit');
Route::get('profile', UpdateProfile::class)->name('profile.edit');

Route::get('/analytics', Analytics::class)->name('analytics');
Route::get('/settings', UpdateSetting::class)->name('settings');
