<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>

<h1>Tambah Mahasiswa</h1>

<form  action="/mahasiswa" method="post">
    <?= validation_list_errors() ?>
    
    <div>
         <input type="text" name="nim"  value='<?= old('nim') ?>' placeholder="NIM" id="nim" >
    </div>
    <div>
         <input type="text" name="nama_lengkap"  value='<?= old('nama_lengkap') ?>' placeholder="Nama Lengkap" id="nama_lengkap" >
    </div>
    <div>
        <input type="date" name="tanggal_lahir"  value='<?= old('tanggal_lahir') ?>' placeholder="Tanggal Lahir" id="tanggal_lahir" >
    </div>
    
    <div>
        <select name="entry_year" id="entry_year" aria-label="Pilih Tahun Masuk">
            
        </select>
        <small>Tahun Masuk</small>
        <script>
            // generate tahun dengan mudah
            const year = document.getElementById("entry_year");
            for (let i = 2025; i >= 2000; i--) {
                const option = document.createElement("option");
                option.value = i;
                option.textContent = i;
                year.appendChild(option);
            }
        </script>
    </div>
    <div>
        <select name="jenis_kelamin" id="jenis_kelamin" aria-label="Pilih Jenis Kelamin">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div>
        <input type="text" name="username"  value='<?= old('username') ?>'  placeholder="username" id="username" >
    </div>
    <div>
        <input type="password" name="password"  value='<?= old('password') ?>'  placeholder="password" id="password" >
    </div>

    <button type="submit">Tambah Mahasiswa</button>
</form>
<?= $this->endSection() ?>