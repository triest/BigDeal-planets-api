<?php

class PlanetsApi
{
    private $host = "";
    private $password = "";
    private $login = "";
    private $databese = "";


    public function insertDataTodataBese()
    {
        try {
            $dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->databese, $this->login, $this->password);
            //  $stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
            $stmt = $dbh->prepare("INSERT INTO `planets`( `name`, `rotation_period`, `orbital_period`, 
                                                                  `diameter`, `climate`, `gravity`,
                                                                   `terrain`, `surface_water`, `population`,
                                                                    `created`, `edited`, `url`
            ) 
                                                              VALUES (:name,:rotation_period,:orbital_period,
                                                              :diameter,:climate,:terrain,
                                                              :surface_water,:population,:created,
                                                              :edited,:url");

            $stmt->execute();

        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage()."<br/>";
            //  .//    die();
        }

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
