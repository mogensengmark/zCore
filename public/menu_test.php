<?php 

$connection = mysql_connect('localhost', 'topspejderweb', '3Ek5-!.uduK4');
$database = mysql_select_db('topspejder');

if (!$connection) {
    die('Could not connect: ' . mysql_error());
} else {
	echo "TEST";
	
	$query = "SELECT * FROM login";
	
	$res = mysql_query($query);
	// Extracts from result set
	while($row = mysql_fetch_assoc($res)) {
		$my_array[] = $row;
		echo "<pre>";
		var_dump($row);
		echo "</pre>";
	}

	foreach($my_array as $menu_item){
		
		
	}
	/*
	echo "<pre>";
	var_dump($my_array);
	echo "</pre>";
	*/
}
mysql_close();
?>