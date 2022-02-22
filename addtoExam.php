<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    $exID = "";
    $qid = "";
    $query = "INSERT INTO Exam_Questions_Map (ExamID, QID) VALUES ($exID, $qid)";

    $add = $mycnx->query($query);
    if (!$add)
    {
        echo "Error " . $query . "<br>" . $conn->error;
    }
    else
    {
        echo 'Exam added';
    }
?>