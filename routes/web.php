<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\DepartamentoController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\MarcaController;
use App\Http\Controllers\Admin\ProdutoController;
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


Route::get('/', function () {
    return view('/content/home');
})->name('home');

Route::get('/home', function () {
    return view('/content/home');
})->name('home');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::group(['prefix' => 'fileupload'], function () {
            Route::post('/store', [FileController::class, 'store'])->name('fileupload.store');
        });

        Route::group(['prefix' => 'produtos'], function () {
            Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
            Route::get('/create', [ProdutoController::class, 'create'])->name('produto.create');
            Route::post('/store', [ProdutoController::class, 'store'])->name('produto.store');
            Route::get('/show/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
            Route::get('/edit', [ProdutoController::class, 'edit'])->name('produto.edit');
            Route::post('/update/{produto}', [ProdutoController::class, 'update'])->name('produto.update');
            Route::delete('/delete', [ProdutoController::class, 'delete'])->name('produto.delete');
            Route::get('/export', [ProdutoController::class, 'export'])->name('produtos.export');
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
            Route::get('/create', [CategoriaController::class, 'create'])->name('categoria.create');
            Route::post('/store', [CategoriaController::class, 'store'])->name('categoria.store');
            Route::get('/show/{categoria}', [CategoriaController::class, 'show'])->name('categoria.show');
            Route::get('/edit/{categoria}', [CategoriaController::class, 'edit'])->name('categoria.edit');
            Route::post('/update/{categoria}', [CategoriaController::class, 'update'])->name('categoria.update');
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
