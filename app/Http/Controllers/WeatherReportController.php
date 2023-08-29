<?php

namespace App\Http\Controllers;

use App\Models\WeatherReport;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherReportController extends Controller
{
    public function dashboardData()
    {
        return WeatherService::createLogOfWeather();
    }
}
