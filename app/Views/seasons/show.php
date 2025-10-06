<?= $this->extend("layout/template") ?>
<?= $this->section("content") ?>

<div class="container">
    <h1>Sezóna <?= esc($season->start) ?> - <?= esc($season->finish) ?></h1>

    <p><a href="<?= site_url('seasons') ?>">Zpět na seznam sezón</a></p>


    <?php if (empty($leagues)): ?>
        <p>Žádné soutěže k dispozici.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($leagues as $league): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= esc($league->name) ?>
                        <span class="badge bg-primary rounded-pill">Úroveň: <?= esc($league->level) ?></span>
                    </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>