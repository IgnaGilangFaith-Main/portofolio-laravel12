# Portfolio Laravel 12

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.8-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

Website portfolio pribadi yang dibangun menggunakan Laravel 12 dan Bootstrap 5.3.8. Dilengkapi dengan panel admin untuk mengelola konten portfolio secara dinamis.

## 📸 Screenshots

### Frontend

-   **Hero Section** - Tampilan utama dengan foto dan deskripsi singkat
-   **About Section** - Informasi tentang diri dan skills
-   **Projects Section** - Showcase proyek-proyek yang pernah dikerjakan
-   **Contact Section** - Form kontak untuk pengunjung

### Backend (Admin Panel)

-   **Dashboard** - Overview statistik website
-   **CRUD Hero** - Kelola section hero
-   **CRUD About & Skills** - Kelola informasi about dan skills
-   **CRUD Projects** - Kelola portfolio proyek
-   **Pengaturan Akun** - Kelola profil dan password admin

## 🚀 Fitur

-   ✅ Responsive design dengan Bootstrap 5.3.8
-   ✅ Admin panel dengan autentikasi
-   ✅ CRUD untuk semua section portfolio
-   ✅ Upload gambar untuk hero dan proyek
-   ✅ Notifikasi dengan SweetAlert
-   ✅ Custom error pages (400, 401, 403, 404, 405, 419, 429, 500, 503)
-   ✅ Validasi form dengan pesan dalam Bahasa Indonesia

## 📋 Requirements

-   PHP >= 8.2
-   Composer
-   MySQL / MariaDB
-   Node.js & NPM (optional, untuk asset compilation)

## ⚙️ Instalasi

1. **Clone repository**

    ```bash
    git clone https://github.com/IgnaGilangFaith-Main/portofolio-laravel12.git
    cd portofolio-laravel12
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Copy file environment**

    ```bash
    cp .env.example .env
    ```

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Konfigurasi database di file `.env`**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=portofolio_laravel12
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Jalankan migrasi dan seeder**

    ```bash
    php artisan migrate --seed
    ```

7. **Jalankan server**

    ```bash
    php artisan serve
    ```

8. **Akses website**
    - Frontend: http://localhost:8000
    - Login Admin: http://localhost:8000/login

## 🔐 Default Login

| Field    | Value           |
| -------- | --------------- |
| Email    | admin@admin.com |
| Password | password        |

> ⚠️ **Penting:** Segera ganti password setelah login pertama kali!

## 📁 Struktur Folder

```
portofolio-laravel12/
├── app/
│   ├── Http/Controllers/
│   │   ├── AboutController.php
│   │   ├── AuthController.php
│   │   ├── HeroController.php
│   │   ├── HomepageController.php
│   │   ├── ProjectController.php
│   │   ├── SkillController.php
│   │   └── UserController.php
│   └── Models/
│       ├── About.php
│       ├── Hero.php
│       ├── Project.php
│       ├── Skill.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── bootstrap-5.3.8-dist/
│   ├── img/
│   │   ├── hero/
│   │   └── project/
│   └── front/
├── resources/views/
│   ├── back/
│   │   ├── about/
│   │   ├── hero/
│   │   ├── project/
│   │   ├── skill/
│   │   ├── user/
│   │   ├── dashboard.blade.php
│   │   └── login.blade.php
│   ├── errors/
│   ├── front/
│   └── layouts/
│       ├── back.blade.php
│       └── front.blade.php
└── routes/
    └── web.php
```

## 🛣️ Routes

### Public Routes

| Method | URI      | Deskripsi               |
| ------ | -------- | ----------------------- |
| GET    | `/`      | Halaman utama portfolio |
| GET    | `/login` | Halaman login           |
| POST   | `/login` | Proses login            |

### Admin Routes

| Method | URI                | Deskripsi       |
| ------ | ------------------ | --------------- |
| GET    | `/dashboard`       | Dashboard admin |
| GET    | `/hero`            | Daftar hero     |
| GET    | `/about`           | About & skills  |
| GET    | `/project`         | Daftar proyek   |
| GET    | `/pengaturan-akun` | Pengaturan akun |
| POST   | `/logout`          | Logout          |

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan fork repository ini dan buat pull request.

1. Fork repository
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📝 License

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 👤 Author

**Gilang Risky Mahardika**

-   GitHub: [@IgnaGilangFaith-Main](https://github.com/IgnaGilangFaith-Main)

---

⭐ Jika project ini membantu, silakan berikan star!
