<?php

class PlanetsDB
{

    private $host;
    private $password ;
    private $login ;
    private $databese;

    /**
     * PlanetsDB constructor.
     *
     * @param string $host
     * @param string $password
     * @param string $login
     * @param string $databese
     */
    public function __construct(string $host, string $password, string $login, string $databese)
    {
        $this->host = $host;
        $this->password = $password;
        $this->login = $login;
        $this->databese = $databese;
    }


    public function insertDataTodataBese($array)
    {
        try {
            $dbh = new PDO("mysql:host=$this->host;dbname=$this->databese", $this->login, $this->password);
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
            exit();
        }

    }


    public function createTable()
    {
        try {
            $dbh = new PDO("mysql:host=$this->host;dbname=$this->databese", $this->login, $this->password);
            //check planet alredy in databese
            $stmt = $dbh->prepare('CREATE TABLE IF NOT EXISTS `planets` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `rotation_period` int(11) DEFAULT NULL,
  `orbital_period` int(11) DEFAULT NULL,
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

            return true;

        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage();

            return false;
        };
    }


    public function prepareDataToInsert($array)
    {
        $this->createTable();
        $this->insertDataTodataBese($array);
    }


    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getDatabese(): string
    {
        return $this->databese;
    }

    /**
     * @param string $databese
     */
    public function setDatabese(string $databese): void
    {
        $this->databese = $databese;
    }

}
