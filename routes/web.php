<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\inventoryController;
use illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/all-sessions', function () {
    return view('admin.sessions');
})->name('admin-sessions');

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/generatereport', function(){
    return view('admin.reports');
})->name('reportsPage');

Route::get('/adminhome', function () {
    return view('adminpanel');
})->name('adminhome');

Route::get('/admin/addItem', [ItemController::class, 'create'])->name('admin.addItem');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin routes
});

Route::get('/userhome', function () {
    return view('home');
})->name('userhome');

Route::get('/useritems', function () {
    return view('myitems');
})->name('useritems');

Route::get('/usersessions', function () {
    return view('mysessions');
})->name('usersessions');

Route::get('/userannouncement', function () {
    return view('myannouncements');
})->name('userannouncement');


Route::get('/add-session', [SessionController::class, 'createSession'])->name('session.create');
Route::post('/add-session', [SessionController::class, 'storeSession'])->name('session.store');


Route::get('/add-post', [PostController::class, 'create'])->name('post.create');
Route::post('/add-post', [PostController::class, 'store'])->name('post.store');
Route::get('/all-posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/admin/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/admin/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::get('/add-item-form', [ItemController::class, 'createItem'])->name('item.create');
Route::post('/add-item', [ItemController::class, 'storeItem'])->name('item.store');
Route::get('/all-items', [ItemController::class, 'indexItem'])->name('items.index');
Route::get('/admin/{item_id}', [ItemController::class, 'showItem'])->name('items.show');
Route::get('/admin/{item_id}/editItem', [ItemController::class, 'editItem'])->name('items.edit');
Route::put('/admin/items/{item_id}', [ItemController::class, 'updateItem'])->name('items.update');
Route::delete('/admin/items/{item_id}', [ItemController::class, 'destroyItem'])->name('items.destroy');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/fetch-cart-items', [CartController::class, 'fetchCartItems']);

Route::get('/fetch-sessions', [SessionController::class, 'fetchSessions']);

Route::get('/fetch-announcements', [PostController::class, 'fetchAnnouncements']);

Route::get('/all-users', [UserController::class, 'index'])->name('users.index');
Route::get('/admin/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/admin/{user}/editUser', [UserController::class, 'edit'])->name('users.edit');
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/fetch-requests', [CartController::class, 'fetchCarts']);
Route::post('/update-status', [CartController::class, 'updateStatus']);

Route::get('/all-requests', [CartController::class, 'index'])->name('requests.index');

Route::post('/send-message-to-admin', [MessageController::class, 'sendMessageToAdmin']);

Route::get('/admin/readall/messages', [MessageController::class, 'fetchMessages'])->name('messages');

Route::get('/all-registered-users', [PdfController::class, 'usersPdf'])->name('usersList');
Route::get('/all-listed-items', [PdfController::class, 'itemsPdf'])->name('itemsList');
Route::get('/borrowed-items', [PdfController::class, 'debtsPdf'])->name('debtsList');
Route::get('/pending-requests', [PdfController::class, 'requestPdf'])->name('pendingRequest');
Route::get('/cleared-requests', [PdfController::class, 'clearedPdf'])->name('clearedDebts');

//Route::get('/fetch-users', [UserController::class, 'fetchUsers'])->name('users.manage');

//Route::get('/fetch-users', function () { return view('admin.users');})->name('users.manage');

Route::get('/pending-items', [CartController::class, 'pending'])->name('pending-items');
Route::get('/approved-items', [CartController::class, 'approved'])->name('approved-items');
Route::get('/rejected-items', [CartController::class, 'rejected'])->name('rejected-items');
Route::post('/update-status', [CartController::class, 'updateStatus'])->name('update-status');



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
