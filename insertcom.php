<?php

include("config.php");
include("functions.php");

$author = mysqli_real_escape_string($db,$_POST['myname']);
$email = mysqli_real_escape_string($db,$_POST['myemail']);

$comment_body = mysqli_real_escape_string($db,$_POST['commentbody']);
$parent_id = mysqli_real_escape_string($db,$_POST['parent_id']);


$q = "INSERT INTO comment_tbl (author, email, comment, parent_id) 
VALUES ('$author', '$email', '$comment_body', $parent_id)"; 
$r = mysqli_query($db,$q);
if($r == 1){

    echo '<script type="text/javascript">
	  alert("New comment Added successful...");window.location.href = "index.php";</script>'; 

}else {
 echo '<script type="text/javascript">
	  alert("Error post, contact admin...");window.location.href = "index.php";</script>'; 
}

?>





