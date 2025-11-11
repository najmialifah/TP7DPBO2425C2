<?php
require_once '../../class/Player.php';
$pObj = new Player();
$players = $pObj->getAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Players</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Players</h3>
  <a class="btn btn-sm btn-primary mb-2" href="create.php">Tambah Player</a>
  <a class="btn btn-sm btn-secondary mb-2" href="../../index.php">Kembali</a>
  <div class="card"><div class="card-body">
    <?php if(!$players): ?><p class="text-muted">Belum ada data.</p><?php else: ?>
    <table class="table table-bordered"><thead><tr><th>Nama</th><th>Email</th><th>Negara</th><th>Aksi</th></tr></thead><tbody>
      <?php foreach($players as $p): ?>
      <tr>
        <td><?=htmlspecialchars($p['nama_player'])?></td>
        <td><?=htmlspecialchars($p['email'])?></td>
        <td><?=htmlspecialchars($p['negara'])?></td>
        <td>
          <a class="btn btn-sm btn-success" href="edit.php?id=<?=$p['id_player']?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?=$p['id_player']?>" onclick="return confirm('Hapus player?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody></table>
    <?php endif; ?>
  </div></div>
</div></body></html>