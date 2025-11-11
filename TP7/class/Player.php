<?php
require_once __DIR__ . '/../config/Database.php';
class Player {
    private $pdo;
    public function __construct(){
        $this->pdo = Database::connect();
    }
    public function getAll(){
        $stmt = $this->pdo->query('SELECT * FROM player ORDER BY id_player DESC');
        return $stmt->fetchAll();
    }
    public function getById($id){
        $stmt = $this->pdo->prepare('SELECT * FROM player WHERE id_player = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($nama, $email, $negara){
        $stmt = $this->pdo->prepare('INSERT INTO player (nama_player, email, negara) VALUES (?, ?, ?)');
        return $stmt->execute([$nama, $email, $negara]);
    }
    public function update($id, $nama, $email, $negara){
        $stmt = $this->pdo->prepare('UPDATE player SET nama_player = ?, email = ?, negara = ? WHERE id_player = ?');
        return $stmt->execute([$nama, $email, $negara, $id]);
    }
    public function delete($id){
        $stmt = $this->pdo->prepare('DELETE FROM player WHERE id_player = ?');
        return $stmt->execute([$id]);
    }
}
?>