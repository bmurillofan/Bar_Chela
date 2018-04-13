<?php

	//Destructor de sesiones o deslogeo
	session_start();
	session_destroy();
	header("Location: ../../site_media/html/modules/homeMC/homeController.php");

 ?>
