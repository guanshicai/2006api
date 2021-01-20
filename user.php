<?php
    include "pdo.php";

    if(empty($_GET['token'])){
        $response = [
            'errno' => 40005,
            'msg' => "缺少token参数"
        ];
        die(json_encode($response,JSON_UNESCAPED_UNICODE));
    }
    $token = $_GET['token'];
//    echo $token;

    $pdo = getPdo();

    $sql = "select * from tokens where token = '{$token}'";
    $res = $pdo->query($sql);
    $row = $res->fetch(PDO::FETCH_ASSOC);
//    print_r($row);
    if($row && $row['expire']>time()){

    }else{

    }