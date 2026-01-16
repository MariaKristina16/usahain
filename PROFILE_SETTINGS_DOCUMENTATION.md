# Dokumentasi Profile & Settings

## Deskripsi Umum

Fitur Profile dan Settings adalah bagian integral dari Usahain yang memungkinkan pengguna untuk mengelola data pribadi, informasi bisnis, dan preferensi akun mereka dengan mudah dan aman.

## Halaman Profile

### URL
- `http://localhost/usahain/user/profile/{id_user}`
- Default: `http://localhost/usahain/user/profile`

### Fitur Utama

#### 1. **Ringkasan Akun (Overview Tab)**
Menampilkan informasi lengkap pengguna:
- ✓ ID Pengguna (unik)
- ✓ Nama Lengkap
- ✓ Email Terdaftar
- ✓ Metode Autentikasi (Email/Google)
- ✓ Tanggal Pendaftaran
- ✓ Status Akun (Aktif/Nonaktif)

#### 2. **Data Bisnis (Business Tab)**
Menampilkan informasi usaha yang terdaftar:
- ✓ Nama Usaha
- ✓ Jenis Usaha
- ✓ Tips pengembangan bisnis

#### 3. **Aktivitas (Activity Tab)**
Statistik aktivitas pengguna:
- ✓ Jumlah Konsultasi AI
- ✓ Jumlah Transaksi Tercatat
- ✓ Jumlah Analisis Produk
- ✓ Riwayat Aktivitas Terbaru

#### 4. **Pengaturan Akun (Settings Tab)**
Akses cepat ke pengaturan:
- ✓ Edit Profile
- ✓ Ubah Password (untuk login lokal)
- ✓ Logout
- ✓ Status Keamanan Akun

### Layout Responsif
- Desktop: Layout penuh dengan sidebar
- Tablet: Layout tersesuaikan
- Mobile: Layout vertikal dengan navigasi yang disederhanakan

## Halaman Settings

### URL
- `http://localhost/usahain/user/settings`

### Fitur Utama

#### 1. **Informasi Profil**
Edit data pribadi:
- ✓ Nama Lengkap (wajib)
- ✓ Email (read-only untuk keamanan)
- ✓ Nama Usaha (opsional)
- ✓ Jenis Usaha (dropdown selection)

**Pilihan Jenis Usaha:**
- Kuliner
- Fashion
- Kerajinan
- Jasa
- Retail
- Digital
- Lainnya

#### 2. **Keamanan & Password**
Hanya tersedia untuk login lokal (bukan Google OAuth):
- ✓ Password Lama (verifikasi)
- ✓ Password Baru (minimal 6 karakter)
- ✓ Konfirmasi Password

**Validasi Password:**
- Minimal 6 karakter
- Harus cocok dengan konfirmasi password
- Password lama harus benar

#### 3. **Preferensi**
Informasi notifikasi dan keamanan:
- ✓ Status Notifikasi Email
- ✓ Informasi Keamanan Akun
- ✓ Protokol Enkripsi

#### 4. **Informasi Akun**
Detail teknis akun:
- ✓ ID Pengguna
- ✓ Metode Autentikasi
- ✓ Tanggal Terdaftar
- ✓ Status Akun

#### 5. **Zona Berbahaya**
Tindakan berbahaya:
- ✓ Hapus Akun Permanen
  - Menghapus semua data bisnis
  - Tidak dapat dibatalkan
  - Memerlukan konfirmasi

## Alur Data Penyimpanan

### Saat User Mendaftar/Login
```
Registration/OAuth
    ↓
Session diisi dengan data user
    ↓
Data tersimpan di tabel 'user'
```

### Saat Update Profile
```
Form Submit
    ↓
Validasi Input
    ↓
Update Database
    ↓
Update Session
    ↓
Redirect dengan Success Message
```

### Data yang Tersimpan
```sql
user table:
- id_user (primary key)
- google_id (nullable)
- oauth_provider ('local' atau 'google')
- avatar_url (nullable)
- nama
- role ('user' atau 'admin')
- email
- password (hashed)
- nama_usaha
- jenis_usaha
- created_at
- updated_at
```

## Controller Methods

### User Controller (`application/controllers/User.php`)

#### `profile($id = null)`
- **Fungsi**: Menampilkan halaman profile
- **Akses**: Hanya user yang login
- **Parameter**: User ID (optional)
- **Return**: View profile.php dengan data user

