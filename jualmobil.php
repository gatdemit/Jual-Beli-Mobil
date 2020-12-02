<html>
    <head>
        <title>Jual Mobil</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">
    </head>
    <?php 
    include_once('config.php');
    session_start();
    if($_SESSION['status']!="login"){
        header("location:login.php?pesan=belum_login");
    }
    ?>
    <body class="container blue lighten-3">
    <h2>Masukkan data mobil yang akan anda jual, <?php echo $_SESSION['username'];?></h2>
    <a href="index.php"><input type="submit" value="Home" class="waves-effect waves-light btn"></a><br><br>
    <a href="profile.php"><input type="submit" value="Kembali ke Profil" class="waves-effect waves-light btn"></a>
        <form action="jualmobil.php" method="post">
            <table>
                <tr>
                    <td><h6 class="blue lighten-5">Nomor Polisi :</h6></td>
                    <td><input type="text" name="nopol" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td><h6 class="blue lighten-5">Merk Mobil :</h6></td>
                    <td>: <input type="text" name="merk" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td><h6 class="blue lighten-5">Tipe Mobil :</h6></td>
                    <td>: <input type="text" name="tipe" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td><h6 class="blue lighten-5">Harga :</h6></td>
                    <td>: <input type="text" name="harga" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="mblBtn" value="Jual!" class="waves-effect waves-light btn"></td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['mblBtn'])){
            $username_profil=$_SESSION['username'];
            $cari=mysqli_query($mysqli,"SELECT*FROM profil WHERE username_profil='$username_profil'");
            $user_data=mysqli_fetch_array($cari);
            $pemilik=$user_data['nama_profil'];
            $nopol_cek=$user_data['nomor_polisi'];
            $nopol_trim=$_POST['nopol'];
            $nopol=str_replace(' ', '',$nopol_trim);
            $merk=$_POST['merk'];
            $tipe=$_POST['tipe'];
            $harga=$_POST['harga'];

            include_once('config.php');
            if($nopol_cek!=""){
                echo "Anda sedang menjual mobil lain! silakan tunggu laku!";
            } else{
                $result=mysqli_query($mysqli, "INSERT INTO mobil(nopol, merk_mobil, tipe_mobil, pemilik_mobil, harga)
                VALUES('$nopol','$merk','$tipe','$pemilik','$harga')");
                $result2=mysqli_query($mysqli, "UPDATE profil SET nomor_polisi='$nopol' 
                WHERE username_profil='$username_profil'");
                header("location:index.php");
            }
        }
        ?>
    </body>
</html>