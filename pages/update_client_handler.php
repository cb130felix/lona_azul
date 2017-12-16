<?php

session_start();
require_once '../config/dbconfig.php';

$user_name = "indefinido";
$user_email = "indefinido";
$user_id = $_GET['user_id'];

if(isset($_GET['name'])){
$user_name = $_GET['name'];
}

if(isset($_GET['email'])){
$user_email = $_GET['email'];
}

$sql = "UPDATE `client` SET `name`= '".$user_name."', `email`='".$user_email."' WHERE id=".$user_id;

$conn = createConn();
if (mysqli_multi_query($conn, $sql)) {
	$_SESSION['message'] = "Dados atualizados com sucesso!";
	echo "Dados atualizados";
} else {
	$_SESSION['message'] = "Nao foi possivel atualizar os dados!";
	echo "Dados nao atualizado";
}



header('Location: consult_client.php?user_id='.$user_id);
closeConn($conn);