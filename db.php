<?php
session_start();


function test_input($data) {
	if (!empty($data))
	{
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	}
	else $data = 0;
	return $data;
} 

$session_id = session_id();
$servername = "ooe.host.cs.st-andrews.ac.uk";
$username = "ooe";
$password = "d1UP7!R759h1Mj";
$dbname = "ooe_experiment";

        // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
} 
?>
