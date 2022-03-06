<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    if(isset($response['Username'])) $user = "'".$response['Username']."'";
    if(isset($response['Answers'])) $answers = $response['Answers'];
    if(isset($response['questions'])) $questions = $response['questions'];
    if(isset($response['ExamID'])) $exam = $response['ExamID'];
    if(isset($response['examName'])) $examName = "'".$response['examName']."'";
    
    $indices = count($questions);
    
    $query1 = "INSERT INTO Student_Exams (Username, ExamID, Exam_Name) VALUES ($user, $exam, $examName)";
    $add = $mycnx->query($query1);
    $status = true;
    for ($x = 0; $x < $indices; $x++)
    {
        $iteration = $questions[$x];
        $QID = $iteration['qid'];
        $answer = $iteration['answer'];
        $query = "INSERT INTO Student_Results (Username, ExamID, QID, Answer) VALUES ($user, $exID, $QID, $answer)";
        $add = $mycnx->query($query);
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
      $response = array('response' => 'Exam submitted successfully');
    }
    echo json_encode($response);
?>