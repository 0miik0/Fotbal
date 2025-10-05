<?= $this->extend("layout/template") ?>
<?= $this->section("content") ?>

<div class="container">
    <h1>Detail zápasu</h1>
    <p><a href="<?= site_url('seasons/matches/' . $match->id_season) ?>">Zpět na zápasy sezóny</a></p>

    <div class="row align-items-center">
        <div class="col-md-5 text-center">
            <h3><?= esc($homeTeam->name) ?></h3>
            <?php if (!empty($homeTeam->logo)): ?>
                <img src="<?= base_url('uploads/logos/' . $homeTeam->logo) ?>" alt="<?= esc($homeTeam->name) ?>" class="img-fluid" style="max-height: 150px;">
            <?php endif; ?>
        </div>

        <div class="col-md-2 text-center">
            <h2><?= esc($match->home_goals) ?> : <?= esc($match->away_goals) ?></h2>
            <p>(Poločas: <?= esc($match->home_goals_ht) ?> : <?= esc($match->away_goals_ht) ?>)</p>
        </div>

        <div class="col-md-5 text-center">
            <h3><?= esc($awayTeam->name) ?></h3>
            <?php if (!empty($awayTeam->logo)): ?>
                <img src="<?= base_url('uploads/logos/' . $awayTeam->logo) ?>" alt="<?= esc($awayTeam->name) ?>" class="img-fluid" style="max-height: 150px;">
            <?php endif; ?>
        </div>
    </div>

    <hr>

    <p><strong>Datum a čas:</strong> <?= date('d.m.Y', $match->date) ?> <?= $match->time ? date('H:i', strtotime($match->time)) : 'Čas není znám' ?></p>
    <p><strong>Stadion:</strong> <?= esc($match->stadium) ?></p>
    <p><strong>Počet diváků:</strong> <?= esc($match->attendance) ?></p>
</div>

<?= $this->endSection() ?>