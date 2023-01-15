<?php
function mailsender( $Mail_Subject,$Mail_Txt,$MAIL_TO ){
	//SMTP  CREDENTIALS
	$SMTP_SERVER = 'smtp.mailgun.org';
	$SMTP_USERNAME = "postmaster@sandbox2946eecca5fc4d5682ee5143e8450770.mailgun.org";
	$SMTP_PASSWORD = "3ed185b718bf130d43d6592a833c5153-c2efc90c-7a7c2a1a";

	$mail_string = "From: <$SMTP_USERNAME>\r\n";
	$mail_string .= "To: <$MAIL_TO>\r\n";
	$mail_string .= "Date: " . date('r') . "\r\n";
	$mail_string .= "Subject: $Mail_Subject\r\n";
	$mail_string .= "\r\n";
	$mail_string .= " $Mail_Txt\r\n";
	$mail_string .= "\r\n"; 

	$emailFile = fopen("php://temp", 'w+');
	fwrite($emailFile, "$mail_string");
	rewind($emailFile);
	$fstat = fstat($emailFile);
	$size = $fstat['size'];
	$ch = curl_init($SMTP_SERVER);
	curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
	curl_setopt($ch, CURLOPT_MAIL_FROM, "<" . $SMTP_USERNAME . ">");
	curl_setopt($ch, CURLOPT_MAIL_RCPT, array("<" . $MAIL_TO . ">"));
	curl_setopt($ch, CURLOPT_USERNAME, $SMTP_USERNAME);
	curl_setopt($ch, CURLOPT_PASSWORD, $SMTP_PASSWORD);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_USE_SSL, CURLUSESSL_ALL);
	curl_setopt($ch, CURLOPT_PUT, 1);
	curl_setopt($ch, CURLOPT_INFILE, $emailFile);
	curl_setopt($ch, CURLOPT_INFILESIZE,$size);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	fclose($emailFile);
	curl_close($ch);
}

?>