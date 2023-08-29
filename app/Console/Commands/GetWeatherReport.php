<?php

namespace App\Console\Commands;

use App\Services\WeatherService;
use Illuminate\Console\Command;

class GetWeatherReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Weather report every 10 minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        WeatherService::createLogOfWeather();
        return Command::SUCCESS;
    }
}
