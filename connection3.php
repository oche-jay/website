<?php
    require('db.php');

    $email;    
    //POST variables to be stored in DB
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $email  = test_input($_GET["email"]);
    }

    $sql = "INSERT INTO experiment_draw_participants 
    (email)
    VALUES ('$email')";

    if ($conn->query($sql) === TRUE) {
        header( 'Location: goodbye.php' ) ; 
        $done = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>