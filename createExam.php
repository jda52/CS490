<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    $rowQue = "SELECT * FROM Exam_Questions_Map";
    $rows = mysql_num_rows($rowQue);
    
    $teacher = "";
    $exID = $rows + 1;
    $query = "INSERT INTO Exam_Questions_Map (Instructor,ExamID) VALUES ($teacher,$exID)";

    $add = $mycnx->query($query);
    if (!$add)
    {
        echo "Error " . $query . "<br>" . $conn->error;
    }
    else
    {
        echo 'Question added';
    }
?>