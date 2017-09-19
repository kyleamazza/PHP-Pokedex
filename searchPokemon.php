<!DOCTYPE html>
<html>
	<head>
		<title>Album Search Results</title>
		<meta charset="utf-8"/>
	</head>
	<body>
<?php

include 'createTables.php';

$db = connectDB();

$name = strtolower(mysqli_real_escape_string($db, $_GET['pokename']));

$pokeQuery = "SELECT * FROM pokemon WHERE name LIKE '$name'";


$result = $db->query($pokeQuery);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "Name: " . $row["name"] . "; Type: " . $row['type'] . "; Height(m): " . $row['height'] . "; Weight(kg): " . $row['weight'] . "; Ability: " . $row['ability'] ."";
	} 
} else {
		echo "Error"; 
}

?>
		<form action="index.php" method="GET">
			<input type="submit" value="Return Home"/>
		</form>
	</body>
</html>
