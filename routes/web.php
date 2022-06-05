<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    return view('welcome');
});


// Route::get('/about', function () {
//     return view('about');
// });

Route::get('/awad', function () {
    // echo "Hello Awad";
    return view('awad');
});

// Route::get('/about', [AboutController::class, 'index'])->middleware('check');

Route::get('/about-lara-app-electronics-devices', [AboutController::class, 'index'])->name('about');


//Category
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'EditCat']);
Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCat']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pardelete']);

//suppliers
Route::get('/supplier/all', [SupplierController::class, 'AllSupplier'])->name('all.supplier');
Route::post('/supplier/add', [SupplierController::class, 'StoreSupplier'])->name('store.supplier');

Route::get('/supplier/edit/{id}', [SupplierController::class, 'EditSupp']);
Route::post('/supplier/update/{id}', [SupplierController::class, 'UpdateSupp']);
Route::get('/supplier/delete/{id}', [SupplierController::class, 'DeleteSupp']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
