<?php

use Illuminate\Support\Facades\Route;

Route::get('/add-pet', [App\Http\Controllers\PetController::class, 'addPet'])->name('pet.add');
Route::post('/submit-form', [App\Http\Controllers\PetController::class, 'submitPet'])->name('pet.submit');
Route::get('/', [App\Http\Controllers\PetController::class, 'pet'])->name('pet');
Route::get('/edit/{id}', [App\Http\Controllers\PetController::class, 'editPet'])->name('pet.edit');
Route::post('/edit/submit/{id}', [App\Http\Controllers\PetController::class, 'petEditSubmit'])->name('pet.edit.submit');
Route::get('/delete/{id}', [App\Http\Controllers\PetController::class, 'deletePet'])->name('pet.delete');
