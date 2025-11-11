<?php
require_once __DIR__ . '/../config/Database.php';
class Genre {
    private $pdo;
    public function __construct(){
        $this->pdo = Database::connect();
    }
    public function getAll(){
        $stmt = $this->pdo->query('SELECT * FROM genre ORDER BY id_genre DESC');
        return $stmt->fetchAll();
    }
    public function getById($id){
        $stmt = $this->pdo->prepare('SELECT * FROM genre WHERE id_genre = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($nama){
        $stmt = $this->pdo->prepare('INSERT INTO genre (nama_genre) VALUES (?)');
        return $stmt->execute([$nama]);
    }
    public function update($id, $nama){
        $stmt = $this->pdo->prepare('UPDATE genre SET nama_genre = ? WHERE id_genre = ?');
        return $stmt->execute([$nama, $id]);
    }
    public function delete($id){
        $stmt = $this->pdo->prepare('DELETE FROM genre WHERE id_genre = ?');
        return $stmt->execute([$id]);
    }
}
?>