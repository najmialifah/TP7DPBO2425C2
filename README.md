# TP7DPBO2425C2 - Sistem Review Game

## Tugas Praktikum 7 DPBO

Saya **Najmi Alifah Hilmiya** dengan **NIM 2410393** mengerjakan **Tugas Praktikum 7** dalam mata kuliah *Desain Pemrograman Berorientasi Objek* untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
**Aamiin.**

-----

## Deskripsi Proyek

Proyek ini adalah aplikasi web PHP sederhana yang mengimplementasikan sistem manajemen **Review Game**. Aplikasi ini dibangun menggunakan PHP natif dengan pendekatan *Object-Oriented Programming* (OOP) dan menggunakan database MySQL untuk menyimpan data. Antarmuka pengguna (UI) menggunakan Bootstrap 5.

Aplikasi ini mengelola 5 entitas data utama:

  * **Game**: Data game yang akan di-review.
  * **Developer**: Perusahaan atau perorangan pembuat game.
  * **Genre**: Kategori dari game.
  * **Player**: Pengguna yang memberikan review.
  * **Review**: Ulasan dan rating yang diberikan oleh player untuk sebuah game.

## Fitur Utama

Aplikasi ini menyediakan fungsionalitas **CRUD** (Create, Read, Update, Delete) penuh untuk semua entitas:

  * **Manajemen Game**: Tambah, lihat, edit, dan hapus data game.
  * **Manajemen Developer**: Tambah, lihat, edit, dan hapus data developer.
  * **Manajemen Genre**: Tambah, lihat, edit, dan hapus data genre.
  * **Manajemen Player**: Tambah, lihat, edit, dan hapus data player.
  * **Manajemen Review**: Tambah, lihat, edit, dan hapus data review.
  * **Halaman Utama**: Menampilkan daftar semua game beserta rata-rata rating (dari semua review) dan jumlah review yang masuk.

## Teknologi yang Digunakan

  * **Backend**: PHP (OOP)
  * **Database**: MySQL (dengan konektor PDO)
  * **Frontend**: HTML & Bootstrap 5

## Struktur Proyek

```
TP7/
├── index.php           # Halaman utama, menampilkan daftar game & avg rating
├── class/              # Berisi kelas-kelas model (OOP)
│   ├── Developer.php
│   ├── Game.php
│   ├── Genre.php
│   ├── Player.php
│   └── Review.php
├── config/
│   └── Database.php      # Kelas untuk koneksi database (PDO)
├── database/
│   └── db_game_review.sql # Skema dan data awal database
├── style/
│   └── style.css         # CSS kustom (jika ada)
└── view/                 # Berisi file-file antarmuka (UI) untuk CRUD
    ├── developer/
    │   ├── index.php, create.php, edit.php, delete.php
    ├── game/
    │   ├── index.php, create.php, edit.php, delete.php
    ├── genre/
    │   ├── index.php, create.php, edit.php, delete.php
    ├── player/
    │   ├── index.php, create.php, edit.php, delete.php
    └── review/
        ├── index.php, create.php, edit.php, delete.php
```

## Skema Database

Database (`db_game_review`) terdiri dari 5 tabel:

1.  `developer`
      * `id_developer` (PRIMARY KEY)
      * `nama_developer`
      * `negara`
2.  `genre`
      * `id_genre` (PRIMARY KEY)
      * `nama_genre`
3.  `player`
      * `id_player` (PRIMARY KEY)
      * `nama_player`
      * `email`
      * `negara`
4.  `game`
      * `id_game` (PRIMARY KEY)
      * `nama_game`
      * `tahun_rilis`
      * `id_genre` (FOREIGN KEY ke `genre`)
      * `id_developer` (FOREIGN KEY ke `developer`)
5.  `review`
      * `id_review` (PRIMARY KEY)
      * `id_game` (FOREIGN KEY ke `game`)
      * `id_player` (FOREIGN KEY ke `player`)
      * `rating`
      * `komentar`
      * `tanggal_review`

-----

## Dokumentasi
https://youtu.be/iSPjXxBWmeA
