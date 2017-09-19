<!DOCTYPE html>
<html>
	<?php
	
	include 'createTables.php';
	
	?>
	<head>
		<title>CS85 Final Project</title>
	<meta charset="utf-8">
	<meta name="description" content="Pokedex giving values and stuff of pokemans">
	<link rel="stylesheet" href="./css/pokestyles.css">
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script>
		$(document).ready(function(){
			var pokeQueryArr = [];
			for (var i = 1; i <= 151; i++){
				$.get("http://pokeapi.co/api/v1/pokemon/" + i +"/", function(pokerus){
					
					var name = pokerus.name;
					var typeStr = pokerus.types[0].name;
					var height = pokerus.height/10;
					var weight = pokerus.weight/10;
					var abilStr = pokerus.abilities[0].name;
					
					var pokeQuery = "INSERT INTO pokemon VALUES (null, '" + name + "', '" + typeStr + "', " + height + ", " + weight +", '" + abilStr +"');";
					console.log(pokeQuery);
					pokeQueryArr.push(pokeQuery);
					
				});
			}
			$('#genEntriesBtn').click(function(event) {
				event.preventDefault();
				console.log("Clicked!");
				for(var i = 0; i < pokeQueryArr.length; i++) {
					console.log(i + ": " + pokeQueryArr[i]);
				}
				$.ajax({
				    type: "POST",
				    url: 'createTables.php',
				    data: {pokeQueryArr:pokeQueryArr},
				
				    complete: function (data) {
				    $('#genEntriesMessage').innerHTML(data);
			           console.log(data);
			        }
				});
				$.post('./createTables.php', pokeQueryArr, function(res) {
					console.log("Response: " + res);
				});
			});
		});
	</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="content-header">
				<h1>PHP Pokedex Database!</h1>
				<p>by Kyle Provencher</p>
			</div>
			<form action="createTables.php" method="POST">
				<input type="submit" name="genTables" value="Generate Tables"/>
			</form>
			<button id="genEntriesBtn">Generate Entries</button>
			<p id="genEntriesMessage"></p>
			<form class="pokeform" action="handleNewPokemon.php" method="POST">
				New Pokemon:
				<label for="pokename">Name: <input name="pokename"/></label>
				<label for="poketype">Type: <input name="poketype"/></label>
				<label for="pokeheight">Height(m): <input name="pokeheight"/></label>
				<label for="pokeweight">Weight(kg): <input name="pokeweight"/></label>
				<label for="pokeability">Ability: <input name="pokeability"/></label>
				<input type="submit" value="PokeSubmit" name="submit"/>
			</form>
			<div id="dbMessages"><?php if(isset($_GET['message'])) { echo "<p>" . $_GET['message'] . "</p>"; } ?></div>
			<form class="pokeform" action="searchPokemon.php" method="GET">
				Find a Pokemon!
				<label for="pokename">Name: <input name="pokename"/></label>
				<input type="submit" value="Search"/>
			</form>
			
			<div class="images">
				<div class="modal" id="modalWindow">
					<div class="modal-content">
					</div>
				</div>
			</div>
		</div>
		<script>
			window.onclick = function(event){
				var modal = document.getElementById("modalWindow");
				if (event.target == modal){
					modal.style.display = "none";
				}
			}
		</script>
	</body>
</html>