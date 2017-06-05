<?php
    include'db.php';
    error_reporting(E_ALL);
    ini_set('display_errors',1);
   

	$query = mysqli_query($con, "select vehiclenames.name, vehiclenames.logo, vehicles.capacity, vehicles.id, vehicles.organization_id from vehicles  
	    left join vehiclenames on vehicles.vehiclename_id=vehiclenames.id 
	    where vehiclenames.type='Taxi'");
	
	if($query){
		while ($row = mysqli_fetch_array($query)) {
			$flag[]=$row;
		}
		print(json_encode($flag));
	}
	mysqli_close($con);
?>