<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    #if(isset($response['ExamID'])) $exID = $response['ExamID'];
    /*
    $query1 = "SELECT * FROM Exam_Questions_Map WHERE ExamID = $exID";
    $result1 = $mycnx->query($query1) or die($conn->error);
    
    $arrRes = array();
    while($row = $result1->fetch_assoc())
    {
        $arrRes[] = $row['QID'];
    }
    $arrRes = implode("','",$arrRes);
    $query2 = "SELECT * FROM Question_Bank Where QID in ('".$arrRes."')";
    */
    $exID = 2;
    
    #$query = "SELECT Question_Bank.Question, Question_Bank.Topic FROM Question_Bank WHERE Exam_Questions_Map.ExamID = $exID AND Question_Bank.QID = Exam_Questions_Map.QID";
    $query = "SELECT Question_Bank.Question, Question_Bank.Topic FROM Question_Bank, Exam_Questions_Map WHERE Question_Bank.QID = Exam_Questions_Map.QID AND Exam_Questions_Map.ExamID = $exID";
    $result = $mycnx->query($query);

    $questions = array();
    while($row = $result->fetch_assoc())
    {
        echo print_r($row). '<br>';
        #$questions[] = array('Question'=> $row['Question'], 'QID' => $row['QID'], 'topic' => $row['Topic']);
    }
    echo json_encode($questions);
    
?>