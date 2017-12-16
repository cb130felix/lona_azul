<?php include 'site/header.php'; ?>
    
	<br>
	<div class='container'>
		
		

		
		
		<?php
		$prize=false;
		$client_exist=false;
		
		require_once '../config/settings.php';
		require_once '../config/dbconfig.php';
		session_start();
		
		$conn = createConn();
	
		$user_id = $_GET['user_id'];
		
		$sql_select = "SELECT * FROM `client` WHERE client.id = " . $user_id;
		$result = mysqli_query($conn, $sql_select);
		
		
		if (mysqli_num_rows($result) > 0) {
			$client_exist = true;
		}
			
		$user = mysqli_fetch_assoc($result);
		
		//echo "pontos: " . $user['points'] . ' / ' . "max points: " . $max_points;
		$user_points = $user['points'];
		if($user_points >= $settings['max_points'])	$prize=true;
		
		
		if($_SESSION['message'] != null){
			?>
			<div class="alert alert-info">
			  <strong>Info!</strong> <?php echo $_SESSION['message']; ?>.
			</div>
			<?php
		}
		
		?>
		
		
		<?php
		if($client_exist){
			?>
			<ul class="nav nav-tabs">
			  <li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#home">Nome cliente</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#menu1">Atualizar Dados</a>
			  </li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div class="tab-pane active container" id="home">
				<h1>Consulta de cliente</h1>

				<ul>
					<li>ID do cliente: <?php echo $user_id; ?></li>
					<li>Pontos do cliente:<b> <?php echo $user_points; ?></b></li>
					<li>Nome: <?php echo $user['name']?></li>
					<li>email: <?php echo $user['email']?></li>
				</ul>
				<?php
				
				if($prize){
					$prize=true;
					?>
					<p>Cliente apto a resgatar premio!</p>
					
					
					<?php
					
				}else{
					?>
					<p>Falta(m) <?php echo ($settings['max_points'] - $user_points); ?> pontos para resgatar um premio!</p>
					<?php
				}
				
				
				closeConn($conn);
				
				$_SESSION['message'] = null;
				
				
				?>
					
				<div class="btn-toolbar">
					<?php
					if($prize){
					?>
						<form method='get' action='prize_handler.php'>
							<input type="hidden" name='user_id' value='<?php echo $user_id ; ?>'>
							<button type="submit" class="btn btn-success" name='action'>Resgatar</button>
						</form>
					<?php
					}
					?>
					
					
				</div>
			  </div>
			  <div class="tab-pane container" id="menu1">
			  
				<div class='container'>
					<h3>Atualizar dados de cliente</h3>
					<form method='get' action='update_client_handler.php'>
						
						<input name='user_id' type="hidden" value='<?php echo $user_id ; ?>'>
						<div class="form-group">
							<label for="exampleInputEmail1">Nome</label>
							<input name='name' type="text" class="form-control" id="exampleInputEmail1" placeholder="Nome do cliente">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input name='email' type="text" class="form-control" id="exampleInputEmail1" placeholder="Email do cliente">
						</div>
					  
					  <input type="submit" class="btn btn-primary" name='action' value='Atualizar'>
					</form>
					<br>
				</div>
			  
			  </div>
			  
			  
			  
			</div>
			
		<?php
		}else{// if client_exist
			?>
			
				<h3>Nao a registros para esse cliente</h3>
				
				<p>Certifique-se de que esta procurando pelo ID certo.</p>
			
			<?php
		}
		?>
	</div>

		

	<?php include 'site/footer.php'; ?>
    