<?php

    if(isset($_POST["ubahAdmin"])){
        if(ubahAdmin($_POST) > 0){
            echo " <script>
                        alert('Username / Password Admin berhasil diubah!');
                        document.location.href = 'logout.php';
                    </script>
                ";
        }else{
            echo " <script>
                        alert('Username / Password Admin gagal diubah!');
                        document.location.href = 'admin.php?menu=3';
                    </script>
                ";
        }

    }

?>

    <div class="rightSideContainer">

        <h3 class="pt-5 pb-3">Ubah Username / Password Admin</h3>

        <form action="" method="post">
            <ul>
                <li>
                    <label for="usernameLama">Username Lama: </label>
                    <input type="text" name="usernameLama" id="usernameLama">
                </li>
                <li>
                    <label for="passwordLama">Password Lama: </label>
                    <input type="password" name="passwordLama" id="passwordLama">
                </li>
                <li>
                    <label for="usernameBaru">Username Baru: </label>
                    <input type="text" name="usernameBaru" id="usernameBaru">
                </li>
                <li>
                    <label for="passwordBaru">Password Baru: </label>
                    <input type="password" name="passwordBaru" id="passwordBaru">
                </li>
                <li>
                    <button type="submit" name="ubahAdmin" onclick="return confirm('Yakin?')" class="btn btn-success mb-5">Ubah Admin</button>
                </li>
            </ul>
        </form>
    </div>