<?php
require_once '../../class/Player.php';
$pObj = new Player();
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama_player'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $negara = trim($_POST['negara'] ?? '');
    if(!$nama) $errors[] = 'Nama player wajib diisi.';
    if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid.';
    if(empty($errors)){
        $pObj->create($nama, $email, $negara);
        header('Location: index.php'); exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Player</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Tambah Player</h3>
  <a class="btn btn-sm btn-secondary mb-2" href="index.php">Kembali</a>
  <?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e) echo '<div>'.$e.'</div>'; ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Nama Player</label><input class="form-control" name="nama_player" value="<?=htmlspecialchars($_POST['nama_player'] ?? '')?>"></div>
    <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" value="<?=htmlspecialchars($_POST['email'] ?? '')?>"></div>
    <div class="mb-3"><label class="form-label">Negara</label><input class="form-control" name="negara" value="<?=htmlspecialchars($_POST['negara'] ?? '')?>"></div>
    <button class="btn btn-primary">Simpan</button>
  </form>
</div></body></html>