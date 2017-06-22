<?php
    include'db.php';

    $destination = $_POST['destination'];
    $origin = $_POST['origin'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $type = $_POST['type'];

    /*$destination = "Mombasa";
    $origin = "Nairobi";
    $date = "2017-06-21";
    $time = "21:00";
    $type= "SGR";*/

    $flag = array();

    $newdate = strtotime($date.' '.$time);
    $datetime = date('Y-m-d H:i:s', $newdate);

	$query = mysqli_query($con,"select seatno from bookings where origin='".$origin."' and destination='".$destination."' and travel_date='".$datetime."' and type='".$type."'");
	
	if($query){
		$i = 1;
		while ($row = mysqli_fetch_array($query)) {
			$flag[0+$i] = $row['seatno'];
			$flag['seatno'.$i] = $row['seatno'];
			$i++;
		}
		$flag[$i] = mysqli_num_rows($query);
		$flag['total'] = mysqli_num_rows($query);
		$flag = array($flag);
		print(json_encode($flag));
	}
	mysqli_close($con);
?>