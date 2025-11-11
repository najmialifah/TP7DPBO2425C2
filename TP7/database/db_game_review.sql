-- db_game_review.sql
CREATE DATABASE IF NOT EXISTS game_review_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE game_review_db;

CREATE TABLE IF NOT EXISTS developer (
  id_developer INT AUTO_INCREMENT PRIMARY KEY,
  nama_developer VARCHAR(100) NOT NULL,
  negara VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS genre (
  id_genre INT AUTO_INCREMENT PRIMARY KEY,
  nama_genre VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS game (
  id_game INT AUTO_INCREMENT PRIMARY KEY,
  nama_game VARCHAR(150) NOT NULL,
  tahun_rilis INT,
  id_genre INT,
  id_developer INT,
  FOREIGN KEY (id_genre) REFERENCES genre(id_genre) ON DELETE SET NULL,
  FOREIGN KEY (id_developer) REFERENCES developer(id_developer) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS player (
  id_player INT AUTO_INCREMENT PRIMARY KEY,
  nama_player VARCHAR(100) NOT NULL,
  email VARCHAR(150),
  negara VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS review (
  id_review INT AUTO_INCREMENT PRIMARY KEY,
  id_game INT,
  id_player INT,
  rating TINYINT,
  komentar TEXT,
  tanggal_review DATE,
  FOREIGN KEY (id_game) REFERENCES game(id_game) ON DELETE CASCADE,
  FOREIGN KEY (id_player) REFERENCES player(id_player) ON DELETE SET NULL
);

-- sample data
INSERT INTO developer (nama_developer, negara) VALUES
('PixelCraft Studios', 'Indonesia'),
('Aurora Games', 'Japan');

INSERT INTO genre (nama_genre) VALUES ('Action'), ('RPG'), ('Puzzle');

INSERT INTO game (nama_game, tahun_rilis, id_genre, id_developer) VALUES
('Star Voyager', 2020, 1, 1),
('Mystic Quest', 2019, 2, 2);

INSERT INTO player (nama_player, email, negara) VALUES
('Andi Gamers', 'andi@example.com', 'Indonesia'),
('Sakura', 'sakura@example.jp', 'Japan');

INSERT INTO review (id_game, id_player, rating, komentar, tanggal_review) VALUES
(1,1,9,'Seru sekali, grafis bagus', '2023-05-10'),
(2,2,8,'Story menarik, kontrol halus', '2023-06-15');