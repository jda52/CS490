<?php
    $server = "sql1.njit.edu";
    $username = "jda52";
    $password = '3Tdb$h90+&';
    $dbName = "jda52";

    $mycnx = mysqli_connect($server, $username, $password, $dbName);

    if ($mycnx->connect_error)
    {
        die("connection failure: " . $mycnx->connect_error);
    }
?>