<?php
session_start();

include('config.php');

$uname=$_POST['username'];
$pass=$_POST['passwordAkun'];
$jenis=$_POST['jenis'];

$encrypt=md5($pass);

$akun=mysqli_query($mysqli, "SELECT*FROM akun WHERE username='$uname'");

$user_data=mysqli_fetch_array($akun);

$cek=mysqli_num_rows($akun);

if($cek==1){
    echo "Username sudah ada! Silakan ganti";
    header("location:register.php?pesan=gagal");
} else{
    $result=mysqli_query($mysqli, "INSERT INTO akun(username,password, jenis_akun)
                        VALUES('$uname','$encrypt', '$jenis')");
    if($jenis=="Penjual"){
        $_SESSION['username']=$uname;
        $_SESSION['status']="login";
        header("location:register.php?pesan=sukses");
    } else if($jenis=="Pembeli"){
        $_SESSION['username']=$uname;
        $_SESSION['status']="login_beli";
        header("location:register.php?pesan=sukses");
    }
}
?>