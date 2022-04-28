<?php
    include "dbcnx.php";
    
    
    #$str_json = '"{"user_id":"student","exam_id":"143","results":[{"question_id":"128","question":"Write a function oper that takes an operation and two integers. It will then perform the operation on the two integers and return the result.","constraint":"","student_answer":"def oper(op, a, b):\r\n\tif op == \"+\":\r\n\t\treturn a+b\r\n\tif op == \"-\":\r\n\t\treturn a-b\r\n\tif op ==\"*\":\r\n\t\treturn a*b\r\n\treturn a\/b","tc_num":"3","score":{"correct_function_name":"5","constraint_check":"0","hasConstraint":"False","expected":"{\"expected_1\":\"8\",\"expected_2\":\"1\",\"expected_3\":\"25\"}","points_earned":"{\"testcase_1\":\"5\",\"testcase_2\":\"5\",\"testcase_3\":\"55\"}","student_out":"{\"student_out_1\":\"8\",\"student_out_2\":\"1\",\"student_out_3\":\"25\"}","function_call":"{\"function_call_1\":\"oper(\'+\',3,5)\",\"function_call_2\":\"oper(\'-\',2,1)\",\"function_call_3\":\"oper(\'*\',5,5)\"}","total_points":20,"comments":""},"Final_Func":"5","Manual_Results":{"testcase_1":"5","testcase_2":"5","testcase_3":"5"},"Final_Constraint":"0","Score":"20"}],"query":"manual_grade"}"';
    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);
    
    if(isset($response['user_id'])) $user = "'".$response['user_id']."'";
    if(isset($response['exam_id'])) $exam = intval($response['exam_id']);
    if(isset($response['results'])) $results = $response['results'];
    echo $results;

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
        $call = "'".$score["function_call"]."'";
        $hasConstraint = "'".$score["hasConstraint"]."'";
        $query = "UPDATE Student_Results SET Function_Score= $funcScore, TC_Scores= $tcScores, Constraint_Score = $constScore, Score= $totalScore, Output = $output, Comments = $comment, Func_Call = $call, hasConstraint = $hasConstraint WHERE Username= $user AND ExamID= $exam AND QID= $qid";
        
        
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