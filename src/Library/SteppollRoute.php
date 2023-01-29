<?php


namespace Steppoll\Library;


use Illuminate\Support\Facades\Route;

class SteppollRoute
{

    public static function routes()
    {
        Route::get('/poll/{stepClass}', [\Steppoll\Http\Controllers\StepPollController::class, 'index'])->name("poll");
        Route::post('/poll/validate/{stepClass}', [\Steppoll\Http\Controllers\StepPollController::class, 'validateStepData']);
        Route::post('/poll/complete/{stepClass}', [\Steppoll\Http\Controllers\StepPollController::class, 'Complete'])->name("poll.complete");
    }

}
