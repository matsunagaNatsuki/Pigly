<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// 会員登録
Route::get('/register/step1', [RegisterController::class, 'create'])->name('register');
Route::post('/register/step1', [RegisterController::class, 'store'])
    ->name('register.store')
    ->middleware('guest');

// 初期目標体重登録
Route::get('/register/step2', [RegisterController::class, 'step'])
    ->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'setting'])
    ->name('register.setting');

// ログイン
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::middleware(['auth'])->group(function () {
    // トップページ
    Route::get('/weight_logs', [WeightLogController::class, 'index']);
    // 体重登録
    Route::get('/weight_logs/create', [WeightLogController::class, 'create']);
    Route::post('/weight_logs/create', [WeightLogController::class, 'store']);
    // 体重検索
    Route::get('/weight_logs/search', [WeightLogController::class, 'search']);
    // 体重詳細
    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show']);
    // 体重更新
    Route::get('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'edit']);
    Route::put('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');
    // 体重削除
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
    // 目標設定
    Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting']);
    Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'updateGoal']);

    // ログアウト
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/login');
    });
});




