<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);
    
    if(isset($response['student_id'])) $user = $response['student_id'];
    if(isset($response['exam_id'])) $exam = intval($response['exam_id']);
    #$user = 'student';
    #$exam = 89;
    $query = "SELECT * FROM ((Student_Results
              INNER JOIN Exam_Questions_Map ON Student_Results.ExamID = Exam_Questions_Map.ExamID AND Student_Results.QID = Exam_Questions_Map.QID) 
              INNER JOIN Question_Bank ON Student_Results.QID = Question_Bank.QID)";

    $result = $mycnx->query($query);
    $arr = [];

    while($row = $result->fetch_assoc())
    {
        if ($row['Username'] == $user AND  $row['ExamID'] == $exam)
        {   
          $arr[] =  array('question_id' => $row['QID'], 'question' => $row['Question'], 'student_answer' => $row['Answer'], 'Func_Score'  => $row['Function_Score'], 'TC_Results' => $row['TC_Scores'], 'Constraint_Score' => $row['Constraint_Score'], 'testcases' => $row['TestCase'], 'points' => $row['Points'], 'comments'=> $row['Comments'], 'Output' => $row['Output'], 'constraint' => $row['Const'], 'tc_num' => $row['TestCase_Count'], 'Score' => $row['Score'], 'Call' => $row['Func_Call'], 'hasConstraint' => $row['hasConstraint']);
        }
    }
    echo json_encode($arr);
    $mycnx->close();
?>