<html>
    <head>
        <title>Edit Profile Anda</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">    
    </head>

    <body class="container blue lighten-3">
    <?php
    include_once('config.php');
    session_start();
    if($_SESSION['status']!="login"&&$_SESSION['status']!="login_beli"){
        header("location:login.php?pesan=belum_login");
    }
    ?>
        <h2>Ubah profil Anda, <?php echo $_SESSION['username'];?></h2>
        <a href="index.php"><input type="submit" value="Home" class="waves-effect waves-light btn"></a><br><br>
        <a href="profile.php"><input type="submit" value="Kembali ke Profil" class="waves-effect waves-light btn"></a>
        <form action="edit.php" method="post">
            <table>
                <tr>
                    <td><h6 class="blue lighten-5">Nama :</h6></td>
                    <td><input type="text" name="nama_edit" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td><h6 class="blue lighten-5">Nomor Hp :</h6></td>
                    <td><input type="text" name="nope_edit" class="blue lighten-5"></td>
                </tr>
                <tr>
                    
                    <td><input type="submit" name="edit" value="Ubah" class="waves-effect waves-light btn"></td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['edit'])){
            $username=$_SESSION['username'];
            $query=mysqli_query($mysqli,"SELECT*FROM akun WHERE username='$username'");
            $user_data=mysqli_fetch_array($query);
            $nama_profil=$_POST['nama_edit'];
            $nope_profil=$_POST['nope_edit'];
            if($user_data['jenis_akun']=="Penjual"){
                $result=mysqli_query($mysqli, "UPDATE profil SET nama_profil='$nama_profil', nomor_hp='$nope_profil'
                WHERE username_profil='$username'");
                header("location:profile.php");
            } else if($user_data['jenis_akun']=="Pembeli"){
                $result=mysqli_query($mysqli, "UPDATE profil_beli SET nama_beli='$nama_profil', nope_beli='$nope_profil'
                WHERE username_beli='$username'");
                header("location:profile_beli.php");
            }
        }
        ?>
    </body>
</html>