#### `settings()`
- **Fungsi**: Menampilkan halaman settings
- **Akses**: Hanya user yang login
- **Return**: View settings.php dengan data user dan messages

#### `update_profile($id = null)`
- **Fungsi**: Update data profil user
- **Akses**: POST, hanya user yang login
- **Validasi**: 
  - Nama: wajib, max 200 char
  - Nama Usaha: max 255 char
  - Jenis Usaha: max 100 char
- **Return**: Redirect ke settings dengan pesan sukses/error

#### `change_password()`
- **Fungsi**: Ubah password user
- **Akses**: POST, hanya untuk login lokal
- **Validasi**:
  - Password lama: wajib, min 6 char
  - Password baru: wajib, min 6 char
  - Konfirmasi: harus match dengan password baru
- **Security**: Password lama diverifikasi dengan password_verify()

#### `delete_account($id = null)`
- **Fungsi**: Menghapus akun user
- **Akses**: POST, hanya user yang login
- **Dampak**: Menghapus data user dari database
- **Peringatan**: Data tidak dapat dipulihkan

## Fitur Keamanan

### 1. **Session Check**
Semua halaman profile/settings memerlukan session login:
```php
if (!$this->session->userdata('id_user')) {
    redirect('auth/login');
}
```

### 2. **Password Hashing**
Password selalu di-hash menggunakan bcrypt:
```php
password_hash($password, PASSWORD_BCRYPT)
password_verify($password, $hash)
```

### 3. **Input Validation**
Semua input divalidasi dengan Form Validation library:
- Sanitasi data
- Type checking
- Length validation
- Email validation

### 4. **Email Read-Only**
Email tidak dapat diubah untuk menjaga integritas akun

### 5. **CSRF Protection**
(Jika CSRF enabled di CI config)

## Integrasi Session

### Data yang Disimpan di Session
```php
session->userdata([
    'id_user' => int,
    'nama' => string,
    'email' => string,
    'role' => string,
    'usaha' => string,
    'type' => string,
    'nama_usaha' => string (optional),
    'oauth_provider' => string
])
```

### Update Session setelah Change Profile
```php
$this->session->set_userdata('nama', $nama);
$this->session->set_userdata('nama_usaha', $nama_usaha);
```

## Pesan Flash

### Success Messages
```
"Profil berhasil diperbarui!"
"Password berhasil diubah!"
"Akun berhasil dihapus."
```

### Error Messages
Ditampilkan sebagai array dari form validation errors

## Tampilan Responsif

### Desktop (> 768px)
- Grid 2 kolom untuk form inputs
- Sidebar menu visible
- Full width sections

### Tablet (768px - 1024px)
- Grid auto-fit
- Adjusted padding
- Optimized for touch

### Mobile (< 768px)
- Single column layout
- Full width buttons
- Hamburger menu
- Touch-friendly spacing

## API Response Format (AJAX)

Endpoint `save_bisnis_info` mengembalikan JSON:

```json
{
    "status": "success|error",
    "code": "OK|VALIDATION_ERROR|UNAUTHORIZED",
    "message": "string",
    "data": {
        "id_user": int,
        "nama_usaha": string,
        "jenis_usaha": string,
        "updated_at": string
    }
}
```

## Catatan Penting

1. **Data Unik**: Setiap user memiliki ID unik dan email unik
2. **Otomatis**: Field `created_at` dan `updated_at` diupdate otomatis
3. **Keamanan**: Password tidak pernah ditampilkan atau dikirim tanpa hash
4. **Backup**: Pastikan backup database secara berkala
5. **Privacy**: Email user adalah informasi sensitif

## Troubleshooting

### Issue: "Page not found" saat akses profile
- Cek apakah user ID valid
- Pastikan user sudah login
- Periksa routes di application/config/routes.php

### Issue: Password tidak bisa diubah
- Pastikan menggunakan login lokal (bukan Google)
- Verifikasi password lama benar
- Cek password baru minimal 6 karakter

### Issue: Data tidak tersimpan
- Cek koneksi database
- Verifikasi form validation rules
- Lihat error logs di application/logs/

## Pengembangan Lebih Lanjut

Fitur yang bisa ditambahkan:
1. Upload Avatar/Foto Profil
2. Two-Factor Authentication (2FA)
3. Login History
4. Connected Devices
5. Account Recovery
6. Privacy Settings
7. Export Data
8. Activity Timeline Detail
9. Preferences for Notifications
10. Theme Selection (Dark/Light Mode)
