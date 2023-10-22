<?php

    require 'functions.php';

    if(empty($_GET["id"])){
        header("Location: index.php");
    }

    $id = $_GET["id"];

    $detailWisata = query("SELECT * FROM detail_wisata WHERE id_destinasi_wisata = $id");
    $detailPost = query("SELECT * FROM detail_wisata_post WHERE id_detail_wisata = $id");
    $web = query("SELECT nama_web, instagram, whatsapp, facebook, footer FROM detail_website")[0];
    $namaTempat = query("SELECT namaTempat FROM destinasi_wisata WHERE id = $id")[0];
    $detailHarga = query("SELECT * FROM detail_wisata_harga WHERE id_destinasi_wisata = $id");

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
    <title><?= $web["nama_web"] ?> - <?= $namaTempat["namaTempat"] ?></title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function hitungHarga() {

            var dewasa = document.getElementById("dewasa").value;
            var anak = document.getElementById("anak").value;
            var dewasa_weekend = document.getElementById("dewasa_weekend").value;
            var anak_weekend = document.getElementById("anak_weekend").value;

            var dewasa_harga = document.getElementById("dewasa_harga").innerHTML;
            var anak_harga = document.getElementById("anak_harga").innerHTML;
            var dewasa_weekend_harga = document.getElementById("dewasa_weekend_harga").innerHTML;
            var anak_weekend_harga = document.getElementById("anak_weekend_harga").innerHTML;

            var total = 
                (dewasa*dewasa_harga) + 
                (anak*anak_harga) +
                (dewasa_weekend*dewasa_weekend_harga) +
                (anak_weekend*anak_weekend_harga); 

            document.getElementById("total").value = total;
            }
    </script>
</head>
<body>

    <section class="nav" id="nav">
            <nav class="navbar navbar-custom navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="#"><?= $web["nama_web"] ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="weatherApi.php" name="cuaca">Prediksi Cuaca</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php" name="login">Login</a>
                        </li>

                    </ul>
                    </div>
                </div>
            </nav>
    </section>

    <section class="vp" id="vp">
        <div class="container">
            <div class="subTitle SWisata">
                <h2><?= $detailWisata[0]["header1"] ?></h2>
                <p>
                    <?= $detailWisata[0]["header2"] ?>
                </p>
            </div>


            <?php if($detailPost == null) : ?>
                <?php include'dbKosong.php'; ?>
            <?php else : ?>
                <?php $i = 1; ?>
                <?php foreach($detailPost as $post) : ?>
                    
                    <div class="row valuePropotition">
                        <div class="col">
                            <div class="frameVP img-fluid">
                                <img src="images/<?= $post["gambar"] ?>" alt="<?= $post["gambar"] ?>" class="imageVP">
                                <div class="lineAnimation"></div>
                            </div>
                        </div>
                        
                        <div class="col">
                            <h2><?= $post["gambarTitle"] ?></h2>
                            <p>
                                <?= $post["gambarDetail"] ?>
                            </p>
                        </div>
                    </div>
                    
                <?php $i++; ?>
                <?php endforeach ?>
            <?php endif ?>
                
        </div>
    </section>

    <?php if($detailHarga != null) : ?>
        <?php if($detailHarga[0]["dewasa"] != 0 && $detailHarga[0]["anak"] != 0 && $detailHarga[0]["dewasa_weekend"] != 0 && $detailHarga[0]["anak_weekend"] != 0) : ?>
            <section class="hitung">
            <div class="container">
                    <div class="subTitle">
                        <h2>Harga</h2>
                        <p>
                            Hitung harga masuk Pengunjung di sini
                        </p>
                    </div>

                    <div class="bgHitung">
                        <form action="">
                            <table cellspacing="0" cellpadding="20" align="center" class="hitungHarga table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="3" scope="col">Hari Kerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dewasa</td>
                                        <td><input type="number" id="dewasa" placeholder="Jumlah Dewasa"></td>
                                        <td id="dewasa_harga"><?= $detailHarga[0]["dewasa"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Anak-Anak</td>
                                        <td><input type="number" id="anak" placeholder="Jumlah Anak"></td>
                                        <td id="anak_harga"><?= $detailHarga[0]["anak"] ?></td>
                                    </tr>
                                </tbody>
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="3" scope="col">Weekend dan Hari Libur Nasional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dewasa</td>
                                        <td><input type="number" id="dewasa_weekend" placeholder="Jumlah Dewasa"></td>
                                        <td id="dewasa_weekend_harga"><?= $detailHarga[0]["dewasa_weekend"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Anak-Anak</td>
                                        <td><input type="number" id="anak_weekend" placeholder="Jumlah Anak"></td>
                                        <td id="anak_weekend_harga"><?= $detailHarga[0]["anak_weekend"] ?></td>
                                    </tr>
                                </tbody>
                                <thead class="thead-dark">
                                    <tr>
                                        <th colspan="3" scope="col">TOTAL HARGA</th>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <button type="button" onclick="hitungHarga()" class="btn btn-success mt-5">Hitung</button>
                                            <button type="reset" class="btn btn-secondary mt-5">Reset</button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3"><input type="number" id="total"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </section>
        <?php endif ?>
    <?php endif ?>

    <section class="lokasi" id="lokasiPantai">
        <div class="container">
            <div class="subTitle">
                <h2><?= $detailWisata[0]["header3"] ?></h2>
                <?php echo $detailWisata[0]["map"] ?>
            </div>
        </div>
    </section>

    <section class="footer">
        <div class="deskripsi">
            <a href="<?= $web["instagram"] ?>" target="_blank"><img src="images/instagram.png" alt="instagram" class="footerIcons"></a>
            <a href="<?= $web["whatsapp"] ?>" target="_blank"><img src="images/whatsapp.png" alt="whatsapp" class="footerIcons"></a>
            <a href="<?= $web["facebook"] ?>" target="_blank"><img src="images/messenger.png" alt="messenger" class="footerIcons"></a>
            <br>
            <div class="linkFooter">
                <ul>
                    <li><p><a href="index.php">Beranda</a></p></li>
                    <li><p><a href="weatherApi.php">Prediksi Cuaca</a></p></li>
                    <li><p><a href="login.php">Login</a></p></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        <div class="copyright">
            <p><?= $web["footer"] ?></p>
        </div>
    </section>
    
    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>

</body>
</html>