<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>으악</title>
    <link rel = "stylesheet" href="style.css">
    <script src = "index.js"></script>
    <script src = "jquery-3.6.0..js"></script>

<?php
    $host = 'promalldb22.godomall.com';
    $user = 'mindthedb';
    $pw = '';
    $dbName = 'pdt';
    
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect -> set_charset("uft8");

    if(mysqli_connect_errno()){
        echo "데이터베이스 {$dbName} 접속 실패";
    }
?>