# Inventif

Inventif adalah sistem manajemen inventori berbasis web yang dibangun dengan Laravel. Aplikasi ini dirancang untuk membantu organisasi dalam pencatatan, peminjaman, dan penyewaan inventaris secara efisien.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-blue)
![Laravel](https://img.shields.io/badge/Laravel-9.x%7C10.x-red)

## ✨ Fitur Utama

* **Manajemen Multi-Role:**
    * **Admin:** Memiliki akses penuh untuk mengelola pengguna, kategori, dan seluruh data inventaris.
    * **Organisasi:** Role khusus untuk manajemen aset tingkat organisasi.
    * **Umum:** Pengguna biasa yang dapat melihat katalog dan mengajukan peminjaman/penyewaan.
* **Manajemen Inventaris:** CRUD (Create, Read, Update, Delete) data barang lengkap dengan gambar dan deskripsi.
* **Kategorisasi Barang:** Pengelompokan barang berdasarkan kategori untuk memudahkan pencarian.
* **Sistem Pengajuan (Pengajuan):**
    * **Peminjaman:** Formulir pengajuan untuk meminjam barang inventaris.
    * **Penyewaan:** Formulir pengajuan untuk menyewa aset.
    * **Persetujuan:** Alur kerja (workflow) untuk menyetujui, menolak, atau membatalkan pengajuan.
* **Autentikasi & Keamanan:** Login, Register, Reset Password, dan Verifikasi Email yang aman.
* **Dashboard Interaktif:** Dashboard yang responsif dan modern.

## 🛠️ Teknologi yang Digunakan
Project ini dibangun menggunakan teknologi berikut:

* **Backend:** [Laravel](https://laravel.com/) (PHP Framework)
* **Frontend:**
    * [Blade Templates](https://laravel.com/docs/blade)
    * [Bootstrap](https://getbootstrap.com/) (Framework CSS)
    * [JavaScript]
* **Database:** MySQL
* **Asset Bundling:** [Vite](https://vitejs.dev/)
* **Library Tambahan:** 
    * `sweetalert` (Untuk notifikasi popup yang menarik)
    * `fontawesome` & `simple-line-icons` (Ikon)
* **Package Manager:** Composer, NPM

## 📋 Prasyarat

Sebelum memulai instalasi, pastikan sistem Anda memiliki: 

- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL / MariaDB
- Web Server (Apache / Nginx)
- Git

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Krisnaaxz/inventif.git
cd inventif
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventif
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database

```bash
# Jalankan migrasi
php artisan migrate

# (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Jalankan Aplikasi

```bash
# Jalankan server development
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## 📁 Struktur Project

```
inventif/
├── app/                    # Application logic
│   ├── Http/
│   │   ├── Controllers/   # Controllers
│   │   └── Middleware/    # Middleware
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic services
├── database/
│   ├── migrations/        # Database migrations
│   ├── seeders/          # Database seeders
│   └── factories/        # Model factories
├── public/               # Public assets
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── views/            # Blade templates
│   ├── css/              # CSS source files
│   └── js/               # JavaScript source files
├── routes/
│   ├── web.php           # Web routes
│   └── api. php           # API routes
├── storage/              # Generated files
├── tests/                # Automated tests
├── . env. example          # Environment example
├── composer.json         # PHP dependencies
├── package.json          # NPM dependencies
└── README.md
```

## 💻 Contoh Penggunaan

### Login ke Sistem

```
* Admin
Email: admin@admin.com
Password: admin123

* Organisasi
Email: himaki@unud.com
Password: himaki123

* Umum
Email: mangkriisnaa@unud.com
Password: 12345678
```

### Menambah Inventaris Baru (Admin)

1. Navigate ke menu **Inventaris** >> **Kategori Inventaris**
2. Klik tombol **Tambah Kategori**
3. Isi form dengan *Nama Kategori*
4. Klik **Simpan**


### Menambah Inventaris Baru (Admin)

1. Navigate ke menu **Inventaris** >> **Daftar Inventaris**
2. Klik tombol **Tambah Inventaris**
3. Isi form dengan data inventaris: 
   - Nama
   - Kategori
   - Jumlah
   - Harga Satuan
   - Harga Sewa (per hari)
   - Gambar
   - Deskripsi
4. Klik **Simpan**

### Menambah Pengajuan Peminjaman Baru (Organisasi)

1. Navigate ke menu **Pengajuan** >> **Peminjaman Inventaris**
2. Klik tombol **Ajukan Peminjaman**
3. Isi form dengan data peminjaman: 
   - Tanggal mulai
   - Tanggal Selesai
   - Waktu mulai
   - Waktu Selesai
   - Keperluan
   - Pilih Barang yang akan dipinjam (beserta jumlahnya)
   - Surat Pengajuan
4. Klik **Simpan**

### Menambah Pengajuan Penyewaan Baru (Umum)

1. Navigate ke menu **Pengajuan** >> **Penyewaan Inventaris**
2. Klik tombol **Ajukan Penyewaan**
3. Isi form dengan data penyewaan: 
   - Tanggal mulai
   - Waktu mulai
   - Durasi sewa (hari)
   - Keperluan
   - Pilih Barang yang akan dipinjam (beserta jumlahnya)
   - Surat Pengajuan
4. Klik 

## Hasil Pengajuan

### Organisasi & Umum Control
- Organisasi dan Umum bisa melakukan konfirmasi pengajuan kepada admin
- Organisasi dan Umum bisa membatalkan pengajuan sebelum disetujui atau ditolak oleh admin

### Admin Control
- Admin bisa mengubah status pengajuan oleh Ogranisasi (peminjaman) dan Umum (penyewaan) dari *menunggu* menjadi *disetujui* atau *ditolak*.
- Admin bisa mengubah status pengajuan yang sudah *disetujui* menjadi *selesai*.
- Admin bisa menghapus data pengajuan yang berstatus *ditolak*, *dibatalkan*, dan *selesai*.


## 🤝 Kontribusi

Kontribusi sangat kami apresiasi!  Berikut cara berkontribusi: 

1. **Fork** repository ini
2. **Clone** fork Anda: 
   ```bash
   git clone https://github.com/username-anda/inventif.git
   ```
3. **Buat branch** baru untuk fitur Anda: 
   ```bash
   git checkout -b fitur-baru
   ```
4. **Commit** perubahan Anda:
   ```bash
   git commit -m "Menambahkan fitur baru"
   ```
5. **Push** ke branch: 
   ```bash
   git push origin fitur-baru
   ```
6. Buat **Pull Request** di GitHub

### Panduan Kontribusi

- Pastikan code mengikuti PSR-12 coding standard
- Tulis test untuk fitur baru
- Update dokumentasi jika diperlukan
- Gunakan commit message yang deskriptif
- Satu pull request untuk satu fitur/fix


## 🐛 Bug Report

Jika Anda menemukan bug, silakan buat issue di [GitHub Issues](https://github.com/Krisnaaxz/inventif/issues) dengan detail:

- Deskripsi bug
- Langkah reproduksi
- Expected behavior
- Screenshot (jika ada)
- Environment (OS, PHP version, dll)


## 👨‍💻 Author

**Krisnaaxz**
- GitHub: [@Krisnaaxz](https://github.com/Krisnaaxz)

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap / Tailwind CSS


---

⭐ Jika project ini bermanfaat, jangan lupa berikan star! 
