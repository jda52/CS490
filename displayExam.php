<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    if(isset($response['exam_id'])) $exam = $response['exam_id'];
    
    $query = "SELECT Question_Bank.Question, Question_Bank.Topic, Question_Bank.QID, Exam_Questions_Map.Points FROM Question_Bank, Exam_Questions_Map WHERE Question_Bank.QID = Exam_Questions_Map.QID AND Exam_Questions_Map.ExamID = $exam";
    $result = $mycnx->query($query);

    $questions = array();
    while($row = $result->fetch_assoc())
    {
        $questions[] = array('Question'=> $row['Question'], 'QID' => $row['QID'], 'topic' => $row['Topic'], 'points' =>$row['Points']);
    }
    echo json_encode($questions);
    
?>