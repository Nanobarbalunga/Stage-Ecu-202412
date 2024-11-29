<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get('/cinappi', function () {
//     return "<h1>Cinappi</h1>";
// });

// Route::get('/cinappi2', function (Request $request) {
//     $params = implode($request->all());
//     $cc=$request->query('cc') ?? 'No credit card provided';
//     return "<h1>Cinappi</h1> <pre>$params</pre><hr /> <h2>Credit Card: $cc</h2>";
// });

// Route::get('/cinappi43', function () {
//     $params = implode(request()->all());
//     $cc=request()->query('cc') ?? 'No credit card provided';
//     $value = env("LOG_CHANNEL");
//     return "<h1>Cinappi</h1> <pre>$params</pre><hr /> <h2>Credit Card: $cc</h2> <hr /> <h3>$value</h3> ";
// });

// Route::get('/cinappio/{id?}', function ($pupu = 'default') {
//     $params = implode(request()->all());
//     $cc=request()->query('cc') ?? 'No credit card provided';
//     $value = $pupu;
//     return "<h1>Cinappioooooo</h1> <pre>$params</pre><hr /> <h2>Credit Card: $cc</h2> <hr /> <h3>$value</h3> ";
// });