<?php
    include "dbcnx.php";

    if(isset($response['Username'])) $user = $response['Username'];
    if(isset($response['ExamID'])) $exam = $response['ExamID'];
    if(isset($response['results'])) $results = $response['results'];
    
    $indices = count($results);
    $status = true;
    
    for ($x = 0; $x < $indices; $x++)
    {
        $iteration = $results[$x];
        $qid = $iteration['question_id'];
        $score = $iteration['score'];
        $funcScore = intval($score['correct_function_name']);
        $tc1Score = intval($score['testcase_1']);
        $tc2Score = intval($score['testcase_2']);
        $totalScore = $funcScore + $tc1Score + $tc2Score;
        $query = "UPDATE Student_Results SET Fuction_Score = $funcScore, TC1_Score = $tc1Score, TC2_Score = $tc2Score, Score = $totalScore, Comments = $comment WHERE Username = $user, ExamID = $exam, QID = $qid";
        
        $update = $mycnx->query($query);
        if (!$update)
        {
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
?>