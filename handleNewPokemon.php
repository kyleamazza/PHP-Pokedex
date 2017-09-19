<?php

include 'createTables.php';

$db = connectDB();

$name = mysqli_real_escape_string($db, $_POST['pokename']);
$type = mysqli_real_escape_string($db, $_POST['poketype']);
$height = mysqli_real_escape_string($db, $_POST['pokeheight']);
$weight = mysqli_real_escape_string($db, $_POST['pokeweight']);
$ability = mysqli_real_escape_string($db, $_POST['pokeability']);

$addPokeQuery = "INSERT IGNORE INTO pokemon VALUES (null, '$name', '$type', $height, $weight, '$ability');";

$result = $db->query($addPokeQuery);

if($result) {
	echo "Woo! Added to DB<br>";
	Redirect('./index.php?message='.urlencode("Successfully added to database"), false);
} else {
	echo "Nope! Not added to DB<br>";
	Redirect('./index.php?message='.urlencode("Error while adding to database"), false);
	
}



?>