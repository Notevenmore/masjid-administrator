![Screenshot from 2024-10-27 15-55-40](https://github.com/user-attachments/assets/d5e85dd7-a1a8-4a23-8d96-8fac07975eed)# Website Masjid Administrator

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
  <table align="center" style="border: none;">
       <tr>
        <td align="center">
          <img src="https://github.com/user-attachments/assets/4b57ba0d-b567-4f95-b2a3-02ccf547a92d" />
          <br>
          Pemasukan Mesjid
        </td>
       </tr>
       <tr>
        <td align="center">
            <img src="https://github.com/user-attachments/assets/fb2d0f81-86fa-40ca-929b-ee2b348bbbbb" />
          <br>
          Pengeluaran Mesjid
        </td>
       </tr>
      <tr>
        <td align="center">
            <img src="https://github.com/user-attachments/assets/ef213bbd-0768-48b4-9442-9724ddec4f88" />
          <br>
          Laporan Keuangan mesjid
        </td>
       </tr>
    </table>
- **Penambahan Pemasukan dan Kategori**: Bendahara dapat menambahkan sumber pemasukan baru beserta kategori.
  <table align="center" style="border: none;">
       <tr>
        <td align="center">
          <img src="https://github.com/user-attachments/assets/c830e503-3187-4997-a3ca-cd1b84e24fe2" />
          <br>
          Form Penambahan Kategori Pemasukan mesjid
        </td>
       </tr>
       <tr>
        <td align="center">
            <img src="https://github.com/user-attachments/assets/233aca8a-7e9f-427c-9826-9c357d6c5c4e" />
          <br>
          Form Penambahan Pemasukan Mesjid
        </td>
       </tr>
    </table>
- **Penambahan Pengeluaran dan Kategori**: Bendahara juga dapat menambahkan pengeluaran dan kategorinya.
  <table align="center" style="border: none;">
       <tr>
        <td align="center">
          <img src="https://github.com/user-attachments/assets/ddc89f2d-4abd-4416-bc4f-456f0b0729d3" />
          <br>
          Form Penambahan Kategori Pengeluaran mesjid
        </td>
       </tr>
       <tr>
        <td align="center">
            <img src="https://github.com/user-attachments/assets/31b8062b-4cbe-45d4-b62e-8ef8ff4d9e72" />
          <br>
          Form Penambahan Pengeluaran Mesjid
        </td>
       </tr>
    </table>
- **Penambahan Aset dan Status**: Admin Aset dapat menambah dan mengelola aset masjid.
  <table align="center" style="border: none;">
       <tr>
        <td align="center">
          <img src="https://github.com/user-attachments/assets/1876d20c-f616-4308-b6af-36742570da6b" />
          <br>
          Tabel Aset aset mesjid yang telah terdata beserta status
        </td>
       </tr>
    </table>
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
