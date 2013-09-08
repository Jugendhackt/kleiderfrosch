<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$THICK_JACKET = 'thick_jacket';
$PULLOVER = 'pullover';
$T_SHIRT = 't_shirt';
$TANK_TOP = 'tank_top';

$JEANS = 'jeans';
$SHORTS = 'shorts';

if((!isset($_GET["lat"]) || !isset($_GET["lon"])) && !isset($_GET["city"]))
{
    
    $lat = 50.93 ;
    $lot = 11.58 ;
}
else if(isset($_GET["lat"]) && isset($_GET["lon"])){
    
$lat = $_GET["lat"];
$lon = $_GET["lon"] ;
}
else if(isset($_GET["city"]))
{
    
    $city = $_GET["city"];
    $nominatim_url = 'http://nominatim.openstreetmap.org/search?';
    $nominatim_url .= 'q=' . $city . '&' . 'format=json';
    
    $nominatim = file_get_contents($nominatim_url);
    $json_nominatim = json_decode($nominatim);
    
    $lat = round($json_nominatim[0]->lat,2);
    $lon = round($json_nominatim[0]->lon,2);
    
}   

$gender = isset($_GET["gender"]) ? $_GET["gender"] : 'm';

//178.254.12.77
//http://api.openweathermap.org/data/2.5/weather?lat=50.93&lon=11.58&units=metric
$url = 'http://api.openweathermap.org/data/2.5/weather?';
$url .= 'lat=' . $lat . '&';
$url .= 'lon=' . $lon . '&';
$url .= 'units=metric' . '&' . 'lang=de';
//$url = 'http://api.openweathermap.org/data/2.5/weather?lat=50.93&lon=11.58&units=metric';

$json = file_get_contents($url);
//echo $json;
$decoded_json = json_decode($json);

 


$top;
$trousers;

$icon = $decoded_json->weather[0]->icon;
$description = $decoded_json->weather[0]->description;

if(strpos($description, 'Regen'))
    $is_raining = true;
else
    $is_raining = false;

$location = $decoded_json->name;
$min_temperature = $decoded_json->main->temp_min;
$max_temperature = $decoded_json->main->temp_max;
$cloudiness = $decoded_json->clouds->all;


$temperature_difference = $max_temperature - $min_temperature;
$average_temperature = $min_temperature + ($temperature_difference/2);

$day_or_night = $icon{strlen($icon)-1};

if ($cloudiness < 20 && $day_or_night == 'd' )
{
    $average_temperature += 3;    
}

if ($temperature_difference >= 10) {
    
}


if($average_temperature < 7)
{
    $top = $THICK_JACKET;
    $trousers = $JEANS;
}
else if($average_temperature < 15)
{
    $top = $PULLOVER;
    $trousers = $JEANS;
}
else if($average_temperature < 20)
{
    $top = $T_SHIRT;
    $trousers = $JEANS;
}
else if($average_temperature < 27)
{
    $top = $T_SHIRT;
    $trousers = $SHORTS;
}
else if($average_temperature >= 27)
{
    $top = $TANK_TOP;
    $trousers = $SHORTS;
}

$array = Array('top' => $top, 'trousers' => $trousers, 'location' => $location, 'icon' => $icon, 'description' => $description, 'rain' => $is_raining);
//$array = Array('top' => $top, 'trousers' => $trousers, 'location' => $location, 'icon' => $icon,); 
echo json_encode($array);


?>
