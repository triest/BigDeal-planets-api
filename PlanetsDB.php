<?php

class PlanetsDB
{
    private $host = "localhost";
    private $password = "";
    private $login = "root";
    private $databese = "planets_db";

    /**
     * PlanetsDB constructor.
     *
     * @param string $host
     * @param string $password
     * @param string $login
     * @param string $databese
     */
    /*  public function __construct(string $host, string $password, string $login, string $databese)
      {
          $this->host = $host;
          $this->password = $password;
          $this->login = $login;
          $this->databese = $databese;
      }
  */


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
            if ($row > 0) {

            } else {
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
            print "Error!: ".$e->getMessage()."<br/>";
            echo "Eror";
        }

    }

    public function prepareDataToInsert($array)
    {
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
