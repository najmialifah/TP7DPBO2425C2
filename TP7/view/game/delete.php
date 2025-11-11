<?php
require_once '../../class/Game.php';
$gameObj = new Game();
$id = $_GET['id'] ?? null;
if($id){
    $gameObj->delete($id);
}
header('Location: index.php');