<?=$this->extend("layout/template");?>

<?=$this->section("content");?>

<h1>Top publikované články</h1>

<?php if (!empty($article) && is_array($article)): ?>
    <div class="row mt-4">
        <div class="col-12 col-md-6 mb-4">
            <?php $mainArticle = array_shift($article); ?>
            <div class="ratio ratio-4x3 position-relative overflow-hidden rounded">
                <?php if ($mainArticle->photo): ?>
                    <div class="position-absolute top-0 start-0 w-100 h-100" 
                         style="background-size: cover; background-position: center; 
                                background-image: url('<?= base_url('assets/obrazky/sigma/' . $mainArticle->photo) ?>');">
                    </div>
                <?php else: ?>
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary"></div>
                <?php endif; ?>

                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex flex-column justify-content-center align-items-start text-white p-4">
                    <a href="<?= base_url('article/' . $mainArticle->id) ?>" 
                       class="fw-bold fs-3 text-white text-decoration-none">
                        <?= esc($mainArticle->title) ?>
                    </a>
                    <div class="mt-3 fs-5"><?= date('j.n.Y', strtotime($mainArticle->created_at ?? 'now')) ?></div>
                    <p class="mt-auto mb-0 fs-6"><?= substr(strip_tags($mainArticle->text), 0, 100) ?>...</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-4">
            <div class="d-flex flex-wrap gap-3">
                <?php foreach ($article as $article): ?>
                    <div class="ratio ratio-1x1 position-relative overflow-hidden rounded" style="width: 100%; max-width: 230px;">
                        <?php if ($article->photo): ?>
                            <div class="position-absolute top-0 start-0 w-100 h-100" 
                                 style="background-size: cover; background-position: center; 
                                        background-image: url('<?= base_url('assets/obrazky/sigma/' . $article->photo) ?>');">
                            </div>
                        <?php else: ?>
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary"></div>
                        <?php endif; ?>

                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex flex-column justify-content-center align-items-start text-white p-3">
                            <a href="<?= base_url('article/' . $article->id) ?>" 
                               class="fw-bold fs-6 text-white text-decoration-none">
                                <?= esc($article->title) ?>
                            </a>
                            <div class="mt-2 fs-6"><?= date('j.n.Y', strtotime($article->created_at ?? 'now')) ?></div>
                            <p class="mt-auto mb-0 small"><?= substr(strip_tags($article->text), 0, 60) ?>...</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?=$this->endSection();?>
    
