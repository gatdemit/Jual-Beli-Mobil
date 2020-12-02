<?php
session_start();
if($_SESSION['status']!="login"&&$_SESSION['status']!="login_beli"){
    header("location:login.php?pesan=belum_login");
} else if($_SESSION['status']=="login"){
    header("location:index.php?login=iya");
}
?>
<html>
    <head>
        <title>Anda Yakin?</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">
    </head>

    <body class="container blue lighten-3" id="body-content">
        <form action="beli.php" method="post">
            <h2>Apakah Anda yakin ingin membeli mobil ini?</h2>
            <input type="hidden" name="nomorpol" value=<?php echo $_GET['nomorpol'];?>>
            <input type="submit" name="ya" value="Yes" class="waves-effect waves-light btn">
            <input type="submit" name="tdk" value="No" class="waves-effect waves-light btn">
        </form>
        <?php
            include_once('config.php');
            
            if(isset($_POST['ya'])){
                $username_beli=$_SESSION['username'];
                $nopol=$_POST['nomorpol'];

                $result=mysqli_query($mysqli, "SELECT*FROM profil WHERE nomor_polisi='$nopol'");
                $result2=mysqli_query($mysqli, "SELECT*FROM profil_beli WHERE username_beli='$username_beli'");

                $user_data=mysqli_fetch_array($result);
                $user_data2=mysqli_fetch_array($result2);

                $username_profil=$user_data['username_profil'];
                $ganti_nama=$user_data2['nama_beli'];

                $tambah=mysqli_query($mysqli, "UPDATE profil_beli SET nopol_beli='$nopol' WHERE username_beli='$username_beli'");
                $ganti_milik=mysqli_query($mysqli, "UPDATE mobil SET pemilik_mobil='$ganti_nama' WHERE nopol='$nopol'");
                $kurang=mysqli_query($mysqli, "UPDATE profil SET nomor_polisi='' WHERE username_profil='$username_profil'");
                header("location:index.php");
            } else if(isset($_POST['tdk'])){
                header("location:index.php");
            }
    ?>
    </body>
</html>