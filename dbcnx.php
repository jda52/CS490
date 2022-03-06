<?php
    
    $mycnx = mysqli_connect('sql1.njit.edu', 'jda52', '3Tdb$H90+&', "jda52");

    if ($mycnx->connect_error)
    {
        die("connection failure: " . $mycnx->connect_error);
    }
?>