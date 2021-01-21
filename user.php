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
        //token验证通过

        // 查询用户信息  并返回JSON
        $sql = "select * from user where id = '{$row["id"]}'";
//        echo $sql;
        $res = $pdo->query($sql);
        $data = $res->fetch(PDO::FETCH_ASSOC);
//         print_r($data);
        $response = [
            'errno'=> 0,
            'msg' => '验证通过',
            'data' => $data
        ];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else{
        //  验证未通过
        $response = [
            'errno' => 40009,
            'msg' => "验证未通过"
        ];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }