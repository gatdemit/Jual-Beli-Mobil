<html>
    <head>
        <title>Pelengkapan Profil</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">
    </head>

    <body class="container blue lighten-3">
    <?php
    session_start();
    if($_SESSION['status']!="login"&&$_SESSION['status']!="login_beli"){
        header("location:login.php?pesan=belum_login");
    }
    ?>
        <h2>Lengkapi Profil Anda untuk lanjut!</h2>

        <form action="lengkapi_profil.php" method="post">
            <table>
                <tr>
                    <td><h6 class="blue lighten-5">Nama :</h6></td>
                    <td><input type="text" name="nama_profil" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td><h6 class="blue lighten-5">Nomor Hp :</h6></td>
                    <td><input type="text" name="nomor_hp" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="prfBtn" value="Masukkan Data!" class="waves-effect waves-light btn"></td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['prfBtn'])){
            include_once('config.php');
            $username_profil=$_SESSION['username'];
            
            $query=mysqli_query($mysqli,"SELECT*FROM akun WHERE username='$username_profil'");

            $user_data=mysqli_fetch_array($query);

            $namaProfil=$_POST['nama_profil'];
            $nomorHp=$_POST['nomor_hp'];

            if($user_data['jenis_akun']=="Penjual"){
                $result=mysqli_query($mysqli, "INSERT INTO profil(username_profil,nama_profil,nomor_hp)
                VALUES('$username_profil','$namaProfil','$nomorHp')");
                header("location:profile.php");
            } else if($user_data['jenis_akun']=="Pembeli"){
                $result=mysqli_query($mysqli, "INSERT INTO profil_beli(username_beli, nama_beli, nope_beli)
                VALUES('$username_profil','$namaProfil','$nomorHp')");
                header("location:profile_beli.php");
            }
        }
        ?>
    </body>
</html>