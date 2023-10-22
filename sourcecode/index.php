<?php

    require 'functions.php';

    $web = query("SELECT * FROM detail_website")[0];
    $data = tampilLagi("destinasi_wisata");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $web["nama_web"] ?></title>
    <style>
        .hero{
            background-image: url(images/<?= $web["hero"] ?>);
        }
    </style>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script>
        if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>

    <section class="hero" id="hero">
        <nav class="navbar navbar-custom navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><?= $web["nama_web"] ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#hero">Beranda</a>
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

        <div class="container">
            <div class="line"></div>
            <div class="line2"></div>
            <h1><?= $web["nama_web"] ?></h1>
            <p><?= $web["detail_web"] ?></p>
            <div class="row">
                <div class="col">
                        <a href="#map" class="button button2">Lokasi</a>
                </div>
                <div class="col">
                        <a href="#vp" class="button button1">Lihat</a>
                </div>
            </div>
        </div>
    </section>

    <?php if($data == "kosong") : ?>

        <div class="container">
            <?php include'dbKosong.php'; ?>
        </div>

    <?php else : ?>

        <section class="vp" id="vp">
            <div class="container">
                <div class="subTitle">
                    <h2><?= $web["header1"] ?></h2>
                    <p>
                    <?= $web["header2"] ?>
                    </p>

                    <form action="" method="post" class="cari mt-5">
                        <input type="text" name="keyword" size="40" placeholder="masukkan keyword pencarian.." autocomplete="off">
                        <button type="submit" name="cari" class="btn btn-outline-success mx-2">Cari</button>
                        <button type="submit" name="refresh" class="btn btn-outline-secondary">Refresh</button>
                    </form>
                </div>

                
                <div class="pagination mt-5">
                    <?php include 'pagination.php' ?>
                </div>


                <?php $i = 1; ?>
                <?php foreach($data["data"] as $destinasiWisata) : ?>

                    <div class="row valuePropotition">
                        <div class="col">
                            <div class="frameVP img-fluid">
                                <img src="images/<?= $destinasiWisata["gambarTempat"] ?>" alt="<?= $destinasiWisata["gambarTempat"] ?>" class="imageVP">
                                <div class="lineAnimation"></div>
                            </div>
                        </div>
                        
                        <div class="col">
                            <h2><?= $destinasiWisata["namaTempat"] ?></h2>
                            <p>
                                <?= $destinasiWisata["detailSingkat"] ?>
                            </p>
                                <a href="detailWisata.php?id=<?= $destinasiWisata["id"] ?>" class="btn btn-primary" style="background-color: #EBB970;  border: none;" onMouseOver="this.style.background='#a77d3e'"
                                    onMouseOut="this.style.background='#EBB970'"><?= $destinasiWisata["tombolTeks"] ?></a>
                        </div>
                    </div>
                    
                <?php $i++; ?>
                <?php endforeach ?>
            </div>
        </section>
        
        <div class="pagination mt-5">
            <?php include 'pagination.php' ?>
        </div>

        <section class="map" id="map">
            <h2><?= $web["header1_2"] ?></h2>
            <div class="containe mt-5r">
                <?= $web["map"] ?>
            </div>
        </section>
    
    <?php endif ?>
  

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