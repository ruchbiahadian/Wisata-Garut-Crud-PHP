<?php

    session_start();

    require 'functions.php';

    // background
    $bg = mysqli_query($conn, "SELECT hero FROM detail_website 
                                    WHERE id = 1");

    $background = mysqli_fetch_assoc($bg);

    // cek cookie
    if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
        $id = $_COOKIE["id"];
        $key = $_COOKIE["key"];
        
        // ambil username berdasarka id
        $result = mysqli_query($conn, "SELECT username FROM admin 
                                            WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        // cek cookie dan username
        if($key === hash('sha256', $row['username'])){
            $_SESSION["login"] = true;
        }



    }

    if(isset($_SESSION["login"])){
        header("Location: admin.php");
        exit;
    }


    if(isset($_POST["login"])){

         // ambil data
        $username = $_POST["username"];
        $password = $_POST["password"];
        

        $result = mysqli_query($conn, "SELECT * FROM admin 
                                            WHERE username = '$username'");

        if(mysqli_num_rows($result) === 1){

            // cek password
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row["password"])){

                // set session
                $_SESSION["login"] = true;

                // cek remember me
                if(isset($_POST["remember"])){

                    // set cookie
                    setcookie('id', $row['id'], time() + 604800);
                    setcookie('key', hash('sha256' , $row['username']), time() + 604800);
                }

                header("Location: admin.php");
                exit;
            }


        }

        $error = true;

    }

     $salam = salam("Admin");
        echo " <script>
                    alert('$salam')
                </script>
            ";




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .hero{
            background-image: url(images/<?= $background["hero"] ?>);
        }
    </style>
</head>
<body>


    <section class="hero" id="hero">
        
        <div class="inputLogin pt-5">

            <h2>Login Admin</h2>

            <?php if(isset($error)): ?>
                <p style="color: red; font-style: italic; font-size: medium; font-weight: bold;">username atau password salah!</p>
            <?php endif ?>


            <form action="" method="post">
                <ul>
                    <li class="inputTitle">
                        <label for="username">Username </label> <br>
                        <input type="text" name="username" id="username" required>
                    </li>
                    <li class="inputTitle">
                        <label for="password">Password </label> <br>
                        <input type="password" name="password" id="password" required>
                    </li>
                    <li>
                        <input type="checkbox" name="remember" id="login">
                        <label for="login">Remember Me</label>
                    </li>
                    <li>
                        <button type="submit" name="login" class="btn btn-primary mr-2" style="background-color: #EBB970;  border: none;" onMouseOver="this.style.background='#a77d3e'"
                                    onMouseOut="this.style.background='#EBB970'">Login</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </li>
                </ul>
            </form>

            <a href="index.php">Kembali</a>

        </div>
        
    </section>

    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    
</body>
</html>