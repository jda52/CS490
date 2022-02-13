<?php
    include "dbcnx.php";

    function hashPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $hashedPassword;
    }
    
    function checkPassword($result, $user, $password)
    {
        $status = 'invalid';
        while($row = $result->fetch_assoc())
        {
            if ($user == $row['Username'] and password_verify($password, $row['Password']))
            {
                $status = $row['Status'];
                $success = True;
            }
        }
        return $status;
    }

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    $name="none";$pass="none";

    if(isset($response['username'])) $name = $response['username'];
    if(isset($response['password'])) $pass = $response['password'];

    $com = "SELECT * FROM Login";
    $result = $mycnx->query($com);

    $stat = checkPassword($result, $name, $pass);
    $response = array('role' => $stat);
    $json_res = json_encode($response);
    echo $json_res;
    $mycnx->close();
?>
