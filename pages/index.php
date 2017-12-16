<?php include 'site/header.php'; ?>
    
	<div class="container">
		<br>
		<h1>Controle de clientes</h1>
		
		<form method='get' action='controll_handler.php'>
		  <div class="form-group">
			<label for="exampleInputEmail1">ID do usuarios</label>
			<input autofocus  required name='user_id' type="number" class="form-control" id="exampleInputEmail1" placeholder="Entre com o cpf">
			<small>Um ID deve ser um valor unico para cada cliente. Ex: cpf, numero de celular.</small>
		  </div>
		  
		  <input type="submit" class="btn btn-success" name='action' value='Inserir'>
		  <input type="submit" class="btn btn-primary" name='action' value='Consultar'>
		</form>
		
	

	</div>
	
	

	<?php include 'site/footer.php'; ?>
