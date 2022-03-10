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
        $comment = "'".$score['comments']."'";
        $funcScore = floatval($score['correct_function_name']);
        $tc1Score = floatval($score['testcase_1']);
        $tc2Score = floatval($score['testcase_2']);
        $totalScore = $funcScore + $tc1Score + $tc2Score;
        $query = "UPDATE Student_Results SET Function_Score= $funcScore, TC1_Score= $tc1Score, TC2_Score= $tc2Score, Score= $totalScore, Comments = $comment WHERE Username= $user AND ExamID= $exam AND QID= $qid";
        
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