<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    if(isset($response['user_id'])) $user = "'".$response['user_id']."'";
    if(isset($response['exam_id'])) $exam = $response['exam_id'];
    if(isset($response['questions'])) $questions = $response['questions'];
    
    $query1 = "DELETE FROM Student_Results WHERE Username = $user AND ExamID = $exam";
    #$query1 = "SELECT Username, ExamID FROM Student_Results WHERE Username = $user AND ExamID = $exam";
    $delete = $mycnx->query($query1);
    
    $indices = count($questions);
    $status = true;
    for ($x = 0; $x < $indices; $x++)
    { 
        $iteration = $questions[$x];
        $QID = $iteration['question_id'];
        $answer = "'".$iteration['answer']."'";
        $query = "INSERT INTO Student_Results (Username, ExamID, QID, Answer) VALUES ($user, $exam, $QID, $answer)";
        $add = $mycnx->query($query);
        if (!$add)
        {
            $status = !$status;
            break;
        }
    }        
        /*        
    if($rows > 0)
    {
      for ($x = 0; $x < $indices; $x++)
      {  
        $iteration = $questions[$x];
        $QID = $iteration['question_id'];
        $answer = "'".$iteration['answer']."'";
        $query = "UPDATE Student_Results SET Answer = $answer WHERE Username = $user AND ExamID = $exam AND QID = $QID";
        $add = $mycnx->query($query);
        if (!$add)
        {
            $status = !$status;
            break;
        }
      }
    }
    else
    {
      for ($x = 0; $x < $indices; $x++)
      { 
        $iteration = $questions[$x];
        $QID = $iteration['question_id'];
        $answer = "'".$iteration['answer']."'";
        $query = "INSERT INTO Student_Results (Username, ExamID, QID, Answer) VALUES ($user, $exam, $QID, $answer)";
        $add = $mycnx->query($query);
        if (!$add)
        {
            $status = !$status;
            break;
        }
      }
    }
    */    
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