<?php
require_once ("../../../wp-load.php");
$recipient_email = "drudro@outlook.com";
//recepient
$fields = array('name', 'email', 'phone', 'message', 'subject', 'hFiles');

header('Content-Type: text/html; charset=utf-8');
foreach ($fields as $field) {
	if (isset($_POST[$field]))
		$posted[$field] = stripslashes(trim($_POST[$field]));
	else
		$posted[$field] = '';
}

$headers = 'From: ' . $posted['name'] . ' <' . $posted['email'] . '>' . "\r\n";
$message_text = $posted['name'] . "\r\n" . $posted['email'] . "\r\n" . $posted['phone'] . "\r\n\r\n" . $posted['message'];
if (isset($_POST['hFiles'])) {
	$file = '' . $_POST['hFiles'] . '';

	if (wp_mail($recipient_email, $posted['subject'], $message_text, $headers, $file)) {
		echo '<div> Отправлено</div>';
	} else {
		echo '<div> Не отправлено </div> ';
	}
} else {

	if (wp_mail($recipient_email, $posted['subject'], $message_text, $headers)) {
		echo '<div> Отправлено</div>';
	} else {
		echo '<div> Не отправлено </div> ';
	}
}
?>