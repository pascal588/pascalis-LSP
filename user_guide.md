# POS Application - User Guide (Laporan Eksekusi)

Dokumen ini disusun untuk memenuhi persyaratan laporan eksekusi/user guide pada aplikasi kasir berbasis web.

---

## 1. Persiapan Sistem
Sebelum menjalankan aplikasi, pastikan langkah-langkah berikut telah dilakukan:
1.  **Database**: Pastikan database `USK` tersedia di MySQL (XAMPP/Laragon). Konfigurasi ada di file `.env`.
2.  **Seeding**: Jalankan `php artisan db:seed` untuk mendapatkan data awal (Kategori, Item, dan User Admin).
3.  **Akses**: Buka browser dan arahkan ke alamat `http://localhost:8000` (setelah menjalankan `php artisan serve`).

## 2. Autentikasi
Aplikasi ini dilindungi oleh sistem login.
-   **URL Login**: `/login`
-   **Akun Default**: 
    -   Email: `admin@example.com`
    -   Password: `password`
-   Hanya pengguna yang berhasil login yang dapat mengakses Dashboard dan fitur lainnya.

## 3. Fitur Utama

### A. Dashboard
Menampilkan ringkasan statistik:
-   Total Kategori, Total Item, dan Total Transaksi.
-   Tombol pintas untuk memulai transaksi baru.

### B. Master Data (Kategori & Item)
-   **Kategori**: Kelola pengelompokan produk. Berlaku validasi *Unique Name*.
-   **Item**: Kelola data produk (Nama, Harga, Stok). 
    -   Harga minimal: Rp 100.
    -   Stok minimal: 0.
    -   Validasi stok otomatis saat transaksi.

### C. Transaksi (Point of Sale)
1.  Buka menu **New Transaction**.
2.  Pilih item yang tersedia, masukkan jumlah (Quantity), dan klik **Add to Cart**.
3.  Sistem akan memvalidasi stok. Jika stok kurang, item gagal ditambahkan.
4.  Buka menu **Cart** untuk melihat ringkasan belanja dan total harga.
5.  Masukkan **Jumlah Pembayaran**. Pembayaran harus >= Total Harga.
6.  Klik **Selesaikan Transaksi**. Stok akan dipotong otomatis dan keranjang dikosongkan.

### D. Riwayat & Cetak Struk
-   Buka menu **History** untuk melihat daftar transaksi yang pernah dilakukan.
-   Klik **View Receipt** untuk melihat struk virtual.
-   Gunakan tombol **Print Receipt** untuk mencetak struk sebagai bukti pembayaran.

---

## 4. Validasi & Keamanan
-   Sistem menggunakan Middleware `auth` untuk setiap halaman sensitif.
-   Validasi stok dilakukan secara *real-time* di sisi server saat penambahan item ke cart dan saat checkout.
-   Pesan sukses/gagal ditampilkan menggunakan komponen Alert yang konsisten.


Ringkasan Urutan Cepat (Cheatsheet):
cp .env.example .env
composer install
npm install
php artisan key:generate
(Sesuaikan database di .env)
php artisan migrate
npm run build
php artisan serve