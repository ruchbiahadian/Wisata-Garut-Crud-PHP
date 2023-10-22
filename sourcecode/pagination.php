<?php 

    if(isset($_GET["menu"])){
        $menu = $_GET["menu"];
    }else{
        $menu = "";
    }

?>

<!-- navigasi -->
<?php if($data["halamanAktif"] > 1) : ?>
     <a href="?menu=<?= $menu ?>&halaman=<?= $data["halamanAktif"]-1 ?>">&laquo;</a>
<?php endif ?>

<?php for($i=1; $i<=$data["jumlahHalaman"]; $i++) : ?>
    <?php if($i == $data["halamanAktif"]) : ?>
        <a href= "?menu=<?= $menu ?>&halaman=<?= $i ?>" style="font-weight: bold; background-color: #a77d3e;"><?= $i ?></a>
        <?php else: ?>
            <a href="?menu=<?= $menu ?>&halaman=<?= $i ?>"><?= $i ?></a>
        <?php endif ?>
<?php endfor; ?>

<?php if($data["halamanAktif"] < $data["jumlahHalaman"]) : ?>
    <a href="?menu=<?= $menu ?>&halaman=<?= $data["halamanAktif"]+1 ?>">&raquo;</a>
<?php endif ?>