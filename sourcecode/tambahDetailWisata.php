<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    $id = $_GET["id"];

    if(isset($_POST["submit"])){

        if(tambah($_POST, 2) > 0){
            echo " <script>
                        alert('Data berhasil ditambahkan!');
                        document.location.href = 'index.php';
                    </script>
                ";
        }else{
            echo " <script>
                        alert('Data gagal ditambahkan!');
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
    <title>Tambah Detail Wisata</title>
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
            <h3 class="pt-5 pb-3">Posting Detail Wisata</h3>
            
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>">
                <ul>
                    <li>
                        <label for="gambarTitle">Judul : </label>
                        <input type="text" name="gambarTitle" id="gambarTitle" required>
                    </li>
                    <li>
                        <label for="gambarDetail">Gambar Detail : </label>

                        <textarea name="gambarDetail" id="gambarDetail" cols="30" rows="10" required></textarea>
                    </li>
                    <li>
                    <li>
                        <label for="gambar">Gambar : </label>
                        <input type="file" name="gambar" id="gambar">
                    </li>
                    </li>       
                    <li>
                        <button type="submit" name="submit" class="btn btn-success mb-5 mr-2">Tambah Data</button>
                        <a href="crud_detailWisata2.php?id=<?= $id ?>" class="btn btn-secondary mb-5">Kembali</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>

</body>
</html>