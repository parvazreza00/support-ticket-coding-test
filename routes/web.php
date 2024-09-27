<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;

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

// user All route
Route::middleware('auth','role:customer')->group(function(){
    Route::get('/dashboard', [CustomerController::class, 'customerDashboard'])->name('dashboard');
    Route::get('/open/ticket', [TicketController::class, 'openTicket'])->name('open.ticket');
    Route::post('/create/ticket', [TicketController::class, 'createTicket'])->name('create.ticket');
    Route::get('/ticket/admin/response/{id}', [TicketController::class, 'ticketAdminResponse'])->name('ticket.admin.response');
});


//admin dashboard
Route::middleware('auth','role:admin')->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/ticket/response/{id}', [TicketController::class, 'ticketResponse'])->name('ticket.response');
    Route::post('/ticket/response', [TicketController::class, 'ticketResponseStore'])->name('ticket.response.store');
    Route::get('/ticket/all/response/{id}', [TicketController::class, 'ticketAllResponse'])->name('ticket.all.response');
    Route::get('/ticket/close/{id}', [TicketController::class, 'ticketClose'])->name('ticket.close');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
