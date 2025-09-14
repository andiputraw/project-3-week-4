<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>
<div class="container">

    <h1>List Mahasiswa</h1>

    <div>
        <?= ((session()->getFlashdata("error") ?? "")) ?>
        <?= ((session()->getFlashdata("info") ?? "")) ?>
    </div>

    <a href="/mahasiswa/create">Tambah Mahasiswa</a>
    
    <form action="/mahasiswa" method="get">
        <fieldset role="group">
            <input type="text" name="keyword" id="keyword" value="<?= $_GET["keyword"] ?? "" ?>" placeholder="Masukan Nama Mahasiswa" >
            <button type="submit" >Cari</button>
        </fieldset>
    </form>
    
    <table style="border: 1px solid black" >
        <tr>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td>
                    <a href="/mahasiswa/<?= $mhs["nim"] ?>"><?= $mhs["nim"] ?></a> 
                </td>
                <td>
                    <?= $mhs["nama_lengkap"] ?>
                </td>
                <td>
                    <?= $mhs["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?>
                </td>
                <td>
                    <?= $mhs["tanggal_lahir"] ?>
                </td>
                <td>
                    <form action="/mahasiswa/edit/<?= $mhs["nim"] ?>">
                        <button type="submit">Edit</button>
                    </form>
                    <form action="/mahasiswa/<?= $mhs["nim"] ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE" >
                        
                        <button type="submit" >Delete</button>
                    </form>
                    
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    </div>    
        <?= $this->endSection() ?>