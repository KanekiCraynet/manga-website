**Dokumentasi Template Manga Website WordPress**  
Berikut adalah panduan lengkap untuk mengelola dan mengembangkan website manga berbasis WordPress menggunakan template dari GitHub [KanekiCraynet/manga-website](https://github.com/KanekiCraynet/manga-website). Template ini menggunakan PHP, CSS, JavaScript, dan mengikuti praktik pengembangan WordPress.

---

### **1. Instalasi dan Prasyarat**
#### **Persiapan Server**
- **Hosting**: Pastikan server mendukung PHP 7.4+ (direkomendasikan PHP 8+) dan MySQL/MariaDB .  
- **WordPress**: Instal WordPress versi 4.7 atau lebih baru .  

#### **Instalasi Template**
1. **Unduh Template**: Clone repositori GitHub atau unduh file ZIP dari [KanekiCraynet/manga-website](https://github.com/KanekiCraynet/manga-website).  
2. **Upload ke WordPress**:  
   - Ekstrak file ZIP, lalu upload folder tema ke `/wp-content/themes/`.  
   - Aktifkan tema melalui **Appearance > Themes** di dashboard WordPress .  
3. **Instal Plugin Wajib**:  
   - Setelah mengaktifkan tema, sistem akan meminta instalasi plugin pendukung (misalnya: WP Manga FTP/SFTP Storage, Autoptimize) .  

#### **Backup Database**  
- Selalu backup database sebelum melakukan pembaruan atau perubahan besar. Gunakan plugin seperti UpdraftPlus atau phpMyAdmin .  

---

### **2. Konfigurasi Dasar**
#### **Pengaturan Media**  
- **Penyimpanan Gambar**:  
  - Gunakan plugin seperti **WP Manga FTP/SFTP Storage** untuk mengunggah gambar ke server eksternal (Amazon S3, Google Photos) .  
  - Aktifkan opsi enkripsi nama folder untuk keamanan .  

#### **Struktur URL**  
- Atur permalink ke format **Manga/Chapter** melalui **Settings > Permalinks** (misal: `/manga/%manga%/chapter/%chapter%/`) .  

#### **Pengaturan Tema**  
- **Customizer**:  
  - Gunakan **Theme Customizer** untuk mengatur skema warna (light/dark mode), tata letak sidebar, dan ukuran thumbnail .  
  - Aktifkan fitur **Adult Content Warning** dan **Family Safe Button** jika diperlukan .  

---

### **3. Fitur Utama**  
#### **Manajemen Manga**  
- **Tambah Manga**:  
  - Buat posting baru dengan tipe **Manga** di dashboard.  
  - Tambahkan metadata seperti genre, penulis, status (ongoing/complete), dan rating .  
- **Chapter Management**:  
  - Unggah chapter melalui **Front-End Upload** atau impor dari sumber eksternal (misal: Mangakakalot) menggunakan skrip TamperMonkey .  

#### **Pembaca Manga**  
- **Tampilan**:  
  - Pilih mode **Single-Page** atau **All-Pages Layout** untuk membaca chapter .  
  - Aktifkan **Lazy Load** untuk optimasi kecepatan .  
- **Navigasi**:  
  - Tombol **Next/Prev Chapter** dan dukungan keyboard (panah kiri/kanan) .  

#### **Integrasi Add-Ons**  
- **WooCommerce**: Tambahkan toko merchandise manga .  
- **WP Discuz**: Aktifkan kolom komentar khusus .  
- **AMP**: Aktifkan versi mobile-optimized untuk pengguna seluler .  

---

### **4. Kustomisasi Lanjutan**  
#### **CSS & JavaScript**  
- **Child Theme**:  
  - Buat child theme untuk menghindari kehilangan perubahan saat pembaruan tema .  
  - Modifikasi `style.css` untuk menyesuaikan tampilan (misal: ukuran font, warna) .  
- **Shortcodes**:  
  - Gunakan shortcode seperti `[manga_post_slider]` atau `[advancesearchform]` untuk menampilkan daftar manga atau formulir pencarian .  

#### **Hooks & API**  
- **Web Hooks**:  
  - Integrasikan API eksternal menggunakan hook seperti `useMangaList` atau `useMangaSearch` untuk menarik data dari sumber seperti MangaDex .  

---

### **5. Pemeliharaan dan Troubleshooting**  
#### **Pembaruan**  
- **Tema & Plugin**:  
  - Selalu perbarui tema dan plugin setelah melakukan backup.  
  - Bersihkan cache (Cloudflare, browser, server) setelah pembaruan .  

#### **Masalah Umum**  
- **404 Error**: Periksa struktur permalink dan pastikan `.htaccess` writable .  
- **Upload Gagal**:  
  - Pastikan izin folder `/wp-content/uploads/` diatur ke **755** .  
  - Nonaktifkan opsi **Aggregate JS-files** di Autoptimize jika terjadi konflik .  

#### **Keamanan**  
- Batasi akses pengguna dengan plugin seperti **User Role Editor**.  
- Aktifkan reCaptcha untuk formulir login/registrasi .  

---
