Struktur Utama CMS
================
Web ini menggunakan Yii Framework 2, dengan template Basic.
Seluruh coding untuk front-end akan ditaruh di folder depan.
Sedangkan untuk backend akan ditaruh di module/backend.

Membuat Table Baru
==================
Kalau mau membuat table baru, pastikan untuk selalu menyertakan 5 field berikut ini: 
publish: int(11)
created_by: int(11)
created_at: datetime
updated_by: int(11)
update_at: datetime


Membuat CRUD (create/read/update/delete) Baru pada Backend CMS
=======================
Misalnya kita punya satu table, bernama Slideshow.
Kita ingin admin bebas menambah,edit atau hapus Slideshow
Kamu tidak perlu banyak coding. Hal yang harus kamu lakukan: 
1. Pergi ke Gii, generate model Slideshow dengan memilih Computesta Model Generator
2. Tambahkan formFields() pada model yang baru dibuat. Tulislah seluruh field-field yang ingin kamu tampilkan di form create/update
3. Pergi ke module/backend/controllers. Copylah salah satu coding di situ, dan ganti saja nama controller
4. Pada bagian indexFields() tulislah seluruh field-field yang ingin kamu tampilkan di Index (list management)


Upload File
=================
Apabila item yang kamu buat ini harus bisa upload file, maka pada formFields(), 
buatlah parameter seperti ini
[
	'name'=> 'namafield',
	'type'=>'file', //agar admin bisa upload
	'uploadFolder'=>'@webroot/images/slideshow', //agar nanti diupload ke folder web/images/slideshow
	'isImage'=> true //agar nanti dianggap sebagai gambar di form
]


Ganti warna template
==================
Template ini menggunakan AdminLTE 2. Untuk mengganti tema warna adminLTE, sementara kita belum 
ada cara permanen. Jadi setiap kali composer update adminlte2, kamu harus ulangi langkah ini. 
1. Pergi ke vendor/almasaeed2010/adminlte/build/less
2. Gantilah nilai yang ingin diubah. Contohnya saya ingin ganti warna skin red, agar lebih muda sedikit. cari file bernama variables.less
3. Setelah selesai ganti saatnya compile ke css. Caranya, jalankan sintaks ini `lessc --clean-css _all-skins.less ../../../dist/cs
s/skins/_all-skins.min.css`
(Catatan, sintaks ini asumsi di komputer mu sudah jalankan dua sintaks ini sebelum-sebelumnya)
npm install -g less
npm install -g less-plugin-clean-css

Sistem penjadwalan pada Dokter
===================
Saat ini sistem penjadwalan dokter secara otomatis mengatur shift pagi dan shift malam berdasarkan jam 12. 
Jadi kalau mulainya di atas jam 12 dianggap shift malam. Kalau sebelum jam 12 dianggap shift pagi.
Tapi kalau dalam satu hari ada dua shift dan dua-duanya di shift pagi (atau shift malam, maka harus munculkan di jadwal)
Kalau dalam satu hari ada 3 shift, maka sementara kita skip dulu, tidak perlu kita tangani.

Penggunaan plugin css-compress
==================
Setiap kali update CSS, hapus semua file css di /public_html/assets/css-compress/