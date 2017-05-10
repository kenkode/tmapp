<?php
    include'db.php';
    $destination = $_POST['destination'];
    $origin = $_POST['origin'];
    $province = $_POST['province'];
    $vehicle = $_POST['vehicle'];

	$query = mysqli_query($con, "select payments.vip_fare,payments.normal_fare from schedules 
	 left join organizations on schedules.organization_id=organizations.id 
	 left join vehicle on schedules.vehicle_id=vehicle.id 
	 left join (select destinations.name as oname,destinations.id from schedules left join destinations on schedules.origin_id=destinations.id left join vehicle on schedules.vehicle_id=vehicle.id where destinations.name='".$origin."' and vehicle.name='".$vehicle."') as origin on schedules.origin_id=origin.id
	 left join (select destinations.name as dname,destinations.id from schedules left join destinations on schedules.destination_id=destinations.id left join vehicle on schedules.vehicle_id=vehicle.id where destinations.name='".$destination."' and vehicle.name='".$vehicle."') as des on schedules.destination_id=des.id
	 left join payments on schedules.id=payments.schedule_id 
	 where $province = 1 and origin.oname='".$origin."' and des.dname='".$destination."' and vehicle.name='".$vehicle."'");
	
	if($query){
		while ($row = mysqli_fetch_array($query)) {
			$flag[]=$row;
		}
		print(json_encode($flag));
	}
	mysqli_close($con);
?>