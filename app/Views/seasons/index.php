<?= $this->extend("layout/template") ?>

<?= $this->section("content") ?>

<style>
.pagination {

}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  border-radius: 5px;
}
.pagination a.active {
  background-color: #2758f8ff;
  color: white;
  border-radius: 5px;
}

.pagination a:hover:not(.active) {background-color: #72a4ffff;}
</style>

<div class="container">
    <h1>Sezóny</h1>

    <?php if (!empty($seasons)) : ?>
        <div class="row">
            <?php foreach ($seasons as $season) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?= site_url('seasons/' . $season->id) ?>">
                                    Sezóna <?= esc($season->start) ?> - <?= esc($season->finish) ?>
                                </a>
                                
                            </h5>
                </div>
            </div>
        </div>
            <?php endforeach; ?>
        </div>

    <footer>
        <div class="d-flex">
            <div class="mx-auto text-center pagination a">
                <?php
                    $pageCount = (int) ($pager->getPageCount() ?? 1);
                    $current = (int) ($pager->getCurrentPage() ?? 1);
                    for ($p = 1; $p <= $pageCount; $p++):
                        $class = $p === $current ? 'active' : '';
                ?>
                    <a class="<?= $class ?>" href="<?= current_url() . '?page=' . $p ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </footer>


    <?php else: ?>
        <p>Žádné sezóny nenalezeny.</p>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>