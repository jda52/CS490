<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    foreach($response as $entry)
    {
        $user = $entry['Username'];
        $exID = $entry['ExamID'];
        $QID = $entry['QID'];
        $answer = $entry['Answer'];
        $query = "INSERT INTO Student_Results (Username, ExamID, QID, Answer) VALUES ($user, $exID, $QID, $answer)";
        $add = $mycnx->query($query);
    }

    $response = array('response' => 'Exam submitted successfully');
    echo json_encode($response);
?>