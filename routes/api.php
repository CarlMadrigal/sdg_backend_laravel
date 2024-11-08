<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\projectsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('projects', [projectsController::class,'index'] );

Route::post('projects', [projectsController::class,'upload'] );

Route::put('projects/edit/{id}', [projectsController::class,'edit'] );

Route::delete('projects/delete/{id}', [projectsController::class,'delete'] );

/*Route::get('projects', function () {
    return 'I am working';
});*/