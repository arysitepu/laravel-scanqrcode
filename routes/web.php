<?php

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

use App\Http\Controllers\QRCodeController;
// use Illuminate\Routing\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [QRCodeController::class, 'index']);
Route::get('/create', [QRCodeController::class, 'create']);
Route::post('/scan', [QRCodeController::class, 'scan']);
Route::post('/save', [QRCodeController::class, 'save']);
