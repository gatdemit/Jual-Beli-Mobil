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
    if($_SESSION['status']=="login"){
        header("location:profile.php");
    } else if($_SESSION['status']!="login_beli"){
        header("location:login.php?pesan=belum_login");
    }
    $uname=$_SESSION['username'];
    $result=mysqli_query($mysqli, "SELECT*FROM profil_beli WHERE username_beli='$uname'");
    $user_data=mysqli_fetch_array($result);
    ?>
        <h2>Selamat datang di profil anda, <?php echo $_SESSION['username'];?></h2>
        <a href="index.php"><input type="submit" value="Home" class="waves-effect waves-light btn"></a><br><br>
        <a href="logout.php"><input type="submit" value="Logout" class="waves-effect waves-light btn"></a><br>
        <form action="profile_beli.php" method="post">
        <table>
            <tr>
                <td>Nama</td>
                <td>: <?php echo $user_data['nama_beli']; ?></td>
            </tr>
            <tr>
                <td>Nomor Hp</td>
                <td>: <?php echo $user_data['nope_beli']; ?></td>
            </tr>
            <tr>
                <td><input type="submit" name="beli" value="Beli Mobil" class="waves-effect waves-light btn"></td>
                <td><input type="submit" name="edit" value="Edit Profil Anda" class="waves-effect waves-light btn"></td>
                <td><input type="submit" name="hapus" value="Hapus Akun" class="waves-effect waves-light btn"></td>
            </tr>
        </table>
        </form>
        <?php
        if(isset($_POST['beli'])){
            header("location:index.php");
        }
        else if(isset($_POST['edit'])){
            header("location:edit.php?username=$uname");
        } else if(isset($_POST['hapus'])){
            header("location:delete.php?nama=$user_data[nama_beli]");
        }
        ?>
    </body>
</html>