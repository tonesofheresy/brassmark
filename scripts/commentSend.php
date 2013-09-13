<?php

$emailTo				= '86.s.mittal@gmail.com';
$emailSubject		= 'Brassmark Wines Feedback';
$fromFirst 			= $_REQUEST['First'];
$fromLast				= $_REQUEST['Last'];
$fromEmail			= 'no-reply@brassmarkwines.com';
$fromPhone			= $_REQUEST['Phone'];
$comments				= $_REQUEST['Comments'];
$fromFull				= "$fromFirst $fromLast";

$body						= "Name: $fromFull\n
									 Email: $fromEmail\n";
if($fromPhone) {
	 $body       .= "Phone: $fromPhone\n";
}
$body 				 .= "Feedback: $comments";
$headers				= "From: $fromFull <{$fromEmail}>";

$success        = mail($emailTo, $emailSubject, $body, $headers);

if($success) {
	header("Location: ../thanks.html");
}
?>