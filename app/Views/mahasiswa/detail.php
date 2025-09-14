<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>
<main class="container">

    
    <article>
    <header><h1><?= $mahasiswa["nama_lengkap"] ?></h1></header>
    
     <p>NIM: <?= $mahasiswa["nim"] ?></p>
   
    <p>Jenis Kelamin: <?= $mahasiswa["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?>   </p>
    <p>Tanggal Lahir: <?= $mahasiswa["tanggal_lahir"] ?>   </p>
    </article>
    <footer></footer>
</main>

<?= $this->endSection() ?>