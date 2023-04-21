<?php

$ipp = $_REQUEST['ipp'];

include("connectionBD.php");
if ($ipp !== "") {
	$query = mysqli_query($con, "SELECT nom_P,
	prenom_P FROM patient WHERE IPP='$ipp'");

	$row = mysqli_fetch_array($query);
	$nom = $row["nom_P"];
	$prenom = $row["prenom_P"];
}

$result = array("$nom", "$prenom");

$myJSON = json_encode($result);
echo $myJSON;
?>
