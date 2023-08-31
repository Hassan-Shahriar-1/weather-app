<?php

namespace App\Models;

use App\Services\WeatherService;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherReport extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'weather_reports';

    protected $fillable = [
        'city',
        'lon',
        'lat',
        'temparature',
        'feels_like',
        'humidity',
        'icon',
        'wind_speed',
        'weather_status',
        'country',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * scope for last 24 hours data get
     * 
     */
    public function scopeLast24Hours($query)
    {
        $start = now()->subHours(24); // Current time - 24 hours
        $end = now(); // Current time

        return $query->whereBetween('created_at', [$start, $end]);
    }

    /**
     * getting data
     * @return array
     */
    public static function getReport(string $city): array
    {

        $data = self::select('temparature', 'wind_speed', 'humidity')
            ->where('city', $city)
            ->last24Hours()
            ->get();
        $report = [];
        $report['latest'] = self::latestData();
        $report['cities'] = WeatherService::CITIES;
        $report['dataset']['temparature'] = $data->pluck('temparature');
        $report['dataset']['wind'] = $data->pluck('wind_speed');
        $report['dataset']['humidity'] = $data->pluck('humidity');

        return $report;
    }

    /**
     * getting latest data of weather
     * @return object
     */
    protected static function latestData(): object
    {
        return self::select('country', 'city', 'temparature', 'icon')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
}
