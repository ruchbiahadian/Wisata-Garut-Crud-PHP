                <div class="rightSideContainer">

                        <h3 class="pt-5 pb-3">Destinasi Wisata</h3>

                        <a href="tambahDestinasi.php" class="btn btn-primary px-3 mt-5">Tambah Destinasi</a>

                        <?php 
                            if($data == "kosong"){
                                include 'dbKosong.php';die;
                            }
                        ?>

                        <form action="" method="post" class="cari mt-4">
                            <input type="text" name="keyword" size="40" placeholder="masukkan keyword pencarian.." autocomplete="off">
                            <button type="submit" name="cari" class="btn btn-outline-success mx-2">Cari</button>
                            <button type="submit" name="refresh"  class="btn btn-outline-secondary">Refresh</button>
                        </form>

                        <table border="1" cellspacing="0" cellpadding="16" class="table mt-3">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Destinasi Wisata</th>
                                    <th colspan="2" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($data["data"] as $destinasiWisata) : ?>
                                    <tr>
                                        <td align="center"><?= $i + $data["awalData"] ?></td>
                                        <td><?= $destinasiWisata["namaTempat"] ?></td>
                                        <td align="center"><a href="ubah.php?id=<?= $destinasiWisata['id'] ?>" class="btn btn-primary px-4">Edit</a></td>
                                        <td align="center"><a href="hapus.php?menu=1&id=<?= $destinasiWisata['id'] ?>" class="btn btn-danger px-4" onclick="return confirm('Yakin?')">Hapus</a></td>
                                    </tr>
                                        
                                    <?php $i++; ?>
                                    <?php endforeach ?>
                            </tbody>
                        </table>

                    <div class="pagination mt-5">
                        <?php include 'pagination.php' ?>
                    </div>
                </div>