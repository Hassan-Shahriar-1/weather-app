<?php

namespace App\Models;

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
        'wind_speed',
        'weather_status',
        'country',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
