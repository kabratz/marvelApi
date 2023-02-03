<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoryCharacterController;
use App\Http\Controllers\StoryController;
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

Route::get('/', [HomeController::class, 'index' ]);

/* Characters */
Route::get('/characters', [CharacterController::class, 'loadAll' ])->name('Characters');
Route::get('/characters/importAll', [CharacterController::class, 'importAll' ]);

/* Stories */
Route::get('/stories', [StoryController::class, 'loadAll' ])->name('Stories');
Route::get('/stories/importAll', [StoryController::class, 'importAll' ]);

/* Characters 1tories */
Route::get('/stories-character', [StoryCharacterController::class, 'create' ]);
Route::get('/stories-character/characters', [StoryCharacterController::class, 'getCharactersAvaibleToStory' ]);
Route::get('/stories-character/delete', [StoryCharacterController::class, 'delete' ]);
