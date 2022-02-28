<?php
    include "dbcnx.php";

    if(isset($response['Score'])) $score = $response['Score'];
    if(isset($response['Comments'])) $comment = $response['Comments'];
    if(isset($response['Username'])) $user = $response['Username'];
    if(isset($response['ExamID'])) $exam = $response['ExamID'];
    if(isset($response['QID'])) $QID = $response['QID'];

    $query = "UPDATE Student_Results SET Score = $score, Comments = $comment WHERE Username = $user, ExamID = $exam, QID = $QID";
    $update = $mycnx->query($query);
    if (!$add)
    {
        $response = array('response' => "Error " . $query . "<br>" . $conn->error);
    }
    else
    {
        $response = array('response' => 'Student result updated');
    }
    echo json_encode($response);
?>