<?php
include_once('config.php');
session_start();
$uname=$_SESSION['username'];
$nama_profil=$_GET['nama'];

$query=mysqli_query($mysqli,"SELECT*FROM akun WHERE username='$uname'");

$cek=mysqli_fetch_array($query);
if($cek['jenis_akun']=="Penjual"){
    $result=mysqli_query($mysqli, "DELETE FROM akun WHERE username='$uname'");
    $result2=mysqli_query($mysqli, "DELETE FROM profil WHERE username_profil='$uname'");
    $result3=mysqli_query($mysqli, "DELETE FROM mobil WHERE pemilik_mobil='$nama_profil'");
} else if($cek['jenis_akun']=="Pembeli"){
    $result=mysqli_query($mysqli, "DELETE FROM akun WHERE username='$uname'");
    $result2=mysqli_query($mysqli, "DELETE FROM profil_beli WHERE username_beli='$uname'");
    $result3=mysqli_query($mysqli, "DELETE FROM mobil WHERE pemilik_mobil='$nama_profil'");
}
session_destroy();
header("location:login.php?pesan=hapus_akun")
?>