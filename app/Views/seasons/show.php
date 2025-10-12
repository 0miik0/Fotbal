<?=$this->extend("layout/template") ?>
<?=$this->section("content") ?>

<div class="container">
    <h1>Sezóna <?= esc($season->start) ?> - <?= esc($season->finish) ?></h1>

    <p><a href="<?= site_url('seasons') ?>">Zpět na seznam sezón</a></p>

    <?php if (empty($leagues)): ?>
        <p>Žádné soutěže k dispozici.</p>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($leagues as $l): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= esc($l->name) ?></strong>
                        <div class="small text-muted">Úroveň: <?= esc($l->level) ?></div>
                    </div>
                    <div class="text-end">
                        <div class="mb-1">Zápasy: <?= $l->games_count ?></div>
                        <a href="<?= site_url('seasons/' . $season->id . '/matches?league=' . $l->league_season_id) ?>" class="btn btn-sm btn-primary">Zobrazit zápasy</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-3">
            <a href="<?= site_url('seasons/' . $season->id . '/matches') ?>" class="btn btn-secondary">Zobrazit všechny zápasy sezóny</a>
        </div>
    <?php endif; ?>

</div>

<?=$this->endSection() ?>
