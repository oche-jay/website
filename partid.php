<?php
    require('db.php');
    // $json = json_decode(file_get_contents("php://input"),true);
    // var_dump($json);

    // var_dump($_POST);

//     CREATE TABLE `experiment_ratings` (
//   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
//   `session_id` text COLLATE utf8_bin,
//   `video` varchar(11) COLLATE utf8_bin DEFAULT NULL,
//   `rating` int(11) DEFAULT NULL,
//   `video_url` text COLLATE utf8_bin,
//   `json_summary` text COLLATE utf8_bin,
//   `adaptation_profile` text COLLATE utf8_bin,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

    $session_id= "";
    $video= "";
    $rating= "";
    $video_url = "";
    $adaptation_profile = "";
    $json_summary ="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $json_summary = test_input($_POST['js']);
        $session_id = test_input($_POST['session_id']);
        $video = test_input($_POST['video']);
        $rating = test_input($_POST['rating']);
        $url = test_input($_POST['url']);
        $adaptation_profile =  test_input($_POST['profile']);
        $unhappiness =  test_input($_POST['unhappiness_events']);
        $happiness =  test_input($_POST['happiness_events']);
      
        $file = fopen("summary.json","a") or die("unable to open file!");

        fwrite($file, $json_summary);
        fclose($file);

        $sql = "INSERT INTO experiment_ratings (
        session_id, 
        video, 
        rating, 
        video_url,
        adaptation_profile,
        json_summary,
        unhappiness_events,
        happiness_events
        )
        VALUES (
        '$session_id', 
        '$video', 
        '$rating', 
        '$url', 
        '$adaptation_profile', 
        '$json_summary',
        '$unhappiness',
        '$happiness'
        )";

    if ($conn->query($sql) === TRUE) {
        header( 'Location: video.php' ) ; 
        $done = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    }
?>
