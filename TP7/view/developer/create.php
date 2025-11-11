<?php
require_once '../../class/Developer.php';
$devObj = new Developer();
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama_developer'] ?? '');
    $negara = trim($_POST['negara'] ?? '');
    if(!$nama) $errors[] = 'Nama developer wajib diisi.';
    if(empty($errors)){
        $devObj->create($nama, $negara);
        header('Location: index.php'); exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Developer</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Tambah Developer</h3>
  <a class="btn btn-sm btn-secondary mb-2" href="index.php">Kembali</a>
  <?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e) echo '<div>'.$e.'</div>'; ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Nama Developer</label><input class="form-control" name="nama_developer" value="<?=htmlspecialchars($_POST['nama_developer'] ?? '')?>"></div>
    <div class="mb-3"><label class="form-label">Negara</label><input class="form-control" name="negara" value="<?=htmlspecialchars($_POST['negara'] ?? '')?>"></div>
    <button class="btn btn-primary">Simpan</button>
  </form>
</div></body></html>