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

    public $usr = "https://swapi.co/api/planets/"; //url запроса
    private $host;
    private $password;
    private $login;
    private $databese;
    public $resivedStrings = array();

    /**
     * PlanetsApi constructor.
     */
    public function __construct()
    {
        $this->readConnectProperty();
    } //переменныя для считывание ответа от API


    //запрос к API
    private function MakeRequwest()
    {
        $this->resivedStrings = array();
        try {
            array_push($this->resivedStrings, file_get_contents($this->usr));
        } catch (Exception $e) {
            print "API error!: ".$e->getMessage();
            exit();
        }
    }

    //считываеие данных из запроса
    public function printRez()
    {
        $planetDn = new PlanetsDB($this->host, $this->databese, $this->login,
            $this->password); //класс, работающий с базой данных
        $arr = [];
        while ($this->usr != null) {
            $this->MakeRequwest();
            foreach ($this->resivedStrings as $string) { //данные по планетам
                $json = json_decode($string, true);  //
                $planetArray = $json["results"];   //плдучаем массив с планетами
                $this->usr = $json["next"];  //данные рзбиты по страницам. Адрес следуюзей стрницы в переменной next. Если $net==null ->данные кончились
                foreach ($planetArray as $planet) {
                    array_push($arr, $planet);
                }
            }
        }
      //  print_r($arr);
     //   $planetDn->insertMultiRowsToDatabase($arr);
        $planetDn->insertMultiRowsMySQLi($arr);
    }

    //считываеие данных для подключения из файла connect.txt
    private function readConnectProperty()
    {
        try {
            if ($file = fopen("connect.txt", "r")) {
                while ($line = fgets($file)) {
                    $arr = explode("=", $line);
                    if ($arr[0] == "host") {
                        $arr[1] = str_replace('/\s+/', '', $arr[1]);
                        $this->host = trim($arr[1]);
                    }
                    if ($arr[0] == "login") {
                        $arr[1] = preg_replace('/\s+/', '', $arr[1]);
                        $this->login = trim($arr[1]);
                    }
                    if ($arr[0] == "password") {
                        $arr[1] = str_replace('/\s+/', '', $arr[1]);
                        $this->password = trim($arr[1]);
                    }
                    if ($arr[0] == "database") {
                        $arr[1] = str_replace('/\s+/', '', $arr[1]);
                        $this->databese = $arr[1];
                    }
                }
                fclose($file);
            }
        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage();
            exit();
        }
    }
}