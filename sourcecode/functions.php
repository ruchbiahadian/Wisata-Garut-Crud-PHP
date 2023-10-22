<?php

    // koneksi database
    // $conn = mysqli_connect("sql103.epizy.com", "epiz_27800598", "Qrh5lCF77zFRMNw", "epiz_27800598_wisata_garut");
    $conn = mysqli_connect("localhost", "id16034549_root", "lldJQap9+xxOEB*D", "id16034549_wisata_garut");
    // $conn = mysqli_connect("localhost", "root", "", "wisata_garut");

    // ambil data
    function query($query){
        global $conn;

        $result = mysqli_query($conn, $query);

        $rows = []; // array kosong

        while($row =  mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;
       
    }

    // tambah data
    function tambah($data, $no){
        global $conn;

        switch($no){
            case 1:
                $namaTempat = mysqli_real_escape_string($conn, htmlspecialchars($data["namaTempat"]));
                $detailSingkat = mysqli_real_escape_string($conn, htmlspecialchars($data["detailSingkat"]));
                $tombolTeks = htmlspecialchars($data["tombolTeks"]);
                
                // upload gambar
                $gambar = upload("gambarTempat");

                if(!$gambar){
                    return false;
                }

                $query = "INSERT INTO destinasi_wisata
                            VALUES 
                            (0, '$namaTempat', '$detailSingkat', '$gambar', '$tombolTeks')";

                mysqli_query($conn, $query);
            break;
            case 2:
                $id_detail_wisata = $data["id"];
                $gambarTitle = mysqli_real_escape_string($conn, htmlspecialchars($data["gambarTitle"]));
                $gambarDetail = mysqli_real_escape_string($conn, htmlspecialchars($data["gambarDetail"]));

                $gambar = upload("gambar");

                if(!$gambar){
                    return false;
                }

                $query = "INSERT INTO detail_wisata_post
                            VALUES 
                            (0, '$id_detail_wisata', '$gambar', '$gambarTitle', '$gambarDetail')";

                mysqli_query($conn, $query);
                echo mysqli_error($conn);die;
            break;
            case 3:
                $id = $data["id"];
                $header1 = $data["header1"];
                $header2 = $data["header2"];
                $header3 = $data["header3"];
                $map = $data["map"];

                $query = "INSERT INTO detail_wisata VALUES(
                            0, $id, '$header1', '$header2', '$header3', '$map')";
                
                mysqli_query($conn, $query);
            break;
            case 4:
                $id_destinasi_wisata = $data;
                $value = 0;

                $query = "INSERT INTO detail_wisata_harga VALUES(
                    0, $data, $value, $value, $value, $value)";

                mysqli_query($conn, $query);
            break;
        }

        return mysqli_affected_rows($conn);

    }

    function upload($namaGambar){
        // isi data file
        $namaFIle = $_FILES["$namaGambar"]["name"];
        $ukuranFile = $_FILES["$namaGambar"]["size"];
        $error = $_FILES["$namaGambar"]["error"];
        $tmp_name = $_FILES["$namaGambar"]["tmp_name"];

        // cek apakah tidak ada gambar yang diupload
        if($error === 4){
            echo " <script>
                        alert('Pilih gambar terlebih dahulu!');
                    </script>
                ";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $explodeNamaFile = explode('.', $namaFIle);
        $ekstensiGambar = strtolower(end($explodeNamaFile));
        
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo " <script>
                        alert('File yang anda pilih bukan berupa gambar!');
                    </script>
                ";
            return false;
        }

        // cek ukuran file dengan max 2000000 byte == 2 MB
        if($ukuranFile > 2000000){
            echo " <script>
                        alert('File yang anda pilih melebihi 1MB!');
                    </script>
                ";
            return false;
        }

        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmp_name, 'images/' . $namaFileBaru);

        return $namaFileBaru;
    }

    // hapus data
    function hapus($menu, $id){
        global $conn;
       
        switch($menu){
            case 1:
                $gambarDestinasiWisata = query("SELECT gambarTempat FROM destinasi_wisata where id = $id")[0];
                unlink("images/" . $gambarDestinasiWisata["gambarTempat"]);

                $gambarDetailWisataPost = query("SELECT gambar FROM detail_wisata_post WHERE id_detail_wisata = $id");
                
                if($gambarDetailWisataPost){
                    foreach($gambarDetailWisataPost as $gambar){
                        unlink("images/" . $gambar["gambar"]);
                    }
                }

                mysqli_query($conn, "DELETE FROM detail_wisata_post WHERE id_detail_wisata = $id");
                mysqli_query($conn, "DELETE FROM detail_wisata WHERE id_destinasi_wisata = $id");
                mysqli_query($conn, "DELETE FROM detail_wisata_harga WHERE id_destinasi_wisata = $id");

                mysqli_query($conn, "DELETE FROM destinasi_wisata WHERE id = $id");
                
            break;
            case 2:

                $gambarDetailWisataPost =query("SELECT gambar FROM detail_wisata_post WHERE id = $id");

                if($gambarDetailWisataPost){
                    unlink("images/" . $gambarDetailWisataPost[0]["gambar"]);
                }

                mysqli_query($conn, "DELETE FROM detail_wisata_post WHERE id = $id");
            break;
        }
        
        return mysqli_affected_rows($conn);
    }

    // ubah data
    function ubah($data, $no){
        global $conn;

        switch($no){
            case 1:
                $id = $data["id"];
                $namaTempat = mysqli_real_escape_string($conn, htmlspecialchars($data["namaTempat"]));
                $detailSingkat = mysqli_real_escape_string($conn, htmlspecialchars($data["detailSingkat"]));
                $tombolTeks = htmlspecialchars($data["tombolTeks"]);
                $gambarLama = htmlspecialchars($data["gambarLama"]);
                
                if($_FILES["gambarTempat"]["error"] === 4){
                    $gambar = $gambarLama;
                }else{
                    $gambar = upload("gambarTempat");
                    unlink("images/" . $gambarLama);
                }

                $query = "UPDATE destinasi_wisata SET
                            namaTempat = '$namaTempat',
                            detailSingkat = '$detailSingkat',
                            tombolTeks = '$tombolTeks',
                            gambarTempat = '$gambar'
                        WHERE id = $id;
                ";
            break;
            case 2:
                $nama_web = mysqli_real_escape_string($conn, htmlspecialchars($data["nama_web"]));
                $detail_web = mysqli_real_escape_string($conn, htmlspecialchars($data["detail_web"]));
                $header1 = mysqli_real_escape_string($conn, htmlspecialchars($data["header1"]));
                $header2 = mysqli_real_escape_string($conn, htmlspecialchars($data["header2"]));
                $header1_2 = mysqli_real_escape_string($conn, htmlspecialchars($data["header1_2"]));
                $map = mysqli_real_escape_string($conn, $data["map"]);
                $instagram = mysqli_real_escape_string($conn, htmlspecialchars($data["instagram"]));
                $whatsapp = mysqli_real_escape_string($conn, htmlspecialchars($data["whatsapp"]));
                $facebook = mysqli_real_escape_string($conn, htmlspecialchars($data["facebook"]));
                $footer = mysqli_real_escape_string($conn, htmlspecialchars($data["footer"]));
                $gambarLama = htmlspecialchars($data["gambarLama"]);

                if($_FILES["hero"]["error"] === 4){
                    $gambar = $gambarLama;
                }else{
                    $gambar = upload("hero");
                    unlink("images/" . $gambarLama);
                }

                $query = "UPDATE detail_website SET
                            nama_web = '$nama_web',
                            hero = '$gambar',
                            detail_web = '$detail_web',
                            header1 = '$header1',
                            header2 = '$header2',
                            header1_2 = '$header1_2',
                            map = '$map',
                            instagram = '$instagram',
                            whatsapp = '$whatsapp',
                            facebook = '$facebook',
                            footer = '$footer'
                        WHERE id = 1;
                ";

            break;
            case 3:
                $id = $data["id"];
                $gambarTitle = mysqli_real_escape_string($conn, htmlspecialchars($data["gambarTitle"]));
                $gambarDetail = mysqli_real_escape_string($conn, htmlspecialchars($data["gambarDetail"]));
                $gambarLama = htmlspecialchars($data["gambarLama"]);

                if($_FILES["gambar"]["error"] === 4){
                    $gambar = $gambarLama;
                }else{
                    $gambar = upload("gambar");
                    unlink("images/" . $gambarLama);
                }

                $query = "UPDATE detail_wisata_post SET
                            gambar = '$gambar',
                            gambarTitle = '$gambarTitle',
                            gambarDetail = '$gambarDetail'
                        WHERE id = $id";

            break;
            case 4:
                $id = $data["id"];
                $header1 = mysqli_real_escape_string($conn, htmlspecialchars($data["header1"]));
                $header2 = mysqli_real_escape_string($conn, htmlspecialchars($data["header2"]));
                $header3 = mysqli_real_escape_string($conn, htmlspecialchars($data["header3"]));
                $map = $data["map"];

                $query = "UPDATE detail_wisata SET
                            header1 = '$header1',
                            header2 = '$header2',
                            header3 = '$header3',
                            map = '$map'
                        WHERE id_destinasi_wisata = $id";
            break;
            case 5:
                $id = $data["id"];
                $dewasa = intval($data["dewasa"]);
                $anak = intval($data["anak"]);
                $dewasa_weekend = intval($data["dewasa_weekend"]);
                $anak_weekend = intval($data["anak_weekend"]);

                $query = "UPDATE detail_wisata_harga SET
                            dewasa = '$dewasa',
                            anak = '$anak',
                            dewasa_weekend = '$dewasa_weekend',
                            anak_weekend = '$anak_weekend'
                        WHERE id_destinasi_wisata = $id";
            break;
        }

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // cari data
    function cari($keyword, $namaTabel){
        $query = "SELECT * FROM $namaTabel
                    WHERE
                    namaTempat LIKE '%$keyword%'
        ";

        return $query;
    }

    // tambah user
    function ubahAdmin($data){
        global $conn;

        // admin
        // $2y$10$fYEcUFAc.Gcm2ALH56ggsuEFD8Y9vC9kGHibkiiDjeLUvYq.Uq74O

        $usernameLama = mysqli_real_escape_string($conn, strtolower(stripslashes($data["usernameLama"])));
        $passwordLama = mysqli_real_escape_string($conn, $data["passwordLama"]);
        $usernameBaru = mysqli_real_escape_string($conn, strtolower(stripslashes($data["usernameBaru"])));
        $passwordBaru = mysqli_real_escape_string($conn, $data["passwordBaru"]);

        $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$usernameLama'"); 

        $result = mysqli_fetch_assoc($result);

        if($usernameLama == $result["username"] && password_verify($passwordLama, $result["password"])){

            // enkripsi password
            $passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);

            mysqli_query($conn, "UPDATE admin SET username = '$usernameBaru', password = '$passwordBaru'");

        }else{
            echo "<script>
                    alert('username atau password lama salah!');
                  </script>
            ";

            return -1;
        }

        return mysqli_affected_rows($conn);
    }

    function tampil($namaTabel){

        global $conn;

        $query = "SELECT * FROM $namaTabel";

        if(isset($_POST["refresh"])){
            setcookie('keyword', '', time() - 3600);
        }

        if(empty($_POST["keyword"]) && isset($_POST["cari"])){
            setcookie('keyword', '', time() - 3600);
        }else{
            
            if(!isset($_POST["keyword"]) && !isset($_COOKIE["keyword"])){
                false;
            }else{
                if(!isset($_COOKIE["keyword"])){
                    setcookie("keyword", $_POST["keyword"]);
                    $keyword = mysqli_real_escape_string($conn, $_POST["keyword"]);
                }else if(isset($_POST["keyword"])){
                    if(($_COOKIE["keyword"] !== $_POST["keyword"])){
                        setcookie("keyword", $_POST["keyword"]);
                        $keyword = mysqli_real_escape_string($conn, $_POST["keyword"]);
                    }
                }
                else{
                    $keyword = $_COOKIE["keyword"];
                }
                $_POST = [];
                if(!isset($keyword) && isset($_COOKIE["keyword"])){
                    setcookie('keyword', '', time() - 3600);
                    false;
                }else{
                    $query = cari($keyword, $namaTabel);
                    unset($_GET["halaman"]);
                }
            }
        }

        return $query;

    }

    function tampilLagi($namaTabel){

        $query = tampil("$namaTabel");
        
        $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1; 

        $jumlahDataPerHalaman = 3;
        $jumlahData = count(query("$query"));
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data = query("$query " . "LIMIT $awalData, $jumlahDataPerHalaman");

        if(empty($jumlahData) && isset($_COOKIE["keyword"])){
            return "kosong";
        }

        if(empty($data)){
            setcookie('keyword', '', time() - 3600);
            
            echo " <script>
                        alert('Keyword yang anda cari tidak ditemukan!');
                        document.location.href = 'index.php';
                    </script>
                ";
        }
        $kembali= ["awalData" => $awalData, "jumlahHalaman" => $jumlahHalaman, "data" => $data, "halamanAktif" => $halamanAktif];

        return $kembali;

    }

    function ubahLeftSide($menu, $menuTampil){
        if($menu == $menuTampil){
            return "background-color: #a77d3e;";
        }
    }

    function salam($nama = "Ibu"){

        date_default_timezone_set("Asia/Jakarta");

        $waktu = date("G");

        if($waktu <= 5 || $waktu >= 18){
            $waktu = "Malam";
        }else if($waktu <= 10){
            $waktu = "Pagi";
        }else if($waktu <= 14){
            $waktu = "Siang";
        }else{
            $waktu = "Sore";
        }

        return "Selamat $waktu, $nama!";
    }
?>