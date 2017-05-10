<?php
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="dubai, AE") and u="c"';
    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json&u=c";

    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
    // Convert JSON to PHP object
    $phpObj =  json_decode($json);
    $condition = $phpObj->query->results->channel->item->condition->text;
    $temp = $phpObj->query->results->channel->item->condition->temp;

    //print_r($phpObj->query->results->channel->item);

    // echo $temp." ".$condition;
    $ava_conditions = array(
        'cloudy'=> 'icon-icon-cloudy',
        'sunny' => 'icon-icon-day-sunnyrain',
        'fair (day)' => 'icon-icon-day',
        'thunderstorms' => 'icon-icon-day-thunderrain',
        'fair (night)' => 'icon-icon-night',
        'showers' => 'icon-icon-day-rainy');

    $condition = isset($ava_conditions[$condition])? $ava_conditions[$condition] : "icon-icon-day";

?>