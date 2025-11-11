<?php
require_once 'class/Game.php';
require_once 'class/Review.php';
$game = new Game();
$games = $game->getAllWithJoin();

// average rating per game
$avgStmt = Database::connect()->query('SELECT id_game, AVG(rating) as avg_rating, COUNT(*) as cnt FROM review GROUP BY id_game');
$avgs = [];
foreach($avgStmt->fetchAll() as $r){
    $avgs[$r['id_game']] = $r;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Game Library</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Game Library & Reviews</h1>
    <div>
      <a class="btn btn-sm btn-primary" href="view/game/create.php">Tambah Game</a>
      <a class="btn btn-sm btn-secondary" href="view/review/index.php">Reviews</a>
      <a class="btn btn-sm btn-secondary" href="view/developer/index.php">Developers</a>
      <a class="btn btn-sm btn-secondary" href="view/genre/index.php">Genres</a>
      <a class="btn btn-sm btn-secondary" href="view/player/index.php">Players</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <?php if(!$games): ?>
        <p class="text-muted">Belum ada game. Tambah dulu!</p>
      <?php else: ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nama Game</th>
            <th>Genre</th>
            <th>Developer</th>
            <th>Tahun</th>
            <th>Avg Rating</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($games as $g): ?>
          <tr>
            <td><?=htmlspecialchars($g['nama_game'])?></td>
            <td><?=htmlspecialchars($g['nama_genre'] ?? '-')?></td>
            <td><?=htmlspecialchars($g['nama_developer'] ?? '-')?></td>
            <td><?=htmlspecialchars($g['tahun_rilis'])?></td>
            <td>
              <?php
                $avg = $avgs[$g['id_game']]['avg_rating'] ?? null;
                if($avg !== null) echo number_format($avg,2).' ('.$avgs[$g['id_game']]['cnt'].')';
                else echo '-';
              ?>
            </td>
            <td>
              <a class="btn btn-sm btn-success" href="view/game/edit.php?id=<?=$g['id_game']?>">Edit</a>
              <a class="btn btn-sm btn-danger" href="view/game/delete.php?id=<?=$g['id_game']?>" onclick="return confirm('Hapus game ini?')">Hapus</a>
              <a class="btn btn-sm btn-outline-primary" href="view/review/create.php?game=<?=$g['id_game']?>">Tambah Review</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>