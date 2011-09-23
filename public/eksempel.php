<?php

function myValidate($data, $dataType)  {
	// $data == det der skal valideres
	// $dataType == hvordan skal det valideres

	// Vi forventer at der ikke er nogen fejl
	$return_value = false; 
	
	switch($dataType) {
		case "empty":
			if(empty($data)) {
				$return_value = true;
			}
			break;
		case "email":
			if (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/" , $data)) {
				$return_value = true;
			}
			break;
		case "numeric":
			if(!is_numeric($data)) {
				$return_value = true;
			}
			break;
		default:
			break;	
	}
	
	return $return_value;
}

function secondsToTime($seconds){
	return date("H:i:s", mktime(0, 0, $seconds, 0, 0, 0 ));
	
}



// Controllere
$fejlcontroller1 = false;
$fejlcontroller2 = false;
$fejlcontroller3 = false;



// Er knappen trykket?
if(isset($_POST['knap'])){
	echo "form postet.<br>";
	//navn, email, besked
	// myValidate('data der skal valideres', 'typen af data jeg forventer at det skal være')
	$fejlcontroller1 = myValidate($_POST['navn'], 'empty');
	$fejlcontroller2 = myValidate($_POST['email'], 'email');
	$fejlcontroller3 = myValidate($_POST['besked'], 'empty');
	
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>validering</title>
</head>
<style>
	.error {
		border: 1px solid red;	
	}

	.menu_div {
		display: inline;
	
	}
	
	.menu_div ul {
		display:block;
	}
	
	.menu_div li {
		list-style-type: none;
		float: left;	
	}


</style>



<body>
	<?php
		if($fejlcontroller1 || $fejlcontroller2 || $fejlcontroller3) {
			echo "du har en fejl<br>";
		} else {
			echo "ingen fejl<br>";
		}
	?>

	<form action="" method="post">
		<table>
			<tr>
				<td>navn:</td>
				<td><input type="text" name="navn" id="navn" <?php if($fejlcontroller1) { ?>class="error"<?php }?> ></input></td>
			</tr>
			<tr>
				<td>email:</td>
				<td><input type="text" name="email" id="email" <?php if($fejlcontroller2) { ?>class="error"<?php }?> ></input></td>
			</tr>
			<tr>
				<td>besked:</td>
				<td><textarea name="besked" id="besked" <?php if($fejlcontroller3) { ?>class="error"<?php }?> ></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="knap" value="test"></td>
			</tr>
		</table>
	</form>
	<hr>
	<?php
		echo secondsToTime(360);
	?>
	<hr>
	<div class="menu_div">
		<ul>
			<li><a href="#">menu1</a></li>
			<li><a href="#">menu2</a></li>
			<li><a href="#">menu3</a></li>
			<li><a href="#">menu4</a></li>
			<li><a href="#">menu5</a></li>
		</ul>
	</div>
	
	<?php 
	
	$key = "jUm.w8(a11rJAerniaw&21";
	
	$password = "300m486e";
	
	$hash = sha1(sha1($password).$key);
	
	echo "length: " . strlen($hash) . "<br>";
	echo $hash;
	
	?>
	
</body>
</html>