<?php
    include "dbcnx.php";
    
    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);
    
    if(isset($response['user_id'])) $user = "'".$response['user_id']."'";
    if(isset($response['exam_id'])) $exam = intval($response['exam_id']);
    if(isset($response['results'])) $results = $response['results'];
    

    $indices = count($results);
    $status = true;
    
    for ($x = 0; $x < $indices; $x++)
    {
        $iteration = $results[$x];
        $qid = intval($iteration['question_id']);
        $score = $iteration['score'];
        $output = "'".$score['student_out']."'";
        $tcScores = "'".$score['points_earned']."'";
        $comment = "'".$score['comments']."'";
        $funcScore = floatval($score['correct_function_name']);
        $constScore = floatval($score['constraint_check']);
        $totalScore = floatval($score['total_points']);
        $query = "UPDATE Student_Results SET Function_Score= $funcScore, TC_Scores= $tcScores, Constraint_Score = $constScore, Score= $totalScore, Output = $output, Comments = $comment WHERE Username= $user AND ExamID= $exam AND QID= $qid";
        
        
        $update = $mycnx->query($query);
        if (!$update)
        {
            echo mysqli_error($mycnx);
            $status = !$status;
            break;
        }
    }
    if (!$status)
    {
        $response = array('response' => "Error " . $query . "<br>" . $conn->error);
    }
    else
    {
        $response = array('response' => 'Student result updated');
    }
    echo json_encode($response);
    $mycnx->close();
?>