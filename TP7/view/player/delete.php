<?php
require_once '../../class/Player.php';
$pObj = new Player();
$id = $_GET['id'] ?? null;
if($id){
    $pObj->delete($id);
}
header('Location: index.php');