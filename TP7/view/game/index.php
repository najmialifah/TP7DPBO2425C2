<?php
require_once '../../class/Game.php';
require_once '../../class/Genre.php';
require_once '../../class/Developer.php';
$gameObj = new Game();
$genreObj = new Genre();
$devObj = new Developer();
$games = $gameObj->getAllWithJoin();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Games</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Games</h3>
  <a class="btn btn-sm btn-primary mb-2" href="create.php">Tambah Game</a>
  <a class="btn btn-sm btn-secondary mb-2" href="../../index.php">Kembali</a>
  <div class="card"><div class="card-body">
    <?php if(!$games): ?><p class="text-muted">Belum ada game.</p><?php else: ?>
    <table class="table table-striped"><thead><tr><th>Nama</th><th>Genre</th><th>Developer</th><th>Tahun</th><th>Aksi</th></tr></thead><tbody>
    <?php foreach($games as $g): ?>
      <tr>
        <td><?=htmlspecialchars($g['nama_game'])?></td>
        <td><?=htmlspecialchars($g['nama_genre'] ?? '-')?></td>
        <td><?=htmlspecialchars($g['nama_developer'] ?? '-')?></td>
        <td><?=htmlspecialchars($g['tahun_rilis'])?></td>
        <td>
          <a class="btn btn-sm btn-success" href="edit.php?id=<?=$g['id_game']?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?=$g['id_game']?>" onclick="return confirm('Hapus game?')">Hapus</a>
          <a class="btn btn-sm btn-outline-primary" href="../review/create.php?game=<?=$g['id_game']?>">Tambah Review</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody></table>
    <?php endif; ?>
  </div></div>
</div></body></html>