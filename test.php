<?php
//////////////////
//DATABASE QUERY//
//////////////////

$input = $_POST['typerequest'];

//for github i had to hide my credentials here =)
$servername = "localhost";
$username = "dummy";
$password = "dummy";
$dbname = "dummy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//SELECT species_id,flavor_text FROM pokedex_descriptions GROUP BY species_id

// QUERIES //
// SELECT id, identifier FROM pokemon WHERE id<5
$sql = "";
if ($input == "Get_Pokemon"){
    $sql = "SELECT id, identifier FROM pokemon";
} else if ($input == "Get_Description") {
    $sql = "SELECT species_id,flavor_text FROM pokedex_descriptions GROUP BY species_id";
}


$result = $conn->query($sql);


$rPokemonList = array();


if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {	 
		if ($input == "Get_Pokemon"){
		    array_push($rPokemonList, array($row["id"],$row["identifier"]));
		} elseif ($input == "Get_Description") {
		    array_push($rPokemonList, array($row["species_id"],$row["flavor_text"]));
		
		}
		
    }

} else {
    echo "0 results";
}

//print_r($rPokemonList);

//$jsonenc = json_encode($rPokemonList);
//print_r($jsonenc);
//echo $jsonenc;

echo json_encode($rPokemonList);


$conn->close();


?>
