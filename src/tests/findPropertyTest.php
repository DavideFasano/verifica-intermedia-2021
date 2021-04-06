<?php
$users = include(__DIR__."/mockdata_array.php");
require "./src/class/user.php";
require "./lib/UsersSearchFunctions.php";
// Test ricerca omonimi
// expectedResult è il risultato della funzione  count applicato al risultato della ricerca 
$testResultsDataset = array(
	array(
		"firstName" => "Achille",
		"lastName" => "BIANCHI",
		"expectedResult" => 2,
	),
	array(
		"firstName" => "Adamo",
		"lastName" => "ROSSI",
		"expectedResult" => 2,
	),
	array(
		"firstName" => "Adriano",
		"lastName" => "ROMANO",
		"expectedResult" => 2,
	),
	array(
		"firstName" => "Luigi",
		"lastName" => "RUSSO",
		"expectedResult" => 2,
	),
	array(
		"firstName" => "Mario",
		"lastName" => "FERRARI",
		"expectedResult" => 2,
	),
);

foreach ($testResultsDataset as $row) {
        extract($row);
		/**
		 * scrivi qui il tuo test
		 */
		$actual = array_filter($users, searchUserName($row));
		$actual2 = array_filter($actual, searchUserLastname($row));

		//var_dump($actual2);
		//echo "\n";
		$tmp = count($actual2);
		if($expectedResult === $tmp) {
			echo "Corretto\n";
		}
        
}