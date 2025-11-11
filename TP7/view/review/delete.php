<?php
require_once '../../class/Review.php';
$reviewObj = new Review();
$id = $_GET['id'] ?? null;
if($id){
    $reviewObj->delete($id);
}
header('Location: index.php');