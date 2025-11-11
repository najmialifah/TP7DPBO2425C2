<?php
require_once __DIR__ . '/../config/Database.php';
class Game {
    private $pdo;
    public function __construct(){
        $this->pdo = Database::connect();
    }
    public function getAllWithJoin(){
        $sql = 'SELECT g.*, gen.nama_genre, d.nama_developer
                FROM game g
                LEFT JOIN genre gen ON g.id_genre = gen.id_genre
                LEFT JOIN developer d ON g.id_developer = d.id_developer
                ORDER BY g.id_game DESC';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    public function getById($id){
        $stmt = $this->pdo->prepare('SELECT * FROM game WHERE id_game = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($nama, $tahun, $id_genre, $id_dev){
        $stmt = $this->pdo->prepare('INSERT INTO game (nama_game, tahun_rilis, id_genre, id_developer) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$nama, $tahun ?: null, $id_genre ?: null, $id_dev ?: null]);
    }
    public function update($id, $nama, $tahun, $id_genre, $id_dev){
        $stmt = $this->pdo->prepare('UPDATE game SET nama_game = ?, tahun_rilis = ?, id_genre = ?, id_developer = ? WHERE id_game = ?');
        return $stmt->execute([$nama, $tahun ?: null, $id_genre ?: null, $id_dev ?: null, $id]);
    }
    public function delete($id){
        $stmt = $this->pdo->prepare('DELETE FROM game WHERE id_game = ?');
        return $stmt->execute([$id]);
    }
}
?>