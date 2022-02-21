<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    $type = "";
    $quest = "";
    $input = "";
    $output = "";
    $diff = "";
    $questID = "";

    $query = "INSERT INTO Question_Bank (Topic, Question, Input, Output, Difficulty, ID) VALUES ($type, $quest, $input, $output, $diff, $questID)";
    $add = $mycnx->query($query);
    if (!$add)
    {
        echo "Error " . $query . "<br>" . $conn->error;
    }
    else
    {
        echo 'Question added';
    }
    
?>