<?php
	$recepient = $_POST["email"];
	$sitename = "blog.yottos.com";

	$name = $_POST["name"];
	$email = $_POST["email"];
	//$str = $_POST


	$message = "Имя: $name \nEmail: $email";

	$pagetitle = "Запрос обратного звонка с сайта \"$sitename\"";
	wp_mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
?>