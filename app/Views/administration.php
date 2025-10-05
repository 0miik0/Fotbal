<?=$this->extend("layout/template");?>

<?=$this->section("content");?>

<html lang="cs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Administrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Administrace</h1>

        <?php if (! $ionAuth->loggedIn()) : ?>
            <p>Pro pokračování se přihlas nebo registruj:</p>
            <a href="<?= base_url('login') ?>" class="btn btn-primary me-2">Login</a>
            <a href="<?= base_url('register') ?>" class="btn btn-secondary">Register</a>
        <?php else: ?>
            <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
        <?php endif; ?>
    
        <?php if ($ionAuth->isAdmin()): ?>
            <div class="mt-4">
                <h2>Nástroje administrace</h2>
                <div class="list-group">
                    <a href="<?= base_url('admin/articles') ?>" class="list-group-item list-group-item-action">Správa článků</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?=$this->endSection();?>