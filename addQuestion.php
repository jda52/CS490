<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    $topic = "";
    $quest = "";
    $input1 = "";
    $output1 = "";
    $input2 = "";
    $output2 = "";
    $diff = "";
    

    $query = "INSERT INTO Question_Bank (Topic, Question, Input1, Output1, Input2, Output2, Difficulty) VALUES ($type, $quest, $input1, $output1, $input2, $output2, $diff)";
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