<?php
    include "dbcnx.php";

    #var_dump(file_get_contents("php://input"));
    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);
    if(isset($response['examName'])) $exam = "'".$response['examName']."'";
    if(isset($response['questions'])) $questions = $response['questions'];
    #if(isset($response['qid'])) $qid = $response['qid'];
    #if(isset($response['points'])) $points = $response['points'];
    $indices = count($questions);
    $query1 = "INSERT INTO Exam_Bank (Exam_Name) VALUES ($exam)";

    $add = $mycnx->query($query1);
    if (!$add)
    {
        $response = array('response' => "Error " . $query . "<br>" . $conn->error);
    }

    $query2 = "SELECT MAX(ExamID) FROM Exam_Bank";
    $result = $mycnx->query($query2);
    $row = mysqli_fetch_array($result);
    $status = true;
    for ($x = 0; $x < $indices; $x++)
    {
        $iteration = $questions[$x];
        $qid = $iteration['qid'];
        $points = $iteration['points'];
        $query3 = "INSERT INTO Exam_Questions_Map (ExamID, QID, Points) VALUES ($row[0], $qid, $points)";
        $add = $mycnx->query($query3);
        if (!$add)
        {
            break;
        }
    }
    if($status = false)
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