<?php
    include "dbcnx.php";

    if(isset($response['Username'])) $user = $response['Username'];
    if(isset($response['ExamID'])) $exam = $response['ExamID'];

    $query = "SELECT Student_Results.Answer, Question_Bank.Question FROM Student_Results, Question_Bank 
               WHERE Student_Results.ExamID = $exam AND Username = $user AND Student_Results.QID = Question_Bank.QID";
    #$query2 = 'SELECT * FROM Exam_Question_Map WHERE ExamID = $exam';
    $result = $mycnx->query($query);
    $arr = [];
    while($row = $result->fetch_assoc())
    {
        $arr[] =  array('Question' => $row['Question_Bank.Question'], 'Answer' => $row['Student_Results.Answer']);
    }
    echo json_encode($arr);
?>