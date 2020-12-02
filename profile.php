<html>
    <head>
        <title>Halaman Profil</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">
    </head>

    <body class="container blue lighten-3">
    <?php
    include_once('config.php');
    session_start();
    if($_SESSION['status']=="login_beli"){
        header("location:profile_beli.php");
    } else if($_SESSION['status']!="login"){
        header("location:login.php?pesan=belum_login");
    }
    $uname=$_SESSION['username'];
    $result=mysqli_query($mysqli, "SELECT*FROM profil WHERE username_profil='$uname'");
    $user_data=mysqli_fetch_array($result);
    $nopol=$user_data['nomor_polisi'];
    ?>
        <h2>Selamat datang di profil anda, <?php echo $_SESSION['username'];?></h2>
        <a href="index.php"><input type="submit" value="Home" class="waves-effect waves-light btn"></a><br><br>
        <a href="logout.php"><input type="submit" value="Logout" class="waves-effect waves-light btn"></a><br>
        <form action="profile.php" method="post">
        <table>
            <tr>
                <td>Nama</td>
                <td>: <?php echo $user_data['nama_profil']; ?></td>
            </tr>
            <tr>
                <td>Nomor Hp</td>
                <td>: <?php echo $user_data['nomor_hp']; ?></td>
            </tr>
            <tr>
                <td><input type="submit" name="jual" value="Jual Mobil" class="waves-effect waves-light btn"></td>
                <td><input type="submit" name="gak_jadi" value="Hapus Mobil" class="waves-effect waves-light btn"></td>
                <td><input type="submit" name="edit" value="Edit Profil Anda" class="waves-effect waves-light btn"></td>
                <td><input type="submit" name="hapus" value="Hapus Akun" class="waves-effect waves-light btn"></td>
            </tr>
        </table>
        </form>
        <?php
        if(isset($_POST['jual'])){
            header("location:jualmobil.php?nama=$user_data[nama_profil]");
        } else if(isset($_POST['edit'])){
            header("location:edit.php?username=$uname");
        } else if(isset($_POST['hapus'])){
            header("location:delete.php?nama=$user_data[nama_profil]");
        } else if (isset($_POST['gak_jadi'])){
            try{
                if($user_data==""){
                    throw new Exception("Anda belum mengiklankan mobil! Iklankan mobil terlebih dahulu!");
                } else{
                    $hapus=mysqli_query($mysqli, "DELETE FROM mobil WHERE nopol='$nopol'");
                    $update=mysqli_query($mysqli, "UPDATE profil SET nomor_polisi='' WHERE username_profil='$uname'");
                    header("location:index.php?pesan=terhapus");
                }
            } catch(Exception $e){
                echo $e->getMessage();
                die();
            }
        }
        ?>
    </body>
</html>