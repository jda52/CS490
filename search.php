<?php
  include "dbcnx.php";
  
  if(isset($response['keyword'])) $keyword = "'".$response['keyword']."'";
  
  $com = "SELECT * FROM Question_Bank where Question LIKE '%$keyword%'";
  $result = $mycnx->query($com);
  while($row = $result->fetch_assoc())
  {
    $arr[] = array('Question'=> $row['Question'], 'QID' => $row['QID']);
  }
  $json_res = json_encode($arr);
  echo $json_res;
  $mycnx->close();
?>