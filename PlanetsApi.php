<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 18.03.2019
 * Time: 21:08
 */

class PlanetsApi
{

    private $usr = "https://swapi.co/api/planets/";

    private $resivedStrings = array();

    public function Test()
    {
        echo "Test";
    }

    public function GetRequwest()
    {
        $ch = curl_init();
        //   curl_setopt($ch, CURLOPT_URL, $this->usr);
        try {
            // $this->resivedString = file_get_contents($this->usr);
            array_push($this->resivedStrings, file_get_contents($this->usr));
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function printRez()
    {
        foreach ($this->resivedStrings as $string) {
            $json = json_decode($string,true);
          //  $planets = $json['planets"];
            $json=$json["results"];   //плдучаем массив с планетами
            print_r($json);
        }
    }

}