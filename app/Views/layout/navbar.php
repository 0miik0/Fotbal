<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <div class="navbar-collapse" id="navbarColor01">

        <ul class="navbar-nav me-auto">
            <?php foreach ($user_nav ?? [] as $item): ?>
                <?php if ($item->visible == 0): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url($item->url) ?>">
                            <?= $item->title ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

        <?php if (isset($ionAuth) && $ionAuth->loggedIn() && $ionAuth->isAdmin()): ?>
            <ul class="navbar-nav ms-auto">
                <?php foreach ($admin_nav ?? [] as $item): ?>
                    <?php if ($item->visible == 1): ?>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?= base_url($item->url) ?>">
                                <?= $item->title ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>



        </div>
    </div>
</nav>