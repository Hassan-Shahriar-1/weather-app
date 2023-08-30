<?php

namespace App\Http\Controllers;

use App\Models\WeatherReport;
use App\Services\WeatherService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherReportController extends Controller
{
    public function dashboardData()
    {
        return view('dashboard');
    }

    /**
     * get weather report data for chart
     * @return JsonResponse
     */
    public function getWeatherReportData(): JsonResponse
    {
        try {
            $data = WeatherReport::getReport();
            return response()->json([
                'status_code' => 500,
                'message' => null,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Something Went Wrong',
                'data' => []
            ]);
        }
    }
}
