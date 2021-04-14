<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'roott';
    $dbName = 'mindtheshop';
    
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect -> set_charset("uft8");

    if(mysqli_connect_errno()){
        echo "데이터베이스 {$dbName} 접속 실패";
    }

    $entCode = $_POST['entCode'];
    $st1 = $_POST['st1'];
    $nd2 = $_POST['nd2'];
    $rd3 = $_POST['rd3'];

    $sql = "INSERT INTO
                mindtheshop(
                    entCode,
                    st1)
            VALUES
                '{$entCode}',
                '{$st1}';";

    