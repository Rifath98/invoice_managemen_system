<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Invoice CRUD Route
Route::get('/', [InvoiceController::class, 'dashboard'])->name('dashboard');

Route::get('/invoice',[InvoiceController::class,'create'])->name('invoice.open');
Route::get('/invoice-list',[InvoiceController::class,'index'])->name('invoice.list');
Route::put('/invoice/save',[InvoiceController::class,'saveOrUpdate'])->name('invoice.create');
Route::put('/invoice/{id}',[InvoiceController::class,'saveOrUpdate'])->name('invoice.update');
Route::delete('/invoice/delete/{id}',[InvoiceController::class,'destroy'])->name('invoice.delete');
Route::get('/invoice/{id}/edit',[InvoiceController::class,'edit'])->name('invoice.edit');
Route::get('/invoices/generate-number',[InvoiceController::class,'generateInvoiceNumber']);
Route::get('/invoice/{id}/pdf',[InvoiceController::class,'generatePdf'])->name('invoice.pdf');
Route::get('/invoice/search',[InvoiceController::class,'search'])->name('invoice.search');

Route::post('/get-customer-details',[InvoiceController::class,'getCustomerDetails'])->name('customers.details');


//Customer Code
Route::get('/customers', [CustomerController::class, 'showCustomers'])->name('customers');
Route::get('/customers/{id}/edit', [CustomerController::class, 'editCustomer'])->name('editCustomer');
Route::post('/customers/{id}/update', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
Route::get('/customers/{id}/delete', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer');

Route::get('/customers/add', [CustomerController::class, 'createCustomer'])->name('createCustomer');
Route::post('/customers/store', [CustomerController::class, 'storeCustomer'])->name('storeCustomer');
Route::get('/customers/filter', [CustomerController::class, 'index'])->name('customers.index_filter');


//Route::get('/get-customer-details', [CustomerController::class, 'loadCustomerDetails']);


//Product CRUD Route

Route::get('/products', [ProductController::class, 'view'])->name('product.view');
