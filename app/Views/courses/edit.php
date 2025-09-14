<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>

<h1>Update Course</h1>

<form  action="/courses/<?= $data['course_id'] ?>" method="post">
    <?= validation_list_errors() ?>
    <input type="hidden" name="_method" value="PUT">

    <!-- <input type="hidden" name="course_id" value="<?= $data['course_id'] ?>"> -->
    
    <div>
         <input type="text" name="course_name"  value='<?= old('course_name') != null ? old('course_name') : $data['course_name'] ?>' placeholder="Nama Course" id="course_name" >
    </div>

    <div>
         <input type="number" name="credits"  value='<?= old('credits') != null ? old('credits') : $data['credits'] ?>' placeholder="Credits" id="credits" >
    </div>
    
    <button type="submit">Update Course</button>
</form>
<?= $this->endSection() ?>