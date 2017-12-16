<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../config/settings.php';

require_once '../plugin/send_mail.php';


$_SESSION['message'] = "";

$user_id = $_GET['user_id'];

$conn = createConn();

$sql = "UPDATE client set client.points = (client.points - (".$settings['max_points'].")) where client.id = '".$user_id."'";

if (mysqli_multi_query($conn, $sql)) {
	
	$sql_selectt = "SELECT * FROM `client` WHERE client.id = " . $user_id;
	$result = mysqli_query($conn, $sql_selectt);
	$user = mysqli_fetch_assoc($result);
	
	if(send_mail_to($user['email'], $user['name'], 'prize')){
		$_SESSION['message'] = $_SESSION['message'] . "Email enviado! ";
	}else{
		$_SESSION['message'] = $_SESSION['message'] . "Email  <b>NAO</b> enviado! ";
	}
	//echo "pontos restantes no cartão: " . $user['points'];
	
	
}

closeConn($conn);

$_SESSION['message'] = $_SESSION['message'] . "Premio resgatado!";

header('Location: consult_client.php?user_id='.$user_id);