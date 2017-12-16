	<?php
	session_start();
	require_once '../config/dbconfig.php';
	require_once '../config/settings.php';
	
	
require_once '../plugin/send_mail.php';


	$user_id = null;

	$_SESSION['prize'] = false;


	if(isset($_GET['user_id'])){
		$user_id = $_GET['user_id'];
		
	}

	echo "operacao: " . $_GET['action'] . "<br>";
	$conn = createConn();

	$max_points = $settings['max_points'];
	
	

	if($_GET['action'] == 'Inserir'){
		if($user_id != null){
		
		$_SESSION['message'] = "Ponto registrado! ";	
		
		$sql_insert = "INSERT INTO client (id, points) VALUES (" . $user_id . ", 1) ON DUPLICATE KEY UPDATE points= (points+1)";
		
		if (mysqli_multi_query($conn, $sql_insert)) {
			
			$sql_selectt = "SELECT * FROM `client` WHERE client.id = " . $user_id;
			$result = mysqli_query($conn, $sql_selectt);
			$user = mysqli_fetch_assoc($result);
			
			if(send_mail_to($user['email'], $user['name'], 'point')){
				$_SESSION['message'] = $_SESSION['message'] . "Email enviado! ";
			}else{
				$_SESSION['message'] = $_SESSION['message'] . "Email  <b>NAO</b> enviado! ";
			}
			
						
		} else {
		
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);

		}
		
		
		
		}


		
	}else if($_GET['action'] == 'Consultar'){
		
	}
	
	closeConn($conn);
	header('Location: consult_client.php?user_id='.$user_id);
	
	?>