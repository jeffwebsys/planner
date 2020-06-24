<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function (){

Route::get('/members','MembersController@index');
Route::post('/members','MembersController@store');   
Route::get('/members/{member}','MembersController@show'); 
Route::patch('/members/{member}','MembersController@update');
Route::delete('/members/{member}','MembersController@destroy');
//Cellgroups
Route::get('/cellgroups','CellGroupsController@index');
Route::post('/cellgroups','CellGroupsController@store');










});