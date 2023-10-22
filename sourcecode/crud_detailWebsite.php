                <?php

                    if(isset($_POST["submit"])){
                        if(ubah($_POST, 2) >= 0){
                            echo " <script>
                                        alert('Data berhasil diubah!');
                                        document.location.href = 'admin.php';
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

                ?>
                
                <div class="rightSideContainer">

                <h3 class="pt-5 pb-3">Ubah Detail Website</h3>

                <form action="" method="post" enctype="multipart/form-data">
                    <ul>
                        <input type="hidden" name="gambarLama" value="<?= $web["hero"] ?>">
                        <li>
                            <label for="hero">Gambar Hero : </label>
                            <img src="images/<?= $web["hero"] ?>" style="width:400px"> <br>
                            <input type="file" name="hero" id="hero">
                        </li>
                        <li>
                            <label for="nama_web">Nama Website : </label>
                            <input type="text" name="nama_web" id="nama_web" value="<?= $web["nama_web"] ?>" required>
                        </li>
                        <li>
                            <label for="detail_web">Detail Website : </label>
                            <textarea name="detail_web" id="detail_web" cols="30" rows="10"><?= $web["detail_web"] ?></textarea>
                        </li>       
                        <li>
                            <label for="header1">Header 1 : </label>
                            <input type="text" name="header1" id="header1" value="<?= $web["header1"] ?>" required>
                        </li>
                        <li>
                            <label for="header2">Header 2 : </label>
                            <input type="text" name="header2" id="header2" value="<?= $web["header2"] ?>" required>
                        </li>
                        <li>
                            <label for="header1_2">Header 1_2 : </label>
                            <input type="text" name="header1_2" id="header1_2" value="<?= $web["header1_2"] ?>" required>
                        </li>
                        <li>
                            <label for="map">Map : </label>
                            <textarea name="map" id="map" cols="30" rows="10" required><?= $web["map"] ?></textarea>
                            <p class="mapText">Embed html map dari google maps!</p>
                        </li>  
                        <li>
                            <label for="instagram">instagram : </label>
                            <input type="text" name="instagram" id="instagram" value="<?= $web["instagram"] ?>" required>
                        </li>
                        <li>
                            <label for="whatsapp">Whatsapp : </label>
                            <input type="text" name="whatsapp" id="whatsapp" value="<?= $web["whatsapp"] ?>" required>
                        </li>
                        <li>
                            <label for="facebook">Facebook : </label>
                            <input type="text" name="facebook" id="facebook" value="<?= $web["facebook"] ?>" required>
                        </li>
                        <li>
                            <label for="footer">Footer : </label>
                            <input type="text" name="footer" id="footer" value="<?= $web["footer"] ?>" required>
                        </li>
                        <li>
                            <button type="submit" name="submit" class="btn btn-success mb-5">Ubah Data</button>
                        </li>
                    </ul>
                </form>

                </div>