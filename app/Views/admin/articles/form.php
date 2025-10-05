<?=$this->extend("layout/template");?>

<?=$this->section("content");?>

<div class="container mt-4">
    <h1><?= isset($article) ? 'Upravit článek' : 'Nový článek' ?></h1>

    <form method="post" action="<?= base_url('admin/article/save') ?>">
        <?php if (isset($article)): ?>
            <input type="hidden" name="id" value="<?= $article->id ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Nadpis</label>
            <input class="form-control" name="title" value="<?= isset($article) ? esc($article->title) : '' ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Text</label>
            <!-- Placeholder for WYSIWYG editor. Replace with TinyMCE/CKEditor init script as desired -->
            <textarea class="form-control" id="articleText" name="text" rows="10"><?= isset($article) ? $article->text : '' ?></textarea>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="publishedSwitch" name="published" <?= (isset($article) && $article->published) ? 'checked' : '' ?>>
            <label class="form-check-label" for="publishedSwitch">Publikováno</label>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="topSwitch" name="top" <?= (isset($article) && $article->top) ? 'checked' : '' ?>>
            <label class="form-check-label" for="topSwitch">Top kategorie</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Datum</label>
            <?php
                $dateValue = '';
                if (isset($article) && !empty($article->date)) {
                    // support unix timestamp stored as int or mysql datetime string
                    if (is_numeric($article->date)) {
                        $dateValue = date('Y-m-d\TH:i', (int)$article->date);
                    } else {
                        $dateValue = date('Y-m-d\TH:i', strtotime($article->date));
                    }
                } else {
                    $dateValue = date('Y-m-d\TH:i');
                }
            ?>
            <input class="form-control" type="datetime-local" name="date" value="<?= $dateValue ?>">
        </div>

        <button class="btn btn-primary" type="submit">Uložit</button>
        <a class="btn btn-secondary" href="<?= base_url('admin/articles') ?>">Zpět</a>
    </form>
</div>

<!-- TinyMCE CDN init (WYSIWYG) -->
<script src="https://cdn.tiny.cloud/1/wtzrkm9ng24oerzyodd9cyi0i1s1x65v08rza9ytbeza3uhy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#articleText',
    menubar: false,
    plugins: 'link image lists table code',
    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code'
  });
</script>

<?=$this->endSection();?>
