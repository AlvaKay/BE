<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Models\history;

use App\Models\service;
use Illuminate\Support\Carbon;
use App\Models\shop;
use App\Models\stylist;
use App\Models\combo;
use App\Models\payment;
use Carbon\CarbonInterval;

class TrungController extends Controller
{
    public function register(Request $request)
    {

        // Lấy giá trị từ request
        $user_register_name = $request->input('user_name');
        $user_register_email = $request->input('user_email');
        // Tạo mã OTP
        $otpCode = mt_rand(100000, 999999);
        // Tạo một đối tượng user và gán các giá trị từ request vào các thuộc tính tương ứng
        $user = new user();
        $user->user_name = $request->input('user_name');
        $user->user_phone = $request->input('user_phone');
        $user->user_address = $request->input('user_address');
        $user->user_email = $request->input('user_email');
        $user->user_password = $otpCode;

        // Lưu đối tượng user vào cơ sở dữ liệu
        $user->save();

        // Gửi mã OTP qua email
        $this->sendOtpEmail($user_register_email, $otpCode, $user_register_name);

        return response()->json([
            'message' => 'Registration successful. Please check your email for the OTP.'
        ]);
    }


    private function sendOtpEmail($email, $otpCode, $name)
    {
        $messageContent = "Welcome " . $name . "♥\nYour Password: " . $otpCode;

        Mail::raw($messageContent, function ($message) use ($email) {
            $message->to($email)
                ->subject('OTP Verification');
        });
    }

    // Xác minh mã opt có đúng không
    public function verifyOtp(Request $request)
    {
        // $otpFromRequest = intval($request->input('input_password'));
        $input_password = $request->input('input_password');
        $input_email = $request->input('user_email');

        $user = User::where('user_email', $input_email)->first();

        $hashedPassword = $user->user_password; // Mật khẩu đã được mã hóa trong cơ sở dữ liệu

        if ($hashedPassword == $input_password) {
            // Cập nhật trường 'is_user' thành true
            $user->is_user = true;
            $user->save();
            // OTP đúng, cập nhật trạng thái thành công
            // Gửi thông báo xác minh OTP thành công và biến thành công là true về ReactJS qua API
            return response()->json([
                'success' => true,
            ]);
        } else {
            // OTP đúng, nhưng cập nhật trạng thái thất bại
            // Xử lý lỗi nếu cần
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function login(Request $request)
    {
        $input_email = $request->input('input_email');
        $input_password = $request->input('input_password');
        // Lấy người theo có cùng địa chỉ email
        $users = User::where('user_email', $input_email)->get();

        $authenticated = false;
        $authenticatedAdmin = false;


        // Kiểm tra mật khẩu cho từng người dùng
        foreach ($users as $user) {
            $id_user = $user->user_id;
            if ($input_password == $user->user_password && $user->is_user == true) {
                $authenticated = true;
                break;
            } elseif ($input_password == $user->user_password && $user->is_admin == true) {
                $authenticatedAdmin = true;
            }
        }
        if ($authenticated && !$authenticatedAdmin) {
            // Thông tin đăng nhập không chính xác
            return response()->json(
                [
                    'user' => true,
                    'id_user' => $id_user

                ]
            );
        }
        if (!$authenticated && !$authenticatedAdmin) {
            return response()->json(['user' => false]);
        }
        if (!$authenticated && $authenticatedAdmin) {
            // Thông tin đăng nhập không chính xác
            return response()->json(
                [
                    'admin' => true,
                    'id_user' => $id_user
                ]
            );
        }
    }


    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function forgotpassword(Request $request)
    {

        // Lấy giá trị từ request
        $input_user_email = $request->input('input_email');
        // Tạo mã OTP
        $otp_new_password = mt_rand(100000, 999999);

        // Lấy user_name ra từ db
        $user = User::where('user_email', $input_user_email)->first();

        if ($user) {
            $user->user_password = $otp_new_password; // Cập nhật mật khẩu mới
            $user->save(); // Lưu thay đổi vào cơ sở dữ liệu
        }

        $user_name_db = $user->user_name;

        // Gửi mã OTP qua email
        $this->sendOtpEmailPassword($input_user_email, $otp_new_password, $user_name_db);

        return response()->json([
            'message' => 'Registration successful. Please check your email for the OTP.'
        ]);
    }

    private function sendOtpEmailPassword($email, $otp, $name)
    {
        $messageContent = "Welcome " . $name . "♥\nYour new Password: " . $otp;

        Mail::raw($messageContent, function ($message) use ($email) {
            $message->to($email)
                ->subject('OTP Verification');
        });
    }

    // Xác minh mã opt có đúng không
    public function verifyNewPassword(Request $request)
    {
        // $otpFromRequest = intval($request->input('input_password'));
        $input_password = $request->input('input_password');
        $input_email = $request->input('input_email');

        $user = User::where('user_email', $input_email)->first();

        $hashedPassword = $user->user_password; // Mật khẩu đã được mã hóa trong cơ sở dữ liệu
        $id_user = $user->user_id;

        if ($hashedPassword == $input_password) {
            // OTP đúng, cập nhật trạng thái thành công
            // Gửi thông báo xác minh OTP thành công và biến thành công là true về ReactJS qua API
            return response()->json([
                'success' => true,
                'id_user' => $id_user

            ]);
        } else {
            // OTP đúng, nhưng cập nhật trạng thái thất bại
            // Xử lý lỗi nếu cần
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function booking(Request $request)
    {
        // // Tạo mã billing_code
        $billing_code = mt_rand(100000, 999999);
        // code user_id để tạo payment_id
        $user_id = $request->input('user_id');
        $payment_amount = $request->input('payment_amount');
        $payment_date =  Carbon::now();
        // thêm vào các trường trong table payment
        $payment = new payment();
        $payment->user_id = $user_id;
        $payment->payment_amount = $payment_amount;
        $payment->billing_code = $billing_code;
        $payment->payment_date = $payment_date;
        // lưu vào db
        // $payment->save();

        $set = true;
        // Lấy giá trị từ request
        $shop_id = $request->input('shop_id');

        $stylist_id = $request->input('stylist_id');
        $service_id = $request->input('services_id');
        $combo_id = $request->input('combo_id');
        $appointment_date = $request->input('appointment_date');
        $appointment_time = $request->input('appointment_time');
        $input_date = Carbon::createFromFormat('Y-m-d', $appointment_date);
        $input_start_time = Carbon::createFromFormat('H:i:s', $appointment_time);

        $service_idss = explode(',', $service_id); // Tách chuỗi thành mảng các service_id

        $service_ids = History::where('stylist_id', $stylist_id)
            ->distinct('service_id')
            ->pluck('service_id')
            ->toArray();

        $services = Service::whereIn('service_id', $service_ids)->get(); // Lấy danh sách dịch vụ

        if (count($services) === 1) {
            $time = $services[0]->time; // Lấy thời gian từ dịch vụ đơn lẻ
        } else {
            $totalTime = 0;

            foreach ($services as $service) {
                $totalTime += $service->time;
            }

            $time = $totalTime;
        }

        $duration = CarbonInterval::minutes($time);

        $input_end_time = $input_start_time->copy()->add($duration);

        $histories = History::where('stylist_id', $stylist_id)->get();

        foreach ($histories as $history) {
            $db_date = Carbon::createFromFormat('Y-m-d', $history->appointment_date);
            $db_start_time = Carbon::createFromFormat('H:i:s', $history->appointment_time);
            $db_duration = $duration;
            $db_end_time = $db_start_time->copy()->add($db_duration);

            if (
                !$input_date->isSameDay($db_date) ||
                $input_start_time->isAfter($db_end_time) ||
                $input_end_time->isBefore($db_start_time)
            ) {
                // Thời gian không trùng và không dính vào lịch sử trong cơ sở dữ liệu
                return response()->json([
                    'trung' => false,
                    'abc' => $db_duration,
                ]);
            }
        }

        // Thời gian trùng hoặc dính vào lịch sử trong cơ sở dữ liệu
        return response()->json([
            'trung' => true,
            'abc' => $db_end_time,
        ]);
    }


    public function getInforhistory($userID)
    {
        $userData = Payment::select('billing_code', 'payment_amount', 'payment_date', 'status')
            ->where('user_id', $userID)
            ->first();

        if ($userData) {
            $billing_Code = $userData->billing_code;

            $historyData = History::select('histories.shop_id', 'histories.stylist_id', 'histories.service_id', 'histories.combo_id', 'histories.payment_id')
                ->join('payments', 'payments.billing_code', '=', 'histories.billing_code')
                ->where('histories.billing_code', $billing_Code)
                ->get();


            if ($historyData->isNotEmpty()) {
                $serviceIds = []; // Mảng lưu trữ các service_id

                foreach ($historyData as $history) {
                    // Lấy thông tin từ các bảng tương ứng
                    $shopData = Shop::where('shop_id', $history->shop_id)
                        ->first()
                        ->toArray();

                    $stylistData = Stylist::where('stylist_id', $history->stylist_id)
                        ->first()
                        ->toArray();

                    $serviceData = Service::where('service_id', $history->service_id)
                        ->first()
                        ->toArray();

                    $comboData = Combo::where('combo_id', $history->combo_id)
                        ->first()
                        ->toArray();

                    // Lưu trữ service_id vào mảng
                    $serviceIds[] = $history->service_id;

                    // Lưu thông tin vào kết quả
                    $result[] = [
                        $serviceData,
                    ];
                }

                return response()->json([
                    'stylist_data' => $stylistData,
                    'shop_data' => $shopData,
                    'combo_data' => $comboData,
                    'history_data' => $result,
                    'payment' => $userData
                ]);
            }
        }
        return response()->json([
            'message' => 'User data not found.',
        ], 404);
    }

    // show user booking ở shop
    public function gethistory_user(Request $request)
    {

        $user_id = $request->input('user_id');
        $histories = History::with('user') // Tải thông tin người dùng
            ->where('user_id', $user_id) // Lọc lịch sử theo user_id
            ->get();
        return response()->json([
            $histories
        ]);
    }
}
