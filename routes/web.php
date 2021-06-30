<?php

use App\Http\Controllers\PostController;
use App\Models\post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Mail;
//use Prophecy\Doubler\ClassPatch\DisableConstructorPatc;
use App\Mail\DiscountOffer;
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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('posts',PostController::class );

Route::post('/posts/{post}/comments',[CommentsController::class,'store']);

Route::post('mail/',function(){
  $email=  request()->validate([
        'email'=>'required|email'
    ]);

Mail::to($email)->send(new DiscountOffer());
 return back();
});