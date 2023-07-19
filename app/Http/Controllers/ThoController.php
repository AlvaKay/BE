<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rating;
use App\Models\payment;
use App\Models\shop;
use App\Models\User;
use Carbon\Carbon;
use App\Models\history;
use App\Models\address;
use App\Models\stylist;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;



class ThoController extends Controller
{
   public function getBookingDetail($historyId)
    {
        // Lấy thông tin chi tiết lịch đặt từ cơ sở dữ liệu
        $bookingDetail = History::join('users', 'histories.user_id', '=', 'users.user_id')
        ->join('payments', 'histories.payment_id', '=', 'payments.payment_id')
        ->join('stylists', 'histories.stylist_id', '=', 'stylists.stylist_id')
        ->leftJoin('combo', 'histories.combo_id', '=', 'combo.combo_id')
        ->leftJoin('services', 'histories.service_id', '=', 'services.service_id')
        ->select(
            'users.user_name',
            'users.user_phone',
            'users.user_address',
            'payments.payment_amount as price',
            'stylists.stylist_name',
            'histories.appointment_date',
            'histories.appointment_time',
            'combo.combo_name',
            'services.service_name'
        )
        ->where('histories.history_id', $historyId)
        ->first();
    
    // Kiểm tra xem có lịch đặt tồn tại hay không
    if (!$bookingDetail) {
        return response()->json(['error' => 'Lịch đặt không tồn tại'], 404);
    }
    
    return response()->json($bookingDetail);
    
    }
    public function getHistoryBooking($shopId)
{
    $currentDate = Carbon::now()->toDateString(); // Lấy ngày hiện tại

    $history = History::join('users', 'histories.user_id', '=', 'users.user_id')
        ->where('histories.shop_id', $shopId)
        ->whereDate('histories.appointment_date', '=', $currentDate) // So sánh ngày hiện tại
        ->select('histories.billing_code', 'users.user_name', 'histories.history_id')
        ->get();

    return $history;
}


public function deleteStylist($user_id,$stylist_id)
{
    // Xóa stylist với shop_id cụ thể
  Stylist::join('shops', 'stylists.shop_id', '=', 'shops.shop_id')
        ->join('users', 'shops.user_id', '=', 'users.user_id')
        ->where('shops.user_id', $user_id)
        ->where('stylists.stylist_id', $stylist_id)
        ->delete();
        return response()->json(['message' => 'xóa stylist thành công'], 200);}
        public function addStylist(Request $request)
        {
            // Lấy dữ liệu từ request
            $stylistName = $request->input('stylistName');
            $stylistImage = $request->input('stylistImage');
            $userId = $request->input('user_id'); // Thay đổi tên biến thành $userId
        
            // Kiểm tra xem user có shop tương ứng không
            $shop = Shop::where('user_id', $userId)->first();
        
            if (!$shop) {
                return response()->json(['error' => 'User không có shop tương ứng'], 404);
            }
        
            // Kiểm tra xem stylist đã tồn tại trong shop hay chưa
            $existingStylist = Stylist::where('stylist_name', $stylistName)
                ->where('shop_id', $shop->shop_id)
                ->first();
        
            if ($existingStylist) {
                return response()->json(['error' => 'Stylist đã tồn tại trong shop'], 400);
            }
        
            // Tạo mới stylist
            $stylist = new Stylist();
            $stylist->stylist_name = $stylistName;
            $stylist->stylist_image = $stylistImage;
            $stylist->shop_id = $shop->shop_id;
            $stylist->save();
        
            return response()->json(['message' => 'Stylist created successfully'], 200);
        }
        

