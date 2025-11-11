# TP7DPBO2425C2 - Sistem Review Game

## Tugas Praktikum 7 DPBO

Saya **Najmi Alifah Hilmiya** dengan **NIM 2410393** mengerjakan **Tugas Praktikum 7** dalam mata kuliah *Desain Pemrograman Berorientasi Objek* untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.
**Aamiin.**

-----

## Deskripsi Proyek

Proyek ini adalah aplikasi web CRUD (Create, Read, Update, Delete) yang dibangun menggunakan PHP natif dengan paradigma **Pemrograman Berorientasi Objek (OOP)**. Aplikasi ini berfungsi sebagai platform untuk mengelola dan menampilkan ulasan (review) untuk berbagai game.

Arsitektur proyek ini memisahkan logika bisnis dan akses data ke dalam kelas-kelas model (di dalam direktori `class/`), sementara file-file di direktori `view/` bertindak sebagai *controller* dan *view* yang menangani *request* HTTP, validasi form, dan presentasi data ke pengguna.

Koneksi database dikelola menggunakan **PHP Data Objects (PDO)** melalui kelas `Database` yang menerapkan pola *Singleton* untuk memastikan hanya ada satu koneksi database yang dibuat.

## 📜 Fitur Utama

Aplikasi ini menyediakan fungsionalitas CRUD penuh untuk 5 entitas data utama:

  * **Halaman Utama (Game Library)**

      * Menampilkan daftar semua game yang ada di database.
      * Data game ditampilkan beserta relasinya (Genre dan Developer) menggunakan `LEFT JOIN`.
      * Fitur khusus: Menghitung dan menampilkan **rata-rata rating** (`AVG(rating)`) dan **jumlah review** (`COUNT(*)`) untuk setiap game. Ini dilakukan dengan query agergat terpisah yang hasilnya dipetakan ke data game.
      * Menyediakan navigasi ke semua modul manajemen lainnya (Reviews, Developers, Genres, Players).

  * **Manajemen Game** (Model: `Game.php`, View: `view/game/`)

      * **Create**: Menambahkan game baru dengan validasi nama game tidak boleh kosong.
      * **Read**: Menampilkan daftar semua game beserta genre dan developer.
      * **Update**: Mengedit data game, termasuk mengubah genre dan developer melalui *dropdown*.
      * **Delete**: Menghapus data game (akan menghapus review terkait berkat `ON DELETE CASCADE`).

  * **Manajemen Review** (Model: `Review.php`, View: `view/review/`)

      * **Create**: Menambahkan review baru dengan validasi (Game wajib dipilih, Rating antara 1-10).
      * **Read**: Menampilkan daftar semua review, termasuk nama game dan nama player yang terkait (menggunakan `LEFT JOIN`).
      * **Update**: Mengedit data review yang sudah ada.
      * **Delete**: Menghapus data review.

  * **Manajemen Player** (Model: `Player.php`, View: `view/player/`)

      * **Create**: Menambahkan data player baru dengan validasi (Nama wajib diisi, Email harus format valid).
      * **Read**: Menampilkan daftar semua player.
      * **Update**: Mengedit data player.
      * **Delete**: Menghapus data player (review terkait akan diatur `id_player` menjadi `NULL`).

  * **Manajemen Developer & Genre** (Model: `Developer.php` & `Genre.php`, View: `view/developer/` & `view/genre/`)

      * Menyediakan fungsionalitas CRUD standar untuk data master Developer dan Genre.
      * Validasi sederhana diterapkan (Nama wajib diisi).

## 💻 Teknologi yang Digunakan

  * **Backend**: **PHP 7+** (Native OOP)
      * Setiap entitas direpresentasikan sebagai kelas (misal: `Game`, `Review`).
      * Menggunakan `require_once` untuk memuat dependensi kelas.
  * **Database**: **MySQL**
      * Koneksi ditangani oleh **PDO (PHP Data Objects)** untuk *prepared statements* yang aman dari SQL Injection.
      * Skema database dan *sample data* disediakan dalam file `.sql`.
  * **Frontend**: **HTML5** & **Bootstrap 5.3.2**
      * Menggunakan *utility classes* Bootstrap untuk *styling* dan layout yang responsif.

## 📂 Struktur Proyek

Struktur direktori dirancang untuk memisahkan *concerns* (perhatian) antara logika, tampilan, dan konfigurasi.

```
TP7/
├── index.php           # Halaman utama (dashboard) yang menampilkan daftar game
│                         dan rata-rata ratingnya.
├── class/              # Berisi kelas-kelas Model (OOP) untuk setiap entitas
│   ├── Developer.php   # Model untuk tabel 'developer'
│   ├── Game.php        # Model untuk tabel 'game', termasuk method getAllWithJoin()
│   ├── Genre.php       # Model untuk tabel 'genre'
│   ├── Player.php      # Model untuk tabel 'player'
│   └── Review.php      # Model untuk tabel 'review', termasuk method getAllWithJoin()
├── config/
│   └── Database.php    # Kelas koneksi database (PDO) dengan pola Singleton
├── database/
│   └── db_game_review.sql # Skema SQL untuk membuat tabel dan memasukkan data awal
├── style/
│   └── style.css       # File CSS kustom (saat ini hanya berisi pengaturan font)
└── view/               # Berisi file-file View dan Controller (logika form)
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

## 🗃️ Skema Database

Database (`db_game_review`) berisi 5 tabel utama dengan relasi sebagai berikut:

1.  `developer` (Data master)
2.  `genre` (Data master)
3.  `player` (Data master)
4.  `game`
      * Memiliki relasi *many-to-one* dengan `genre` via `id_genre`.
      * Memiliki relasi *many-to-one* dengan `developer` via `id_developer`.
      * **Aturan Foreign Key**: `ON DELETE SET NULL`. Artinya, jika sebuah `developer` atau `genre` dihapus, data `game` yang terkait tidak akan ikut terhapus, tetapi kolom `id_genre` atau `id_developer`-nya akan diatur menjadi `NULL`.
5.  `review`
      * Memiliki relasi *many-to-one* dengan `game` via `id_game`.
      * Memiliki relasi *many-to-one* dengan `player` via `id_player`.
      * **Aturan Foreign Key (Game)**: `ON DELETE CASCADE`. Ini adalah aturan penting: jika sebuah `game` dihapus, semua `review` yang terkait dengan game tersebut akan **otomatis ikut terhapus** dari database.
      * **Aturan Foreign Key (Player)**: `ON DELETE SET NULL`. Jika seorang `player` dihapus, `review` yang pernah ia tulis akan tetap ada, tetapi kolom `id_player` pada review tersebut akan diatur menjadi `NULL` (menjadi review anonim).
        
-----

## Dokumentasi
https://youtu.be/iSPjXxBWmeA
