<?php
require 'koneksi.php';

iff(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM user WHERE username ='$username',and password ='$password'");

    $hitung = mysqli_num_rows($cekdatabase);

    if($hitung>0){

        $_SESSION['log'] = 'True';
        header('location:index.php');
    } else {
        header['location:login.php'];
    };

};
