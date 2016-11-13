<?php
    require('db.php');

    $age ;
    $gender ;
    $corr ;
    $worn ;
    $screen ;
    $size =  "";
    $res =  "";
    $usage =  "";
    $energy_saving_attitude  ;
    $environmental_impact    ;
    $keep_costs_down ;
    $protect_environment ;
    $not_wasteful    ;
    $following_rules ;
    $motivating_others   ;
    $impressing_others   ;
    $energy_motivation7  ;
    $energy_motivation7_detail ; 

 
    //POST variables to be stored in DB
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $age = test_input($_POST["age"]);
        $gender =  test_input($_POST["gender"]);
        $corr = test_input($_POST["correction"]);
        $worn = test_input($_POST["worn"]);
        $screen = test_input($_POST["screen"]);
        $size = test_input($_POST["screen_size"]);
        $res = test_input($_POST["screen_res"]);
        $usage = test_input($_POST["screen_usage"]);
        $screen_hours = test_input($_POST["screen_hours"]);
        $energy_saving_attitude  = test_input($_POST["energy_saving_attitude"]);
        $environmental_impact    = test_input($_POST["environmental_impact"]);
        $keep_costs_down = test_input($_POST["keep_costs_down"]);
        $protect_environment = test_input($_POST["protect_environment"]);
        $not_wasteful    = test_input($_POST["not_wasteful"]);
        $following_rules = test_input($_POST["following_rules"]);
        $motivating_others   = test_input($_POST["motivating_others"]);
        $impressing_others   = test_input($_POST["impressing_others"]);
        $energy_motivation7  = test_input($_POST["energy_motivation7"]);
        $energy_motivation7_detail = test_input($_POST["energy_motivation7_detail"]);  
    }

    echo "<table>";


    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    };

    $sql = "INSERT INTO experiment_userinfo 
    (session_id, 
        age, 
        gender, 
        eye_correction_required, 
        eye_correction_worn, 
        type_of_screen, 
        size_of_screen, 
        resolution, 
        usage_ratio,
        screen_hours,
        energy_saving_attitude,
        environmental_impact,
        keep_costs_down,
        protect_environment,
        not_wasteful,
        following_rules,
        motivating_others   ,
        impressing_others   ,
        energy_motivation7  ,
        energy_motivation7_detail
        )
    VALUES ('$session_id', 
        '$age', 
        '$gender', 
        '$corr', 
        '$worn', 
        '$screen', 
        '$size', 
        '$res', 
        '$usage',
        '$screen_hours',
        '$energy_saving_attitude',
        '$environmental_impact',
        '$keep_costs_down',
        '$protect_environment',
        '$not_wasteful',
        '$following_rules',
        '$motivating_others',
        '$impressing_others',
        '$energy_motivation7',
        '$energy_motivation7_detail'
        )";

    if ($conn->query($sql) === TRUE) {
        header( 'Location: video.php' ) ; 
        $done = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
