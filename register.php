<html>
    <head>
        <title>Registrasi</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">
    </head>

    <body class="container blue lighten-3">
    <?php
        include_once('config.php');
        session_start();
        
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=="sukses"){
                $username=$_SESSION['username'];
                header("location:lengkapi_profil.php?username=$username");
            }
            else if($_GET['pesan']=="gagal"){
                echo "Registrasi gagal! Periksa kembali Username dan Password yang Anda masukkan!";
            }
        }
    ?>

    <h2>Daftar Akun</h2>
    <a href="index.php" class="waves-effect waves-light btn">Home</a>
        <form action="cek_register.php" method="post" name="form1">
            <table>
                <tr>
                    <td><h6 class="blue lighten-5">Username :</h6></td>
                    <td><input type="text" name="username" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td><h6 class="blue lighten-5">Password :</td>
                    <td><input type="password" name="passwordAkun" class="blue lighten-5"></td>
                </tr>
                <tr>
                    <td>Menjual atau Membeli?</td>
                    <td><label for="jenis1" class="black-text lighten-5"><input type="radio" name="jenis" value="Penjual" id="jenis1"><span>Menjual</span></label>
                    <label for="jenis2" class="black-text lighten-5"><input type="radio" name="jenis" value="Pembeli" id="jenis2"><span>Membeli</span></label></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><input type="submit" value="Daftar!" class="waves-effect waves-light btn"></td>
                </tr>
            </table>
            <p>Sudah punya akun? <a href="login.php" class="waves-effect waves-light btn">Silakan Login!</a></p>
        </form>
    </body>
</html>