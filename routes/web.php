<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


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

Route::get('/template', [TestController::class,'viewImportFileTemplate']);
Route::post('/importFile',[TestController::class,'importFile'])->name('importFile');
Route::get('/createImage',[TestController::class,'createImage'])->name('createImage');
Route::get('/template1/{name}/{id}/{profile_pic}',[TestController::class,'viewTemplate1'])->name('template1');
Route::post('/saveImage', [TestController::class, 'saveImage']);
