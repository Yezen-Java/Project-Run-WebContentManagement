<?php

include 's3_config.php';
include 'Connect.php';

$getMedia = $_POST['stringBuldier']; 
//$getArrayMedia = json_decode(str_replace('\\', '', $_POST['ArrayMedia']));
$stringBuilder=explode(",", $_POST['stringBuldier']);

echo $getMedia;

$query = "DELETE From media where mediaid = $1";
$result = pg_prepare($dbconn,"query1", $query);

$i = count($stringBuilder);

for ($i=0; $i < $i; $i++) { 

$mediaObject = pg_query("SELECT * From media where mediaid = $1");

if ($mediaObject) {
	
$rows = pg_fetch_array($mediaObject);

echo $rows['media_name'];

if ($s3->deleteObject($bucket,$rows['media_name'])) {
$result = pg_execute($dbconn,"query1",  array($stringBuilder[$i]));

        echo 'deleted';

}
}

sleep(2);
}



?>