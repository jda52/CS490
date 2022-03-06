<?php

    include "dbcnx.php";

    $user = 'student';
    $exam = 2;

    $query = "SELECT Student_Results.Answer, Question_Bank.Question FROM Student_Results, Question_Bank 
              WHERE Question_Bank.QID = Student_Results.QID AND Student_Results.ExamID = $exam
              AND Student_Results.Username = '". $user. "'";
    #$query = "SELECT Student_Results.Answer AND Question_Bank.Question FROM Student_Results, Question_Bank
              #WHERE Student_Results.ExamID = $exam AND Student_Results.QID = Question_Bank.QID";
    $result = $mycnx->query($query);
    while($row = $result->fetch_assoc())
    {
        echo print_r($row). '<br>';
        #$arr2[] = array('Question'=> $row['Question'], 'QID' => $row['QID']);
    }
    #echo json_encode($arr);
/*
    $str_json = '{"query":"insert_exam","examName":"Exam 2","questions":[{"qid":"14","points":"75"},{"qid":"15","points":"25"}]}';
    $response = json_decode($str_json, true);

    $questions = $response['questions'];
    $indices = count($questions);
    for ($x = 0; $x < $indices; $x++)
    {
        echo $questions[$x]['qid'];
    } 
    */
?>