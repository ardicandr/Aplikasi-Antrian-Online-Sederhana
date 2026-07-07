# Aplikasi Antrian Online Sederhana - Pretest

Tugas Technical Test

## Tech Stack
- Laravel 12
- PHP 8.2
- MySQL
- Tailwind CSS (Laravel Breeze)

## Cara Instalasi
1. Clone repository ini.
2. Jalankan `composer install`.
3. Copy `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
4. Jalankan `php artisan key:generate`.
5. Jalankan `php artisan migrate`.
6. Jalankan `php artisan serve`.

## Fitur
- **Admin:** Login, Tambah Antrian, Navigasi Next/Prev, List Antrian.
- **User Display:** Menampilkan nomor antrian sekarang dan list tunggu secara Real-time (Polling 3s).