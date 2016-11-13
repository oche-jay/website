<?php
    require('db.php');

    $money_saving_attitude;
    $environmental_impact;
    
    //POST variables to be stored in DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $money_saving_attitude  = test_input($_POST["money_saving_attitude"]);
        $video_energy_saving_attitude = test_input($_POST["video_energy_saving_attitude"]);    
    }

    $sql = "INSERT INTO experiment_userinfo2 
    (session_id, 
        money_saving_attitude,
        video_energy_saving_attitude
        )
    VALUES ('$session_id', 
        '$money_saving_attitude',
        '$video_energy_saving_attitude'
        )";

    if ($conn->query($sql) === TRUE) {
        header( 'Location: goodbye.php' ) ; 
        $done = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>