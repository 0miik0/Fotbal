<?=$this->extend('layout/template')?>
<?=$this->section('content')?>

<div class="container mt-5">
    <h2>Registrace</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('register') ?>">
        <div class="mb-3">
            <label for="identity" class="form-label">Uživatelské jméno</label>
            <input type="text" class="form-control" id="identity" name="identity" value="<?= old('identity') ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirm" class="form-label">Potvrď heslo</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
        </div>

        <button type="submit" class="btn btn-secondary">Registrovat</button>
    </form>
</div>

<?=$this->endSection()?>