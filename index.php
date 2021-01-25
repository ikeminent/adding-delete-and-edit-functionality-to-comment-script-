<?php 
include("config.php");
include("functions.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Threaded Comments</title>
<script type='text/javascript' src='jquery.pack.js'></script>
<script src="jquery.1.9.js"></script>
  <script src="jquery.validate.min.js"></script>
<script type='text/javascript'>
$(function(){
	$("a.reply").click(function() {
		var id = $(this).attr("id");
		$("#parent_id").attr("value", id);
		$("#name").focus();
	});
});
</script>


<?php

// If the form was submitted, scrub the input (server-side validation)
// see below in the html for the client-side validation using jQuery

$name = '';
$email = '';
$comment_body = '';
$output = '';

if($_POST) {
  // collect all input and trim to remove leading and trailing whitespaces
  $name = trim($_POST['myname']);
  $email = trim($_POST['myemail']);
  $commentbody = trim($_POST['commentbody']);
  
  $errors = array();
  
  // Validate the input
  if (strlen($name) == 0)
    array_push($errors, "Please enter your name");

  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    array_push($errors, "Please specify a valid email address");
 
  if (strlen($comment_body) == 0) 
    array_push($errors, "Please specify your comment_body");
    
  // If no errors were found, proceed with storing the user input
  if (count($errors) == 0) {
    array_push($errors, "No errors were found. Thanks!");
  }
  
  //Prepare errors for output
  $output = '';
  foreach($errors as $val) {
    $output .= "<p class='output'>$val</p>";
  }
  
}

?>

<style type="text/css">
    .label {width:100px;text-align:right;float:left;padding-right:10px;font-weight:bold;}
    #commentform label.error, .output {color:#FB3A3A;font-weight:bold;}
 </style>
 

  
  
  
   <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #comment_form element
    $("#commentform").validate({
    
        // Specify the validation rules
        rules: {
            name: "required",
            comment_body: "required",
            email: {
                required: true,
                email: true
            },
        },
        
        // Specify the validation error messages
        messages: {
            name: "Please enter your name",
            email: "Please enter a valid email address",
    		comment_body: "Please enter your comment",
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>


 <!--  New Test.php Ends Here -->


<style type='text/css'>
html, body, div, h1, h2, h3, h4, h5, h6, ul, ol, dl, li, dt, dd, p, blockquote,
pre, form, fieldset, table, th, td { margin: 0; padding: 0; }

body {
font-size: 14px;
line-height:1.3em;
}

a, a:visited {
outline:none;
color:#7d5f1e;
}

.clear {
clear:both;
}

#allContainer {
	width:480px;
	margin:0px auto;
	padding:15px 0px;
}

.comment {
	padding:5px;
	border:2px solid #7d5f1e;
	margin-top:15px;
	list-style:none;
}

.aut {
	font-weight:bold;
}

.timestamp {
	font-size:85%;
	float:right;
}

#commentform {
	margin-top:15px;
}

#commentform input {
	font-size:1.2em;
	margin:0 0 10px;
	padding:3px;
	display:block;
	width:100%;
}

#commentbody {
	display:block;
	width:100%;
	height:150px;
}

#submitbutton {
	text-align:center; 
	clear:both;
}
</style>


</head>
<body>
<!--<br><br><br>
<!--<center>
<pre>

This code is available at : <a href="http://www.watchoutonnet.com/php-script-for-unique-visitor-counter.php">php script for unique visitor counter Page</a>

If you liked or benefitted from it, please subscribe to our
entertainment channel at following link :

<a href="https://goo.gl/Cc3fzq" target="_blank">Entertainment Channel</a>	

Thanks. 
Team - Watch Out On Net.

</pre>
</center>--><br><br><br>


<?php echo $output; ?>


<div id='allcontainer'>
<form id="commentform" action="insertcom.php" method='post'>
<label for="name">Name:</label>	<input type="text" id="name" name="myname" value="<?php echo $name; ?>" /><br />

<label for="email">Email:</label> <input type="text" id="email" name="myemail" value="<?php echo $email; ?>" /><br />
<label for="commentbody">Comment:</label><textarea id="commentbody" name="commentbody" value="<?php echo $commentbody; ?>" />   </textarea> <br />
	<input type='hidden' name='parent_id' id='parent_id' value='0'/>
	<div id='submitbutton'> <input type="submit" value="Add comment" name="go" />
	</div>
</form>

<ul>
<?php
$q = "SELECT * FROM comment_tbl WHERE parent_id = 0";
$r = mysqli_query($db,$q);
while($row = mysqli_fetch_assoc($r)):
	getComments($row);
endwhile;
?>
</ul>

</div>
</body>
</html>
