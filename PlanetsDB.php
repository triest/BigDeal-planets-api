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
            //  $stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
            $stmt = $dbh->prepare('INSERT INTO planets( name) 
                                                              VALUES (:name)');
            /*    if ($array["name"] != null) {

                    $stmt->bindParam(':name', $array["name"]);
                } else {

                }
                if ($array["rotation_period"] != null) {
                    $stmt->bindParam(':rotation_period', $array["rotation_period"]);
                } else {

                }
                if ($array["orbital_period"] != null) {
                    $stmt->bindParam(':orbital_period', $array["orbital_period"]);
                } else {

                }
                if ($array["diameter"] != null) {
                    $stmt->bindParam(':diameter', $array["diameter"]);
                } else {

                }
                if ($array["climate"] != null) {
                    $stmt->bindParam(':climate', $array["climate"]);
                } else {

                }
                if ($array["gravity"] != null) {
                    $stmt->bindParam(':gravity', $array["gravity"]);
                } else {

                }
                if ($array["terrain"] != null) {
                    $stmt->bindParam(':terrain', $array["terrain"]);
                } else {

                }
                if ($array["surface_water"] != null) {
                    $stmt->bindParam(':surface_water', $array["surface_water"]);
                } else {

                }
                if ($array["population"] != null) {
                    $stmt->bindParam(':population', $array["population"]);
                } else {

                }
                if ($array["created"] != null) {
                    $stmt->bindParam(':created', $array["created"]);
                } else {

                }
                if ($array["edited"] != null) {
                    $stmt->bindParam(':edited', $array["edited"]);
                } else {

                }
                if ($array["url"] != null) {
                    $stmt->bindParam(':url', $array["url"]);
                } else {

                }*/
            $stmt->execute([
              //  $array["name"] != null
                'name'=>$array["name"]
            ]);
          //  echo "SUb";

        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage()."<br/>";
            echo "Eror";
            //  .//    die();
        }

    }

    public function prepareDataToInsert($array)
    {
         print_r($array);
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
