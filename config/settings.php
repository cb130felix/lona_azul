<?php

$settings = array();

//Site settings
	
	$settings['site_name'] = "Nome do site";

	$settings['max_points'] = 2;
	
//DB SETTINGS
	$settings['db_servername'] = "localhost";
	$settings['db_username'] = "root";
	$settings['db_password'] = "";
	$settings['db_dbname'] = "lona_azul";


// EMAIL SETTINGS
/* 
OBS: LIBERAR EMAIL PARA USO DE APLICATIVOS POUCO CONFI�VEIS
 Link da solu��o: https://stackoverflow.com/questions/20337040/gmail-smtp-debug-error-please-log-in-via-your-web-browser
*/

	$settings['email'] = 'izabelfelixrodrigues@gmail.com';
	$settings['password'] = 'ri070214';
	$settings['name'] = 'Izabel Felix';

	$settings['reply_to_mail'] = 'noreply@gmail.com';
	$settings['reply_to_name'] = 'noreply';

	//When receives a prize
	$settings['email_subject_prize'] = 'T�tulo do email aqui - prize';
	$settings['email_body_prize'] = 'Conte�do do email aqui - prize';

	//when receives a point
	$settings['email_subject_point'] = 'T�tulo do email aqui - ponto';
	$settings['email_body_point'] = 'Conte�do do email aqui - ponto';

	


