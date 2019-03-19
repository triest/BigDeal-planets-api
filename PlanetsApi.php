<?php
/**
 * Created by PhpStorm.
 * User: triest
 * Date: 18.03.2019
 * Time: 21:08
 */
require_once "PlanetsDB.php";


class PlanetsApi
{

    public $usr = "https://swapi.co/api/planets/";

    public $resivedStrings = array();

    public function GetRequwest()
    {
     $this->resivedStrings = array();
        try {
            // $this->resivedString = file_get_contents($this->usr);
            array_push($this->resivedStrings, file_get_contents($this->usr));
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function printRez()
    {
        $planetDn = new PlanetsDB();
        while ($this->usr != null) {
            $this->GetRequwest();
            foreach ($this->resivedStrings as $string) {
                $json = json_decode($string, true);
                $planetArray = $json["results"];   //плдучаем массив с планетами
                $this->usr = $json["next"];
                foreach ($planetArray as $item) {
                    $planetDn->prepareDataToInsert($item);
                }
            }
        }
    }

}