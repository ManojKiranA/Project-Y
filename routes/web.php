<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;

Auth::routes();

Route::any('testWhen', function (Request $request) {

    User::query()
    ->when($request->get('whenpass'),
        //execute this callback when condition is passed
        function($query,$passedValue){
            return $query->where('when','=',$passedValue);
        },
        //execute this callback when condition is not passed
        function($query) use ($request){
            return $query->where('when','=','NOT PASSED');
    })

    ->dd();

    dd($request);
});


Route::view('/vue/stacked/home', 'vue.stacked.home');
Route::view('/vue/stacked/ui', 'vue.stacked.ui.index');

Route::view('/vue/sidebar/home', 'vue.sidebar.home');
Route::view('/vue/sidebar/ui', 'vue.sidebar.ui.index');

Route::view('/alpine/stacked/home', 'alpine.stacked.home');
Route::view('/alpine/stacked/ui', 'alpine.stacked.ui.index');

Route::view('/alpine/sidebar/home', 'alpine.sidebar.home');
Route::view('/alpine/sidebar/ui', 'alpine.sidebar.ui.index');
