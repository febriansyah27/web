<div align="center">

# 🏢 LokalKerja

**Platform Portal Lowongan Kerja Berbasis Web**

[![Laravel](https://img.shields.io/badge/Laravel-v13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-v8-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

*LokalKerja adalah aplikasi portal lowongan kerja yang menghubungkan pencari kerja dengan perusahaan. Dilengkapi dengan fitur AI untuk pembuatan CV otomatis.*

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Arsitektur Aplikasi](#-arsitektur-aplikasi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi & Setup](#-instalasi--setup)
- [Konfigurasi Environment](#-konfigurasi-environment)
- [Struktur Database](#-struktur-database)
- [Struktur Direktori](#-struktur-direktori)
- [Panduan Penggunaan](#-panduan-penggunaan)
- [API Routes](#-api-routes)
- [Middleware](#-middleware)
- [Kontribusi](#-kontribusi)

---

## 🎯 Tentang Proyek

**LokalKerja** adalah platform digital yang mempertemukan dua jenis pengguna:

- **Pencari Kerja (Job Seeker)** — dapat melihat lowongan, melamar pekerjaan, mengelola profil, dan menghasilkan CV profesional berbasis AI.
- **Perusahaan (Company)** — dapat memposting lowongan kerja, mengelola pelamar, dan mengubah status lamaran.

Proyek ini dikembangkan sebagai tugas akhir (UAS) mata kuliah **Pemrograman Web** menggunakan framework **Laravel 13** dan terintegrasi dengan **Laravel AI** untuk fitur generasi CV otomatis berbasis model bahasa besar (LLM).

---

## ✨ Fitur Utama

### 👤 Autentikasi & Manajemen Akun
- Registrasi akun dengan pemilihan peran (Job Seeker / Company)
- Login & Logout yang aman
- Proteksi route berbasis peran menggunakan middleware custom

### 🔍 Pencari Kerja (Job Seeker)
- **Jelajahi Lowongan** — Lihat semua lowongan kerja yang aktif dengan detail lengkap
- **Lamar Pekerjaan** — Upload CV dan kirim cover letter langsung dari aplikasi
- **Manajemen Profil** — Kelola data diri, bio, nomor telepon, dan alamat
- **Riwayat Pengalaman Kerja** — Tambah/hapus pengalaman kerja secara dinamis (JSON-based)
- **Riwayat Pendidikan** — Tambah/hapus riwayat pendidikan secara dinamis (JSON-based)
- **Manajemen Keahlian** — Tambah/hapus daftar skill secara dinamis
- **🤖 Generate CV dengan AI** — Hasilkan CV profesional ATS-friendly secara otomatis menggunakan Gemini AI berdasarkan data profil

### 🏢 Perusahaan (Company)
- **Dashboard** — Ringkasan statistik: total lowongan, total pelamar, dan lowongan aktif
- **Manajemen Lowongan** — CRUD lengkap untuk posting lowongan kerja (judul, deskripsi, lokasi, tipe, gaji, deadline, persyaratan, tanggung jawab)
- **Manajemen Pelamar** — Lihat detail setiap pelamar beserta CV yang diunggah
- **Update Status Lamaran** — Ubah status lamaran menjadi `Diterima`, `Ditolak`, atau `Pending`

### 🌐 Landing Page
- Halaman utama dinamis dengan statistik real-time (total lowongan, perusahaan, pencari kerja)
- Tampil 3 lowongan terbaru sebagai featured jobs
- Desain modern dengan animasi AOS (Animate On Scroll)

---

## 🛠 Tech Stack

| Kategori | Teknologi | Versi |
|---|---|---|
| **Framework Backend** | Laravel | ^13.8 |
| **Bahasa** | PHP | ^8.3 |
| **Frontend Build Tool** | Vite | ^8.0 |
| **CSS Framework** | TailwindCSS | ^4.3 |
| **Animasi** | AOS (Animate On Scroll) | ^2.3.4 |
| **Ikon** | Blade Lucide Icons | ^1.26 |
| **AI Integration** | Laravel AI (Gemini) | ^0.6.8 |
| **Template Engine** | Blade | - |
| **Database** | MySQL / SQLite | - |
| **Package Manager (PHP)** | Composer | - |
| **Package Manager (JS)** | NPM | - |
| **Testing** | PestPHP | ^4.7 |

---

## 🏗 Arsitektur Aplikasi

```
┌─────────────────────────────────────────────┐
│                  Browser                     │
└───────────────────┬─────────────────────────┘
                    │ HTTP Request
┌───────────────────▼─────────────────────────┐
│              routes/web.php                  │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  │
│  │  Public  │  │auth+role │  │auth+role │  │
│  │  Routes  │  │job_seeker│  │ company  │  │
│  └──────────┘  └────┬─────┘  └────┬─────┘  │
└────────────────────│──────────────│──────────┘
                     │              │
        ┌────────────▼──┐  ┌───────▼────────┐
        │  Controllers  │  │   Controllers  │
        │  (Job Seeker) │  │   (Company)    │
        │ JobController │  │DashboardCtrl   │
        │ ProfileCtrl   │  │JobPostingCtrl  │
        │ authController│  │ApplicantCtrl   │
        └───────┬───────┘  └───────┬────────┘
                │                  │
        ┌───────▼──────────────────▼────────┐
        │              Models               │
        │  User | Profile | JobPosting      │
        │  Application                      │
        └───────────────┬───────────────────┘
                        │
        ┌───────────────▼───────────────────┐
        │            Database               │
        │  (MySQL / SQLite)                 │
        └───────────────────────────────────┘
                        
        ┌───────────────────────────────────┐
        │          AI Layer (Optional)      │
        │  GenerateCvAgent → Laravel AI     │
        │  → Gemini LLM → CV Markdown       │
        └───────────────────────────────────┘
```

### Relasi Antar Model

```
User (1) ──────── (1) Profile
User (1) ──────── (N) JobPosting  [sebagai Company]
User (1) ──────── (N) Application [sebagai Job Seeker]
JobPosting (1) ── (N) Application
```

---

## 💻 Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum instalasi:

- **PHP** >= 8.3 (dengan ekstensi: `pdo`, `mbstring`, `openssl`, `fileinfo`, `json`)
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM** >= 9.x
- **MySQL** >= 8.0 atau **SQLite** (untuk development)
- **Git**

---

## 🚀 Instalasi & Setup

### 1. Clone Repositori

```bash
git clone https://github.com/AmarSlebew/Lokal-Kerja-web-app.git
cd Lokal-Kerja-web-app
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Salin File Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lokal_kerja
DB_USERNAME=root
DB_PASSWORD=
```

> **Atau gunakan SQLite untuk development:**
> ```env
> DB_CONNECTION=sqlite
> ```

### 6. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 7. Install Dependensi JavaScript

```bash
npm install
```

### 8. Konfigurasi AI (Opsional — Untuk Fitur Generate CV)

Tambahkan API key Gemini ke file `.env`:

```env
GEMINI_API_KEY=your_gemini_api_key_here
```

> Dapatkan API key di [Google AI Studio](https://aistudio.google.com/)

### 9. Jalankan Aplikasi

**Development (direkomendasikan — menjalankan server, queue, dan vite secara bersamaan):**

```bash
composer run dev
```

Atau jalankan secara manual:

```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite (asset bundler)
npm run dev

# Terminal 3 - Queue (untuk fitur AI)
php artisan queue:listen --tries=1
```

Aplikasi akan berjalan di: **http://localhost:8000**

---

### Setup Cepat (One Command)

Jika ingin setup sekaligus dalam satu perintah:

```bash
composer run setup
```

Perintah ini akan otomatis:
1. Install semua dependensi PHP
2. Menyalin `.env.example` ke `.env`
3. Generate application key
4. Menjalankan migrasi
5. Install dependensi NPM
6. Build asset produksi

---

## ⚙️ Konfigurasi Environment

Berikut variabel `.env` yang perlu dikonfigurasi:

```env
# Aplikasi
APP_NAME=LokalKerja
APP_ENV=local
APP_KEY=                          # Di-generate otomatis
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lokal_kerja
DB_USERNAME=root
DB_PASSWORD=

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database

# Queue (untuk fitur AI asinkron)
QUEUE_CONNECTION=database

# Google Gemini AI
GEMINI_API_KEY=your_key_here
```

---

## 🗄 Struktur Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint unsigned | Primary key |
| `name` | varchar | Nama pengguna |
| `email` | varchar | Email (unique) |
| `password` | varchar | Password (hashed) |
| `role` | varchar | `job_seeker` atau `company` |
| `email_verified_at` | timestamp | Verifikasi email |
| `timestamps` | - | `created_at`, `updated_at` |

### Tabel `profiles`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint unsigned | Primary key |
| `user_id` | bigint unsigned | FK → users |
| `bio` | text | Ringkasan diri |
| `phone` | varchar | Nomor telepon |
| `alamat` | varchar | Alamat |
| `skills` | json | Daftar keahlian |
| `experience` | json | Riwayat pengalaman kerja |
| `education` | json | Riwayat pendidikan |

### Tabel `job_postings`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint unsigned | Primary key |
| `company_id` | bigint unsigned | FK → users (company) |
| `title` | varchar | Judul pekerjaan |
| `description` | text | Deskripsi pekerjaan |
| `location` | varchar | Lokasi kerja |
| `type` | varchar | Tipe kerja (Full-time, Part-time, dll) |
| `salary` | varchar | Range gaji |
| `status` | varchar | `Aktif` / `Nonaktif` |
| `deadline` | date | Batas waktu lamaran |
| `requirements` | text | Persyaratan |
| `responsibilities` | text | Tanggung jawab |

### Tabel `applications`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint unsigned | Primary key |
| `user_id` | bigint unsigned | FK → users (job seeker) |
| `job_posting_id` | bigint unsigned | FK → job_postings |
| `cover_letter` | text | Surat lamaran |
| `cv_path` | varchar | Path file CV yang diunggah |
| `status` | varchar | `Pending`, `Diterima`, `Ditolak` |

---

## 📁 Struktur Direktori

```
lokalKerja/
├── app/
│   ├── Ai/
│   │   └── Agents/
│   │       └── GenerateCvAgent.php    # AI Agent untuk generate CV
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Company/
│   │   │   │   ├── ApplicantController.php   # Manajemen pelamar
│   │   │   │   ├── DashboardController.php   # Dashboard perusahaan
│   │   │   │   └── JobPostingController.php  # CRUD lowongan
│   │   │   ├── authController.php    # Login, Register, Logout
│   │   │   ├── JobController.php     # Jelajah & lamar pekerjaan
│   │   │   └── ProfileController.php # Profil & generate CV
│   │   └── Middleware/
│   │       ├── RedirectIfAuthenticated.php  # Redirect jika sudah login
│   │       └── RoleMiddleware.php           # Proteksi akses berbasis role
│   ├── Models/
│   │   ├── Application.php    # Model lamaran kerja
│   │   ├── JobPosting.php     # Model lowongan kerja
│   │   ├── Profile.php        # Model profil pengguna
│   │   └── User.php           # Model pengguna
│   └── Providers/
├── database/
│   ├── migrations/            # File migrasi database
│   └── seeders/               # Seeder database
├── resources/
│   ├── views/
│   │   ├── auth/              # Halaman login & register
│   │   ├── company/           # Views untuk role company
│   │   │   ├── applicants/    # Manajemen pelamar
│   │   │   ├── jobs/          # Manajemen lowongan
│   │   │   └── dashboard.blade.php
│   │   ├── components/        # Komponen Blade yang dapat digunakan ulang
│   │   ├── jobs/              # Views untuk role job seeker
│   │   │   ├── index.blade.php    # Daftar lowongan
│   │   │   ├── show.blade.php     # Detail lowongan
│   │   │   ├── apply.blade.php    # Form lamaran
│   │   │   ├── profile.blade.php  # Halaman profil
│   │   │   └── cv-result.blade.php # Hasil CV dari AI
│   │   └── welcome.blade.php  # Landing page
│   └── css/                   # Asset CSS (diproses Vite)
├── routes/
│   └── web.php                # Definisi semua route aplikasi
├── composer.json
├── package.json
└── vite.config.js
```

---

## 📖 Panduan Penggunaan

### Sebagai Pencari Kerja

1. **Daftar** akun baru → pilih peran **Job Seeker**
2. **Login** menggunakan email dan password
3. **Lengkapi Profil** di menu `/profile`:
   - Isi data diri (nama, email, telepon, alamat, bio)
   - Tambahkan pengalaman kerja, pendidikan, dan keahlian
4. **Generate CV** otomatis dengan klik tombol "Generate CV dengan AI"
5. **Jelajahi Lowongan** di menu `/jobs`
6. Klik lowongan untuk melihat detail → klik **Lamar Sekarang**
7. Isi cover letter dan upload file CV → Submit lamaran

### Sebagai Perusahaan

1. **Daftar** akun baru → pilih peran **Company**
2. **Login** → akan diarahkan ke `/company/dashboard`
3. **Kelola Lowongan** di menu Jobs:
   - Tambah lowongan baru dengan mengisi semua detail
   - Edit atau hapus lowongan yang sudah ada
   - Aktif/nonaktifkan lowongan
4. **Lihat Pelamar** → klik "Lihat Pelamar" pada lowongan tertentu
5. **Review Lamaran** → buka detail pelamar, download CV, baca cover letter
6. **Update Status** → ubah status menjadi `Diterima` atau `Ditolak`

---

## 🛣 API Routes

### Public Routes
| Method | URI | Keterangan |
|---|---|---|
| `GET` | `/` | Landing page |
| `GET` | `/register` | Halaman registrasi |
| `POST` | `/register` | Proses registrasi |
| `GET` | `/login` | Halaman login |
| `POST` | `/login` | Proses login |
| `DELETE` | `/logout` | Logout |

### Job Seeker Routes (Auth + Role: `job_seeker`)
| Method | URI | Keterangan |
|---|---|---|
| `GET` | `/jobs` | Daftar semua lowongan aktif |
| `GET` | `/jobs/{job}` | Detail lowongan |
| `GET` | `/jobs/{job}/apply` | Form lamaran |
| `POST` | `/jobs/{job}/apply` | Submit lamaran |
| `GET` | `/profile` | Halaman profil |
| `POST` | `/profile` | Update data diri |
| `POST` | `/profile/experience` | Tambah pengalaman kerja |
| `DELETE` | `/profile/experience/{index}` | Hapus pengalaman kerja |
| `POST` | `/profile/education` | Tambah pendidikan |
| `DELETE` | `/profile/education/{index}` | Hapus pendidikan |
| `POST` | `/profile/skill` | Tambah keahlian |
| `DELETE` | `/profile/skill/{index}` | Hapus keahlian |
| `POST` | `/profile/generate-cv` | Generate CV dengan AI |

### Company Routes (Auth + Role: `company`)
| Method | URI | Keterangan |
|---|---|---|
| `GET` | `/company/dashboard` | Dashboard perusahaan |
| `GET` | `/company/jobs` | Daftar lowongan milik perusahaan |
| `GET` | `/company/jobs/create` | Form tambah lowongan |
| `POST` | `/company/jobs` | Simpan lowongan baru |
| `GET` | `/company/jobs/{job}/edit` | Form edit lowongan |
| `PUT/PATCH` | `/company/jobs/{job}` | Update lowongan |
| `DELETE` | `/company/jobs/{job}` | Hapus lowongan |
| `GET` | `/company/jobs/{job}/applicants` | Daftar pelamar |
| `GET` | `/company/applicants/{application}` | Detail pelamar |
| `PATCH` | `/company/applicants/{application}/status` | Update status lamaran |

---

## 🔐 Middleware

### `RoleMiddleware`
Memeriksa apakah pengguna yang sudah login memiliki peran yang sesuai. Jika tidak, pengguna akan dialihkan ke halaman yang sesuai dengan perannya.

**Cara penggunaan di route:**
```php
Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    // Route khusus job seeker
});

Route::middleware(['auth', 'role:company'])->group(function () {
    // Route khusus company
});
```

### `RedirectIfAuthenticated`
Mencegah pengguna yang sudah login mengakses halaman login/register. Jika sudah login, pengguna akan diarahkan sesuai dengan perannya.

---

## 🤝 Kontribusi

Proyek ini adalah proyek akademik (UAS). Jika Anda ingin berkontribusi atau memberikan saran:

1. Fork repositori ini
2. Buat branch baru: `git checkout -b feature/NamaFitur`
3. Commit perubahan: `git commit -m 'feat: tambahkan fitur baru'`
4. Push ke branch: `git push origin feature/NamaFitur`
5. Buat Pull Request

---

<div align="center">

**Dibuat dengan ❤️ menggunakan Laravel**

*UAS Pemrograman Web — Semester 4*

</div>
