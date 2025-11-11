<?php
require_once '../../class/Player.php';
$pObj = new Player();
$id = $_GET['id'] ?? null;
if(!$id) header('Location: index.php');
$row = $pObj->getById($id);
if(!$row) header('Location: index.php');
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama_player'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $negara = trim($_POST['negara'] ?? '');
    if(!$nama) $errors[] = 'Nama player wajib diisi.';
    if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid.';
    if(empty($errors)){
        $pObj->update($id, $nama, $email, $negara);
        header('Location: index.php'); exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Player</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Edit Player</h3>
  <a class="btn btn-sm btn-secondary mb-2" href="index.php">Kembali</a>
  <?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e) echo '<div>'.$e.'</div>'; ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Nama Player</label><input class="form-control" name="nama_player" value="<?=htmlspecialchars($_POST['nama_player'] ?? $row['nama_player'])?>"></div>
    <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" value="<?=htmlspecialchars($_POST['email'] ?? $row['email'])?>"></div>
    <div class="mb-3"><label class="form-label">Negara</label><input class="form-control" name="negara" value="<?=htmlspecialchars($_POST['negara'] ?? $row['negara'])?>"></div>
    <button class="btn btn-primary">Update</button>
  </form>
</div></body></html>