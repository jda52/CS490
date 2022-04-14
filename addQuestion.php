<?php
    include "dbcnx.php";

    //$str_json = '{"query":"create_question","Topic":"for-loop","Question":"Write a function iterate that loops over an array.","TestCase":"{\"Input1\":[\"20\"],\"Output1\":[\"10\"],\"Input2\":[\"30\"],\"Output2\":[\"15\"],\"Input3\":[\"15\"],\"Output3\":[\"50\"],\"Input4\":[\"15\"],\"Output4\":[\"1\"],\"Input5\":[\"\"],\"Output5\":[null]}","Difficulty":"Hard","Constraint":"for","TestCaseCount":"4"}';
    $str_json = file_get_contents("php://input");
    $response = json_decode($str_json, true);
    echo $str_json;
    
    if(isset($response['Topic'])) $topic = "'".$response['Topic']."'";
    if(isset($response['Question'])) $quest = "'".$response['Question']."'";
    if(isset($response['TestCase'])) $tc = "'".$response['TestCase']."'";
    if(isset($response['Difficulty'])) $diff = "'".$response['Difficulty']."'";
    if(isset($response['TestCaseCount'])) $tcCount = $response['TestCaseCount'];
    if(isset($response['Constraint'])) $constraint = "'".$response['Constraint']."'";

    $query = "INSERT INTO Question_Bank (Topic, Question, TestCase, Difficulty, TestCase_Count, Const) VALUES ($topic, $quest, $tc, $diff, $tcCount, $constraint)";
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