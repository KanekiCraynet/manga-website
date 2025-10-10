# KomikCAST - WordPress Manga Website Theme

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![WordPress](https://img.shields.io/badge/WordPress-4.7%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://php.net/)

**KomikCAST** adalah tema WordPress yang dirancang khusus untuk website manga/komik. Tema ini menyediakan antarmuka yang modern dan responsif untuk membaca manga online dengan fitur-fitur lengkap seperti bookmark, rating, dan manajemen chapter.

## 🚀 Fitur Utama

- **Responsive Design**: Tampilan optimal di desktop, tablet, dan mobile
- **Dark/Light Mode**: Dukungan tema gelap dan terang
- **Manga Reader**: Pembaca manga dengan navigasi chapter yang mudah
- **Bookmark System**: Sistem bookmark untuk pengguna terdaftar
- **Rating System**: Sistem rating untuk setiap manga
- **Search & Filter**: Pencarian dan filter manga yang canggih
- **User Management**: Manajemen pengguna dengan berbagai level akses
- **SEO Optimized**: Optimasi SEO untuk performa pencarian yang baik
- **Multi-language Support**: Dukungan multi-bahasa
- **Custom Post Types**: Post type khusus untuk manga dan chapter

## 🛠️ Teknologi yang Digunakan

### Backend
- **PHP 7.4+** - Bahasa pemrograman utama
- **WordPress 4.7+** - CMS dan framework
- **MySQL/MariaDB** - Database management
- **Meta Box** - Custom fields management

### Frontend
- **HTML5** - Markup language
- **CSS3** - Styling dengan Bootstrap framework
- **JavaScript (ES6+)** - Interaktivitas dan AJAX
- **jQuery** - DOM manipulation dan AJAX calls
- **Owl Carousel** - Slider dan carousel
- **Font Awesome** - Icon library

### Tools & Libraries
- **Mobile Detect** - Device detection
- **Remote Thumbnail** - Image optimization
- **Bootstrap** - CSS framework
- **jQuery Barrating** - Rating system
- **jQuery Qtip** - Tooltip functionality

---

## 📋 Prasyarat Sistem

### Server Requirements
- **PHP**: 7.4 atau lebih baru (direkomendasikan PHP 8.0+)
- **MySQL**: 5.6 atau lebih baru / MariaDB 10.1+
- **Apache/Nginx**: Web server dengan mod_rewrite enabled
- **Memory Limit**: Minimal 256MB (direkomendasikan 512MB+)
- **Upload Size**: Minimal 64MB untuk upload gambar manga

### WordPress Requirements
- **WordPress**: 4.7 atau lebih baru
- **Theme Support**: Custom post types, custom fields, menus
- **Plugin Compatibility**: Meta Box, WooCommerce (opsional)

---

## 🚀 Instalasi dan Setup

### Metode 1: Instalasi Manual

1. **Download Theme**
   ```bash
   git clone https://github.com/KanekiCraynet/manga-website.git
   # atau download ZIP dari GitHub
   ```

2. **Upload ke WordPress**
   - Ekstrak file ZIP
   - Upload folder tema ke `/wp-content/themes/komikcast/`
   - Pastikan struktur folder: `/wp-content/themes/komikcast/`

3. **Aktifkan Theme**
   - Login ke WordPress Admin Dashboard
   - Navigasi ke **Appearance > Themes**
   - Klik **Activate** pada tema KomikCAST

### Metode 2: Instalasi via WordPress Admin

1. **Upload Theme**
   - Login ke WordPress Admin
   - Navigasi ke **Appearance > Themes > Add New > Upload Theme**
   - Upload file ZIP tema
   - Klik **Install Now** dan **Activate**

### Konfigurasi Awal

1. **Setup Custom Post Types**
   - Tema akan otomatis membuat post types: `komik` dan `chapter`
   - Pastikan permalink structure diatur ke **Post name**

2. **Install Plugin Wajib**
   - **Meta Box** - Untuk custom fields
   - **WooCommerce** (opsional) - Untuk e-commerce features

3. **Konfigurasi Permalink**
   - Navigasi ke **Settings > Permalinks**
   - Pilih **Post name** atau custom structure
   - Klik **Save Changes**

### Backup & Keamanan

⚠️ **PENTING**: Selalu backup sebelum instalasi atau update
- Backup database menggunakan phpMyAdmin atau plugin UpdraftPlus
- Backup file tema dan uploads folder
- Test di staging environment terlebih dahulu  

---

## 📁 Struktur File Project

```
manga-website/
├── 📄 style.css                 # File utama tema WordPress
├── 📄 functions.php             # Fungsi-fungsi utama tema
├── 📄 index.php                 # Template utama
├── 📄 header.php                # Header template
├── 📄 footer.php                # Footer template
├── 📄 sidebar.php               # Sidebar template
├── 📄 single-komik.php          # Template halaman manga
├── 📄 single-chapter.php        # Template halaman chapter
├── 📄 search.php                # Template hasil pencarian
├── 📄 archive.php               # Template arsip
├── 📄 404.php                   # Template halaman error
├── 📄 page-list.php             # Template halaman daftar manga
├── 📄 project-page.php          # Template halaman project
├── 📄 hot.php                   # Template halaman manga populer
├── 📄 completed-page.php        # Template halaman manga selesai
├── 📄 a-zpage.php               # Template halaman A-Z
├── 📄 page-blog.php             # Template halaman blog
├── 📄 tooltip.php               # Template tooltip
├── 📄 darkmode.min.css          # CSS untuk dark mode
├── 📄 style_v1.min.css          # CSS versi lama
├── 📁 css/                      # Folder CSS dan assets
│   ├── komik.redesign.css       # CSS utama tema
│   ├── boostrap.css             # Bootstrap CSS
│   ├── login.css                # CSS halaman login
│   ├── tooltip.css              # CSS tooltip
│   ├── fontawesome-stars.css    # CSS rating stars
│   ├── 📁 font/                 # Font files
│   └── 📁 images/               # Image assets
├── 📁 js/                       # Folder JavaScript
│   ├── komik.redesign.js        # JavaScript utama
│   ├── chapter.js               # JavaScript pembaca manga
│   ├── login.js                 # JavaScript login
│   ├── bookmark.min.js          # JavaScript bookmark
│   ├── jquery.barrating.min.js  # JavaScript rating
│   ├── jquery.qtip.js           # JavaScript tooltip
│   ├── owl.carousel.js          # JavaScript carousel
│   └── ...                      # File JS lainnya
├── 📁 inc/                      # Folder includes
│   ├── core.php                 # Core functions
│   ├── meta.php                 # Meta box configuration
│   ├── auth.php                 # Authentication functions
│   ├── panel.php                # Admin panel
│   ├── taxonomy.php             # Taxonomy functions
│   ├── widget.php               # Widget functions
│   ├── ads.php                  # Advertisement functions
│   └── 📁 lib/                  # Library files
│       └── 📁 plugins/          # Plugin libraries
├── 📁 template-parts/           # Template parts
│   ├── 📁 header/               # Header components
│   ├── 📁 navigation/           # Navigation components
│   └── 📁 post/                 # Post components
├── 📁 pages/                    # Custom page templates
│   ├── bookmark.php             # Halaman bookmark
│   ├── history.php              # Halaman riwayat
│   ├── loginpages.php           # Halaman login
│   └── usersetting.php          # Halaman pengaturan user
├── 📁 update/                   # Update scripts
├── 📁 build/                    # Build files
├── 📁 images/                   # Theme images
└── 📄 README.md                 # Dokumentasi
```

---

## ⚙️ Konfigurasi Dasar

### Pengaturan Media & Storage
- **Penyimpanan Gambar**: 
  - Gunakan plugin seperti **WP Manga FTP/SFTP Storage** untuk upload ke server eksternal
  - Dukungan Amazon S3, Google Cloud Storage, dan FTP/SFTP
  - Aktifkan enkripsi nama folder untuk keamanan
  - Optimasi gambar otomatis dengan lazy loading

### Struktur URL & Permalink
- **Permalink Structure**: 
  - Navigasi ke **Settings > Permalinks**
  - Pilih **Post name** atau custom structure
  - Format yang direkomendasikan: `/manga/%manga%/chapter/%chapter%/`
  - Pastikan `.htaccess` file writable

### Pengaturan Tema
- **Theme Customizer**:
  - Skema warna (light/dark mode)
  - Tata letak sidebar dan footer
  - Ukuran thumbnail dan grid layout
  - Logo dan favicon
  - Social media links
  - Advertisement settings

### Custom Post Types
- **Komik**: Post type untuk manga series
- **Chapter**: Post type untuk chapter manga
- **Genre**: Taxonomy untuk kategori manga
- **Status**: Taxonomy untuk status manga (ongoing/completed)  

---

## 🎯 Fitur Utama

### Manajemen Manga
- **Tambah Manga Baru**:
  - Buat posting baru dengan post type **Komik**
  - Tambahkan metadata: genre, penulis, status, rating
  - Upload cover image dan set featured image
  - Konfigurasi hot manga dan project status

- **Chapter Management**:
  - Upload chapter melalui front-end atau admin
  - Import dari sumber eksternal dengan TamperMonkey script
  - Bulk upload dengan ZIP file
  - Auto-generate chapter numbering

### Pembaca Manga
- **Reading Experience**:
  - Single-page dan all-pages layout
  - Lazy loading untuk optimasi performa
  - Zoom dan pan functionality
  - Fullscreen reading mode
  - Keyboard navigation (arrow keys)

- **Navigation**:
  - Next/Previous chapter buttons
  - Chapter list dropdown
  - Bookmark current page
  - Reading progress tracking

### User Features
- **User Account**:
  - Registration dan login system
  - User profile management
  - Reading history tracking
  - Bookmark management
  - Rating dan review system

### Integrasi & Add-ons
- **WooCommerce**: E-commerce untuk merchandise
- **WP Discuz**: Advanced commenting system
- **AMP**: Mobile-optimized pages
- **SEO**: Built-in SEO optimization
- **Analytics**: Google Analytics integration  

---

## 🛠️ Development & Customization

### Child Theme Development
**PENTING**: Selalu gunakan child theme untuk kustomisasi

1. **Buat Child Theme**:
   ```php
   // style.css
   /*
   Theme Name: KomikCAST Child
   Template: komikcast
   Version: 1.0.0
   */
   
   @import url("../komikcast/style.css");
   ```

2. **Override Templates**:
   - Copy template files dari parent theme
   - Modifikasi sesuai kebutuhan
   - File akan otomatis override parent theme

### CSS Customization
- **Main Stylesheet**: `css/komik.redesign.css`
- **Dark Mode**: `darkmode.min.css`
- **Custom CSS**: Tambahkan di child theme atau Customizer

### JavaScript Development
- **Main Script**: `js/komik.redesign.js`
- **Chapter Reader**: `js/chapter.js`
- **Bookmark System**: `js/bookmark.min.js`

### Custom Functions
Tambahkan custom functions di `functions.php` child theme:

```php
// Child theme functions.php
function my_custom_function() {
    // Custom code here
}
add_action('wp_enqueue_scripts', 'my_custom_function');
```

### Hooks & Filters
- **Action Hooks**: `komik_before_content`, `komik_after_content`
- **Filter Hooks**: `komik_meta_fields`, `komik_reading_options`
- **Custom Hooks**: Tersedia untuk extensibility

### Shortcodes
- `[manga_list]` - Display manga list
- `[manga_slider]` - Manga carousel
- `[search_form]` - Advanced search form
- `[user_bookmarks]` - User bookmark list  

---

## 🔧 Troubleshooting & Maintenance

### Common Issues & Solutions

#### 404 Errors
- **Permalink Issues**: 
  - Navigasi ke **Settings > Permalinks**
  - Klik **Save Changes** untuk regenerate `.htaccess`
  - Pastikan file `.htaccess` writable (permission 644)

#### Upload Problems
- **File Upload Failed**:
  - Check folder permissions: `/wp-content/uploads/` (755)
  - Increase PHP upload limits: `upload_max_filesize`, `post_max_size`
  - Disable **Aggregate JS-files** in Autoptimize if conflicts occur

#### Performance Issues
- **Slow Loading**:
  - Enable caching (WP Rocket, W3 Total Cache)
  - Optimize images (Smush, ShortPixel)
  - Use CDN (Cloudflare, MaxCDN)
  - Enable lazy loading

#### Theme Conflicts
- **Plugin Conflicts**:
  - Deactivate plugins one by one to identify conflicts
  - Check error logs in hosting control panel
  - Use WordPress debug mode: `WP_DEBUG = true`

### Maintenance Tasks

#### Regular Updates
- **Theme Updates**: 
  - Backup database dan files sebelum update
  - Test di staging environment
  - Clear cache setelah update
  - Update child theme jika diperlukan

#### Security
- **User Management**:
  - Use **User Role Editor** untuk membatasi akses
  - Enable **reCaptcha** untuk login/registration
  - Regular security scans dengan Wordfence
  - Keep WordPress, themes, dan plugins updated

#### Database Maintenance
- **Optimization**:
  - Regular database cleanup
  - Remove unused post revisions
  - Optimize database tables
  - Backup database secara berkala

---

## 🤝 Contributing

### How to Contribute
1. **Fork** repository ini
2. **Create** feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Open** Pull Request

### Development Guidelines
- Follow WordPress Coding Standards
- Test semua perubahan di staging environment
- Update dokumentasi untuk fitur baru
- Write clear commit messages

### Bug Reports
- Use GitHub Issues untuk melaporkan bug
- Include WordPress version, PHP version, dan theme version
- Provide steps to reproduce the issue
- Include error messages dan screenshots

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

**Copyright (c) 2025 ZenZee Takamia**

---

## 📞 Support

- **GitHub Issues**: [Create an issue](https://github.com/KanekiCraynet/manga-website/issues)
- **Documentation**: [Wiki](https://github.com/KanekiCraynet/manga-website/wiki)
- **Community**: [Discussions](https://github.com/KanekiCraynet/manga-website/discussions)

---

## 🙏 Acknowledgments

- WordPress Community
- Meta Box Plugin
- Bootstrap Framework
- jQuery Library
- Font Awesome Icons
- All contributors dan users

---

**Made for the manga community**
