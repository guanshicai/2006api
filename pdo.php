<?php
function getPdo(){
    $host = '127.0.0.1';
    $user = 'root';
    $pass = 'root';
    $db = 'javascript';
//    return new PDO("mysql:host=$host; dbname = $db",$user,$pass);
    return new PDO("mysql:host=$host; dbname=$db",$user,$pass);

}
