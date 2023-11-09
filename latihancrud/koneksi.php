<?php

$host="localhost:3309";
$user="root";
$password="";
$db="latihancrud";

$kon = mysqli_connect($host,$user,$password,$db);
if (!$kon){
        die("Koneksi Gagal:".mysqli_connect_error());
        
}
?>