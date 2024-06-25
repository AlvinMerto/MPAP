<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ThemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/map", [ThemapController::class,"index"]);

Route::post("/theareas", [ThemapController::class,"theareas"])->name("theareas");
Route::get("/getthe_area_info", [ThemapController::class,"getthe_area_info"])->name("getthe_area_info");

Route::get("/getyields",[ThemapController::class,"get_yields"])->name("get_yields");

Route::get("/specific_commo_data", [ThemapController::class,"specific_commo_data"])->name("specific_commo_data");

Route::get("/the_sectors", [ThemapController::class,"the_sectors"])->name("the_sectors");

Route::get("/project_details",[ThemapController::class,"project_details"])->name('project_details');

Route::get("/the_funder",[ThemapController::class,"the_funder"])->name("the_funder");