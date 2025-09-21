<?php
use App\Models\User;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>
    <script src="<?= base_url() ?>/global.js"></script>
    <script src="<?= base_url() ?>/index.js" defer></script>
</head>
<body>

    <dialog id="modal">
      
    </dialog>
    <nav class="container">
        <ul>
            <li><a href="/">Home</a></li>

        <?php if(is_admin()): ?>
            <li><a href="/mahasiswa">Mahasiswa</a></li>
        <?php else: ?>
            <li><a href="/courses">Course</a></li>

            <?php endif;?>
        </ul>
        <ul>
            <button class="secondary" onclick="SimpleModal('Apakah kamu yakin?', () => Redirect('/auth/logout'))" >
                Logout
            </button>
        </ul>
    </nav>
    <main class="container" >
        <?= $this->renderSection('content') ?>
    </main>
</body>
</html>