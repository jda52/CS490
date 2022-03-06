<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input");
    $response = json_decode($str_json, true);

    
    if(isset($response['Topic'])) $topic = "'".$response['Topic']."'";
    if(isset($response['Question'])) $quest = "'".$response['Question']."'";
    if(isset($response['TestCase'])) $tc = "'".$response['TestCase']."'";
    #if(isset($response['Input1'])) $input1 = $response['Input1'];
    #if(isset($response['Input2'])) $input2 = $response['Input2'];
    #if(isset($response['Output1'])) $output1 = $response['Output1'];
    #if(isset($response['Output2'])) $output2 = $response['Output2'];
    if(isset($response['Difficulty'])) $diff = "'".$response['Difficulty']."'";
    

    $query = "INSERT INTO Question_Bank (Topic, Question, TestCase, Difficulty) VALUES ($topic, $quest, $tc, $diff)";
    $add = $mycnx->query($query);
    if (!$add)
    {
        $response = array('response' => "Error " . $query . "<br>" . $conn->error);
    }
    else
    {
        $response = array('response' => 'Question added');
    }
    $json_res = json_encode($response);
    echo $json_res;
    $mycnx->close();
?>