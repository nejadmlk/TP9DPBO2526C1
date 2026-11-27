# Starter Template MVP Strict Passive View — Daftar Kandidat Karyawan

Starter template praktikum DPBO menggunakan pola **Model-View-Presenter (MVP)** edisi **Strict Passive View (*Dumb View*)**.

## Setup Awal
1. Import `mvp_db.sql` ke MySQL / phpMyAdmin (membuat database `mvp_kandidat_db`).
2. Pastikan folder berada di `htdocs/` (XAMPP) atau `www/` (Laragon).

## Bagian yang Harus Dikerjakan
1. **Latihan (*Read* & *Form*)**: Lengkapi `TabelKandidat::getAllKandidat()`, `TabelKandidat::getKandidatById()`, serta `__construct()`, `tampilkanKandidat()`, dan `tampilkanFormKandidat()` di `PresenterKandidat.php`.
2. **Tugas Praktikum (*Create, Update, Delete*)**: Lengkapi method `add/update/delete` di `TabelKandidat.php` dan `PresenterKandidat.php`, lalu hubungkan blok `POST` di `index.php`.

