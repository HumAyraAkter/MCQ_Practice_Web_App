<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Student routes
use App\Http\Controllers\ExamController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // এক্সাম এবং বুকমার্ক রুট
    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/bookmarks', [ExamController::class, 'bookmarks'])->name('bookmarks.index');

    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');
    Route::post('/exams/{exam}/start', [ExamController::class, 'start'])->name('exams.start');
    Route::get('/attempts/{attempt}', [ExamController::class, 'attempt'])->name('exams.attempt');
    Route::post('/attempts/{attempt}/save-answer', [ExamController::class, 'saveAnswer'])->name('exams.saveAnswer');
    Route::post('/attempts/{attempt}/submit', [ExamController::class, 'submit'])->name('exams.submit');
    Route::post('/attempts/{attempt}/violation', [ExamController::class, 'reportViolation'])->name('exams.violation');
    Route::get('/attempts/{attempt}/result', [ExamController::class, 'result'])->name('exams.result');
    Route::get('/results', [ExamController::class, 'results'])->name('results.index');
    
    Route::post('/bookmark/toggle', [ExamController::class, 'toggleBookmark'])->name('bookmark.toggle');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');





    Route::get('/subscription/plans', [SubscriptionController::class, 'plans'])->name('subscription.plans');
Route::post('/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
Route::get('/subscription/success-page', [SubscriptionController::class, 'successPage'])->name('subscription.success');
});
Route::post('/payment/success', [SubscriptionController::class, 'success'])->name('payment.success');
Route::post('/payment/fail', [SubscriptionController::class, 'fail'])->name('payment.failure');
Route::post('/payment/cancel', [SubscriptionController::class, 'cancel'])->name('payment.cancel');
Route::post('/payment/ipn', [SubscriptionController::class, 'ipn'])->name('payment.ipn');
// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
     // ⬇️ Bulk question routes MUST come before Route::resource('questions', ...)
    Route::get('questions/bulk-create', [QuestionController::class, 'bulkForm'])->name('questions.bulkCreate');
    Route::post('questions/bulk-store', [QuestionController::class, 'bulkStore'])->name('questions.bulkStore');

   
    Route::resource('categories', CategoryController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('exams', AdminExamController::class);
    Route::post('exams/{exam}/attach-question', [AdminExamController::class, 'attachQuestion'])->name('exams.attach');
    Route::delete('exams/{exam}/detach-question/{question}', [AdminExamController::class, 'detachQuestion'])->name('exams.detach');

     Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
});

require __DIR__.'/auth.php';