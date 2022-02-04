<?php
    function hashPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $hashedPassword;
    }
    
    function checkPassword($result, $user, $password)
    {
        $success = False;
        while($row = $result->fetch_assoc())
        {
            if ($user == $row['Username'] and password_verify($password, $row['Password']))
            {
                echo $row['Status']. '<br>';
                $success = True;
            }
        }
        if ($success == False)
        {
            echo 'Incorrect <br>';
        }
    }

    $str_json = file_get_contents("php://input"); 
    $response = json_decode($str_json, true);

    $name="none";$pass="none";

    if(isset($response['username'])) $name = $response['username'];
    if(isset($response['password'])) $pass = $response['password'];

    $mycnx = mysqli_connect('sql1.njit.edu', 'jda52', '3Tdb$h90+&', "jda52");

    if ($mycnx->connect_error)
    {
        die("connection failure: " . $mycnx->connect_error);
    }

    $com = "SELECT * FROM Login";
    $result = $mycnx->query($com);

    $use = 'Mka84';
    $test = 'Hl)(347^*%';
    checkPassword($result, $use, $test);
    print $name  . $pass;
    echo $name . "<br>" . $pass;
    $mycnx->close();
?>