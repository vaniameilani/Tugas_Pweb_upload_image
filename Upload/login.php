<?php session_start();
    include "koneksi.php";
    $username = $_POST['idUser'];
    if($username == ""){
        echo "<h4 style='color:red'>Nama Belum dimasukkan!</h4>";
    }

    $password = md5($_POST['password']);
    if($password == ""){
        echo "<h4 style='color:red'>Password wajib diisi!</h4>";
    }

    $query = mysqli_query($koneksi, "select * from user");
    $cek = mysqli_num_rows($query);

    if ($cek) {
        $_SESSION['idUser']=$username;
        ?>Anda berhasil login. Silahkan menuju <a href="index.php"> Halaman index</a><?php
    }

    else {
        ?>Anda gagal login. Silahkan <a href="form_admin.php">Login kembali</a><?php
        echo mysqli_error($koneksi);
    }
?>