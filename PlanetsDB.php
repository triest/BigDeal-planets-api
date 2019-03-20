<?php

class PlanetsDB
{

    public $host;
    public $password = "";
    public $login;
    public $database;
    public $created;

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


    public function insertDataToDatabase($array)
    {
        if ($this->created == false) {
            $this->createTable(); //проерка, создана ли таблица
        }
        try {
            $dbh = new PDO("mysql:host=$this->host;dbname=$this->database", $this->login, $this->password);
            //check planet alredy in databese
            $stmt = $dbh->prepare('SELECT name from planets where name=:name');
            $stmt->execute([
                'name' => $array["name"],
            ]);
            $row = $stmt->rowCount();
            if ($row == 0) {
                $stmt = $dbh->prepare('INSERT INTO planets( name,rotation_period,orbital_period,
                                                                  diameter,climate,gravity,
                                                                  terrain,surface_water,population,
                                                                 created,edited,url   ) 
                                                              VALUES (:name,:rotation_period,:orbital_period,
                                                              :diameter,:climate,:gravity,
                                                              :terrain,:surface_water,:population,
                                                                 :created,:edited,:url  )');

                $stmt->execute([
                    'name' => $array["name"],
                    'rotation_period' => $array["rotation_period"],
                    'orbital_period' => $array["orbital_period"],
                    'diameter' => $array["diameter"],
                    'climate' => $array["climate"],
                    'gravity' => $array["gravity"],
                    'terrain' => $array["terrain"],
                    'surface_water' => $array["surface_water"],
                    'population' => $array["population"],
                    'created' => $array["created"],
                    'edited' => $array["edited"],
                    'url' => $array["url"],
                ]);
            }
        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage();
        }
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

        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage();
            return false;
        };
    }

}
