<?php 

include 'Connect.php';
$TouridCode = $_POST['value'];

$queryString = "SELECT * from tour_res, location where tourid ='$TouridCode' and tour_res.locationid = location.locationid";

$query = pg_query($queryString);

if (pg_num_rows($query ) == 0) {
	echo "No location returned";
}else{

	echo "<lu>";
while($row = pg_fetch_array($query)) {
	$locationname = $row['lname'];
	$locationId = $row['locationid'];

echo "<a href ='#' onClick='addLocationRes(this.value) 'id ='pointer1' value ='$locationId'>$locationname</a>";
}

echo "</lu>";
}

?>