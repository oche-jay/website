<?php
    $partid = $_GET['partid'];
    $dist = $_GET['dist'];
    
    $myfile = fopen("data/".$partid."_".$dist.".csv", "a") or die("File could not be opened");
    
    foreach($_POST as $key=>$value) {
        fwrite($myfile, $value . ",");
    }
    fclose($myfile);
    
    
?>