    public function updateStylist(Request $request)
    {
        $stylist = new Stylist();
        $stylist->stylist_name = $request->input('stylist_name');
        $stylist->stylist_image = $request->input('stylist_image');
        $stylist->stylist_rating = $request->input('stylist_rating');
        $stylist->shop_id = $request->input('shop_id');
        $stylist->save();

        return response()->json(['message' => 'Stylist created successfully'], 201);
    }
    public function GetStylist($id)
    {
        $stylists = Stylist::join('shops', 'shops.shop_id', '=', 'stylists.shop_id')
            ->where('shops.user_id', $id)
            ->select('stylists.*','shops.shop_name')
            ->get();
    
        return response()->json($stylists);
    }
    
    public function getShopsByUserId($userId)
{
    // Lấy dữ liệu từ database sử dụng Eloquent hoặc Query Builder
    $shops = Shop::where('user_id', $userId)->get();

    // Trả về dữ liệu dưới dạng JSON
    return response()->json($shops);
}
    
    // register to become to barbershop
    public function addShop(Request $request)
    {
        try {
            // Lấy dữ liệu từ request
            $shopName = $request->input('shop_name');
            $shopImage = $request->input('shop_image');
            $shopPhone = $request->input('shop_phone');
            $userid=$request-> input('user_id');
    
            // Tạo một đối tượng Shop mới
            $newShop = new shop();
            $newShop->shop_name = $shopName;
            $newShop->shop_image = $shopImage;
            $newShop->shop_phone = $shopPhone;
            $newShop->is_shop="0";
            $newShop->user_id=$userid;
            
    
            // Lưu đối tượng Shop vào cơ sở dữ liệu
            $newShop->save();
    
            // Trả về phản hồi thành công
            return response()->json(['message' => 'Thêm shop thành công'], 200);
        } catch (\Exception $e) {
            dd($e);
            // Xử lý lỗi nếu có
            return response()->json(['error' => 'Đã xảy ra lỗi'], 500);
        }
    }
    public function addAddress(Request $request)
    {
        try {
            $shop = Shop::latest()->first();
            $shopId = $shop->shop_id;
            // Lấy dữ liệu từ request
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $address=$request->input('address');

            // Tạo một đối tượng Address mới
            $newAddress = new address();
            $newAddress->latitude = $latitude;
            $newAddress->longitude = $longitude;
            $newAddress->address=$address;
            $newAddress->shop_id=$shopId;

            // Lưu đối tượng Address vào cơ sở dữ liệu
            $newAddress->save();

            // Trả về phản hồi thành công
            return response()->json(['message' => 'Đã thêm địa chỉ thành công'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return response()->json(['error' => 'Đã xảy ra lỗi'], 500);
        }
    }
    


    // Ratings
    public function getRatings()
    {
        $ratings = rating::join('shops', 'ratings.shop_id', '=', 'shops.shop_id')
            ->join('users', 'ratings.user_id', '=', 'users.user_id')
            ->where('shops.is_shop', 1)
            ->select('ratings.*', 'shops.shop_name', 'shops.shop_image', 'users.user_name', 'users.user_email', 'shops.shop_phone', 'users.user_address')
            ->get();


        return response()->json($ratings);
    }
    public function deleteRatings($rating_id)
    {

        $ratings = rating::where('rating_id', $rating_id)->first();

        if (!$ratings) {
            return response()->json(['status' => 'error', 'msg' => 'Product not found'], 404);
        }

        $ratings->delete();

        return response()->json(['status' => 'ok', 'msg' => 'Delete successful']);
    }


    //Payment
    public function getPaymentsByUserId($user_id)
    {
        $payments = payment::where('user_id', $user_id)->first();

        return response()->json($payments);
    }
    
    public function getPayments()
    {
        $payments = Payment::join('shops', 'payments.shop_id', '=', 'shops.shop_id')
            ->join('users', 'payments.user_id', '=', 'users.user_id')
            ->join('histories', 'payments.payment_id', '=', 'histories.payment_id')
            ->join('stylists', 'histories.stylist_id', '=', 'stylists.stylist_id')
            ->join('services','histories.service_id','=','services.service_id')
            ->select('payments.*', 'shops.shop_name','services.service_name','stylists.stylist_name','shops.shop_image', 'users.user_name', 'histories.*', 'stylists.stylist_name')
            ->get();
    
        return response()->json($payments);
    }
        public function getPayment()
        {
            $payments = payment::join('shops', 'payments.shop_id', '=', 'shops.shop_id')
                ->join('users', 'payments.user_id', '=', 'users.user_id')
                ->select('shops.shop_id', DB::raw('MAX(shops.shop_name) as shop_name'), DB::raw('MAX(shops.shop_image) as shop_image'), DB::raw('SUM(payments.payment_amount) as total_amount'))
                ->groupBy('shops.shop_id')
                ->get();

            return response()->json($payments);
        }
    //Barber Shop

    public function destroy($id)
    {
        $shop = shop::findOrFail($id);
        $shop->delete();
        return response()->json('Shop deleted successfully');
    }

    // duyệt BarBer Shop
    public function getBaberShop()
    {

        $shop = shop::join('users', 'shops.user_id', '=', 'users.user_id')
            ->where('is_shop', 0)
            ->select('shops.*', 'shops.shop_name', 'shops.shop_image', 'shops.shop_name', 'users.user_address')
            ->get();
        return response()->json($shop);
    }
    public function BecomeShop($shop_id)
    {
        // Lấy thông tin của shop dựa trên shop_id
        $shop = shop::find($shop_id);

        // Kiểm tra xem shop có tồn tại hay không
        if (!$shop) {
            return response()->json(['message' => 'Shop không tồn tại'], 404);
        }

        // Cập nhật trường is_shop của shop thành 1
        $shop->is_shop = 1;
        $shop->save();

        return response()->json(['message' => 'Cập nhật is_shop thành công'], 200);
    }
    //Users
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_name' => 'required',
            'user_phone' => 'required',
            'user_email' => 'required',
            'user_address' => 'required',
            'user_password' => 'required',
        ]);

