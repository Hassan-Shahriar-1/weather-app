<?php

namespace App\Services;

use App\Models\WeatherReport;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class WeatherService
{
    private const cordinates = [
        'Abu Dhabi' => ['log' => '54.366669', 'lat' => '24.466667'],
        'Dubai' => ['log' => '55.27022981008994', 'lat' => '25.205049246698042'],
        'Sharjah,' => ['log' => '55.405403', 'lat' => '25.348766'],
        'London' => ['log' => '-0.118092', 'lat' => '51.509865'],
        'New York' => ['log' => '-74.01814437781896', 'lat' => '40.70986392881991'],
        'Tokyo' => ['log' => '139.79983261050972', 'lat' => '35.71956934565265']
    ];

    /**
     * creating log of weather
     * @return void
     */
    public static function createLogOfWeather(): void
    {
        $cordinates = self::cordinates;

        foreach ($cordinates as $city => $cordinate) {
            $weatherInfo = self::weatherApiCall($city);
            self::storingWeatherInformation($weatherInfo);
        }
    }

    /**
     * api call http 
     * @param string $lat
     * @param string $lon
     * @return array
     */
    private static function weatherApiCall(string $cityName): array
    {

        $client = new Client();
        $request = new Request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=' . $cityName . '&appid=' . config('weather.api_key'));
        $res = $client->send($request);

        return json_decode($res->getBody(), true);
    }


    /**
     * storing weather information
     * @param object $weatherData
     * @return object
     */
    private static function storingWeatherInformation(array $weatherInfo): object
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
        $weatherData['weather_status'] = $weatherInfo['weather'][0]['main'];
        $weatherData['country'] = $weatherInfo['sys']['country'];

        return WeatherReport::create($weatherData);
    }
}
