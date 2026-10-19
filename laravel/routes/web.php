
<?php

use App\Http\Controllers\AccountDeletionController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [PortfolioController::class, 'index'])
    ->name('home');

// Dashboard
Route::view('/dashboard', 'dashboard')
    ->name('dashboard');

// Profile
Route::view('/profile', 'profile')
    ->name('profile');

// Account Settings
Route::view('/account-settings', 'account-settings')
    ->name('account-settings');

// Template Selection
Route::view('/templates', 'templates')
    ->name('templates');

// Portfolio Editor
Route::get('/portfolio/create', function (Request $request) {

    // Get selected template; use Modern by default
    $template = $request->query('template', 'modern');

    // Allowed templates
    $allowedTemplates = ['modern', 'creative', 'minimal'];

    // Check if the selected template is valid
    if (!in_array($template, $allowedTemplates, true)) {
        abort(404);
    }

    // Modern editor
    if ($template === 'modern') {
        return view('portfolio.modern-editor');
    }

    // Creative editor
    if ($template === 'creative') {
        return view('portfolio.creative-editor');
    }

    // Minimal editor
    if ($template === 'minimal') {
        return view('portfolio.minimal-editor');
    }

    abort(404);

})->name('portfolio.create');

// Delete Account
Route::post(
    '/account/delete',
    [AccountDeletionController::class, 'destroy']
)->name('account.delete');
