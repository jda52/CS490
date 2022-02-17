<?php
    include "dbcnx.php";

    $type = "";
    $quest = "";
    $input = "";
    $output = "";
    $diff = "";
    $questID = "";

    $query = "INSERT INTO Question Bank (Type, Question, Input, Output, Difficulty, ID) VALUES";
    $add = $mycnx->query($query);
    if (!$add)
    {
        echo "Error " . $query . "<br>" . $conn->error;
    }
    
?>