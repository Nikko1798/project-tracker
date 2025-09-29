<?php
use App\Http\Controllers\PisApiController;

Route::middleware('auth')->prefix('project')->group(function () {
    Route::get('info', [PisApiController::class, 'getProjectInformation'])
        ->name('info');
});