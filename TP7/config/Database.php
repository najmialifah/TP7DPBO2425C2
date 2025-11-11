<?php
class Database {
    private static $host = '127.0.0.1';
    private static $db   = 'db_game_review';
    private static $user = 'root';
    private static $pass = '';
    private static $charset = 'utf8mb4';
    private static $pdo = null;

    public static function connect(){
        if(self::$pdo === null){
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            try{
                self::$pdo = new PDO($dsn, self::$user, self::$pass, $opt);
            }catch(PDOException $e){
                die('Koneksi gagal: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>