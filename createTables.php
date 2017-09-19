<?php 

connectDB();

if(isset($_POST['genTables'])) {
	generateTables();
	Redirect('./index.php', false);
};

function connectDB() {
	$servername = "www.smccs85.com";
	$username = "kprovenc";
	$password = "4H*DmBrhBd";
	$dbName = "kprovenc_project";
	// $username = "root";
	$db = new mysqli('localhost', $username, $password, $dbName);
	// $db = new mysqli("localhost", $username, "", "pokermanz");
	$GLOBALS['db'] = $db;
	
	if($db -> connect_error) {
		die("Connection failed: " . $db->connect_error);
	}
	
	return $db;
	
	echo "Connected to database!";
	
}

function generateTables() {
	$query = "CREATE TABLE IF NOT EXISTS pokemon (
	  `id` INT NOT NULL AUTO_INCREMENT,
	  `name` VARCHAR(45) NOT NULL,
	  `type` VARCHAR(45) NOT NULL,
	  `height` INT NOT NULL,
	  `weight` INT NOT NULL,
	  `ability` VARCHAR(45) NOT NULL,
	  PRIMARY KEY (`id`)
	 );";
	 
	 $result = $GLOBALS['db']->query($query);
		if($result) {
			echo "Table created/exists.";
		} else {
			echo "Error has occurred while creating tables/entering data";
		}
}

if(isset($_POST['pokeQueryArr'])) {
	generateEntries($_POST['pokeQueryArr']);
}

function generateEntries($queryArr) {
	static $hasRun = true;
	if(true) {
		$hasRun = true;
		foreach($queryArr as $query) {
			$result = $GLOBALS['db']->query($query);
			if($result) {
				$ajaxResult['result'] = "Entry added!";
			} else {
				echo "Error has ocurred while creating tables/entering data";
			}
		}
	}
}

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

$db->close();

?>