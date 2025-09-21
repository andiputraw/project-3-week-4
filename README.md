# Readme

## Cara menjalankan aplikasi

lakukan migrasi
```sh
php spark migrate
```

lakukan seed

```sh
php spark db:seed
```

Jalankan aplikasi

```sh
php spark serve
```

Login dengan akun admin

username: admin
password: admin



## ✨ Fitur

* **Manajemen Mahasiswa**: Admin dapat menambah, melihat, mengubah, dan menghapus data mahasiswa.
* **Manajemen Mata Kuliah**: Admin dapat menambah, melihat, mengubah, dan menghapus data mata kuliah.
* **Pengambilan Mata Kuliah**: Mahasiswa dapat mendaftar dan membatalkan pendaftaran pada mata kuliah yang tersedia.
* **Pencarian**: Memudahkan pencarian data mahasiswa dan mata kuliah.

---

## 💻 Teknologi yang Digunakan

* **PHP 8.1**
* **CodeIgniter 4**
* **MySQL**
* **PicoCSS**

---

## 📸 Screenshot

### Fitur General
- Login
![Tampilan Login](docs/login.png)

- Logout
![Tampilan Logout](docs/logout.png)

### Admin

![Tampilan Admin](docs/admin_dashboard.png)
*Tampilan Dashboard Admin*

Fitur yang dapat diakses oleh Admin:
- **Manajemen Mahasiswa**:
    - Melihat semua data mahasiswa.
      ![Tampilan data mahasiswa](docs/admin_mahasiswa.png)
    - Menambahkan data mahasiswa baru.
      ![Tampilan tambah mahasiswa](docs/admin_mahasiswa_tambah.png)
    - Mengubah data mahasiswa.
      ![Tampilan ubah mahasiswa](docs/admin_mahasisw_edit.png)
    - Menghapus data mahasiswa.
      ![Tampilan hapus mahasiswa](docs/admin_course_delete.png)
    - Melihat Detail Data Mahasiswa
      ![Tampilan detail mahasiswa](docs/admin_mahasiswa_delete.png)
      
- **Manajemen Mata Kuliah**:
    - Melihat semua data mata kuliah.
      ![Tampilan data mahasiswa](docs/admin_course.png)
    - Menambahkan data mata kuliah baru.
      ![Tampilan data tambah mahasiswa](docs/admin_course_tambah.png)
    - Mengubah data mata kuliah.
      ![Tampilan mengubah data mahasiswa](docs/admin_course_edit.png)
    - Menghapus data mata kuliah.
      ![Tampilan hapus data mahasiswa](docs/admin_course_delete.png)

### Student

![Tampilan Student](docs/student_dashboard.png)
*Tampilan Dashboard Mahasiswa*

Fitur yang dapat diakses oleh Mahasiswa:
- **Manajemen Mata Kuliah**:
    - Melihat daftar mata kuliah yang tersedia.
      ![Tapilan data matakuliah mahasiswa](docs/student_course_list.png)
    - Mengambil mata kuliah (enroll).
      ![Tampilan enroll matakuliah](docs/student_course_tambah.png)