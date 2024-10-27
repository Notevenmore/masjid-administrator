# Website Masjid Administrator

Website Masjid Administrator adalah platform yang dirancang untuk mempermudah manajemen masjid, termasuk manajemen keuangan, kegiatan, dan pengurus. Dengan fitur-fitur canggih dan mudah digunakan, aplikasi ini bertujuan untuk meningkatkan transparansi dan efisiensi dalam pengelolaan masjid.

## Fitur Utama

### 1. Autentikasi
- **Registrasi Admin**: Admin dapat mendaftar untuk mengelola masjid, termasuk pengurus dan bendahara.
  <img src="https://github.com/user-attachments/assets/391b8d37-5585-445d-9225-dc9744d0e192" align="center" />

- **Registrasi Jamaah**: Jamaah dapat mendaftar untuk berpartisipasi dan mengikuti kegiatan masjid.
- **Login**: Semua pengguna (admin, jamaah) dapat masuk ke sistem dengan aman.
  <img src="https://github.com/user-attachments/assets/1ebc53f6-7b70-413e-906a-68e94478a185" align="center" />


### 2. Otorisasi
- **Jamaah**: Mengakses laporan keuangan dan melihat kegiatan masjid.
- **Admin**: Terdapat beberapa jenis admin:
  - Ketua
  - Bendahara
  - Admin Aset
  - Admin Umum
- **Master Admin**: Mengelola semua akun pengguna dan hak akses.

### 3. Manajemen Keuangan
- **Pembayaran Uang Kas**: Admin dapat melakukan pembayaran uang kas melalui QRIS (Midtrans) atau secara langsung kepada bendahara.
     <table align="center" style="border: none;">
       <tr>
        <td align="center">
          <img src="https://github.com/user-attachments/assets/54654b67-9988-4429-82b7-04a3dc46ec7a" />
          <br>
          Input nominal pembayaran uang kas
        </td>
       </tr>
       <tr>
        <td align="center">
            <img src="https://github.com/user-attachments/assets/b83192e5-adf3-43eb-9530-a91924eaefd8" />
          <br>
          Scan Barcode QRIS Untuk pembayaran uang kas
        </td>
       </tr>
        <td align="center">
            <img src="https://github.com/user-attachments/assets/0a9b19dc-78b1-40b4-9fe3-c04d0613c73c" />
          <br>
          Notifikasi pembayaran berhasil
        </td>
       </tr>
    </table>
- **Pendataan oleh Bendahara**: Bendahara bertanggung jawab untuk mencatat semua transaksi keuangan.

### 4. Dashboard Masjid
- **Manajemen Keuangan**: Memantau aliran dana masuk dan keluar secara real-time.
- **Penambahan Pemasukan dan Kategori**: Bendahara dapat menambahkan sumber pemasukan baru beserta kategori.
- **Penambahan Pengeluaran dan Kategori**: Bendahara juga dapat menambahkan pengeluaran dan kategorinya.
- **Penambahan Aset dan Status**: Admin Aset dapat menambah dan mengelola aset masjid.
- **Penambahan Kegiatan**: Pengurus admin dapat menambahkan kegiatan yang akan diadakan di masjid.
- **Kelola Pengurus**: Mengelola pengurus dengan kemampuan untuk menjadikan jamaah sebagai admin, mengubah admin menjadi jamaah, atau menghapus akun jamaah.

### 5. Monitoring untuk Jamaah
- Jamaah dapat memantau laporan keuangan masjid dan melihat kegiatan yang akan diadakan.

### 6. Pengelolaan Akun Pengguna
- Master Admin dapat mengelola akun pengguna untuk Masjid Administrator.
- Admin dapat mengelola akun pengguna atau jamaah dari Masjid yang terdaftar pada Masjid Administrator
  <img src="https://github.com/user-attachments/assets/53a2178d-bf0f-465d-823f-46c246d57ee6" />


## Teknologi yang Digunakan
- **Framework**: Laravel
- **Pembayaran**: Midtrans untuk integrasi QRIS
- **Frontend**: Blade Component

## Tujuan Proyek
Proyek ini bertujuan untuk menciptakan sistem yang efisien dan transparan dalam pengelolaan masjid, memfasilitasi interaksi antara pengurus dan jamaah, serta meningkatkan akuntabilitas dalam pengelolaan keuangan masjid.
