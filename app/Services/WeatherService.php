<?php

namespace App\Services;

use App\Models\WeatherReport;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class WeatherService
{
    private const cordinates = [
        'Abu Dhabi' => ['log' => '54.366669', 'lat' => '24.466667'],
        'Dubai' => ['log' => '54.366669', 'lat' => '24.466667'],
        'Sharjah,' => ['log' => '55.405403', 'lat' => '25.348766'],
        'London' => ['log' => '-0.118092', 'lat' => '51.509865'],
        'New York' => ['log' => '-73.935242', 'lat' => '40.730610'],
        'Tokyo' => ['log' => '139.839478.', 'lat' => '35.652832'],
    ];

    /**
     * creating log of weather
     * @return void
     */
    public static function createLogOfWeather(): void
    {
        $cordinates = self::cordinates;

        foreach ($cordinates as $city => $cordinate) {
            $weatherInfo = self::weatherApiCall($cordinate['lat'], $cordinate['log']);
            self::storingWeatherInformation($weatherInfo);
        }
    }

    /**
     * api call http 
     * @param string $lat
     * @param string $lon
     * @return object
     */
    private static function weatherApiCall(string $lat, string $lon): object
    {
        $client = new Client();
        $request = new Request('GET', 'https://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=' . config('weather.api_key'));
        $res = $client->send($request);
        return $res->getBody();
    }


    /**
     * storing weather information
     * @param object $weatherData
     * @return object
     */
    private static function storingWeatherInformation(object $weatherInfo): object
    {
        $weatherData = [];
        //assigning values for storing weather info
        $weatherData['city'] = $weatherInfo['name'];
        $weatherData['lon'] = $weatherInfo['coord']['lon'];
        $weatherData['lat'] = $weatherInfo['coord']['lat'];
        $weatherData['temparature'] = $weatherInfo['main']['temp'];
        $weatherData['feels_like'] = $weatherInfo['main']['feels_like'];
        $weatherData['humidity'] = $weatherInfo['main']['humidity'];
        $weatherData['wind_speed'] = $weatherInfo['wind']['speed'];
        $weatherData['weather_status'] = $weatherInfo['weather']['main'];
        $weatherData['country'] = $weatherInfo['sys']['country'];

        return WeatherReport::create($weatherData);
    }
}
