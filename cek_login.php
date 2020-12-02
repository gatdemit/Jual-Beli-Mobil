<?php
session_start();

include('config.php');

$uname=$_POST['username'];
$pass=$_POST['passwordAkun'];

$encrypt=md5($pass);

$akun=mysqli_query($mysqli, "SELECT*FROM akun WHERE username='$uname'");

$user_data=mysqli_fetch_array($akun);
try{
    if($user_data==""){
        header("location:login.php?pesan=akun_tidak_ada");
    }
    if($user_data['jenis_akun']=="Penjual"){
        $result = mysqli_query($mysqli, "SELECT*FROM akun WHERE username='$uname' AND password='$encrypt'");
        $cek = mysqli_num_rows($result);
        if($cek>0){
            $_SESSION['username']=$uname;
            $_SESSION['status']="login";
            header("location:profile.php");
        } else{
            header("location:login.php?pesan=gagal");
        }
    } else if($user_data['jenis_akun']=="Pembeli"){
        $result = mysqli_query($mysqli, "SELECT*FROM akun WHERE username='$uname' AND password='$encrypt'");
        $cek = mysqli_num_rows($result);
        if($cek>0){
            $_SESSION['username']=$uname;
            $_SESSION['status']="login_beli";
            header("location:profile.php");
        } else{
            header("location:login.php?pesan=gagal");
        }
    }
} catch(Exception $e){
    echo $e->getMessage();
    die();
}
?>