        $users = User::findOrFail($id);
        $users->update($validatedData);
        return response()->json($users);
    }
    public function getIsUser()
    {
        $users = User::where('is_user', 1)->get();
        return response()->json($users);
    }



    // Mo mo
  
    public function payment_VnPay(Request $request)
    {
        $totalPrice = $request->input('totalPrice');
        $paymentDate = Carbon::now(); // Lấy ngày thanh toán hiện tại
    
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:3000/Thank";
        $vnp_TmnCode = "HMEJ9HK0"; // Mã website tại VNPAY
        $vnp_HashSecret = "CLTOHNQVRSFMUVOWUFVAQLEATTNJRSJP"; // Chuỗi bí mật
    
        $vnp_TxnRef = rand(00,9990); // Mã đơn hàng
    
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => ($totalPrice * 400) * 100,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Da Thanh Toan",
            "vnp_OrderType" => "100000",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "payment_date" => $paymentDate,
            "created_at" => Carbon::now(),
        ];
    
        $vnp_BankCode = "NCB";
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
    
        ksort($inputData);
        $query = http_build_query($inputData);
    
        $vnpSecureHash = hash_hmac('sha512', $query, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;
    
        $returnData = [
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url,
        ];
    
        // Thêm dữ liệu vào controller
    
    
        return response()->json($returnData);
    }
    public function thanks(Request $request)
    {
      
        $vnp_Amount = $request->input('vnp_Amount');

        $vnp_PayDate = $request->input('vnp_PayDate');

       
        // Trích xuất các thông tin cần thiết từ yêu cầu
    
        // Tạo một instance của mô hình Payment
        $payment = new Payment;
    
        // Gán dữ liệu vào thuộc tính của mô hình Payment
        $payment->payment_amount = $vnp_Amount;
        $payment->payment_date = $vnp_PayDate;

       
        // Gán các thuộc tính khác tương ứng
    
        // Lưu bản ghi bằng phương thức save()
        $payment->save();
    
        return response()->json(['message' => 'Payment data saved successfully']);
    }

    }

