<?php
require_once '../../class/Genre.php';
$gObj = new Genre();
$genres = $gObj->getAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Genres</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Genres</h3>
  <a class="btn btn-sm btn-primary mb-2" href="create.php">Tambah Genre</a>
  <a class="btn btn-sm btn-secondary mb-2" href="../../index.php">Kembali</a>
  <div class="card"><div class="card-body">
    <?php if(!$genres): ?><p class="text-muted">Belum ada data.</p><?php else: ?>
    <table class="table table-bordered"><thead><tr><th>Nama Genre</th><th>Aksi</th></tr></thead><tbody>
      <?php foreach($genres as $g): ?>
      <tr>
        <td><?=htmlspecialchars($g['nama_genre'])?></td>
        <td>
          <a class="btn btn-sm btn-success" href="edit.php?id=<?=$g['id_genre']?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?=$g['id_genre']?>" onclick="return confirm('Hapus genre?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody></table>
    <?php endif; ?>
  </div></div>
</div></body></html>