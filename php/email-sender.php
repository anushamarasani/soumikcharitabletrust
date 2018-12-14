<?php
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
header('Content-type: application/json');

$Recipient = 'cs@beachandcruise.co.uk'; // <-- Set your email here

if($Recipient) {

	$Name = filter_var($_POST['name_apply'], FILTER_SANITIZE_STRING);
	$Email = filter_var($_POST['email_apply'], FILTER_SANITIZE_EMAIL);
	$phone = filter_var($_POST['phone_apply'], FILTER_SANITIZE_STRING);
	$departureFrom = filter_var($_POST['departureFrom_apply'], FILTER_SANITIZE_STRING);
	$howDoYouFindUs = filter_var($_POST['howDoYouFindUs_apply'], FILTER_SANITIZE_STRING);
	$Message = filter_var($_POST['yourQuery'], FILTER_SANITIZE_STRING);
	if (isset($_POST['guests'])) {
		$Guests = filter_var($_POST['guests'], FILTER_SANITIZE_STRING);
	} else {
		$Guests = "";
	}
	if (isset($_POST['events'])) {
		$Events = filter_var($_POST['events'], FILTER_SANITIZE_STRING);
	} else {
		$Events = "";
	}
	if (isset($_POST['category'])) {
		$Category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
	} else {
		$Category = "";
	}

	$Email_body = "";
	$Email_body .= "From: " . $Name . "\n" .
				   "Email: " . $Email . "\n" .
				   "phone: " . $phone . "\n" .
				   "departureFrom: " . $departureFrom . "\n" .
				   "howDoYouFindUs: " . $howDoYouFindUs . "\n" .
				   "Message: " . $Message . "\n" .
				  
	$Email_headers = "";
	$Email_headers .= 'From: ' . $Name . ' <' . $Email . '>' . "\r\n".
					  "Reply-To: " .  $Email . "\r\n";

	$sent = mail($Recipient, $Subject, $Email_body, $Email_headers);

	if ($sent){
		$emailResult = array ('sent'=>'yes');
	} else{
		$emailResult = array ('sent'=>'no');
	}

	echo json_encode($emailResult);

} else {

	$emailResult = array ('sent'=>'no');
	echo json_encode($emailResult);

}
?>
