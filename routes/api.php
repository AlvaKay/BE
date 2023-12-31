<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\NhatController;
use App\Http\Controllers\TamController;
use App\Http\Controllers\TrungController;
use App\Http\Controllers\ThoController;
use App\Http\Controllers\HoanController;



use App\Http\Controllers\BookingController;
use App\Http\Controllers\SearchController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// TRUNG ĐẶNG
// register
Route::post('/register', [TrungController::class, 'register']);
Route::post('/verify-otp', [TrungController::class, 'verifyOtp']);

// forgot password
Route::post('/forgot_password', [TrungController::class, 'forgotpassword']);
Route::post('/verify_new_password', [TrungController::class, 'verifyNewPassword']);

// Login
Route::post('/login', [TrungController::class, 'login']);
// lấy thông tin user.
Route::get('/users', [TrungController::class, 'getUsers']);

// lấy thông tin user từ history
Route::get('/history/user', [TrungController::class, 'gethistory_user']);





// VÕ THÀNH TÂM
// users
Route::get('/users', [TamController::class, 'getUsers']);
Route::get('/users/{users_id}', [TamController::class, 'getUsersId']);
Route::put('/users/{id}', [TamController::class, 'update']);
//Rating
Route::post('/rating', [TamController::class, 'storeRating']);
Route::get('/ratings/{shop_id}', [TamController::class, 'getRatingsWithUserNames']);

// PAHN ĐỨC THƠ
Route::post('/stylists', [ThoController::class, 'updateStylist']);

Route::get('/stylist/{id}', [ThoController::class, 'getStylist']);

Route::get('/is_user', [ThoController::class, 'getIsUser']);
Route::put('/users/{id}', [ThoController::class, 'update']);

Route::post('/payment-vnpay', [ThoController::class, 'payment_VnPay']);
Route::post('/thank', [ThoController::class, 'thanks']);

Route::post('/addstylist', [ThoController::class, 'addStylist']);
Route::delete('/stylists/{user_id}/{stylist_id}', [ThoController::class, 'deleteStylist']);


Route::get('/get_history_user/{user_id}',[ThoController::class, 'getHistoryBooking']);

Route::get('/getbookingdetail/{history_id}', [ThoController::class, 'getBookingDetail']);


//payments
Route::get('/payments/{user_id}', [ThoController::class, 'getPaymentsByUserId']);
Route::get('/get-payments', [ThoController::class, 'getPayments']);
Route::get('/get-payment', [ThoController::class, 'getPayment']);

//ratings
Route::get('/delete-ratings/{rating_id}', [ThoController::class, 'deleteRatings']);
Route::get('/get-ratings', [ThoController::class, 'getRatings']);

// Shops
Route::get('/shops', [ShopController::class, 'index']);
Route::get('shops/{shop_id}', [ShopController::class, 'show']);
Route::post('shops', [ShopController::class, 'store']);
Route::put('shops/{id}', [ThoController::class, 'update']);
Route::delete('shops/{id}', [ThoController::class, 'destroy']);

// duyệt shop
Route::post('/add-shop', [ThoController::class, 'addShop']);
Route::post('/add-address', [ThoController::class, 'addAddress']);
Route::get('/shops-by-users/{user_id}',[ThoController::class, 'getShopsByUserId']);


Route::get('/approve', [ThoController::class, 'getBaberShop']);
Route::post('/approve/{shop_id}', [ThoController::class, 'BecomeShop']);


Route::get('/tho/payment-redirect', [VNPayController::class, 'momo_payment'])->name('payment.redirect');


// HOÀN BÙI

//Booking
Route::get('random-key', [HoanController::class, 'generateKey']);
Route::get('/getservices',[HoanController::class, 'getShopServices']);
Route::post('/bookingservices',[HoanController::class, 'booking']);
Route::post('/getbookedstylists', [HoanController::class, 'checkStylistAvailability']);



//Search
Route::post('/getdistance', [HoanController::class, 'calculateDistance']);
Route::get('/getallShop', [HoanController::class, 'allShop']);
Route::post('/getratingstar', [HoanController::class, 'caculateRatingStar']);
Route::get('/shops', [HoanController::class, 'search']);




// NGUYỄN VĂN NHẬT
Route::get('/shops', [NhatController::class, 'getshops']);
Route::get('/shops/{shop_id}',[NhatController::class, 'getShopbyShopId']);
Route::get('/service_shop_id/{shop_id}',[NhatController::class,'getServicesByShopId']);
Route::get('/style/{shop_id}',[NhatController::class ,'getStylelistByShopId']);
Route::get('/combo/{shop_id}',[NhatController::class,'getComboByShopId']);
