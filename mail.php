<!--Register Form Code-->
<?php
require_once "vendor/autoload.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$FormName  = isset( $_GET['FormName'] ) ? $_GET['FormName'] : '';
$EmailAddr = isset( $_GET['nls_email'] ) ? $_GET['nls_email'] : '';

if ( ! empty( $EmailAddr ) ) {

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	//Server settings
	$mail->SMTPDebug = 3;                      //Enable verbose debug output
	$mail->From      = $EmailAddr;
	$mail->FromName  = 'Carforyou Html';
	$mail->addAddress('contact@exampleurl.com', 'User');
	$mail->addReplyTo('info@example.com', 'Information');
	$mail->isHTML(true);                                  // Set email format to HTML

	if ( $FormName == 'subscribe' ) {
	    $mail->Subject = 'New subscriber';
	    $mail->Body    = '<h4>You have received a new subscriber</h4><p>Email:- '.$EmailAddr.'</p>';
	} else {
	    $mail->Subject = 'You have a new query';
	    $mail->Body    = '<h4>You have received a new enquiry</h4><p>Name:- '.$FulleName.'</p><p>Email:- '.$EmailAddr.'</p><p>Phone:- '.$Phone_no.'</p><p>Message:- '.$MgsContent.'</p>';
	}

	if(!$mail->send()) {
	    echo json_encode( array( 'status' => 'error', 'mgs' => 'Message could not be sent' ) );
	} else {
	    echo json_encode( array( 'status' => 'success', 'mgs' => 'Message sent successfully' ) );
	}
} else {
	$to="info@webmasterdriver.net"; // Change with your email address
	$subject = "Reserve Your Seat";
	if($_REQUEST['name'])
	 $name = $_REQUEST['name'];
	else
	 $name = "Not Specified"; 
	if($_REQUEST['email'])
	 $email = $_REQUEST['email'];
	else
	 $email = "Not Specified"; 
	if($_REQUEST['phone'])
	 $phone = $_REQUEST['phone'];
	else
	 $phone = "Not Specified"; 
	if($_REQUEST['Numberofseats'])
	 $Numberofseats = $_REQUEST['Numberofseats'];
	else
	 $Numberofseats = "Not Specified"; 
	if($_REQUEST['eventPlan'])
	 $eventPlan = $_REQUEST['eventPlan'];
	else
	 $eventPlan = "Not Specified"; 

	$msgg='<table width="100%" border="0" cellspacing="5" cellpadding="5">
				  <tr>
					<td width="50%" align="left" class="blacktext01">Full Name:</td>
					<td width="50%" align="left"><span class="blacktext01">'.$name.'</span></td>
				  </tr>
				  <tr>
					<td width="50%" align="left" class="blacktext01">Email Address: </td>
					<td width="50%" align="left"><span class="blacktext01">'.$email.'</span></td>
				  </tr>
				  <tr>
					<td width="50%" align="left" class="blacktext01">Phone Number: </td>
					<td width="50%" align="left"><span class="blacktext01">'.$phone.'</span></td>
				  </tr>
				  <tr>
					<td width="50%" align="left" class="blacktext01">Number Of Seats: </td>
					<td width="50%" align="left"><span class="blacktext01">'.$Numberofseats.'</span></td>
				  </tr>
				  <tr>
					<td width="50%" align="left" class="blacktext01">Event Plan: </td>
					<td width="50%" align="left"><span class="blacktext01">'.$eventPlan.'</span></td>
				  </tr>
		   </table>';

		   $message=$msgg;

	        $headers  = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\n";
			$headers .= "X-Priority: 3\n";
			$headers .= "X-MSMail-Priority: Normal\n";
			$headers .= "X-Mailer: php\n";
			$headers .="From:".$name."<".$email.">\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			mail($to, $subject, $message, $headers);	
}