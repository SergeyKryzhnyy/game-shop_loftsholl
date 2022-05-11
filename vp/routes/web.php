<?php



use App\Http\Controllers\CategoryList;
use App\Http\Controllers\FormSend;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;



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

Route::get(GameController::getUrlCategory(), [GameController::class, 'categoryAction']);

Route::post('game-shop/sendform', [FormSend::class, 'getForm'])->name("game-shop/sendform");

Route::get('/', [GameController::class, 'categoryList'])->name('index');

Route::get('game-shop/cart', [GameController::class, 'cart'])->name('game-shop/cart');

Route::get('game-shop/buy', [GameController::class, 'buy'])->name('game-shop/buy')->middleware('auth');

Route::get('game-shop/news', [GameController::class, 'news'])->name('game-shop/news');

Route::get('game-shop/about', [GameController::class, 'about'])->name('game-shop/about');

Route::get('/send-email', 'GameController@sendEmail');


//})->middleware(['auth'])->name('index');

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
