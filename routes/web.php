<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

//////////////////////////////////////////////  LISTING ROUTES  ///////////////////////////////////////////////////////////////

// All Listing

Route::get('/', [ListingController::class, 'index']);

// Create Listing
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Edit Listing
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Edited Listing
Route::patch('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listing
Route::get('listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//////////////////////////////////////////////  USER ROUTES  ///////////////////////////////////////////////////////////////

// Show USER Register/Create Form

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create New Users

Route::post('/users', [UserController::class, 'store']);

//Logout Users

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show login form Users

Route::get('/login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');

//Login User

Route::post('/users/authenticate', [UserController::class, 'authenticate']);
