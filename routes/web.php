<?php

use Illuminate\Support\Facades\Route;

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
    $comments =  app(\App\Http\Repository\CommentRepository::class)->getComments();
//    dd($comments);
    session_start();
    return view('welcome', ['comments' => $comments]);
});
