<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);
    
    if(isset($response['student_id'])) $user = $response['student_id'];
    if(isset($response['exam_id'])) $exam = intval($response['exam_id']);

     $query = "SELECT * FROM ((Student_Results
              INNER JOIN Exam_Questions_Map ON Student_Results.ExamID = Exam_Questions_Map.ExamID AND Student_Results.QID = Exam_Questions_Map.QID) 
              INNER JOIN Question_Bank ON Student_Results.QID = Question_Bank.QID)";

    $result = $mycnx->query($query);
    $arr = [];

    while($row = $result->fetch_assoc())
    {
        if ($row['Username'] == $user AND  $row['ExamID'] == $exam)
        {   
          $arr[] =  array('question_id' => $row['QID'], 'question' => $row['Question'], 'student_answer' => $row['Answer'], 'Func_Score'  => $row['Function_Score'], 'TC1' => $row['TC1_Score'], 'TC2' => $row['TC2_Score'], 'testcases' => $row['TestCase'], 'points' => $row['Points'], 'comments'=> $row['Comments'], 'Student_output1' => $row['Output1'], 'Student_output2' => $row['Output2']);
        }
    }
    echo json_encode($arr);
    $mycnx->close();
?>