<?= $this->extend("layout/template") ?>
<?= $this->section("content") ?>

<div class="container">
    <h1>Detail zápasu</h1>
    <p>
        <?php if (!empty($seasonId)): ?>
            <a href="<?= site_url('seasons/' . $seasonId . '/matches') ?>">Zpět na zápasy sezóny</a>
        <?php else: ?>
            <a href="<?= site_url('seasons') ?>">Zpět na sezóny</a>
        <?php endif; ?>
    </p>

    <div class="row align-items-center">
        <div class="col-md-5 text-center">
            <h3><?= esc($homeTeam->name) ?></h3>
            <?php if (!empty($homeTeam->logo) && file_exists(FCPATH . 'assets/obrazky/logos/' . $homeTeam->logo)): ?>
                <img src="<?= base_url('assets/obrazky/logos/' . $homeTeam->logo) ?>" alt="<?= esc($homeTeam->name) ?>" class="img-fluid" style="max-height: 150px;">
            <?php else: ?>
                <div class="text-muted">(logo není k dispozici)</div>
            <?php endif; ?>
        </div>

        <div class="col-md-2 text-center">
            <h2><?= esc($match->goals_home) ?> : <?= esc($match->goals_away) ?></h2>
            <p>(Poločas: <?= esc($match->ht_goals_home) ?> : <?= esc($match->ht_goals_away) ?>)</p>
        </div>

        <div class="col-md-5 text-center">
            <h3><?= esc($awayTeam->name) ?></h3>
            <?php if (!empty($awayTeam->logo) && file_exists(FCPATH . 'assets/obrazky/logos/' . $awayTeam->logo)): ?>
                <img src="<?= base_url('assets/obrazky/logos/' . $awayTeam->logo) ?>" alt="<?= esc($awayTeam->name) ?>" class="img-fluid" style="max-height: 150px;">
            <?php else: ?>
                <div class="text-muted">(logo není k dispozici)</div>
            <?php endif; ?>
        </div>
    </div>

    <hr>

    <?php
        // Determine a safe date string. Treat 0/0000-00-00 or invalid dates as unknown.
        $dateStr = '';
        if (!empty($match->date)) {
            if (is_numeric($match->date) && (int)$match->date > 0) {
                $dateStr = date('d.m.Y', (int)$match->date);
            } else {
                $ts = strtotime($match->date);
                if ($ts !== false && $ts > 0) {
                    $dateStr = date('d.m.Y', $ts);
                }
            }
        }

        // Time: only show if non-empty and not all-zero
        $timeStr = '';
        if (!empty($match->time) && strtotime($match->time) !== false && strtotime($match->time) > 0) {
            $timeStr = date('H:i', strtotime($match->time));
        }

        if (empty($dateStr) && empty($timeStr)) {
            $dateTimeDisplay = 'Datum a čas: neznámé';
        } else {
            $dateTimeDisplay = trim(($dateStr ?: '') . ' ' . ($timeStr ?: ''));
        }
    ?>

    <p><strong>Datum a čas:</strong> <?= $dateTimeDisplay ?></p>
    <p><strong>Stadion:</strong> <?= esc($match->stadium) ?></p>
    <p><strong>Počet diváků:</strong> <?= esc($match->attendance) ?></p>
</div>

<?= $this->endSection() ?>