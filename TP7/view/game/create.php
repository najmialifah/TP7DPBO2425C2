<?php
require_once '../../class/Game.php';
require_once '../../class/Genre.php';
require_once '../../class/Developer.php';
$gameObj = new Game();
$genreObj = new Genre();
$devObj = new Developer();
$genres = $genreObj->getAll();
$devs = $devObj->getAll();
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama_game'] ?? '');
    $tahun = (int)($_POST['tahun_rilis'] ?? 0);
    $id_genre = $_POST['id_genre'] ?? null;
    $id_dev = $_POST['id_developer'] ?? null;
    if(!$nama) $errors[] = 'Nama game wajib diisi.';
    if(empty($errors)){
        $gameObj->create($nama, $tahun ?: null, $id_genre ?: null, $id_dev ?: null);
        header('Location: index.php'); exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Game</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Tambah Game</h3>
  <a class="btn btn-sm btn-secondary mb-2" href="index.php">Kembali</a>
  <?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e) echo '<div>'.$e.'</div>'; ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Nama Game</label><input class="form-control" name="nama_game" value="<?=htmlspecialchars($_POST['nama_game'] ?? '')?>"></div>
    <div class="mb-3"><label class="form-label">Tahun Rilis</label><input class="form-control" name="tahun_rilis" value="<?=htmlspecialchars($_POST['tahun_rilis'] ?? '')?>"></div>
    <div class="mb-3"><label class="form-label">Genre</label>
      <select class="form-select" name="id_genre">
        <option value="">-- Pilih Genre --</option>
        <?php foreach($genres as $g): ?>
          <option value="<?=$g['id_genre']?>" <?= (isset($_POST['id_genre']) && $_POST['id_genre']==$g['id_genre'])?'selected':''; ?>><?=htmlspecialchars($g['nama_genre'])?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3"><label class="form-label">Developer</label>
      <select class="form-select" name="id_developer">
        <option value="">-- Pilih Developer --</option>
        <?php foreach($devs as $d): ?>
          <option value="<?=$d['id_developer']?>" <?= (isset($_POST['id_developer']) && $_POST['id_developer']==$d['id_developer'])?'selected':''; ?>><?=htmlspecialchars($d['nama_developer'])?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button class="btn btn-primary">Simpan</button>
  </form>
</div></body></html>