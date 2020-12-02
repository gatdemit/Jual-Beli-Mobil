<html>
    <head>
        <title>Selamat Datang!</title>
        <meta name="viewport" content="width=device-width, initial scale=1">
        <link href="materialize.min.css" rel="stylesheet">
    </head>

    <body class="container blue lighten-3" id="body-content">
        <h2>Selamat Datang! Ingin bertransaksi?</h2>
        <?php
        session_start();
        if(isset($_GET['login'])){
            if($_GET['login']=="iya"){
                echo "Akun Anda untuk menjual dan bukan untuk membeli.";
            }
        } else if(isset($_GET['pesan'])=="sudah_login"){
            echo "Anda sudah login";
        } else if(isset($_GET['pesan'])=="terhapus"){
            echo "Iklan mobil Anda sudah Terhapus!";
        }
        ?>
        <br><a href="login.php"><input type="submit" value="Login Terlebih Dahulu!" class="waves-effect waves-light btn"></a><br>

        <br><a href="logout.php"><input type="submit" value="Logout" class="waves-effect waves-light btn"></a><br>
        
        <br><a href="profile.php" class="waves-effect waves-light btn">Profile Anda</a>
        
        <form action="index.php" method="post">
        
        <p class="blue lighten-5">Cari Merk Mobil di sini: </p>
        
        <input type="text" name="searchText" class="blue lighten-5"><input type="submit" name="searchBox" value="Search" class="waves-effect waves-light btn">
        
        <input type="submit" name="clear" value="Clear" class="waves-effect waves-light btn">
            <table width=80% border=1 class="blue lighten-5">
                <tr>
                    <th>Nama</th><th>Nomor HP</th><th>Nomor Polisi</th><th>Merk Mobil</th><th>Tipe Mobil</th><th>Harga</th><th>Transaksi</th>
                </tr>
                <?php
                include_once('config.php');
                if(isset($_POST['searchBox'])){
                    $search=$_POST['searchText'];
                    $result=mysqli_query($mysqli,"SELECT*FROM list_jual WHERE merk_mobil LIKE '%$search%'");
            
                    while($user_data=mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>".$user_data['nama_profil']."</td>";
                        echo "<td>".$user_data['nomor_hp']."</td>";
                        echo "<td>".$user_data['nopol']."</td>";
                        echo "<td>".$user_data['merk_mobil']."</td>";
                        echo "<td>".$user_data['tipe_mobil']."</td>";
                        echo "<td>".$user_data['harga']."</td>";
                        echo "<td><a href='beli.php'>Beli</a></td>";
                        echo "</tr>";
                    }
                } else{
                    $result=mysqli_query($mysqli,"SELECT*FROM list_jual");
            
                    while($user_data=mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>".$user_data['nama_profil']."</td>";
                        echo "<td>".$user_data['nomor_hp']."</td>";
                        echo "<td>".$user_data['nopol']."</td>";
                        echo "<td>".$user_data['merk_mobil']."</td>";
                        echo "<td>".$user_data['tipe_mobil']."</td>";
                        echo "<td>".$user_data['harga']."</td>";
                        echo "<td><a href='beli.php?nomorpol=$user_data[nopol]'>Beli</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table><br>
            <p class="blue lighten-5">Daftar mobil yang sudah dibeli: </p>
            <table width=80% border=1 class="blue lighten-5">
                <tr>
                    <th>Nomor Polisi</th><th>Merk Mobil</th><th>Tipe Mobil</th><th>Pembeli</th><th>Nomor HP Pembeli</th>
                </tr>
                <?php
                $hasil=mysqli_query($mysqli,"SELECT*FROM list_beli");

                while($user_data=mysqli_fetch_array($hasil)){
                        echo "<tr>";
                        echo "<td>".$user_data['nopol']."</td>";
                        echo "<td>".$user_data['merk_mobil']."</td>";
                        echo "<td>".$user_data['tipe_mobil']."</td>";
                        echo "<td>".$user_data['nama_beli']."</td>";
                        echo "<td>".$user_data['nope_beli']."</td>";
                        echo "</tr>";
                }
                ?>
            </table>
        </form>
    </body>

</html>