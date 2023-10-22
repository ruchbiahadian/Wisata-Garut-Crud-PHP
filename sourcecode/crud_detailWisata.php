<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }


    require 'functions.php';

    $id = $_GET["id"];
    $detailWisata = query("SELECT * FROM detail_wisata WHERE id_destinasi_wisata = $id");


    if(isset($_POST["ubahDetailWisata"])){

        if(ubah($_POST, 4) > 0){
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

    if(empty($detailWisata)){
        $detailWisata["id"] = $id;
        $detailWisata["header1"] = "Mengapa Wisata Ini";
        $detailWisata["header2"] = "Detail Wisata Ini";
        $detailWisata["header3"] = "Lokasi";
        $detailWisata["map"] = "Map belum diisi";

        tambah($detailWisata, 3);
        $detailWisata = query("SELECT * FROM detail_wisata WHERE id_destinasi_wisata = $id");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Detail Wisata</title>
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

            <h3 class="pt-5 pb-3">Tambah Detail Wisata</h3>

            <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <ul>
                            <li>
                                <label for="header1">Header1 : </label>
                                <input type="text" name="header1" id="header1" value="<?= $detailWisata[0]["header1"] ?>" required>
                            </li>  
                            <li>
                                <label for="header2">Header2 : </label>
                                <textarea name="header2" id="header2" cols="30" rows="10" required><?= $detailWisata[0]["header2"] ?></textarea>
                            </li>
                            <li>
                                <label for="header3">Header3 : </label>
                                <input type="text" name="header3" id="header3" value="<?= $detailWisata[0]["header3"] ?>" required>
                            </li>
                            <li>
                                <label for="map">Map : </label>
                                <textarea name="map" id="map" cols="30" rows="10" required><?= $detailWisata[0]["map"] ?></textarea>
                                <p class="mapText">Embed html map dari google maps!</p>
                            </li>
                            <li>
                                <button type="submit" name="ubahDetailWisata" class="btn btn-success mb-5 mr-2">Ubah Data</button>
                                <a href="admin.php?menu=4" class="btn btn-secondary mb-5">Kembali</a>
                            </li>
                        </ul>
                </form> 
        </div>
    </div>

    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    
</body>
</html>