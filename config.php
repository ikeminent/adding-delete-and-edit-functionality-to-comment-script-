<?php

$Hamzathostname_Mirror = "localhost";
$HamzatUser_Mirrior = "root";
$HamzatPass_Mirror = "1974HAMZAcom";
$Hamzatdatabase_Mirrior = "commentreplysystem";

$db = mysqli_connect($Hamzathostname_Mirror, $HamzatUser_Mirrior, $HamzatPass_Mirror, $Hamzatdatabase_Mirrior); 
if(mysqli_connect_errno()) {
    throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
}


?>

