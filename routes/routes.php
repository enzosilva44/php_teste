<?php
session_start();
require_once 'controllers/LoginController.php';

Route::add('/login', [LoginController::class, 'login']);
Route::add('/dashboard', [LoginController::class, 'dashboard']);
Route::add('/logout', [LoginController::class, 'logout']);

Route::handleNotFound();
