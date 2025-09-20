<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');



// Cart routes
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
Route::post('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');

//Route::post('/checkout', function (Request $request) {
   // $cartTotal = $request->input('amount');
    //return view('frontend.project.checkout', compact('cartTotal'));
//})->name('checkout');

// Authentication Routes (moved to the top to avoid conflicts)
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Debug route (remove in production)
Route::get('/users', [AuthController::class, 'showUsers'])->name('users.show');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    
    Route::get('/admin/dashboard', [CheckoutController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('auth');
    
    
});


// Admin Users Routes
Route::get('/admin/users', function () {
    $users = App\Models\User::all();
    return view('admin.users.view', compact('users'));
})->name('admin.users')->middleware('auth');

// Add User Route
Route::get('/admin/users/add', function () {
    return view('admin.users.add');
})->name('admin.users.add')->middleware('auth');

Route::post('/admin/users/store', [AuthController::class, 'storeUser'])
    ->name('admin.users.store')
    ->middleware('auth');

// Admin product CRUD (namespaced names like admin.products.store)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Frontend shop (use controller so $products is passed to blade)
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

//checkout routes
Route::post('/orders', [CheckoutController::class, 'store'])->name('orders.store');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'fetchCart'])->name('checkout.fetchCart');
//admin orders routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Admin Orders
    Route::get('orders', [CheckoutController::class, 'adminOrders'])->name('orders.view');
});

Route::get('/pay', function () {
    abort(404); // show Laravel's 404 page
});


