<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang Repository ini

Sekolahan API berisi manajemen informasi sekolah (Siswa, Guru, Mapel, Kelas, dan Jadwal) yang dibangun dengan Laravel 12.x . Mengimplementasikan arsitektur RESTful API Level 3 (Richardson Maturity Model) menggunakan format media Collection+JSON.

## Arsitektur Response
API ini mengikuti struktur Collection+JSON yang terdiri dari:

**href**: URL unik dari resource yang sedang diakses.

**items**: Array of objects yang berisi data utama (name, value, prompt) serta tautan aksi spesifik (_links).

**queries**: Daftar parameter pencarian atau filter yang didukung oleh endpoint tersebut.

**template**: Struktur data yang diperlukan untuk melakukan penambahan atau pembaruan data.

## Contoh Response
- Contoh response JSON dari GET http://sekolahan.test/api/siswa

```json
{
    "collection": {
        "status": true,
        "message": "Data semua siswa berhasil diambli!",
        "version": "1.0",
        "href": "http://sekolahan.test/api/siswa",
        "items": [
            {
                "href": "http://sekolahan.test/api/siswa/1",
                "data": [
                    {
                        "name": "id",
                        "value": 1,
                        "prompt": "ID"
                    },
                    {
                        "name": "nis",
                        "value": "5541064612",
                        "prompt": "Nomor Induk Siswa"
                    },
                    {
                        "name": "gender",
                        "value": "laki-laki",
                        "prompt": "Jenis Kelamin"
                    },
                    {
                        "name": "nama",
                        "value": "Rocky Volkman",
                        "prompt": "Nama Lengkap"
                    },
                    {
                        "name": "tempat_lahir",
                        "value": "Mosciskishire",
                        "prompt": "Tempat Lahir"
                    },
                    {
                        "name": "tgl_lahir",
                        "value": "2021-12-02",
                        "prompt": "Tanggal Lahir"
                    },
                    {
                        "name": "nama_ortu",
                        "value": "Miss Mara Tillman I",
                        "prompt": "Nama Orang Tua"
                    },
                    {
                        "name": "phone_number",
                        "value": "088448886686",
                        "prompt": "Nomor Telepon"
                    },
                    {
                        "name": "email",
                        "value": "mohammad.ernser@example.net",
                        "prompt": "Email"
                    },
                    {
                        "name": "alamat",
                        "value": "27729 Aimee Mountains\nLake Reid, SD 95951",
                        "prompt": "Alamat"
                    },
                    {
                        "name": "kelas_id",
                        "value": 1,
                        "prompt": "ID kelas"
                    }
                ],
                "_links": [
                    {
                        "rel": "self",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa/1",
                        "prompt": "Detail Siswa"
                    },
                    {
                        "rel": "index",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa",
                        "prompt": "Dafar Siswa"
                    },
                    {
                        "rel": "update",
                        "method": "PUT",
                        "href": "http://sekolahan.test/api/siswa/1",
                        "prompt": "Update Data Siswa"
                    },
                    {
                        "rel": "delete",
                        "method": "DELETE",
                        "href": "http://sekolahan.test/api/siswa/1",
                        "prompt": "Hapus Data Siswa"
                    }
                ]
            },
            {
                "href": "http://sekolahan.test/api/siswa/2",
                "data": [
                    {
                        "name": "id",
                        "value": 2,
                        "prompt": "ID"
                    },
                    {
                        "name": "nis",
                        "value": "8591004449",
                        "prompt": "Nomor Induk Siswa"
                    },
                    {
                        "name": "gender",
                        "value": "perempuan",
                        "prompt": "Jenis Kelamin"
                    },
                    {
                        "name": "nama",
                        "value": "Keagan Nitzsche",
                        "prompt": "Nama Lengkap"
                    },
                    {
                        "name": "tempat_lahir",
                        "value": "Dickiview",
                        "prompt": "Tempat Lahir"
                    },
                    {
                        "name": "tgl_lahir",
                        "value": "1988-09-04",
                        "prompt": "Tanggal Lahir"
                    },
                    {
                        "name": "nama_ortu",
                        "value": "Dr. Eli Gerhold",
                        "prompt": "Nama Orang Tua"
                    },
                    {
                        "name": "phone_number",
                        "value": "088346411896",
                        "prompt": "Nomor Telepon"
                    },
                    {
                        "name": "email",
                        "value": "hettinger.una@example.com",
                        "prompt": "Email"
                    },
                    {
                        "name": "alamat",
                        "value": "3261 Josue Squares\nLakinhaven, OK 14438-6970",
                        "prompt": "Alamat"
                    },
                    {
                        "name": "kelas_id",
                        "value": 2,
                        "prompt": "ID kelas"
                    }
                ],
                "_links": [
                    {
                        "rel": "self",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa/2",
                        "prompt": "Detail Siswa"
                    },
                    {
                        "rel": "index",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa",
                        "prompt": "Dafar Siswa"
                    },
                    {
                        "rel": "update",
                        "method": "PUT",
                        "href": "http://sekolahan.test/api/siswa/2",
                        "prompt": "Update Data Siswa"
                    },
                    {
                        "rel": "delete",
                        "method": "DELETE",
                        "href": "http://sekolahan.test/api/siswa/2",
                        "prompt": "Hapus Data Siswa"
                    }
                ]
            },
            {
                "href": "http://sekolahan.test/api/siswa/3",
                "data": [
                    {
                        "name": "id",
                        "value": 3,
                        "prompt": "ID"
                    },
                    {
                        "name": "nis",
                        "value": "0140246702",
                        "prompt": "Nomor Induk Siswa"
                    },
                    {
                        "name": "gender",
                        "value": "perempuan",
                        "prompt": "Jenis Kelamin"
                    },
                    {
                        "name": "nama",
                        "value": "Barney Huel",
                        "prompt": "Nama Lengkap"
                    },
                    {
                        "name": "tempat_lahir",
                        "value": "Coraliechester",
                        "prompt": "Tempat Lahir"
                    },
                    {
                        "name": "tgl_lahir",
                        "value": "1984-08-11",
                        "prompt": "Tanggal Lahir"
                    },
                    {
                        "name": "nama_ortu",
                        "value": "Prof. Clair Grimes",
                        "prompt": "Nama Orang Tua"
                    },
                    {
                        "name": "phone_number",
                        "value": "082958966473",
                        "prompt": "Nomor Telepon"
                    },
                    {
                        "name": "email",
                        "value": "lee.collins@example.org",
                        "prompt": "Email"
                    },
                    {
                        "name": "alamat",
                        "value": "8319 Lauretta Glens\nWatsicafurt, KS 96336-4437",
                        "prompt": "Alamat"
                    },
                    {
                        "name": "kelas_id",
                        "value": 3,
                        "prompt": "ID kelas"
                    }
                ],
                "_links": [
                    {
                        "rel": "self",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa/3",
                        "prompt": "Detail Siswa"
                    },
                    {
                        "rel": "index",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa",
                        "prompt": "Dafar Siswa"
                    },
                    {
                        "rel": "update",
                        "method": "PUT",
                        "href": "http://sekolahan.test/api/siswa/3",
                        "prompt": "Update Data Siswa"
                    },
                    {
                        "rel": "delete",
                        "method": "DELETE",
                        "href": "http://sekolahan.test/api/siswa/3",
                        "prompt": "Hapus Data Siswa"
                    }
                ]
            }
        ],
        "queries": [
            {
                "rel": "search",
                "href": "http://sekolahan.test/api/siswa",
                "prompt": "Pencarian umum",
                "data": [
                    {
                        "name": "q",
                        "value": "",
                        "prompt": "Pencarian umum"
                    }
                ]
            },
            {
                "rel": "filter",
                "href": "http://sekolahan.test/api/siswa",
                "prompt": "Filter data",
                "data": [
                    {
                        "name": "nis",
                        "value": "",
                        "prompt": "Filter berdasarkan NIS"
                    },
                    {
                        "name": "nama",
                        "value": "",
                        "prompt": "Filter berdasarkan nama siswa"
                    },
                    {
                        "name": "gender",
                        "value": "",
                        "prompt": "Filter berdasarkan jenis kelamin",
                        "options": [
                            {
                                "value": "laki-laki",
                                "prompt": "Laki-laki"
                            },
                            {
                                "value": "perempuan",
                                "prompt": "Perempuan"
                            }
                        ]
                    },
                    {
                        "name": "kelas_id",
                        "value": "",
                        "prompt": "Filter berdasarkan ID Kelas",
                        "options": [
                            {
                                "value": 1,
                                "prompt": "Sepuluh IPA A"
                            },
                            {
                                "value": 2,
                                "prompt": "Sebelas IPA A"
                            },
                            {
                                "value": 3,
                                "prompt": "DuaBelas IPA A"
                            }
                        ]
                    },
                    {
                        "name": "tempat_lahir",
                        "value": "",
                        "prompt": "Cari berdasarkan tempat lahir"
                    }
                ]
            }
        ],
        "template": {
            "data": [
                {
                    "name": "nis",
                    "value": "",
                    "prompt": "NIS"
                },
                {
                    "name": "nama",
                    "value": "",
                    "prompt": "Nama lengkap"
                },
                {
                    "name": "gender",
                    "value": "",
                    "prompt": "Jenis kelamin",
                    "options": [
                        {
                            "value": "laki-laki",
                            "prompt": "Laki-laki"
                        },
                        {
                            "value": "perempuan",
                            "prompt": "Perempuan"
                        }
                    ]
                },
                {
                    "name": "tempat_lahir",
                    "value": "",
                    "prompt": "Tempat Lahir"
                },
                {
                    "name": "tgl_lahir",
                    "value": "",
                    "prompt": "Tanggal Lahir"
                },
                {
                    "name": "email",
                    "value": "",
                    "prompt": "Email"
                },
                {
                    "name": "alamat",
                    "value": "",
                    "prompt": "Alamat"
                },
                {
                    "name": "phone_number",
                    "value": "",
                    "prompt": "Nomor Telepone"
                },
                {
                    "name": "nama_ortu",
                    "value": "",
                    "prompt": "Nama Orang Tua"
                },
                {
                    "name": "kelas_id",
                    "value": "",
                    "prompt": "ID Kelas",
                    "options": [
                        {
                            "value": 1,
                            "prompt": "Sepuluh IPA A"
                        },
                        {
                            "value": 2,
                            "prompt": "Sebelas IPA A"
                        },
                        {
                            "value": 3,
                            "prompt": "DuaBelas IPA A"
                        }
                    ]
                }
            ]
        }
    },
    "status_code": 200
}
```

