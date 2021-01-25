<?php
function getComments($row) {
	
	global $db;

	echo "<li class='comment'>";
	echo "<div class='aut'>".$row['author']."</div>";
	echo "<div>".$row['comment']."</div>";

	echo "<div class='timestamp'>".$row['created_at']."</div>";

	echo "<a href='#comment_form' class='reply' id='".$row['id']."'>Reply</a>";
	echo "&nbsp;&nbsp;";
	echo "<a href='#' class='reply' id='".$row['id']."'>Delete</a>";
	echo "&nbsp;&nbsp;";
	echo "<a href='#' class='reply' id='".$row['id']."'>Edit</a>";
	$q = "SELECT * FROM comment_tbl WHERE parent_id = ".$row['id'].""; 
	$r = mysqli_query($db,$q);
	if(mysqli_num_rows($r)>0){
		echo "<ul>";
		while($row = mysqli_fetch_assoc($r)) {
			getComments($row);
		}
		echo "</ul>";
		}
	echo "</li>";
}
?>
