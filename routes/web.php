<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ThemapController;
use App\Http\Controllers\TheperareaController;

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
    return redirect("/map");
});

Route::get("/map", [ThemapController::class,"index"]);

Route::post("/theareas", [ThemapController::class,"theareas"])->name("theareas");
Route::get("/getthe_area_info", [ThemapController::class,"getthe_area_info"])->name("getthe_area_info");

Route::get("/getyields",[ThemapController::class,"get_yields"])->name("get_yields");

Route::get("/specific_commo_data", [ThemapController::class,"specific_commo_data"])->name("specific_commo_data");

Route::get("/the_sectors", [ThemapController::class,"the_sectors"])->name("the_sectors");
Route::get("/the_sub_sectors",[ThemapController::class,"the_sub_sectors"])->name("the_sub_sectors");
Route::get("/the_sector_function",[ThemapController::class,"the_sector_function"])->name("the_sector_function");
Route::get("/the_sector_impact_output",[ThemapController::class,"the_sector_impact_output"])->name("the_sector_impact_output");

Route::get("/project_details",[ThemapController::class,"project_details"])->name('project_details');

Route::get("/the_funder",[ThemapController::class,"the_funder"])->name("the_funder");

Route::post("/get_project_per_region",[ThemapController::class,"get_project_per_region"])->name("get_project_per_region");

Route::get("/get_funder_in_area", [ThemapController::class,"get_funder_in_area"])->name("get_funder_in_area");
Route::get("/the_province_info",[ThemapController::class,"the_province_info"])->name("the_province_info");
Route::get("/oda_distribution",[ThemapController::class,"oda_distribution"])->name("oda_distribution");
Route::get("/get_programs_projects",[ThemapController::class,"get_programs_projects"])->name("get_programs_projects");
Route::get('/typeofasst', [ThemapController::class,"typeofasst"])->name("typeofasst");

// input dashboard
Route::get("/input/project/info",[TheperareaController::class,"index"])->name("inputproject");
Route::get("/input/province/info",[TheperareaController::class,"province_info"])->name("province_info");
Route::get("/get_location", [TheperareaController::class,"get_location"])->name("get_location");
Route::post("/save_location", [TheperareaController::class,"save_location"])->name("save_location");
Route::post("/save_sdg", [TheperareaController::class,"save_sdg"])->name("save_sdg");
// end 

// province dashboard 
Route::post("/save_province_info", [TheperareaController::class,"save_province_info"])->name("save_province_info");
// end 

// dashboard
Route::post("/odaspertype",[ThemapController::class,"odaspertype"])->name("odaspertype");
Route::post("/odafundspersector",[ThemapController::class,"odafundspersector"])->name("odafundspersector");
Route::post("/odafundspertype",[ThemapController::class,"odafundspertype"])->name("odafundspertype");
// end 

Route::get("/sdg_thrust",[ThemapController::class,"sdg_thrust"])->name("sdg_thrust");