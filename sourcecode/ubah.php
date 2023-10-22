<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    // ambil data di url
    $id = $_GET["id"];

    // query data mahasiswa
    $destinasiWisata = query("SELECT * FROM destinasi_wisata WHERE id = $id")[0];

    // cek apakah tombol submit sudah ditekan
    if(isset($_POST["submit"])){

        if(ubah($_POST, 1) >= 0){
            echo " <script>
                        alert('Data berhasil diubah!');
                        document.location.href = 'index.php';
                    </script>
                ";
        }else{
            echo " <script>
                        alert('Data gagal diubah!');
                        document.location.href = 'index.php';
                    </script>
                ";
        }

    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Destinasi Wisata</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

        <div class="leftSide">
                <ul class="mt-5">
                    <li style="<?= ubahLeftSide(1, $menuTampil) ?>"><a href="admin.php?menu=1">Detail Website</a></li>
                    <li style="<?= ubahLeftSide(2, $menuTampil) ?>"><a href="admin.php?menu=2">Destinasi Wisata</a></li>
                    <li style="<?= ubahLeftSide(4, $menuTampil) ?>"><a href="admin.php?menu=4">Detail Destinasi Wisata</a></li>
                    <li style="<?= ubahLeftSide(3, $menuTampil) ?>"><a href="admin.php?menu=3">Pengaturan Admin</a></li>
                    <li><a href="logout.php" onclick="return confirm('Yakin Ingin Logout?')">Logout</a></li>
                </ul>
            </div>
    
    <div class="rightSide">
        <div class="rightSideContainer">
            <h3 class="pt-5 pb-3">Ubah Destinasi Wisata</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $destinasiWisata["id"] ?>">
                <input type="hidden" name="gambarLama" value="<?= $destinasiWisata["gambarTempat"] ?>">
                <ul>
                    <li>
                        <label for="namaTempat">Nama Tempat : </label>
                        <input type="text" name="namaTempat" id="namaTempat" value="<?= $destinasiWisata["namaTempat"] ?>" required>
                    </li>
                    <li>
                        <label for="detailSingkat">Detail Singkat : </label>

                        <textarea name="detailSingkat" id="detailSingkat" cols="30" rows="10"><?= $destinasiWisata["detailSingkat"] ?></textarea>
                    </li>       
                    <li>
                        <label for="tombolTeks">Tombol Teks : </label>
                        <input type="text" name="tombolTeks" id="tombolTeks" value="<?= $destinasiWisata["tombolTeks"] ?>" required>
                    </li>
                    <li>
                        <label for="gambarTempat">GambarTempat : </label>
                        <img src="images/<?= $destinasiWisata["gambarTempat"] ?>" size="40px" style="width:300px"> <br>
                        <input type="file" name="gambarTempat" id="gambarTempat">
                    </li>
                    <li>
                        <button type="submit" name="submit" class="btn btn-success mb-5 mr-2">Ubah Data</button>
                        <a href="admin.php?menu=2" class="btn btn-secondary mb-5">Kembali</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>

</body>
</html>