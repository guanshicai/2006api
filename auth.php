<?php
include "pdo.php";
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $pdo =  getPdo();http://chromecj.com/web-development/2014-09/60/download.html

    $sql = "select * form user where uname = '{$uname}'";
    $res = $pdo->query($sql);
