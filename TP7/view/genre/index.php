<?php
require_once '../../class/Developer.php';
$devObj = new Developer();
$devs = $devObj->getAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Developers</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Developers</h3>
  <a class="btn btn-sm btn-primary mb-2" href="create.php">Tambah Developer</a>
  <a class="btn btn-sm btn-secondary mb-2" href="../../index.php">Kembali</a>
  <div class="card"><div class="card-body">
    <?php if(!$devs): ?><p class="text-muted">Belum ada data.</p><?php else: ?>
    <table class="table table-bordered"><thead><tr><th>Nama</th><th>Negara</th><th>Aksi</th></tr></thead><tbody>
      <?php foreach($devs as $d): ?>
      <tr>
        <td><?=htmlspecialchars($d['nama_developer'])?></td>
        <td><?=htmlspecialchars($d['negara'])?></td>
        <td>
          <a class="btn btn-sm btn-success" href="edit.php?id=<?=$d['id_developer']?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?=$d['id_developer']?>" onclick="return confirm('Hapus developer?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody></table>
    <?php endif; ?>
  </div></div>
</div></body></html>
