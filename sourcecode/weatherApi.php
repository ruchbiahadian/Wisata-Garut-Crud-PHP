<?php

	require 'functions.php';

	$web = query("SELECT * FROM detail_website")[0];

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/forecast?q=Garut%2C%20ID",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
			"x-rapidapi-key: 5719998480mshe5d61dde8b8e8edp1dc2fajsn2c33fe0d841a"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$data = json_decode($response);
	$currentTime = time();

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prediksi Cuaca Garut</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

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
					<li class="nav-item active">
                        <a class="nav-link" href="weatherApi.php" name="cuaca">Prediksi Cuaca</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" name="login">Login</a>
                    </li>

                </ul>
                </div>
            </div>
        </nav>

	<div class="container pt-5">
		<center>
			<h2 class="pt-5 pb-1">Prediksi Cuaca Kota Garut</h2>

			<p class="pb-3">Berikut merupakan prediksi cuaca Kota Garut 5 hari ke depan yang selalu update!</p>

			<table border="1" cellspacing="0" cellpadding="16" class="table">
				<thead class="thead-dark">
					<tr align="center">
						<th scope="col">Tanggal</th>
						<th scope="col">Jam</th>
						<th scope="col">Kondisi</th>
						<th scope="col">Icon Kondisi</th>
					</tr>
				</thead>

				<tbody>

					<?php foreach($data->list as $dat) { ?>
						<?php

							// ubah format waktu
							$lama = $dat->dt_txt;  
							$baru = date("d-m-Y", strtotime($lama));    

							$baruJam = date("H:i", strtotime($lama)); 

						?>
						<tr align="center">
							<td><?= $baru ?></td>
							<td><?= $baruJam ?></td>
							<td><?= $dat->weather[0]->main ?></td>
							<td><img src="http://openweathermap.org/img/w/<?= $dat->weather[0]->icon ?>.png" alt=""></td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</center>
	</div>

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