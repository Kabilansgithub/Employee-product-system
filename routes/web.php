<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
// Product employee attach/detach
Route::post('/products/{product}/attach/{employee}', [ProductController::class, 'attachEmployee'])->name('products.attachEmployee');
Route::delete('/products/{product}/detach/{employee}', [ProductController::class, 'detachEmployee'])->name('products.detachEmployee');

Route::resource('employees', EmployeeController::class);
