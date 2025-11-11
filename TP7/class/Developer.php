<?php
require_once __DIR__ . '/../config/Database.php';
class Developer {
    private $pdo;
    public function __construct(){
        $this->pdo = Database::connect();
    }
    public function getAll(){
        $stmt = $this->pdo->query('SELECT * FROM developer ORDER BY id_developer DESC');
        return $stmt->fetchAll();
    }
    public function getById($id){
        $stmt = $this->pdo->prepare('SELECT * FROM developer WHERE id_developer = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($nama, $negara){
        $stmt = $this->pdo->prepare('INSERT INTO developer (nama_developer, negara) VALUES (?, ?)');
        return $stmt->execute([$nama, $negara]);
    }
    public function update($id, $nama, $negara){
        $stmt = $this->pdo->prepare('UPDATE developer SET nama_developer = ?, negara = ? WHERE id_developer = ?');
        return $stmt->execute([$nama, $negara, $id]);
    }
    public function delete($id){
        $stmt = $this->pdo->prepare('DELETE FROM developer WHERE id_developer = ?');
        return $stmt->execute([$id]);
    }
}
?>