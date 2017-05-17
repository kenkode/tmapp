<?php
    include'db.php';

    $destination = $_POST['destination'];
    $origin = $_POST['origin'];
    $date = $_POST['date'];
    $time = $_POST['time'];  
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];  
    $vehicle = $_POST['vehicle'];
    $organization = $_POST['organization'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $idno = $_POST['idno'];
    $paymentmode = $_POST['paymentmode'];
    $amount = preg_replace("/[^0-9.]/", "", $_POST['amount']);   
    $newdate = strtotime($date.' '.$time);
    $datetime = date('Y-m-d H:i:s', $newdate);


    $veh = mysqli_query($con, "select vehiclenames.name,regno from vehicles left join vehiclenames on vehicles.vehiclename_id=vehiclenames.id where vehicles.id='".$vehicle."'");

    $rowv = mysqli_fetch_array($veh);

	$sel = mysqli_query($con, "select name,id from organizations where id='".$organization."'");

    $booking = mysqli_query($con, "select id from bookings where organization_id='".$organization."' order by id DESC");

	$row = mysqli_fetch_array($sel);

	$id = 0;

	if(mysqli_num_rows($booking) == 0){
    $id = 0;
	}else{
    $rowb = mysqli_fetch_array($booking);
    $id = $rowb['id'];
	}
	

    function initials($str,$id) {
    $ret = '';
    $bid = $id + 1;
    foreach (explode(' ', $str) as $word){
      if($word == null){
        $ret .= strtoupper($str[0]); 
      }else{
        $ret .= strtoupper($word[0]);
      }
      }
      $ticketnumber = '#' . $ret . date('ydm'). str_pad(($bid), 4, '0', STR_PAD_LEFT);
   
    return $ticketnumber;
    }
    
    $ticketno = initials($row['name'],$id);

    require_once('PHPMailer-master/PHPMailerAutoload.php');

             //Create a new PHPMailer instance
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'wangoken2@gmail.com';                 // SMTP username
$mail->Password = 'Kenkode1!';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$message = "Hello ".$firstname." ".$lastname.",<br> This is a confirmation that you have successfully booked ".$rowv['name']." on ".date('d-M-Y').".<br><br>Your booking details are:<br><table border='0'><tr><td><strong>Ticket number  :</strong></td><td>".$ticketno."</td></tr><tr><td><strong>First name :</strong></td><td>".$firstname."</td></tr><tr><td><strong>Last name :</strong></td><td>".$lastname."</td></tr><tr><td><strong>Phone number :</strong></td><td>".$phone."</td></tr><tr><td><strong>ID / Passport Number :</strong></td><td>".$idno."</td></tr><tr><td><strong>Amount :</strong></td><td>KES".number_format($amount,2)."</td></tr><tr><td><strong>Payment Mode :</strong></td><td>".$paymentmode."</td></tr><tr><td><strong>Vehicle :</strong></td><td>".$rowv['regno'].' - '.$rowv['name']."</td></tr></table><br><br> For mor information contact us on...<a href='#'>upstridge.com</a>";

$mail->setFrom('wangoken2@gmail.com', 'Upstridge');
$mail->addAddress($email, $firstname." ".$lastname);
$mail->Subject = "User Confirnmation";
$mail->msgHTML($message);

if (!$mail->send()) {
    //echo "Mailer Error: " . $mail->ErrorInfo;
    echo "An error occured during booking...please try again!";
} else {
    $query = mysqli_query($con, "insert into bookings(vehicle_id, organization_id, firstname, lastname, email, phone, id_number, ticketno, origin, destination, travel_date, arrival, departure, amount, status, date, mode_of_payment,created_at,updated_at) values ('".$vehicle."','".$organization."','".$firstname."','".$lastname."','".$email."','".$phone."','".$idno."','".$ticketno."','".$origin."','".$destination."','".$datetime."','".$arrival."','".$departure."','".$amount."','approved',NOW(),'".$paymentmode."',NOW(),NOW())");
    
    if($query){
        echo "Booking Successful... Your booking Details have been sent to your email address";
    }else{
        echo "An error occured during booking...please try again!";
        //echo mysqli_error($con);
    }
}
      

	
	mysqli_close($con);
?>