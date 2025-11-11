<?php
require_once '../../class/Genre.php';
$gObj = new Genre();
$id = $_GET['id'] ?? null;
if($id){
    $gObj->delete($id);
}
header('Location: index.php');