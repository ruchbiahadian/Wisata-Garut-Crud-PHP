<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }


    require 'functions.php';

    $id = $_GET["id"];
    
    $detailWisata_harga = query("SELECT * FROM detail_wisata_harga WHERE id_destinasi_wisata = $id");

    if($detailWisata_harga == null){
        tambah($id, 4);
        $detailWisata_harga = query("SELECT * FROM detail_wisata_harga WHERE id_destinasi_wisata = $id");
    }

    if(isset($_POST["submit"])){

        if(ubah($_POST, 5) > 0){
            echo " <script>
                        alert('Harga wisata berhasil diubah!');
                        document.location.href = 'index.php';
                    </script>
                ";
        }else{
            echo " <script>
                        alert('Harga wisata gagal diubah!');
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

            <h3 class="pt-5 pb-3">Tambah Detail Harga Wisata</h3>

            <p class="mapText">Jika tidak ingin harga tampil di halaman wisata, maka isi semua form harga di bawah dengan nilai 0, selain itu akan tampil!</p>

            <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <ul>
                            <li>
                                <label for="dewasa">Dewasa pada Hari Kerja : </label>
                                <input type="number" name="dewasa" id="dewasa" value="<?= $detailWisata_harga[0]["dewasa"] ?>" required>
                            </li>  
                            <li>
                                <label for="anak">Anak pada Hari Kerja : </label>
                                <input type="number" name="anak" id="anak" value="<?= $detailWisata_harga[0]["anak"] ?>" required>
                            </li>
                            <li>
                                <label for="dewasa_weekend">Dewasa pada Weekend : </label>
                                <input type="number" name="dewasa_weekend" id="dewasa_weekend" value="<?= $detailWisata_harga[0]["dewasa_weekend"] ?>" required>
                            </li>
                            <li>
                                <label for="anak_weekend">Anak pada Weekend : </label>
                                <input type="number" name="anak_weekend" id="anak_weekend" value="<?= $detailWisata_harga[0]["anak_weekend"] ?>" required>
                            </li>
                            <li>
                                <button type="submit" name="submit" class="btn btn-success mb-5 mr-2">Tambah Data</button>
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