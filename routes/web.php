<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/flush', function () {
    Session::flush();

    return redirect('/login');
})->name('flush');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    return "Cache is cleared";
});

Route::get('/config-clear', function () {
    Artisan::call('config:clear');
    return "Cache is cleared";
});

Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return "View is cleared";
});

Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    return "View is cleared";
});


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

//Exceptions
Route::get('exceptions', [\App\Http\Controllers\ExceptionController::class, 'index'])->name('exceptions.index');
Route::get('exceptions/datatable', [\App\Http\Controllers\ExceptionController::class, 'datatable'])->name('exceptions.datatable');
Route::get('exceptions/{uuid}/visualizar', [\App\Http\Controllers\ExceptionController::class, 'visualizarException'])->name('exceptions.visualizar');

/* Formulário base 1 */
Route::get('secao_1/', [\App\Http\Controllers\Formulario1Controller::class, 'index'])->name('secao_1.index');
Route::get('cadastro-objetos', [\App\Http\Controllers\Formulario1Controller::class, 'create'])->name('secao_1.formulario');

/* Formulário base 2 */
Route::get('secao_2/', [\App\Http\Controllers\Formulario2Controller::class, 'index'])->name('secao_2.index');
Route::get('cadastro-objetos2', [\App\Http\Controllers\Formulario2Controller::class, 'create'])->name('secao_2.formulario2');

/* Formulário base 3 */
Route::get('secao_3/', [\App\Http\Controllers\Formulario3Controller::class, 'index'])->name('secao_3.index');
Route::get('select/', [\App\Http\Controllers\Formulario3Controller::class, 'multiselect'])->name('secao_3.seletores');

/* Formulario base 4*/
Route::get('secao_4/', [\App\Http\Controllers\Formulario4Controller::class, 'index'])->name('secao_4.index');
Route::get('cadastro-objetos4/', [\App\Http\Controllers\Formulario4Controller::class, 'create'])->name('secao_4.formulario4');

/* Dashboards */
Route::get('dashboard/', [\App\Http\Controllers\DashboardController::class, 'dashboard1'])->name('dashboard.dashboard1');
Route::get('dashboard2/', [\App\Http\Controllers\DashboardController::class, 'dashboard2'])->name('dashboard.dashboard2');
Route::get('dashboard3/', [\App\Http\Controllers\DashboardController::class, 'dashboard3'])->name('dashboard.dashboard3');

/* Gerais */
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\LoginController::class, 'autenticar'])->name('login.autenticar');
Route::get('logout',[\App\Http\Controllers\LoginController::class, 'logout'])->name('logout.post');
Route::get('sair', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

/* Linha do Tempo (Atualizações) */
Route::get('timeline', [\App\Http\Controllers\VersaoSistemaController::class, 'index'])->name('timeline.index');
Route::get('mudarStatus/{uuid}/{novoStatus}', [\App\Http\Controllers\HomeController::class, 'mudarStatus'])->name('mudarStatus');
Route::get('/getStatus/{UUID}', [\App\Http\Controllers\HomeController::class, 'getStatus'])->name('getStatus');

Route::get('logs/datatable/{type}/{nome?}', [\App\Http\Controllers\HomeController::class, 'datatable'])->name('logs.datatable');
Route::get('logs/{idLog}/visualizar', [\App\Http\Controllers\LogController::class, 'visualizarDetalhes'])->name('logs.visualizar');

/** Detalhes da requisição */
Route::get('detail/request', [\App\Http\Controllers\DetalhesRequisicaoController::class, 'buscarDados'])->name('detail.request');
Route::get('detail/{idLog}/show', [\App\Http\Controllers\DetalhesRequisicaoController::class, 'visualizarDetalhesRequest'])->name('detail.show');
Route::get('detail/datatable', [\App\Http\Controllers\DetalhesRequisicaoController::class, 'datatable'])->name('detail.datatable');