<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ChemicalImport;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products/search-list', function (Request $request) {
    $keyword = $request->query('name');

    $results = ChemicalImport::where('chemical_name_th', 'like', "%{$keyword}%")
        ->orWhere('chemical_name_en', 'like', "%{$keyword}%")
        ->limit(10)
        ->get(['chemical_name_th', 'formula', 'id']);

    return response()->json($results);
});
