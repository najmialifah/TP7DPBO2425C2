<?php
require_once '../../class/Genre.php';
$gObj = new Genre();
$id = $_GET['id'] ?? null;
if(!$id) header('Location: index.php');
$row = $gObj->getById($id);
if(!$row) header('Location: index.php');
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = trim($_POST['nama_genre'] ?? '');
    if(!$nama) $errors[] = 'Nama genre wajib diisi.';
    if(empty($errors)){
        $gObj->update($id, $nama);
        header('Location: index.php'); exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Genre</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="p-4">
<div class="container">
  <h3>Edit Genre</h3>
  <a class="btn btn-sm btn-secondary mb-2" href="index.php">Kembali</a>
  <?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e) echo '<div>'.$e.'</div>'; ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Nama Genre</label><input class="form-control" name="nama_genre" value="<?=htmlspecialchars($_POST['nama_genre'] ?? $row['nama_genre'])?>"></div>
    <button class="btn btn-primary">Update</button>
  </form>
</div></body></html>