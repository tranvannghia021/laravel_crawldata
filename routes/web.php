<?php
//admin
use App\Http\Controllers\admin\auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CrawlController;
use Illuminate\Http\Request;
// client
use App\Http\Controllers\client\HomeController;
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
// check login
Route::prefix('/admin')->group(function(){
    
    Route::get('/login',[LoginController::class,'index'])->name('admin.login');
    Route::post('/login',[LoginController::class,'checkLogin']);
    Route::get('/logout',[LoginController::class,'logOutAdmin'])->name('admin.logout');
});
//admin(sẽ áp dụng check role)
Route::middleware(['checkLoginAdmin'])->prefix('/admin')->group(function (){
    // products
    Route::prefix('/products')->group(function (){
        Route::get('/list',[ProductsController::class,'index'])->name('products.list');
        Route::post('/list',[ProductsController::class,'index']);
        Route::get('/show/{id}',[ProductsController::class,'show'])->name('products.show');
        Route::get('/add',[ProductsController::class,'create'])->name('products.add');
        Route::post('/add',[ProductsController::class,'store']);
        Route::get('/edit/{id}',[ProductsController::class,'edit'])->name('products.edit');
        Route::post('/edit/{id}',[ProductsController::class,'update']);
        //áp dụng ajax vào để delete tránh mã độc
        //Route::delete('/destroy',[ProductsController::class,'destroy']);
        // tạm thời fix cứng
        Route::get('/destroy/{id}',[ProductsController::class,'destroy'])->name('products.delete');
    });

     // category
     Route::prefix('/category')->group(function (){
        //add
        Route::get('/list',[CategoryController::class,'index'])->name('categorys.list');
        Route::post('/list',[CategoryController::class,'store'])->name('categorys.add');
        
        //update
        Route::get('/list/{id}',[CategoryController::class,'edit'])->name('categorys.edit');
        Route::post('/list/{id}',[CategoryController::class,'update']);
        // áp dụng ajax vào để delete tránh mã độc
       // Route::delete('/destroy',[CategoryController::class,'destroy']);
        // tạm thời fix cứng
        Route::get('/destroy/{id}',[CategoryController::class,'destroy'])->name('categorys.delete');
    });
    // dân trí
    Route::prefix('/crawls')->group(function (){
       Route::get('/',[CrawlController::class,'index'])->name('crawls.list');
       Route::get('/edit/{id}',[CrawlController::class,'edit'])->name('crawls.edit');
       Route::post('/edit/{id}',[CrawlController::class,'update']);
       Route::delete('/destroy',[CrawlController::class,'destroy'])->name('crawls.delete');
       Route::get('/show/{id}',[CrawlController::class,'show'])->name('crawls.show');
    });
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
    
});
//client

Route::prefix('/')->group(function(){
    Route::prefix('posts')->group(function(){
        Route::get('/list',[HomeController::class,'index'])->name('posts.list');
        Route::get('/show/{id}',[HomeController::class,'show'])->name('posts.show');
    });
    // fit cứng
    Route::get('/',[HomeController::class,'index']);
});







// Route::get('/shopify',function()
// {
//     return redirect('https://nghia132.myshopify.com/admin/oauth/authorize?client_id=a2c26dfe2e1f069d05ff6fa0ccc8987b&scope=write_orders,read_customers&redirect_uri=http://localhost:8000/admin');
// });
// Route::get('/admin',function(Request $request){
//    return redirect('POST https://'.$request->input('shop').'/admin/oauth/access_token
//    ');
// });

