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

    private $host; //= "localhost";
    private $password ;//= "";
    private $login;// = "root";
    private $databese; //= "planets_db";

    public $resivedStrings = array();

    public function GetRequwest()
    {
        $this->resivedStrings = array();
        try {
            array_push($this->resivedStrings, file_get_contents($this->usr));
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function printRez()
    {  echo "\n";

        $planetDn = new PlanetsDB($this->host, $this->databese, $this->login, $this->password);
        while ($this->usr != null) {
            $this->GetRequwest();
            foreach ($this->resivedStrings as $string) {
                $json = json_decode($string, true);
                $planetArray = $json["results"];   //плдучаем массив с планетами
                $this->usr = $json["next"];
                foreach ($planetArray as $item) {
                 //   print_r($item);
                    $planetDn->prepareDataToInsert($item);
                }
            }
        }
    }

    public function readConnectProperty()
    {
        if ($file = fopen("connect.txt", "r")) {
            while ($line = fgets($file)) {
              //  echo $line;
                $arr=explode("=",$line);
              //  print_r($arr);
                if($arr[0]=="host"){
                    $arr[1]=str_replace('/\s+/','',$arr[1]);
                    $this->host=$arr[1];
                }
                if($arr[0]=="login"){
                    $arr[1]=preg_replace('/\s+/','',$arr[1]);
                    $this->login= $arr[1];
                }
                if($arr[0]=="password"){
                    $temp=str_replace('/\s+/','',$arr[1]);
                    $this->password=$temp;
                }
                if($arr[0]=="database"){
                    $temp=str_replace('/\s+/','',$arr[1]);
                    $this->databese=$temp;
                }
            }
        }
        fclose($file);

    }

}