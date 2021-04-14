<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContinutController;

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
Route::get('/',function(){
    return Activity::where('log_name', 'user')->get();
    return view('dashboard');
    
});
Route::get('continut/ac',function(){
    return Activity::all();
   
    
});
Route::get('comments/ac',function(){
    return Activity::all();
   
    
});
Route::get('/', [PagesController::class,'index']);
Route::get('/blog', [PagesController::class,'blog']);
//Route::get('/services', [PagesController::class,'services']);

Route::resources([
    'continut' => ContinutController::class,
    
]);
//Route::get('/continut', 'App\Http\Controllers\ContinutController@store');
//Route::post('','ContinutController@store')->name('continut.store');

Route::get('number', [App\Http\Controllers\ContinutController::class, 'numberComments'])->name('numberComments');

Route::post('number', [App\Http\Controllers\ContinutController::class, 'numberComments'])->name('numberComments');
//Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/index', [App\Http\Controllers\PagesController::class, 'index'])->name('index');
Auth::routes();
Route::get('/pages/index', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');
// Route::get('dashboard', [App\Http\Controllers\ContinutController::class, 'destroy2'])->name('index');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update_avatar'])->name('update_avatar');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('updatePassword');
Route::post('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('updateAvatar');
Route::post('/profile/profile', [App\Http\Controllers\ProfileController::class, 'update_avatar'])->name('update_avatar');


 Route::get('keywords',[App\Http\Controllers\ContinutController::class, 'showKeywords'])->name('showKeywords');
 Route::post('keywords',[App\Http\Controllers\ContinutController::class, 'storeKeywords'])->name('storeKeywords');
 Route::get('search', 'App\Http\Controllers\ContinutController@search')->name('search');
 //Route::get('/search', [App\Http\Controllers\ContinutController::class ,'search'])->name('search');
 Route::post('keywords/update',[App\Http\Controllers\ContinutController::class, 'updateKeywords'])->name('updateKeywords');
 Route::get('updateKeywords',[App\Http\Controllers\ContinutController::class, 'showKeywords'])->name('showKeywords');
 
 //Route::get('search', [App\Http\Controllers\ContinutController::class ,'search'])->middleware('guest')->name('search');
 Route::post('/continut', 'App\Http\Controllers\ContinutController@categorii_index')->name('continut.index');
 Route::get('test',[App\Http\Controllers\ContinutController::class, 'insert2'])->name('insert2');
 //Route::post('test',[App\Http\Controllers\ContinutController::class, 'storeKeywords'])->name('storeKeywords');
 Route::post('','App\Http\Controllers\ContinutController@store')->name('continut.store');
 Route::post('keywords/categorie','App\Http\Controllers\ContinutController@categorie')->name('categorie');
//  Route::post('continut/filter','App\Http\Controllers\ContinutController@filter')->name('filter');


