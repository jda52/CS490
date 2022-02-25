<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);
    
    if(isset($response['Instructor'])) $instructor = $response['Instructor'];

    $query = "INSERT INTO Exam_Questions_Map (Instructor) VALUES ($instructor)";

    $add = $mycnx->query($query);
    if (!$add)
    {
        $response = array('response' => "Error " . $query . "<br>" . $conn->error);
    }
    else
    {
        $response = array('response' => 'Exam Created');
    }
    $json_res = json_encode($response);
    echo $json_res;
    $mycnx->close();
?>