<?=$this->extend("layout/template");?>

<?=$this->section("content");?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Správa článků</h1>
        <a href="<?= base_url('admin/article/new') ?>" class="btn btn-primary">Přidat článek</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nadpis</th>
                <th>Publikován</th>
                <th>Top</th>
                <th>Datum</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $a): ?>
                <tr>
                    <td><?= $a->id ?></td>
                    <td><?= esc($a->title) ?></td>
                    <td><?= $a->published ? 'Ano' : 'Ne' ?></td>
                    <td><?= $a->top ? 'Ano' : 'Ne' ?></td>
          <?php
            $displayDate = '';
            if (!empty($a->date)) {
              if (is_numeric($a->date)) {
                $displayDate = date('d.m.Y', (int)$a->date);
              } else {
                $displayDate = date('d.m.Y', strtotime($a->date));
              }
            }
          ?>
          <td><?= $displayDate ?></td>
                    <td>
                        <a href="<?= base_url('admin/article/' . $a->id) ?>" class="btn btn-sm btn-secondary">Upravit</a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $a->id ?>">Smazat</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Potvrzení smazání</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Opravdu chcete smazat tento článek?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
        <a href="#" id="confirmDelete" class="btn btn-danger">Smazat</a>
      </div>
    </div>
  </div>
</div>

<script>
var deleteModal = document.getElementById('deleteModal')
deleteModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var id = button.getAttribute('data-id')
  var confirm = document.getElementById('confirmDelete')
  confirm.href = '<?= base_url('admin/article/delete') ?>/' + id
})
</script>

<?=$this->endSection();?>
