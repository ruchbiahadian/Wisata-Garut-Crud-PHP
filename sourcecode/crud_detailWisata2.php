<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }


    require 'functions.php';

    $id = $_GET["id"];
    $detailWisata = query("SELECT * FROM detail_wisata WHERE id_destinasi_wisata = $id");
    $detailWisataPost = query("SELECT * FROM detail_wisata_post WHERE id_detail_wisata = $id");


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

            <a href="tambahDetailWisata.php?id=<?= $id ?>" class="btn btn-primary mt-5 mr-2">Tambah Detail Wisata</a>
            <a href="admin.php?menu=4" class="btn btn-secondary mt-5">Kembali</a>

                        <?php if(empty($detailWisataPost)){
                            include 'dbKosong.php';die;
                        }
                        ?>

                        <table border="1" cellspacing="0" cellpadding="10" class="table mt-4">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Detail</th>
                                    <th colspan="2" scope="col">Aksi</th>
                                </tr>
                            </thead>
                                
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($detailWisataPost as $destinasiWisata) : ?>
                                    <tr>
                                        <td align="center"><?= $i ?></td>
                                        <td align="center"><img src="images/<?= $destinasiWisata["gambar"] ?>" alt="<?= $destinasiWisata["gambar"] ?>" style="width:100px"></td>
                                        <td><?= $destinasiWisata["gambarTitle"] ?></td>
                                        <td><textarea cols="30" rows="5"><?= $destinasiWisata["gambarDetail"] ?></textarea></td>
                                        <td align="center"><a href="ubahDetailWisata.php?id=<?= $destinasiWisata['id'] ?>" class="btn btn-primary">Edit</a></td>
                                        <td align="center"><a href="hapus.php?menu=2&id=<?= $destinasiWisata['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</a></td>
                                    </tr>
                                        
                                    <?php $i++; ?>
                                    <?php endforeach ?>
                                </tbody>
                        </table>

                </form>
        </div>
    </div>

    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    
</body>
</html>