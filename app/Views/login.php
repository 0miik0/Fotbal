<?=$this->extend('layout/template')?>
<?=$this->section('content')?>

<div class="container mt-5">
    <h2>Login</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login') ?>">
        <div class="mb-3">
            <label for="identity" class="form-label">Uživatelské jméno nebo email</label>
            <input type="text" class="form-control" id="identity" name="identity" value="<?= old('identity') ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
            <label class="form-check-label" for="remember">Zapamatovat si mě</label>
        </div>

        <button type="submit" class="btn btn-primary">Přihlásit se</button>
    </form>
</div>

<?=$this->endSection()?>