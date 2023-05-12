<?php

use FarhadNstu\Validator\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/validation', [Controllers\ValidatorController::class, '__invoke']);
