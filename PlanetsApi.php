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
    public function GetRequwest()
    {
        $this->resivedStrings = array();
        try {
            array_push($this->resivedStrings, file_get_contents($this->usr));
        } catch (Exception $e) {
            print "API error!: ".$e->getMessage();
            exit();
        }
    }


    public function printRez()
    {
        $planetDn = new PlanetsDB($this->host, $this->databese, $this->login, $this->password); //класс, работающий с базой данных
        while ($this->usr != null) {
            $this->GetRequwest();
            foreach ($this->resivedStrings as $string) { //данные по планетам
                $json = json_decode($string, true);  //
                $planetArray = $json["results"];   //плдучаем массив с планетами
                $this->usr = $json["next"];  //данные рзбиты по страницам. Адрес следуюзей стрницы в переменной next. Если $net==null ->данные кончились
                foreach ($planetArray as $item) {   //проход по массиву м планетами
                    $planetDn->prepareDataToInsert($item);
                }
            }
        }
    }

    //считываеие данных жля подключения из файла connect.txt
    public function readConnectProperty()
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