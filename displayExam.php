<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    if(isset($response['ExamID'])) $exID = $response['ExamID'];
    $query1 = 'SELECT * FROM Exam_Questions_Map WHERE ExamID = $exID';

    $result1 = $mycnx->query($query1);
    $arrRes = array();
    while($row = $result1->fetch_assoc())
    {
        $arrRes[] = $row['QID'];
    }
    $arrRes = implode("','",$arrRes);
    $query2 = "SELECT * FROM Question_Bank Where QID in ('".$arrRes."')";
    $result2 = $mycnx->query($query2);

    $questions = array();
    while($row = $result2->fetch_assoc())
    {
        $questions[] = array('Question'=> $row['Question'], 'QID' => $row['QID'], 'topic' => $row['Topic']);
    }
    echo json_encode($questions);
    
?>