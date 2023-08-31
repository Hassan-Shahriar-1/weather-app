<?php

namespace App\Services;

use App\Models\WeatherReport;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class WeatherService
{
    private const CITIES = [
        'Abu Dhabi',
        'Dubai',
        'Sharjah',
        'London',
        'New York',
        'Tokyo'
    ];

    /**
     * creating log of weather
     * @return void
     */
    public static function createLogOfWeather(): void
    {
        $cordinates = self::CITIES;

        foreach ($cordinates as $city) {
            $weatherInfo = self::weatherApiCall($city);
            self::storingWeatherInformation($weatherInfo);
        }
    }

    /**
     * api call http 
     * @param string $cityName
     * @return array
     */
    private static function weatherApiCall(string $cityName): array
    {

        $client = new Client();
        $request = new Request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=' . $cityName . '&units=metric&appid=' . config('weather.api_key'));
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
        $weatherData['icon'] = $weatherInfo['weather'][0]['icon'];

        return WeatherReport::create($weatherData);
    }
}
