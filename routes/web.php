<?php

use App\Livewire\Home;
use App\Livewire\Explore;
use App\Livewire\Profile\Reels;
use App\Livewire\Profile\Saved;
use Illuminate\Support\Facades\Route;
use App\Livewire\Reels as LivewireReels;
use App\Http\Controllers\ProfileController;
use App\Livewire\Post\View\Page;
use App\Livewire\Profile\Home as ProfileHome;

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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', Home::class)->name('Home');
    Route::get('/explore', Explore::class)->name('explore');


    Route::get('/post/{post}', Page::class)->name('post');


    Route::get('/reels', LivewireReels::class)->name('reels');
    Route::get('/profile/{user}', ProfileHome::class)->name('profile.home');
    Route::get('/profile/{user}/reels', Reels::class)->name('profile.reels');
    Route::get('/profile/{user}/saved', Saved::class)->name('profile.saved');
});

require __DIR__ . '/auth.php';