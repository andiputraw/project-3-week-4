<?php
    use App\Models\User;
?>
<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>

<main class="container">
    <h1>Halo: <?= session()->get('role') === User::ROLE_ADMIN ? esc(session()->get("admin")['full_name']) : esc(session()->get("mahasiswa")['nama_lengkap']) ?></h1>
    
    <ul>
        <?php if(session()->get("role") === User::ROLE_ADMIN): ?>
            <li><a href="/mahasiswa">Data Mahasiswa</a></li>
            <li><a href="/courses">Data Course</a></li>
        <?php else: ?>
            <li><a href="/courses">Course List</a></li>
            <!-- <li><a href="/courses/enroll">Enroll Course</a></li> -->
        <?php endif ?>
    </ul>

    <h2>Coming Soon</h2>
</main>

<?= $this->endSection() ?>