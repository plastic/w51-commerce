<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\DepartamentoController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\MarcaController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Models\Admin\Marca;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StaterkitController::class, 'home'])->name('home');
Route::get('home', [StaterkitController::class, 'home'])->name('home');

// Route Layout Exemples
Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::group(['prefix' => 'fileupload'], function () {
            Route::post('/store', [FileController::class, 'store'])->name('fileupload.store');
        });


        Route::group(['prefix' => 'produtos'], function () {
            Route::get('/', [ProductsController::class, 'index'])->name('produto.index');
            Route::get('/create', [ProductsController::class, 'create'])->name('produto.create');
            Route::post('/store', [ProductsController::class, 'store'])->name('produto.store');
            Route::get('/show/{produto}', [ProductsController::class, 'show'])->name('produto.show');
            Route::get('/edit', [ProductsController::class, 'edit'])->name('produto.edit');
            Route::post('/update/{produto}', [ProductsController::class, 'update'])->name('produto.update');
            Route::delete('/delete', [ProductsController::class, 'delete'])->name('produto.delete');
            Route::get('/export', [ProductsController::class, 'export'])->name('produtos.export');
        });

        Route::group(['prefix' => 'departamentos'], function () {
            Route::get('/', [DepartamentoController::class, 'index'])->name('departamento.index');
            Route::get('/create', [DepartamentoController::class, 'create'])->name('departamento.create');
            Route::post('/store', [DepartamentoController::class, 'store'])->name('departamento.store');
            Route::get('/show/{departamento}', [DepartamentoController::class, 'show'])->name('departamento.show');
            Route::get('/edit/{departamento}', [DepartamentoController::class, 'edit'])->name('departamento.edit');
            Route::post('/update/{departamento}', [DepartamentoController::class, 'update'])->name('departamento.update');
            Route::delete('/delete', [DepartamentoController::class, 'delete'])->name('departamento.delete');
        });

        Route::group(['prefix' => 'categorias'], function () {
            Route::get('/', [CategoriaController::class, 'index'])->name('categoria.index');
            Route::get('/teste', [CategoriaController::class, 'montaArvoreMenu'])->name('categoria.teste');
            Route::get('/show/{categoria}', [CategoriaController::class, 'show'])->name('categoria.show');
            Route::get('/create', [CategoriaController::class, 'create'])->name('categoria.create');
            Route::get('/edit/{categoria}', [CategoriaController::class, 'edit'])->name('categoria.edit');
            Route::get('/update', [CategoriaController::class, 'update'])->name('categoria.update');
            Route::post('/store', [CategoriaController::class, 'store'])->name('categoria.store');
            Route::delete('/delete', [CategoriaController::class, 'delete'])->name('categoria.delete');
        });

        Route::group(['prefix' => 'marcas'], function () {
            Route::get('/', [MarcaController::class, 'index'])->name('marca.index');
            Route::get('/create', [MarcaController::class, 'create'])->name('marca.create');
        });

        Route::group(['prefix' => 'relatorios'], function () {
            Route::get('/newsletter', [NewsletterController::class, 'index'])->name('relatorios.newsletter');
            Route::post('/newsletter', [NewsletterController::class, 'search'])->name('newsletter.search');
            Route::post('/newsletter/active', [NewsletterController::class, 'active'])->name('newsletter.active');
            Route::post('/newsletter/delete', [NewsletterController::class, 'delete'])->name('newsletter.delete');
            Route::get('/newsletter/export', [NewsletterController::class, 'export'])->name('newsletter.export');
        });

        Route::group(['prefix' => 'administradores'], function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/', [UserController::class, 'search'])->name('user.search');
            Route::get('/show/{user}', [UserController::class, 'show'])->name('user.show');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
        });


    });
});
