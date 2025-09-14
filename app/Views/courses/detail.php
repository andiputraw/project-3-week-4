<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>
<main class="container">

    
    <article>
    <header><h1><?= $data["course_name"] ?></h1></header>
    
     <p>ID: <?= $data["course_id"] ?></p>
   
    <p>SKS: <?= $data['credits'] ?></p>
    </article>
    <footer></footer>
</main>

<?= $this->endSection() ?>