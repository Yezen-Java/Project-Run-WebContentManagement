<?php 

include 'Connect.php';

$getLocationId = $_POST['LocationId'];


$getLocationMedia = pg_query("SELECT * From location_res, media where location_res.locationid = $getLocationId and location_res.mediaid = media.mediaid;");


//$rowsNumber = pg_num_rows($getLocationMedia);



	if($getLocationMedia){

	    while ($rows = pg_fetch_array($getLocationMedia)) {
		       //$mediaId = $rows['mediaid'];
               $media_name = $rows['media_name'];


        echo "<div id='container'><button class='glyphicon glyphicon-trash' id='trashBoxMedia'></button> <li> $media_name</li> </div>";


	}
}else{
	echo "No Media";
}





?>