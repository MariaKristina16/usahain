# Panduan Penggunaan Profile & Settings - Usahain

## 📍 Cara Mengakses Profile

### Dari Dashboard
1. **Klik avatar/avatar Anda** di pojok kanan atas header
2. **Pilih "👤 Profile"** dari menu dropdown
3. Atau klik nama Anda untuk membuka profil

### URL Langsung
```
http://localhost/usahain/user/profile/{id_user}
```

### Menu Dropdown
Klik tiga titik (⋯) di sebelah nama pengguna untuk membuka menu cepat:
- 👤 Profile
- ⚙️ Pengaturan
- 🚪 Logout

## 📋 Tab Profile

### 1️⃣ Tab "Ringkasan" (Overview)
Menampilkan informasi akun Anda:
- **ID Pengguna**: Nomor unik Anda di sistem
- **Nama Lengkap**: Nama yang Anda daftarkan
- **Email**: Email yang digunakan untuk login
- **Metode Autentikasi**: Email & Password atau Google
- **Terdaftar Sejak**: Tanggal Anda mendaftar
- **Status Akun**: Menunjukkan akun aktif atau tidak

**Tombol Cepat:**
- 💾 **Edit Profile**: Ubah informasi pribadi dan bisnis
- ⚙️ **Pengaturan Akun**: Buka halaman pengaturan

### 2️⃣ Tab "Data Bisnis" (Business)
Informasi usaha yang Anda kelola:
- **Nama Usaha**: Nama resmi bisnis Anda
- **Jenis Usaha**: Kategori industri (Kuliner, Fashion, dll)

**Tips yang Ditampilkan:**
- Konsistenkan branding di semua platform
- Catat semua transaksi untuk keuangan akurat
- Gunakan tools Usahain untuk perencanaan
- Evaluasi performa secara berkala

### 3️⃣ Tab "Aktivitas" (Activity)
Statistik dan riwayat aktivitas Anda:
- **Konsultasi AI**: Jumlah kali konsultasi dengan AI Advisor
- **Transaksi Tercatat**: Jumlah pencatatan keuangan
- **Analisis Produk**: Jumlah analisis yang dilakukan

### 4️⃣ Tab "Pengaturan" (Settings)
Akses cepat ke fitur keamanan:
- Edit Profil
- Ubah Password (jika login lokal)
- Logout
- Status keamanan akun

---

## ⚙️ Cara Mengakses Settings

### Dari Profile
1. Buka halaman Profile
2. Klik tombol "⚙️ Pengaturan Akun"
3. Atau klik tab "Pengaturan" di profile

### URL Langsung
```
http://localhost/usahain/user/settings
```

### Dari Menu Dropdown
1. Klik avatar/menu di header
2. Pilih "⚙️ Pengaturan"

---

## 📝 Mengubah Informasi Profile

### Langkah-langkah:

1. **Buka Pengaturan**
   - Dari Profile → Klik "✏️ Edit Profile"
   - Atau langsung ke Settings

2. **Lengkapi Form Informasi Profil**
   ```
   Nama Lengkap*        : [Masukkan nama Anda]
   Email               : [Read-only, tidak bisa diubah]
   Nama Usaha         : [Opsional] Contoh: "Toko Fashion Online"
   Jenis Usaha        : [Pilih] Kuliner / Fashion / Kerajinan / Jasa / Retail / Digital / Lainnya
   ```

3. **Simpan Perubahan**
   - Klik tombol "💾 Simpan Perubahan"
   - Atau "❌ Batal" untuk membatalkan

4. **Konfirmasi Sukses**
   - Sistem akan menampilkan pesan "Profil berhasil diperbarui!"
   - Data akan tersimpan ke database
   - Session Anda akan diupdate otomatis

### Validasi Input:
- **Nama**: Wajib diisi, maksimal 200 karakter
- **Nama Usaha**: Opsional, maksimal 255 karakter
- **Jenis Usaha**: Pilih dari dropdown (tidak wajib)

---

## 🔐 Mengubah Password

### ⚠️ Hanya tersedia untuk login Email & Password
(Jika Anda menggunakan Google OAuth, tidak ada opsi ubah password)

### Langkah-langkah:

1. **Buka Pengaturan** → Bagian "Keamanan & Password"

2. **Isi Form Password**
   ```
   Password Lama*          : [Masukkan password saat ini]
   Password Baru*         : [Password minimal 6 karakter]
   Konfirmasi Password*   : [Ketik ulang password baru]
   ```

3. **Klik "🔑 Ubah Password"**

4. **Verifikasi**
   - Sistem akan mengecek password lama
   - Jika benar, password akan diubah
   - Jika salah, akan ada pesan error

