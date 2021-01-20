<?php
//echo '<pre>';print_r($_POST);echo '</pre>';
include "pdo.php";
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];

    $sql = "select * from user where uname = '{$uname}'";
    $pdo =  getPdo();
    $res = $pdo->query($sql);
    $data = $res->fetch(PDO::FETCH_ASSOC);
//echo '<pre>';print_r($data);echo '</pre>';

    if($data){//验证密码
        if(password_verify($pwd,$data['pwd'])){
            //登录成功，生成token  保存token   返回token
            $hash_str = hash('sha256',$data['id'].$data['uname'].mt_rand(1,999999));
//            print_r($hash_str);
            $token = substr($hash_str,10,20);

            //删除原有记录
            $sql = "delete from tokens where id = '{$data['id']}'";
            $pdo->exec($sql);
            //写入新数据
            $expire = time()+7*86400;
            $sql = "insert into tokens(id,token,expire)values('$data[id]','$token','$expire')";
//           print_r($sql);
            $pdo->exec($sql);
            $response = [
                'errno' => 0,
                'msg' => 'ok',
                'data' => [
                    'token' => $token
                ]
            ];
            echo json_encode($response);
            exit;
        }
    }
    //返回错误   授权失败
    $response = [
        'errno' => 40001,
        'msg' => '授权失败'
    ];
    echo json_encode($response);
    exit;