<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\addresses;
use App\Models\rating;
use App\Models\shop;
use App\Services\RandomKeyGenerator;
use App\Models\history;
use Carbon\Carbon;
use App\Models\services;

class HoanController extends Controller
{
    public function generateKey()
    {
        $characters = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
        $length = 6;
        $otpCode = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = array_rand($characters);
            $otpCode .= $characters[$randomIndex];
        }

        echo $otpCode;
    }

    public function getShopServices()
    {
        $data = DB::table('shops')
            ->join('shops_services', 'shops.shop_id', '=', 'shops_services.shop_id')
            ->join('services', 'shops_services.service_id', '=', 'services.service_id')
            ->select('shops.shop_id', 'shops.shop_name', 'services.service_name', 'shops_services.service_price', 'shops_services.service_image', 'services.service_id')
            ->get();
        $newData = [];
        foreach ($data as $item) {
            $shopId = $item->shop_id;
            $shopName = $item->shop_name;

            // Nếu chưa có shop_id trong mảng newData, thêm mới một cửa hàng
            if (!isset($newData[$shopId])) {
                $newData[$shopId] = [
                    'shop_id' => $shopId,
                    'shop_name' => $shopName,
                    'services' => [],
                    'stylists' => [],
                ];
            }

            // Thêm dịch vụ vào mảng services của cửa hàng
            $newData[$shopId]['services'][] = [
                'service_name' => $item->service_name,
                'service_price' => $item->service_price,
                'service_image' => $item->service_image,
                'service_id' => $item->service_id,
            ];
        }

        $stylistData = DB::table('shops')
            ->join('stylists', 'shops.shop_id', '=', 'stylists.shop_id')
            ->select('shops.shop_id', 'stylists.stylist_id', 'stylists.stylist_name', 'stylists.stylist_image')
            ->get();

        foreach ($stylistData as $item) {
            $shopId = $item->shop_id;
            $stylistId = $item->stylist_id;
            $stylistName = $item->stylist_name;
            $stylistImage = $item->stylist_image;

            // Nếu chưa có shop_id trong mảng newData, thêm mới một cửa hàng
            if (!isset($newData[$shopId])) {
                $newData[$shopId] = [
                    'shop_id' => $shopId,
                    'shop_name' => $shopName,
                    'services' => [],
                    'stylists' => [],
                ];
            }

            // Thêm stylist vào mảng stylists của cửa hàng
            $newData[$shopId]['stylists'][] = [
                'stylist_id' => $stylistId,
                'stylist_name' => $stylistName,
                'stylist_image' => $stylistImage,
            ];
        }


        // // Chuyển đổi mảng kết quả thành dạng danh sách (List) nếu cần thiết
        // $newData = array_values($newData);


        return response()->json($newData);
    }

    public function booking(Request $request)
    {
        $shopId = $request->input('shop_id');
        $shopName = $request->input('shop_name');
        $serviceId = $request->input('service_id');
        $serviceName = $request->input('service_name');
        $price = $request->input('price');
        $time = $request->input('appointment_time');
        $date = $request->input('appointment_date');
        $stylist_id = $request->input('stylist_id');


        $history = new history();
        $history->shop_id = $shopId;
        $history->service_id = $serviceId;
        $history->stylist_id = $stylist_id;
        $history->appointment_date = Carbon::parse($date);
        $history->appointment_time = Carbon::parse($time);
        $history->save();
        return response()->json([
            'message' => 'Dữ liệu đã được thêm vào table "histories"'
        ], 200);
    }

    public function checkStylistAvailability(Request $request)
    {
        $appointmentDate = $request->input('appointment_date');
        $appointmentTime = $request->input('appointment_time');
        $stylistId = $request->input('stylist_id');

        $parsedDate = Carbon::parse($appointmentDate)->format('Y-m-d');
        $parsedTime = Carbon::parse($appointmentTime)->format('H:i:s');

        // Kiểm tra xem stylist có khả dụng trong khoảng thời gian được đặt không
        $isStylistAvailable = $this->isStylistAvailable($stylistId, $parsedDate, $parsedTime);

        return response()->json(['available' => $isStylistAvailable]);
    }

    private function isStylistAvailable($stylistId, $appointmentDate, $appointmentTime)
    {
        // Kiểm tra xem stylist có khả dụng trong khoảng thời gian được đặt không
        $existingAppointments = DB::table('histories')
            ->join('services', 'histories.service_id', '=', 'services.service_id')
            ->where('histories.stylist_id', $stylistId)
            ->where('histories.appointment_date', $appointmentDate)
            ->get();

        if ($existingAppointments->isNotEmpty()) {
            foreach ($existingAppointments as $appointment) {
                $startTime = Carbon::parse($appointment->appointment_time);
                $endTime = $startTime->copy()->addMinutes($appointment->time); // Sử dụng giá trị từ trường "time" của dịch vụ

                $selectedStartTime = Carbon::parse($appointmentTime);
                $selectedEndTime = $selectedStartTime->copy()->addMinutes($appointment->time); // Sử dụng giá trị từ trường "time" của dịch vụ

                if (
                    $selectedStartTime->between($startTime, $endTime)
                    || $selectedEndTime->between($startTime, $endTime)
                    || $startTime->between($selectedStartTime, $selectedEndTime)
                    || $endTime->between($selectedStartTime, $selectedEndTime)
                ) {
                    // Stylist đã có cuộc hẹn trong khoảng thời gian này
                    return false;
                }
            }
        }

        return true;
    }

    public function allShop(){
        $shops = shop::all();
        return response()->json($shops);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('search');

        $shops = DB::table('shops')
            ->join('addresses', 'shops.shop_id', '=', 'addresses.shop_id')
            ->leftJoin('ratings', 'shops.shop_id', '=', 'ratings.shop_id')
            ->select(
                'shops.shop_id',
                'shops.shop_name',
                'shops.shop_phone',
                'shops.shop_image',
                'addresses.address as shop_address',
                DB::raw('COUNT(ratings.user_id) as rating_count'),
                DB::raw('ROUND(AVG(ratings.rating_star), 1) as avg_rating_star')
            )
            ->where('shops.shop_name', 'LIKE', '%' . $searchTerm . '%')
            ->groupBy('shops.shop_id', 'shops.shop_name', 'shops.shop_phone', 'shops.shop_image', 'addresses.address')
            ->get();

        return response()->json($shops);
    }



    public function calculateDistance(Request $request)
    {
        $latitudeUser = $request->input('latitude');
        $longitudeUser = $request->input('longitude');
        $distanceData['result'] = DB::table('addresses')
            ->join('shops', 'addresses.shop_id', '=', 'shops.shop_id')
            ->select(
                'shops.shop_name',
                'addresses.address',
                'addresses.shop_id',
                'shops.shop_phone',
                'addresses.latitude',
                'addresses.longitude',
                DB::raw("ROUND(6371 * acos(cos(radians(" . $latitudeUser . "))
                * cos(radians(addresses.latitude))
                * cos(radians(addresses.longitude) - radians(" . $longitudeUser . "))
                + sin(radians(" . $latitudeUser . "))
                * sin(radians(addresses.latitude))), 2) AS distance")
            )
            ->orderBy('distance', 'asc')
            ->get();


        return response()->json($distanceData);
    }

    public function caculateRatingStar()
    {
        $ratings = rating::selectRaw('shops.shop_id,shops.shop_name, shops.shop_phone, addresses.address, ROUND(AVG(ratings.rating_star), 1) as avg_rating, COUNT(ratings.user_id) as rating_count')
            ->join('shops', 'shops.shop_id', '=', 'ratings.shop_id')
            ->join('addresses', 'addresses.shop_id', '=', 'shops.shop_id')
            ->groupBy('shops.shop_id', 'shops.shop_name', 'shops.shop_phone', 'addresses.address')
            ->orderBy('avg_rating', 'desc')
            ->get();

        return response()->json($ratings);
    }
}
