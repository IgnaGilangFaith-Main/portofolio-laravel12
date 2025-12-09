<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomepageController::class, 'index']);

// Auth Routes
Route::get('/login', function () {
    return view('back.login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout']);

    // Dashboard Routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return view('back.dashboard');
        });
    });

    // Hero Routes
    Route::get('/hero', [HeroController::class, 'index']);
    Route::get('/hero/create', [HeroController::class, 'create']);
    Route::post('/hero/create', [HeroController::class, 'store']);
    Route::get('/hero/{id}/edit', [HeroController::class, 'edit']);
    Route::put('/hero/{id}/update', [HeroController::class, 'update']);
    Route::get('/hero/{id}/delete', [HeroController::class, 'delete']);
    Route::delete('/hero/{id}/delete', [HeroController::class, 'destroy']);

    // About Routes
    Route::get('/about', [AboutController::class, 'index']);
    Route::get('/about/create', [AboutController::class, 'create']);
    Route::post('/about/create', [AboutController::class, 'store']);
    Route::get('/about/{id}/edit', [AboutController::class, 'edit']);
    Route::put('/about/{id}/update', [AboutController::class, 'update']);
    Route::get('/about/{id}/delete', [AboutController::class, 'delete']);
    Route::delete('/about/{id}/delete', [AboutController::class, 'destroy']);

    // Skill Routes
    Route::get('/skill', [SkillController::class, 'index']);
    Route::get('/skill/create', [SkillController::class, 'create']);
    Route::post('/skill/create', [SkillController::class, 'store']);
    Route::get('/skill/{id}/edit', [SkillController::class, 'edit']);
    Route::put('/skill/{id}/update', [SkillController::class, 'update']);
    Route::get('/skill/{id}/delete', [SkillController::class, 'delete']);
    Route::delete('/skill/{id}/delete', [SkillController::class, 'destroy']);

    // Project Routes
    Route::get('/project', [ProjectController::class, 'index']);
    Route::get('/project/create', [ProjectController::class, 'create']);
    Route::post('/project/create', [ProjectController::class, 'store']);
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit']);
    Route::put('/project/{id}/update', [ProjectController::class, 'update']);
    Route::get('/project/{id}/delete', [ProjectController::class, 'delete']);
    Route::delete('/project/{id}/delete', [ProjectController::class, 'destroy']);

    // User Routes (Pengaturan Akun)
    Route::get('/pengaturan-akun', [UserController::class, 'index']);
    Route::get('/pengaturan-akun/{id}/edit', [UserController::class, 'edit']);
    Route::put('/pengaturan-akun/{id}/update', [UserController::class, 'update']);

});
