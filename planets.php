<?php
require_once "planetsApi.php";

echo "planets";
$planets = new PlanetsApi();
$planets->printRez();