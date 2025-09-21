<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>
<div class="container">

    <h1>List Course</h1>

    <?php if (is_admin()): ?>
        <a href="/courses/create">Tambah Course</a>
    <?php endif; ?>
    <div>
        <?= ((session()->getFlashdata("error") ?? "")) ?>
        <?= ((session()->getFlashdata("info") ?? "")) ?>
    </div>


    <form action="/courses" method="get">
        <fieldset role="group">
            <input type="text" name="keyword" id="keyword" value="<?= $_GET["keyword"] ?? "" ?>" placeholder="Masukan Nama Course">
            <button type="submit">Cari</button>
        </fieldset>
    </form>
    <?php if (is_admin()): ?>
        <table>
            <thead>
                <th>ID</th>
                <th>Credits</th>
                <th>SKS</th>
                <th>Aksi</th>
            </thead>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td>
                        <a href="/courses/<?= $course['course_id'] ?>"> <?= $course['course_id'] ?> </a>
                    </td>
                    <td>
                        <?= $course['course_name'] ?>
                    </td>
                    <td>
                        <?= $course['credits'] ?>
                    </td>
                    <td>
                        <div role="group">
                            <button class="contrast" onclick="Redirect('/courses/edit/<?= $course['course_id'] ?>')">
                                Edit
                            </button>
                            <button class="secondary" onclick="deleteModal('<?= $course['course_name']  ?>' + ' Dengan SKS ' + '<?= $course['credits']  ?>'   , '<?= $course['course_id'] ?>')">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php endif; ?>
    <?php if (!is_admin()): ?>
        <table style="border: 1px solid black;" id="non-checked-table">

        </table>

        <h1>Course yang diambil</h1>
        <small id="total-sks"></small>
        <table style="border: 1px solid black;" id="checked-table">

        </table>
        <button id="ambil-course" type="input" class="contrast">Ambil</button>
    <?php endif; ?>
</div>

<script>
    /**@type {[]Record<string, any>} */
    const json = <?= json_encode($courses) ?>;

    json.forEach((v) => {
        v.selected = v.enroll_date != null
    })

    let collectedCourse = []
    let nonCollectedCourse = []

    // const modal = document.getElementById('modal')
    <?php if (!is_admin()): ?>
        const checkedTable = document.getElementById('checked-table')
        const nonCheckedTable = document.getElementById('non-checked-table')
        const totalSks = document.getElementById('total-sks')
        const ambilCourseBtn = document.getElementById('ambil-course')

        const ambilAction = async () => {
                const myJson = json.filter((v) => v.selected && v.enroll_date == null)

                await fetch(`/courses/enroll/${myJson.map((v) => v.course_id).join('-')}`, {
                    headers: DefaultHeader,
                    method: 'POST'
                })
                window.location.reload()
            }

        ambilCourseBtn.addEventListener('click', async () => {
            SimpleModal("Apakah kamu yakin ingin mengambil course?", ambilAction)

        })
    <?php endif; ?>


    function closeModal() {
        modal.close()
    }

    const handleDelete = async (id) => {
        console.log(id)
        await fetch(`/courses/${id}`, {
            headers: DefaultHeader,
            method: "DELETE"
        })
        closeModal()
        window.location.reload()
    }

    function deleteModal(desc, id) {

        /**
         * @type {HTMLDialogElement}
         */

        modal.innerHTML = `
        <div>
        <h1>Apakah kamu yakin ingin menghapus ${desc} </h1>
        <div role="group" >
            <button id="cancel" onclick='closeModal()'  type="reset">Cancel</button>
            <button disabled id="deleteModalButton" onclick='handleDelete("${id}")'  type="submit">Confirm 3</button>
        </div>
        </div>
        
        `
        /**@type {HTMLButtonElement} */
        const btnDelete = document.getElementById('deleteModalButton')
        setTimeout(() => {
            btnDelete.innerHTML = "Confirm 2"
        }, 1 * SECS);
        setTimeout(() => {
            btnDelete.innerHTML = "Confirm 1"
        }, 2 * SECS);
        setTimeout(() => {
            btnDelete.innerHTML = "Confirm"
            btnDelete.disabled = false;
        }, 3 * SECS);

        modal.showModal()
    }




    function reloadJson() {
        collectedCourse = json.filter((v) => v.selected)
        nonCollectedCourse = json.filter((v) => !v.selected)

        tableData(checkedTable, collectedCourse, true)
        tableData(nonCheckedTable, nonCollectedCourse)


        totalSks.innerText = `Total SKS: ${collectedCourse.reduce((pre, cur) => pre + parseInt(cur.credits), 0)}`
    }
    /**@param ev {InputEvent} */
    const hadnleChekcboxOnClick = (ev) => {
        /**@type { HTMLInputElement} */
        const checkbox = ev.currentTarget

        const idx = json.findIndex((v) => {
            return v.course_id === checkbox.value
        })
        json[idx].selected = !json[idx].selected
        reloadJson()


    }
    /**
     * @param table {HTMLTableElement}
     */
    function createHeader(table) {

        const tr = document.createElement('tr')

        let th = document.createElement('th')
        th.innerText = 'ID'
        tr.appendChild(th)

        th = document.createElement('th')
        th.innerText = 'Nama'
        tr.appendChild(th)

        th = document.createElement('th')
        th.innerText = 'SKS'
        tr.appendChild(th)

        th = document.createElement('th')
        th.innerText = 'Ambil'
        tr.appendChild(th)


        table.appendChild(tr)
    }
    /**
     * @param table {HTMLTableElement}
     */
    const tableData = (table, data, checked = false) => {
        table.innerText = ''
        // head
        createHeader(table)

        // body
        for (const course of data) {

            const tr = document.createElement('tr')
            let td = document.createElement('td')
            const a = document.createElement('a')
            a.innerText = course.course_id
            a.href = `/courses/${course.course_id}`
            td.appendChild(a)
            tr.appendChild(td)

            td = document.createElement('td')
            td.innerText = course.course_name
            tr.appendChild(td)

            td = document.createElement('td')
            td.innerText = course.credits
            tr.appendChild(td)

            td = document.createElement('td')
            const checkbox = document.createElement('input')

            checkbox.type = 'checkbox'
            checkbox.value = course.course_id
            if (course.enroll_date != null) {
                checkbox.disabled = true;
            }
            if (checked) {
                checkbox.checked = true;
            }
            checkbox.addEventListener('input', hadnleChekcboxOnClick)
            td.appendChild(checkbox)
            tr.appendChild(td)
            table.appendChild(tr)
        }
    }



    <?php if (!is_admin()): ?>
        reloadJson()
    <?php endif; ?>
</script>

<?= $this->endSection() ?>