- Contoh Response dari GET http://sekolahan.test/api/siswa/4

```json
{
    "collection": {
        "status": true,
        "message": "Detail data siswa berhasil ditemukan!",
        "version": "1.0",
        "href": "http://sekolahan.test/api/siswa/4",
        "items": [
            {
                "href": "http://sekolahan.test/api/siswa/4",
                "data": [
                    {
                        "name": "id",
                        "value": 4,
                        "prompt": "ID"
                    },
                    {
                        "name": "nis",
                        "value": "23051130015",
                        "prompt": "Nomor Induk Siswa"
                    },
                    {
                        "name": "gender",
                        "value": "laki-laki",
                        "prompt": "Jenis Kelamin"
                    },
                    {
                        "name": "nama",
                        "value": "Alif Januar Rizky",
                        "prompt": "Nama Lengkap"
                    },
                    {
                        "name": "tempat_lahir",
                        "value": "Purworejo",
                        "prompt": "Tempat Lahir"
                    },
                    {
                        "name": "tgl_lahir",
                        "value": null,
                        "prompt": "Tanggal Lahir"
                    },
                    {
                        "name": "nama_ortu",
                        "value": "SecretMan",
                        "prompt": "Nama Orang Tua"
                    },
                    {
                        "name": "phone_number",
                        "value": "085641133135",
                        "prompt": "Nomor Telepon"
                    },
                    {
                        "name": "email",
                        "value": "alifjanuar.2023@sekolahan.ac.id",
                        "prompt": "Email"
                    },
                    {
                        "name": "alamat",
                        "value": "Kecamatan Grabag, Kabupaten Purworejo, Provinsi Jawa Tengah",
                        "prompt": "Alamat"
                    },
                    {
                        "name": "kelas_id",
                        "value": 1,
                        "prompt": "ID kelas"
                    }
                ],
                "_links": [
                    {
                        "rel": "self",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa/4",
                        "prompt": "Detail Siswa"
                    },
                    {
                        "rel": "index",
                        "method": "GET",
                        "href": "http://sekolahan.test/api/siswa",
                        "prompt": "Dafar Siswa"
                    },
                    {
                        "rel": "update",
                        "method": "PUT",
                        "href": "http://sekolahan.test/api/siswa/4",
                        "prompt": "Update Data Siswa"
                    },
                    {
                        "rel": "delete",
                        "method": "DELETE",
                        "href": "http://sekolahan.test/api/siswa/4",
                        "prompt": "Hapus Data Siswa"
                    }
                ]
            }
        ],
        "queries": [
            {
                "rel": "search",
                "href": "http://sekolahan.test/api/siswa",
                "prompt": "Pencarian umum",
                "data": [
                    {
                        "name": "q",
                        "value": "",
                        "prompt": "Pencarian umum"
                    }
                ]
            },
            {
                "rel": "filter",
                "href": "http://sekolahan.test/api/siswa",
                "prompt": "Filter data",
                "data": [
                    {
                        "name": "nis",
                        "value": "",
                        "prompt": "Filter berdasarkan NIS"
                    },
                    {
                        "name": "nama",
                        "value": "",
                        "prompt": "Filter berdasarkan nama siswa"
                    },
                    {
                        "name": "gender",
                        "value": "",
                        "prompt": "Filter berdasarkan jenis kelamin",
                        "options": [
                            {
                                "value": "laki-laki",
                                "prompt": "Laki-laki"
                            },
                            {
                                "value": "perempuan",
                                "prompt": "Perempuan"
                            }
                        ]
                    },
                    {
                        "name": "kelas_id",
                        "value": "",
                        "prompt": "Filter berdasarkan ID Kelas",
                        "options": [
                            {
                                "value": 1,
                                "prompt": "Sepuluh IPA A"
                            },
                            {
                                "value": 2,
                                "prompt": "Sebelas IPA A"
                            },
                            {
                                "value": 3,
                                "prompt": "DuaBelas IPA A"
                            }
                        ]
                    },
                    {
                        "name": "tempat_lahir",
                        "value": "",
                        "prompt": "Cari berdasarkan tempat lahir"
                    }
                ]
            }
        ],
        "template": {
            "data": [
                {
                    "name": "nis",
                    "value": "",
                    "prompt": "NIS"
                },
                {
                    "name": "nama",
                    "value": "",
                    "prompt": "Nama lengkap"
                },
                {
                    "name": "gender",
                    "value": "",
                    "prompt": "Jenis kelamin",
                    "options": [
                        {
                            "value": "laki-laki",
                            "prompt": "Laki-laki"
                        },
                        {
                            "value": "perempuan",
                            "prompt": "Perempuan"
                        }
                    ]
                },
                {
                    "name": "tempat_lahir",
                    "value": "",
                    "prompt": "Tempat Lahir"
                },
                {
                    "name": "tgl_lahir",
                    "value": "",
                    "prompt": "Tanggal Lahir"
                },
                {
                    "name": "email",
                    "value": "",
                    "prompt": "Email"
                },
                {
                    "name": "alamat",
                    "value": "",
                    "prompt": "Alamat"
                },
                {
                    "name": "phone_number",
                    "value": "",
                    "prompt": "Nomor Telepone"
                },
                {
                    "name": "nama_ortu",
                    "value": "",
                    "prompt": "Nama Orang Tua"
                },
                {
                    "name": "kelas_id",
                    "value": "",
                    "prompt": "ID Kelas",
                    "options": [
                        {
                            "value": 1,
                            "prompt": "Sepuluh IPA A"
                        },
                        {
                            "value": 2,
                            "prompt": "Sebelas IPA A"
                        },
                        {
                            "value": 3,
                            "prompt": "DuaBelas IPA A"
                        }
                    ]
                }
            ]
        }
    },
    "status_code": 200
}
```

