<?php
   include "dbcnx.php";

   #$str_json = file_get_contents("php://input"); 
   #$response = json_decode($str_json, true);
   
   $com = "SELECT * FROM Login WHERE status = 'Student'";
   $result = $mycnx->query($com);
   
   $arr = [];
   while($row = $result->fetch_assoc())
   {
     $arr[] = array('Username' => $row['Username']);
   }
   echo json_encode($arr);
?>