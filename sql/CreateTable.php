<?php

/*
$mysql_host = "localhost";
$mysql_database = "planets_test";
$mysql_user = "root";
$mysql_password = "";
# MySQL with PDO_MYSQL
$dbh= new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
$query = file_get_contents("planets_db.sql");
$stmt = $dbh->prepare($query);
$stmt->execute();
*/


try {
    $host = "localhost";
    $database = "planets_test";
    $user = "root";
    $password = "";
    try {
        $dbh = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        //check planet alredy in databese
        $stmt = $dbh->prepare('CREATE TABLE IF NOT EXISTS `planets` (
  `id` int(11) NOT NULL,
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
        $stmt->execute([

        ]);
        $row = $stmt->rowCount();
    } catch (PDOException $e) {
        print "Error!: ".$e->getMessage();
        exit();
    }

    print("Created  Table.\n");

} catch (PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}