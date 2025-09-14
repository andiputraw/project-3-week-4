<?= $this->extend("auth/layout.php") ?>

<?= $this->section("content") ?>

<main class="container">
    <h1 >Login</h1>
    <form action="/auth/login" method="post">
        <?= validation_list_errors() ?>
        <?= ((session()->getFlashdata("error") ?? "")) ?>
        <input type="text" name="username" placeholder="username" value="<?= old('username') ?>" >    
        <input type="password" name="password" placeholder="password" value="<?= old('password') ?>" >    
        <button type="submit">Login</button>
    </form>
    </main>

<?= $this->endSection() ?>