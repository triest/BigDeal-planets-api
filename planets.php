<?php
require_once "planetsApi.php";

$planets = new PlanetsApi();
//$planets->readConnectProperty(); //считывае данных для соединения с БД
$planets->printRez();