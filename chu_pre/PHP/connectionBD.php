<?php
       	$host = 'localhost';
		$user = 'root';
		$password = '';
		$database = 'chu_f';
		$con = mysqli_connect($host, $user, $password);
        $selectDb = mysqli_select_db($con, $database);
		if( !$con) { echo "Desolé, connexion à localhost impossible"; exit; }
		if($selectDb === false){echo 'Aucune base de données sous ce nom !'; }
?>
