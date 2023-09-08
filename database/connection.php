<?php
$host='localhost';
$username='root';
$password ='2720';
$db_name='mystore';
$conn=null;
try{
    $conn=new PDO('mysql:host='.$host.';dbname='.$db_name,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'connection failed'.$e->getMessage();
}