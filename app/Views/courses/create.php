<?= $this->extend("layout.php") ?>

<?= $this->section("content") ?>

<h1>Tambah Course</h1>

<form id="create-form" action="/courses" method="post">
    <?= validation_list_errors() ?>
    
    <div>
         <input type="text" name="course_name"  value='<?= old('course_name') ?>' placeholder="Nama Course" id="course_name" >
    </div>

    <div>
         <input type="number" name="credits"  value='<?= old('credits') ?>' placeholder="Credits" id="credits" >
    </div>
    
    <button type="submit">Tambah Course</button>
</form>

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