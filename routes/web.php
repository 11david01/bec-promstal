<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::post('/submit-form', [FormController::class, 'submitForm']);

