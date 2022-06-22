<?php

use App\Http\Controllers\{
    UserController
};
use Illuminate\Support\Facades\Route;

Route::delete('users/{id}',[UserController::class, 'delete'])->name('users.delete');
Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update'); //Passar o verbo Patch pois deve editar parcialmente(n pecisa editar a senha) no Put deve editar todos os registros.
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// A rota users/create deve estar antes da users/{id}, se n ira tentar passar o create como se fosse um id.
Route::post('users',[UserController::class, 'store'])->name('users.store'); // N tem problema ter o nome da rota repitido pois uma está com Get e outra com Post.
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');




Route::get('/', function () {
    return view('welcome');
});
