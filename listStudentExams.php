<?php
  include "dbcnx.php";
   
  $str_json = file_get_contents("php://input"); 
  $response = json_decode($str_json, true);
   
  $com = "SELECT * FROM Student_Exams";
  $result = $mycnx->query($com);

  $arr = [];
  while($row = $result->fetch_assoc())
  {
    $arr[] = array('Student'=> $row['Username'], 'ExamID' => $row['ExamID'], 'ExamName' => $row['Exam_Name']);
  }
  $json_res = json_encode($arr);
  echo $json_res;
  $mycnx->close();
?>