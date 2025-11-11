<?php
require_once '../../class/Review.php';
require_once '../../class/Game.php';
require_once '../../class/Player.php';
$reviewObj = new Review();
$gameObj = new Game();
$playerObj = new Player();
$games = $gameObj->getAllWithJoin();
$players = $playerObj->getAll();
$errors = [];
$prefGame = $_GET['game'] ?? null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_game = $_POST['id_game'] ?? null;
    $id_player = $_POST['id_player'] ?? null;
    $rating = (int)($_POST['rating'] ?? 0);
    $komentar = trim($_POST['komentar'] ?? '');
    $tanggal = $_POST['tanggal_review'] ?? date('Y-m-d');
    if(!$id_game) $errors[] = 'Pilih game.';
    if($rating < 1 || $rating > 10) $errors[] = 'Rating harus antara 1-10.';
    if(empty($errors)){
        $reviewObj->create($id_game, $id_player, $rating, $komentar, $tanggal);
        header('Location: index.php'); exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Review</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Tambah Review</h3>
  <a class="btn btn-sm btn-secondary mb-2" href="index.php">Kembali</a>
  <?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e) echo '<div>'.$e.'</div>'; ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Game</label>
      <select class="form-select" name="id_game">
        <option value="">-- Pilih Game --</option>
        <?php foreach($games as $g): ?>
          <option value="<?=$g['id_game']?>" <?= ($prefGame && $prefGame==$g['id_game'])?'selected':''; ?>><?=htmlspecialchars($g['nama_game'])?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3"><label class="form-label">Player</label>
      <select class="form-select" name="id_player">
        <option value="">-- Pilih Player --</option>
        <?php foreach($players as $p): ?>
          <option value="<?=$p['id_player']?>"><?=htmlspecialchars($p['nama_player'])?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3"><label class="form-label">Rating (1-10)</label><input class="form-control" name="rating" value="<?=htmlspecialchars($_POST['rating'] ?? '')?>"></div>
    <div class="mb-3"><label class="form-label">Komentar</label><textarea class="form-control" name="komentar"><?=htmlspecialchars($_POST['komentar'] ?? '')?></textarea></div>
    <div class="mb-3"><label class="form-label">Tanggal</label><input class="form-control" type="date" name="tanggal_review" value="<?=htmlspecialchars($_POST['tanggal_review'] ?? date('Y-m-d'))?>"></div>
    <button class="btn btn-primary">Simpan</button>
  </form>
</div></body></html>