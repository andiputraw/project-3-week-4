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
            <input type="text" name="keyword" id="keyword" value="<?= $_GET["keyword"] ?? "" ?>" placeholder="Masukan Nama Mahasiswa">
            <button type="submit">Cari</button>
        </fieldset>
    </form>

    <table id="data-table" style="border: 1px solid black">

    </table>
</div>

<script>

    class Mahasiswa {
        entry_year
        jenis_kelamin
        nama_lengkap
        nim
        tanggal_lahir
        user_id
        constructor({
            entry_year,
            jenis_kelamin,
            nama_lengkap,
            nim,
            tanggal_lahir,
            user_id
        }) {
            this.entry_year = entry_year;
            this.jenis_kelamin = jenis_kelamin
            this.nama_lengkap = nama_lengkap
            this.nim = nim
            this.tanggal_lahir = tanggal_lahir
            this.user_id = user_id

        }
    }

    const table = document.getElementById('data-table')
    /**@type {HTMLInputElement} */
    const search = document.getElementById('keyword')

    async function handleDelete(id) {
        await fetch(`/mahasiswa/${id}`, {
            headers: DefaultHeader,
            method: "DELETE"
        })

        await populateMahasiswa(table, search.value)
        closeModal()
    }   

    function closeModal() {
        modal.close()
    }

    function deleteModal(mahasiswaName, mahasiswaNim) {
        
        /**
         * @type {HTMLDialogElement}
         */

        modal.innerHTML = `
        <div>
        <h1>Apakah kamu yakin ingin menghapus ${mahasiswaName} </h1>
        <div role="group" >
            <button id="cancel" onclick='closeModal()'  type="reset">Cancel</button>
            <button disabled id="deleteModalButton" onclick='handleDelete("${mahasiswaNim}")'  type="submit">Confirm 3</button>
        </div>
        </div>
        `
        /**@type {HTMLButtonElement} */
        const btnDelete = document.getElementById('deleteModalButton')
        setTimeout(() => {
            btnDelete.innerHTML = "Confirm 2"
        }, 1*SECS);
        setTimeout(() => {
            btnDelete.innerHTML = "Confirm 1"
        }, 2*SECS);
        setTimeout(() => {
            btnDelete.innerHTML = "Confirm"
            btnDelete.disabled = false;
        }, 3*SECS);
        
        modal.showModal()
    }


    async function populateMahasiswa(table, search = '') {
        const mahasiswa = await fetch(`/mahasiswa?keyword=${search}`, {
            headers: DefaultHeader
        }).then(async (res) => (await res.json()))

        table.innerHTML = `
        <tr>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
        </tr>
        `
        for (const mhsRaw of mahasiswa) {
            const mhs = new Mahasiswa(mhsRaw)

            table.innerHTML += `
                <tr>
                <td>
                    <a href="/mahasiswa/${mhs.nim}">${mhs.nim}</a>
                </td>
                <td>
                    ${mhs.nama_lengkap} 
                </td>
                <td>
                    ${mhs.jenis_kelamin ? "Laki-laki" : "Perempuan"}
                </td>
                <td>
                    ${mhs.tanggal_lahir}
                </td>
                <td>
                    <form action="/mahasiswa/edit/${mhs.nim}">
                        <button type="submit">Edit</button>
                    </form>
                    
                        <button type="submit" onclick="deleteModal('${mhs.nama_lengkap}', ${mhs.nim})">Delete</button>
                    

                </td>
            </tr>`
        }
    }


    (async () => {

        populateMahasiswa(table, search.value)

        search.addEventListener('input', (ev) => {
            populateMahasiswa(table, search.value)
        })

    })()
</script>

<?= $this->endSection() ?>