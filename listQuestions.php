<?php
    include "dbcnx.php";

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    $com = "SELECT * FROM Question_Bank";
    $result = $mycnx->query($com);

    $arr = [];
    while($row = $result->fetch_assoc())
    {
        $arr[] = array('quest'=> $row['Question'], 'QID' => $row['QID'], 'topic' => $row['topic']);
    }
    $json_res = json_encode($response);
    echo $json_res;
?>