### ⚡ Tips Keamanan Password:
- ✓ Gunakan minimal 6 karakter
- ✓ Gunakan kombinasi huruf dan angka
- ✓ Hindari password yang terlalu sederhana
- ✓ Jangan bagikan password ke orang lain
- ✓ Ubah password secara berkala

---

## 📊 Informasi Akun

### Data yang Ditampilkan:
- **ID Pengguna**: Nomor unik sistem
- **Metode Autentikasi**: Email atau Google
- **Terdaftar Sejak**: Tanggal registrasi
- **Status Akun**: Status keaktifan

### Preferensi:
- **Notifikasi Email**: Otomatis untuk aktivitas penting
- **Keamanan**: Enkripsi tingkat tinggi

---

## 🗑️ Menghapus Akun

### ⚠️ PERINGATAN! TINDAKAN INI TIDAK DAPAT DIBATALKAN!

Menghapus akun akan:
- ❌ Menghapus semua data pribadi
- ❌ Menghapus semua data bisnis
- ❌ Menghapus semua riwayat transaksi
- ❌ Menghapus semua konsultasi

### Langkah-langkah (jika yakin):

1. **Scroll ke bawah** ke bagian "Zona Berbahaya"

2. **Klik "🗑️ Hapus Akun Secara Permanen"**

3. **Konfirmasi Penghapusan**
   - Sistem akan menampilkan peringatan
   - Baca dengan teliti sebelum mengklik OK

4. **Akun akan dihapus**
   - Anda akan logout otomatis
   - Akun tidak bisa dipulihkan

**Jika Anda ingin kembali, harus registrasi ulang.**

---

## 💡 Tips Penggunaan

### Maksimalkan Penggunaan Profile:

1. **Lengkapi Informasi Bisnis**
   - Isi nama usaha dan jenis usaha
   - Ini membantu sistem memberikan rekomendasi yang lebih baik

2. **Jaga Password Tetap Aman**
   - Ubah password secara berkala
   - Gunakan password yang kuat dan unik

3. **Monitor Aktivitas**
   - Lihat statistik aktivitas di tab "Aktivitas"
   - Pantau penggunaan fitur Usahain

4. **Gunakan Logout dengan Benar**
   - Selalu logout di perangkat publik
   - Jangan biarkan akun terbuka di perangkat orang lain

5. **Email Verification**
   - Email Anda sudah terverifikasi dan aman
   - Email tidak bisa diubah untuk menjaga keamanan

---

## ❓ FAQ (Pertanyaan Umum)

### Q: Bisa ganti email?
**A:** Tidak, email tidak bisa diubah untuk keamanan akun. Hubungi admin jika ada masalah.

### Q: Lupa password, apa yang harus dilakukan?
**A:** Gunakan fitur "Lupa Password" di halaman login, atau hubungi support.

### Q: Bagaimana jika tidak punya password (Google OAuth)?
**A:** Anda hanya perlu Google account untuk login, tidak perlu password terpisah.

### Q: Data saya tersimpan di mana?
**A:** Data disimpan di database server Usahain dan dilindungi dengan enkripsi.

### Q: Berapa lama data tersimpan?
**A:** Data tersimpan selama akun Anda aktif. Jika hapus akun, semua data akan terhapus.

### Q: Bisa recover data setelah hapus akun?
**A:** Tidak, data tidak bisa dipulihkan setelah penghapusan. Tindakan ini permanen.

### Q: Siapa yang bisa lihat data saya?
**A:** Hanya Anda sendiri dan admin Usahain. Data tidak dibagikan ke pihak ketiga.

---

## 📞 Butuh Bantuan?

Jika mengalami masalah:

1. **Cek halaman Profile/Settings lagi**
   - Mungkin ada pesan error yang terlewat

2. **Reload halaman**
   - Refresh browser (F5)
   - Cek koneksi internet

3. **Clear Browser Cache**
   - Hapus cache dan cookies browser
   - Login ulang

4. **Hubungi Support**
   - Email: support@usahain.com
   - Sertakan ID pengguna dan deskripsi masalah

---

## 📋 Checklist Keamanan Akun

- [ ] Password sudah diubah dari password default?
- [ ] Email sudah terverifikasi?
- [ ] Informasi profil sudah lengkap?
- [ ] Nama usaha sudah ditambahkan?
- [ ] Jenis usaha sudah dipilih?
- [ ] Akun hanya diakses dari perangkat pribadi?
- [ ] Password tidak dibagikan ke orang lain?

---

**Terakhir diupdate:** 9 Januari 2026
**Versi:** 1.0

Selamat menggunakan Usahain! 🚀
