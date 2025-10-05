<?= $this->extend("layout/template") ?>
<?= $this->section("content") ?>

<div class="container">
    <h1>Sezóna <?= esc($season->start) ?> - <?= esc($season->finish) ?> - Zápasy</h1>
    <p><a href="<?= site_url('seasons') ?>">Zpět na seznam sezón</a></p>

    <?php if (empty($matchesByRound)): ?>
        <p>Žádné zápasy k dispozici.</p>
    <?php else: ?>
        <?php foreach ($matchesByRound as $round => $matches): ?>
            <h4>Kolo <?= esc($round) ?></h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Doma</th>
                        <th>Výsledek</th>
                        <th>Venku</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matches as $match): ?>
                        <tr>
                            <td><?= esc($teams[$match->home_team]->name ?? 'Neznámý tým') ?></td>
                            <td>
                                <a href="<?= site_url('seasons/match-detail/' . $match->id) ?>">
                                    <?= esc($match->home_goals) ?> : <?= esc($match->away_goals) ?>
                                </a>
                            </td>
                            <td><?= esc($teams[$match->away_team]->name ?? 'Neznámý tým') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>