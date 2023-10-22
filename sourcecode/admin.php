<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    $menuTampil = isset($_GET["menu"]) ? $_GET["menu"] : 1;

    require 'functions.php';

    $web = query("SELECT * FROM detail_website")[0];
    $data = tampilLagi("destinasi_wisata");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>

    <div class="leftSide">
        <ul class="mt-5">
            <li style="<?= ubahLeftSide(1, $menuTampil) ?>"><a href="?menu=1">Detail Website</a></li>
            <li style="<?= ubahLeftSide(2, $menuTampil) ?>"><a href="?menu=2">Destinasi Wisata</a></li>
            <li style="<?= ubahLeftSide(4, $menuTampil) ?>"><a href="?menu=4">Detail Destinasi Wisata</a></li>
            <li style="<?= ubahLeftSide(3, $menuTampil) ?>"><a href="?menu=3">Pengaturan Admin</a></li>
            <li><a href="logout.php" onclick="return confirm('Yakin Ingin Logout?')">Logout</a></li>
        </ul>
    </div>

    <div class="rightSide">
        
            <div class="rightSideContainer">
                <?php

                    switch($menuTampil){
                        case 1: 
                            include 'crud_detailWebsite.php';
                            break;
                        case 2:
                            include 'crud_destinasiWisata.php';
                            break;
                        case 3:
                            include 'ubahAdmin.php';
                            break;
                        case 4:
                            include 'crud_detailDestinasiWisata.php';
                            break;
                    }

                    ?>
        </div>

    </div>

    

    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
        
</body>
</html>