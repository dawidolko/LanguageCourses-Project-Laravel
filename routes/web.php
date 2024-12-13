<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\ShareDataToViews;
use Illuminate\Support\Facades\Route;

Route::middleware([ShareDataToViews::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/regulamin', [HomeController::class, 'regulamin'])->name('regulamin');

    Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
    Route::get('/courses/{id}', [CoursesController::class, 'show'])->name('courses.show');
    Route::post('/cart/add', [UsersController::class, 'add'])->name('cart.add');

    Route::controller(AuthController::class)->group(function () {
        Route::get('/auth/login', 'login')->name('login');
        Route::post('/auth/login', 'authenticate')->name('login.authenticate');
        Route::get('/auth/logout', 'logout')->name('logout');
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/user/settings', [UsersController::class, 'showSettings'])->name('user.settings');
        Route::get('/profile', [UsersController::class, 'showProfile'])->name('user.profile');
        Route::get('/cart', [CartController::class, 'showCart'])->name('user.cart');
        Route::post('/cart/add/{course_id}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/update/{course_id}', [CartController::class, 'updateCart'])->name('cart.update');
        Route::post('/cart/remove/{course_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::put('/update-avatar', [UsersController::class, 'updateAvatar'])->name('user.update_avatar');
        Route::put('/change-password', [UsersController::class, 'changePassword'])->name('user.change_password');
        Route::put('/update-name', [UsersController::class, 'updateName'])->name('user.update_name');
     });

     Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

        Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
        Route::post('/admin/courses', [AdminController::class, 'addCourse'])->name('admin.addCourse');
        Route::put('/admin/courses/{id}', [AdminController::class, 'updateCourse'])->name('admin.updateCourse');
        Route::delete('/admin/courses/{id}', [AdminController::class, 'deleteCourse'])->name('admin.deleteCourse');
        Route::post('/admin/lessons', [AdminController::class, 'addLesson'])->name('admin.addLesson');
        Route::post('/admin/teachers', [AdminController::class, 'addTeacher'])->name('admin.addTeacher');
    
        Route::get('/admin/enrollments', [AdminController::class, 'enrollments'])->name('admin.enrollment');
        Route::get('/admin/enrollments/{id}/edit', [AdminController::class, 'editEnrollment'])->name('admin.enrollments.edit');
        Route::put('/admin/enrollments/{id}', [AdminController::class, 'updateEnrollment'])->name('admin.enrollments.update');
        Route::delete('/admin/enrollments/{id}', [AdminController::class, 'deleteEnrollment'])->name('admin.enrollments.delete');
    });
    
});