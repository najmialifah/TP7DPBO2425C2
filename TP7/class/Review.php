<?php
require_once __DIR__ . '/../config/Database.php';
class Review {
    private $pdo;
    public function __construct(){
        $this->pdo = Database::connect();
    }
    public function getAllWithJoin(){
        $sql = 'SELECT r.*, g.nama_game, p.nama_player
                FROM review r
                LEFT JOIN game g ON r.id_game = g.id_game
                LEFT JOIN player p ON r.id_player = p.id_player
                ORDER BY r.id_review DESC';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function getById($id){
        $stmt = $this->pdo->prepare('SELECT * FROM review WHERE id_review = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($id_game, $id_player, $rating, $komentar, $tanggal){
        $stmt = $this->pdo->prepare('INSERT INTO review (id_game, id_player, rating, komentar, tanggal_review) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$id_game, $id_player ?: null, $rating, $komentar, $tanggal]);
    }
    public function update($id, $id_game, $id_player, $rating, $komentar, $tanggal){
        $stmt = $this->pdo->prepare('UPDATE review SET id_game = ?, id_player = ?, rating = ?, komentar = ?, tanggal_review = ? WHERE id_review = ?');
        return $stmt->execute([$id_game, $id_player ?: null, $rating, $komentar, $tanggal, $id]);
    }
    public function delete($id){
        $stmt = $this->pdo->prepare('DELETE FROM review WHERE id_review = ?');
        return $stmt->execute([$id]);
    }
}
?>