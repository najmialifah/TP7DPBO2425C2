<?php
require_once '../../class/Developer.php';
$devObj = new Developer();
$id = $_GET['id'] ?? null;
if($id){
    $devObj->delete($id);
}
header('Location: index.php');