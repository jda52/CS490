<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    if(isset($response['ExamID'])) $exID = $response['ExamID'];
    if(isset($response['QID'])) $qid = $response['QID'];
    if(isset($response['Points'])) $points = $response['Points'];

    $query = "INSERT INTO Exam_Questions_Map (ExamID, QID, Points) VALUES ($exID, $qid, $points)";

    $add = $mycnx->query($query);
    if (!$add)
    {
        $response = array('response' => "Error " . $query . "<br>" . $conn->error);
    }
    else
    {
        $response = array('response' => 'Question added to Exam');
    }
    $json_res = json_encode($response);
    echo $json_res;
    $mycnx->close();
?>