<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    if(isset($response['user_id'])) $user = "'".$response['user_id']."'";
    if(isset($response['exam_id'])) $exam = $response['exam_id'];
    if(isset($response['questions'])) $questions = $response['questions'];
    
    
    $indices = count($questions);
    #$query1 = "INSERT INTO Student_Exams (Username, ExamID, Exam_Name) VALUES ($user, $exam, $examName)";
    #$add = $mycnx->query($query1);
    $status = true;
    for ($x = 0; $x < $indices; $x++)
    {
        
        $iteration = $questions[$x];
        $QID = $iteration['question_id'];
        $answer = "'".$iteration['answer']."'";
        #query3 = "INSERT INTO Exam_Questions_Map (ExamID, QID, Points) VALUES ($row[0], $qid, $points)";
        $query = "INSERT INTO Student_Results (Username, ExamID, QID, Answer) VALUES ($user, $exam, $QID, $answer)";
        $add = $mycnx->query($query);
        if (!$add)
        {
            $status = !$status;
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
    $mycnx->close();
?>