<?=$this->extend("layout/template");?>

<?=$this->section("content");?>

<div class="container">
    <h1><?= $article->title ?></h1>

    <p class="text-muted">
        Publikováno: <?= date('j.n.Y', strtotime($article->created_at ?? 'now')) ?>
    </p>

    <?php if ($article->photo): ?>
        <img src="<?= base_url('assets/obrazky/sigma/' . $article->photo) ?>" 
             alt="<?= $article->title ?>" class="img-fluid mb-4 rounded">
    <?php endif; ?>

    <div class="fs-5">
        <?= $article->text ?>
    </div>
</div>

<?=$this->endSection();?>