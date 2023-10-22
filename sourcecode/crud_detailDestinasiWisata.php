<div class="rightSideContainer">

                        <h3 class="pt-5 pb-3">Detail Destinasi Wisata</h3>

                        <?php 
                            if($data == "kosong"){
                                include 'dbKosong.php';die;
                            }
                        ?>

                        <form action="" method="post" class="cari mt-4">
                            <input type="text" name="keyword" size="40" placeholder="masukkan keyword pencarian.." autocomplete="off">
                            <button type="submit" name="cari" class="btn btn-outline-success mx-2">Cari</button>
                            <button type="submit" name="refresh" class="btn btn-outline-secondary">Refresh</button>
                        </form>

                        <table border="1" cellspacing="0" cellpadding="16" class="table mt-4">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Destinasi Wisata</th>
                                    <th colspan="3" scope="col">Aksi</th>
                                </tr>
                            </thead>
                                
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($data["data"] as $destinasiWisata) : ?>
                                    
                                    <tr>
                                        <td align="center"><?= $i + $data["awalData"] ?></td>
                                        <td><?= $destinasiWisata["namaTempat"] ?></td>
                                        <td align="center"><a href="crud_detailWisata.php?id=<?= $destinasiWisata['id'] ?>" class="btn btn-secondary">Edit Halaman</a></td>
                                        <td align="center"><a href="crud_detailWisata3.php?id=<?= $destinasiWisata['id'] ?>" class="btn btn-secondary">Tambah Harga</a></td>
                                        <td align="center"><a href="crud_detailWisata2.php?id=<?= $destinasiWisata['id'] ?>" class="btn btn-primary">Tambah Detail</a></td>
                                    </tr>
                                        
                                    <?php $i++; ?>
                                    <?php endforeach ?>
                            </tbody>
                        </table>

                
                    <div class="pagination mt-5">
                        <?php include 'pagination.php' ?>
                    </div>
                </div>