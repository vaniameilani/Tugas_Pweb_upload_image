<?php
$host="localhost";
$user="root";
$password="";
$database="onFace";
$koneksi=mysqli_connect($host,$user,$password,$database);
// mysql_select_db($database,$koneksi);
//cek koneksi
if($koneksi){
//    echo "berhasil koneksi";
    // echo "Welcome";
}else{
    echo "gagal koneksi";
}
?> 