## Instalasi & Setup

#### 1. Clone Repository:
```bash
https://github.com/Zepfort/sekolahan.git
cd sekolahan
```

#### 2. Install Dependecies
```bash
composer install
```

#### 3. Konfigurasi Environment
- Salin `.env.example` ke `.env`
- Atur koneksi database Anda di `.env`.
- Jalankan perintah:
```bash
php artisan key:generate
```

#### 4. Aktifkan Database MySQL/PostgreSQL dan Apache

#### 5. Migrate & Seed:
```bash
php artisan migrate:fresh --seed
```

#### 6. Menjalankan Aplikasi

#### Opsi A: Menggunakan Laragon (Direkomendasikan)
1. Aktifkan **Apache** dan **MySQL** pada panel Laragon.
2. Akses aplikasi melalui URL virtual host: `http://sekolahan.test` (atau sesuai nama folder Anda).

#### Opsi B: Menggunakan Laravel Serve
Jika tidak menggunakan Laragon, jalankan perintah berikut:
```bash
php artisan serve
```

## Daftar Endpoint Utama

| No | Method | Endpoint | Deskripsi |
|----|--------|----------|-----------|
| 1 | GET | `/api/users` | Mengambil daftar user |
| 2 | POST | `/api/users` | Menambahkan user baru |
| 3 | GET | `/api/users/{id}` | Mengambil data user berdasarkan id |
| 4 | PUT/PATCH | `/api/users/{id}` | Mengedit data user berdasarkan id |
| 5 | DELETE | `/api/users/{id}` | Menghapus data user berdasarkan id |
| 6 | GET | `/api/siswa` | Mengambil daftar siswa |
| 7 | POST | `/api/siswa` | Menambahkan siswa baru |
| 8 | GET | `/api/siswa/{id}` | Mengambil data siswa berdasarkan id |
| 9 | PUT/PATCH | `/api/siswa/{id}` | Mengedit data siswa berdasarkan id |
| 10 | DELETE | `/api/siswa/{id}` | Menghapus data siswa berdasarkan id |
| 11 | GET | `/api/guru` | Mengambil daftar guru |
| 12 | POST | `/api/guru` | Menambahkan guru baru |
| 13 | GET | `/api/guru/{id}` | Mengambil data guru berdasarkan id |
| 14 | PUT/PATCH | `/api/guru/{id}` | Mengedit data guru berdasarkan id |
| 15 | DELETE | `/api/guru/{id}` | Menghapus data guru berdasarkan id |
| 16 | GET | `/api/kelas` | Mengambil daftar kelas |
| 17 | POST | `/api/kelas` | Menambahkan kelas baru |
| 18 | GET | `/api/kelas/{id}` | Mengambil data kelas berdasarkan id |
| 19 | PUT/PATCH | `/api/kelas/{id}` | Mengedit data kelas berdasarkan id |
| 20 | DELETE | `/api/kelas/{id}` | Menghapus data kelas berdasarkan id |
| 21 | GET | `/api/mapel` | Mengambil daftar mata pelajaran |
| 22 | POST | `/api/mapel` | Menambahkan mata pelajaran baru |
| 23 | GET | `/api/mapel/{id}` | Mengambil data mata pelajaran berdasarkan id |
| 24 | PUT/PATCH | `/api/mapel/{id}` | Mengedit data mata pelajaran berdasarkan id |
| 25 | DELETE | `/api/mapel/{id}` | Menghapus data mata pelajaran berdasarkan id |
| 26 | GET | `/api/jadwal` | Mengambil daftar jadwal pelajaran |
| 27 | POST | `/api/jadwal` | Menambahkan jadwal pelajaran baru |
| 28 | GET | `/api/jadwal/{id}` | Mengambil data jadwal pelajaran berdasarkan id |
| 29 | PUT/PATCH | `/api/jadwal/{id}` | Mengedit data jadwal pelajaran berdasarkan id |
| 30 | DELETE | `/api/jadwal/{id}` | Menghapus data jadwal pelajaran berdasarkan id |

## Pengembangan Selanjutnya?

1. Implementasi JWT Authentication
