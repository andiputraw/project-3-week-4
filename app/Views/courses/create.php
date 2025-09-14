<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>

<h1>Tambah Course</h1>

<form  action="/courses" method="post">
    <?= validation_list_errors() ?>
    
    <div>
         <input type="text" name="course_name"  value='<?= old('course_name') ?>' placeholder="Nama Course" id="course_name" >
    </div>

    <div>
         <input type="number" name="credits"  value='<?= old('credits') ?>' placeholder="Credits" id="credits" >
    </div>
    
    <button type="submit">Tambah Course</button>
</form>
<?= $this->endSection() ?>