<?php

namespace App\Helpers;

class CityHelper
{
    public static function getCities()
    {
        $jsonFile = file_get_contents(resource_path('json/cities.json'));
        $cities = json_decode($jsonFile, true);
        return $cities;
        
    }//end of get getCities
}
