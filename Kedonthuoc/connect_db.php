<?php 
$host="47.129.52.209";
$user="admin";
$password="12345678";
$db="donthuoc3";
$data=mysqli_connect($host, $user, $password, $db);
if($data==false){
    die("connection error");
}
?>