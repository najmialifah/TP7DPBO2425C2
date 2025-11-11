<?php
require_once '../../class/Review.php';
$reviewObj = new Review();
$reviews = $reviewObj->getAllWithJoin();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Reviews</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Reviews</h3>
  <a class="btn btn-sm btn-primary mb-2" href="create.php">Tambah Review</a>
  <a class="btn btn-sm btn-secondary mb-2" href="../../index.php">Kembali</a>
  <div class="card"><div class="card-body">
    <?php if(!$reviews): ?><p class="text-muted">Belum ada review.</p><?php else: ?>
    <table class="table table-striped"><thead><tr><th>Game</th><th>Player</th><th>Rating</th><th>Komentar</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>
    <?php foreach($reviews as $r): ?>
      <tr>
        <td><?=htmlspecialchars($r['nama_game'] ?? '-')?></td>
        <td><?=htmlspecialchars($r['nama_player'] ?? '-')?></td>
        <td><?=htmlspecialchars($r['rating'])?></td>
        <td><?=htmlspecialchars($r['komentar'])?></td>
        <td><?=htmlspecialchars($r['tanggal_review'])?></td>
        <td>
          <a class="btn btn-sm btn-success" href="edit.php?id=<?=$r['id_review']?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?=$r['id_review']?>" onclick="return confirm('Hapus review?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody></table>
    <?php endif; ?>
  </div></div>
</div></body></html>