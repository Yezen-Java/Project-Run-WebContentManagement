<?php

include'database/LoadDataOnstart.php';

$arrayMeida = $_POST['items']; 

include 's3_config.php';
include 'database/Connect.php';


$loadData = new LoadOnStart();
$liarray = explode("::", $arrayMeida);

$numberOfMedia = count($liarray);

$query = "DELETE From media where mediaid = $1";
$query2 = "SELECT * From media where mediaid = $1";

$result = pg_prepare($dbconn,"query", $query);
$amazonQuery = pg_prepare($dbconn,"query2", $query2);


for ($i=0; $i < $numberOfMedia; $i++) { 
	$amazonQuery = pg_execute($dbconn,"query2",  array($liarray[$i]));
	$rows = pg_fetch_array($amazonQuery);
	$mediaExt = $rows['ext_name'];
	
	if ($s3->deleteObject($bucket,$mediaExt)) {
		$result = pg_execute($dbconn,"query",  array($liarray[$i]));


	}else{
		echo false;
	}
	sleep(1);
}

echo $loadData->mediaResultsFucntion();;


?>