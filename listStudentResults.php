<?php
    include "dbcnx.php";

    #if(isset($response['Username'])) $user = $response['Username'];
    #if(isset($response['ExamID'])) $exam = $response['ExamID'];
    $user = 'student';
    $exam = 2;
    #$query = "SELECT * FROM ((Student_Results
    #          INNER JOIN Exam_Questions_Map ON Student_Results.ExamID = Exam_Questions_Map.ExamID) 
     #         INNER JOIN Question_Bank ON Student_Results.QID = Question_Bank.QID)";
     $query = "SELECT * FROM ((Student_Results
              INNER JOIN Exam_Questions_Map ON Student_Results.ExamID = Exam_Questions_Map.ExamID AND Student_Results.QID = Exam_Questions_Map.QID) 
              INNER JOIN Question_Bank ON Student_Results.QID = Question_Bank.QID)";
    #$query2 = 'SELECT * FROM Exam_Question_Map WHERE ExamID = $exam';
    $result = $mycnx->query($query);
    $arr = [];
    while($row = $result->fetch_assoc())
    {
        if ($row['Username'] == $user AND  $row['ExamID'] == $exam)
        {   
          $arr[] =  array('question_id' => $row['QID'], 'question' => $row['Question'], 'student_answer' => $row['Answer'], 'testcases' => $row['TestCase'], 'points' => $row['Points']);
        }
    }
    echo json_encode($arr);
?>