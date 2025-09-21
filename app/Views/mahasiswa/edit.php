<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>

<main class="container">


    <h1>Edit Mahasiswa</h1>

    <form action="/mahasiswa/<?= $mahasiswa["nim"] ?>" method="post" id="create-form">
        <?= validation_list_errors() ?>
        <input type="hidden" name="_method" value="PUT">

        <div>
            <input type="text" name="nim" placeholder="NIM" id="nim" value="<?= old('nim') != null ? old('nim') :  $mahasiswa["nim"] ?>">
        </div>
        <div>
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" id="nama_lengkap" value="<?= old('nama_lengkap') != null ? old('nama_lengkap') :  $mahasiswa["nama_lengkap"] ?>">
        </div>
        <div>
            <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" id="tanggal_lahir" value="<?= old('tanggal_lahir') != null ? old('tanggal_lahir') :  $mahasiswa["tanggal_lahir"] ?>">
        </div>
        <div>
            <select name="jenis_kelamin" id="jenis_kelamin" aria-label="Pilih Jenis Kelamin">
                <option value="L" <?= $mahasiswa["jenis_kelamin"] == "L" ? "selected" : "" ?>>Laki-laki</option>
                <option value="P" <?= $mahasiswa["jenis_kelamin"] == "P" ? "selected" : "" ?>>Perempuan</option>
            </select>
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
            <input type="text" name="username" value='<?= old('username') != null ? old('username') : $user['username'] ?>' placeholder="username" id="username"   >
        </div>
        <div>
            <input type="password" name="password" value='<?= old('password') ?>' placeholder="password" id="password">
        </div>
        <button type="submit">Edit Mahasiswa</button>
    </form>
</main>

<script>


     const inputs = document.querySelectorAll('#create-form input')

     
     document.getElementById('create-form').addEventListener('submit', async (e) => {
          e.preventDefault()

          let nodes = []
          for(const input of inputs) {
               if (input.value == '') nodes.push(input)
          }

          if(nodes.length > 0) {
               for(const node of nodes) {
                    node.setAttribute('aria-invalid', 'true')
               }
               return
          }
          
          e.target.submit()
     })
</script>
<?= $this->endSection() ?>