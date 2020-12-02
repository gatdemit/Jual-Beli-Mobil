<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">
    </head>

    <body class="container blue lighten-3" id="body-content">
    <h2>Masuk ke Akun Anda!</h2>
    <a href="index.php"><input type="submit" value="Home" class="waves-effect waves-light btn"></a><br>
    <?php
        error_reporting(0);
        session_start();
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=="sukses"){
                header("location:profile.php");
            }
            else if($_GET['pesan']=="gagal"){
                echo "Login gagal! Periksa kembali Username dan Password yang Anda masukkan!";
            }
            else if($_GET['pesan']=="logout"){
                echo "Anda telah berhasil logout";
            }
            else if($_GET['pesan']=="belum_login"){
                echo "Anda Harus Login untuk mengakses layanan kami";
            }
            else if($_GET['pesan']=="hapus_akun"){
                echo "Akun Anda telah terhapus. Mohon maaf atas ketidaknyamannya";
            }
            else if($_GET['pesan']=="akun_tidak_ada"){
                echo "Akun Anda belum terdaftar! Silakan daftar terlebih dahulu!";
            }
        } else if ($_SESSION['status']=="login"||$_SESSION['status']=="login_beli"){
            header("location:index.php?pesan=sudah_login");
        }
    ?>
        <form action="cek_login.php" method="post" name="form1">
            <table>
                <tr>
                    <td><h6 class="blue lighten-5">Username :</h6></td>
                    <td><input type="text" name="username" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td><h6 class="blue lighten-5">Password :</h6></td>
                    <td><input type="password" name="passwordAkun" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Login!" class="waves-effect waves-light btn"></td>
                </tr>
            </table>
        </form>
        <p>Belum punya akun? <a href="register.php"><input type="submit" value="Silakan Daftar!" class="waves-effect waves-light btn"></a></p>
    </body>
</html>