<?php

class PlanetsDB
{

    public $host;
    public $password = "";
    public $login;
    public $database;
    public $created; //если таблица существует- true
    public $table;

    /**
     * PlanetsDB constructor.
     *
     * @param string $host
     * @param string $password
     * @param string $login
     * @param string $database
     */
    public function __construct($host, $database, $login, $password)
    {
        $this->host = trim($host);  //delete spaces for login,pass,host,database
        $this->password = trim($password);
        $this->login = trim($login);
        $this->database = trim($database);
        $this->created = false;
    }


    public function insertMultiRowsToDatabase($dataVals)
    {
        if($this->createTable()==false){
            exit("Error creating table.");
        }
        $mysqli = new mysqli($this->host, $this->login, $this->password, $this->database);
        if ($mysqli->connect_error) {
            die("Connection failed: ".$mysqli->connect_error);
        }
        $sql = "INSERT INTO `planets` (name, rotation_period, orbital_period, diameter, climate, gravity, terrain, surface_water, population,created,edited, url) VALUES";
        $temp = "";
        $findPlanet = $mysqli->prepare('SELECT COUNT(*) from planets where name=?');
        foreach ($dataVals as $item) {
            //смотрим, есть ли эта планета в таблице.
            $findPlanet->bind_param('s', $item["name"]);
            $findPlanet->execute();
            $data = $findPlanet->get_result();
            $row = mysqli_fetch_array($data);
            if ($row["COUNT(*)"] > 0) {
                continue;
            }
            $string = "(\"".$item["name"]."\",\"".$item["rotation_period"]."\",\"".$item["orbital_period"]."\",\"".$item["diameter"]."\",\""
                .$item["climate"]."\",\"".$item["gravity"]."\",\"".$item["terrain"]."\",\"".$item["surface_water"]."\",\"".$item["population"]."\",\""
                .$item["created"]."\",\"".$item["edited"]."\",\"".$item["url"]."\"),";
            $temp .= $string;
        }
        $sql = $sql.$temp;
        if (empty($temp)) {
            echo "no new data to insert";
            exit();
        }
        $sql = substr($sql, 0, -1);
        if ($mysqli->query($sql) === true) {
            echo "New record created successfully";
            exit();
        } else {
            echo "Error: ".$sql."<br>".$mysqli->error;
            exit();
        }
    }

    //вывод в файл для отладки
    public function fileOut($string)
    {
        echo file_put_contents("qwery.txt", $string);
    }

    //проверка, создана ли таблица. Если нет, создаёт
    public function createTable()
    {
        try {
            $dbh = new PDO("mysql:host=$this->host;dbname=$this->database", $this->login, $this->password);
            //check planet alredy in database
            $stmt = $dbh->prepare('CREATE TABLE IF NOT EXISTS `planets` (
                          `id` INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          `name` varchar(100) DEFAULT NULL,
                          `rotation_period` varchar (11) DEFAULT NULL,
                          `orbital_period` varchar (11) DEFAULT NULL,
                          `diameter` bigint(20) DEFAULT NULL,
                          `climate` varchar(50) DEFAULT NULL,
                          `gravity` varchar(50) DEFAULT NULL,
                          `terrain` varchar(50) DEFAULT NULL,
                          `surface_water` tinyint(4) DEFAULT NULL,
                          `population` bigint(20) DEFAULT NULL,
                          `created` datetime DEFAULT NULL,
                          `edited` datetime DEFAULT NULL,
                          `url` varchar(255) DEFAULT NULL,
                          `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ');
            $stmt->execute([]);
            $this->created = true;
            return true;
        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage();
            return false;
        };
    }

}
