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

    <table style="border: 1px solid black;">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>SKS</th>
            <th >Aksi</th>
            

        </tr>
        <?php foreach ($courses as $course) : ?>
            <tr>
                <td>
                    <a href="/courses/<?= $course["course_id"] ?>"><?= $course["course_id"] ?></a>
                </td>
                <td>
                    <?= $course["course_name"] ?>
                </td>
                <td>
                    <?= $course["credits"] ?>
                </td>
                <?php if (is_admin()): ?>
                <td>
                    <form action="/courses/edit/<?= $course["course_id"] ?>">
                        <button type="submit">Edit</button>
                    </form>
                    <form action="/courses/<?= $course["course_id"] ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit">Delete</button>
                    </form>
                </td>
                <?php else: ?>
                <td >
                    <form action="/courses/enroll/<?= $course["course_id"] ?>" method="post">

                        <button type="submit" <?= ($course["enroll_date"] != null ? 'disabled' : '') ?>>Enroll</button>
                        <small>
                            <?php if ($course["enroll_date"] != null ): ?>
                            Diambil pada <?= $course["enroll_date"] ?>
                            <?php endif ?>
                        </small>
                    </form>
                </td>
                <?php endif;?>

            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?= $this->endSection() ?>