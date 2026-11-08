# Use Case Diagram - Lab MMT

```plantuml
@startuml
left to right direction
skinparam packageStyle rectangle

actor "Pengunjung" as Visitor
actor "Admin" as Admin
actor "Editor" as Editor

rectangle "Lab MMT System" {
  usecase "Lihat Proyek" as UC1
  usecase "Lihat Detail Proyek" as UC2
  usecase "Beri Rating Proyek" as UC3
  usecase "Beri Komentar Proyek" as UC4
  usecase "Lihat Artikel" as UC5
  usecase "Lihat Detail Artikel" as UC6
  usecase "Lihat Galeri" as UC7
  usecase "Lihat Mitra" as UC8
  usecase "Hubungi Kami" as UC9
  usecase "Login" as UC10
  
  usecase "Kelola Proyek" as UC11
  usecase "Kelola Artikel" as UC12
  usecase "Kelola Galeri" as UC13
  usecase "Kelola Mitra" as UC14
  usecase "Kelola Komentar" as UC15
  usecase "Kelola Pengguna" as UC16
  usecase "Lihat Dashboard" as UC17
}

' Pengunjung
Visitor --> UC1
Visitor --> UC2
Visitor --> UC3
Visitor --> UC4
Visitor --> UC5
Visitor --> UC6
Visitor --> UC7
Visitor --> UC8
Visitor --> UC9

' Editor
Editor --> UC10
Editor --> UC11
Editor --> UC12
Editor --> UC13
Editor --> UC14
Editor --> UC15
Editor --> UC17

' Admin (inherits from Editor)
Admin -up-|> Editor
Admin --> UC16

@enduml
```

## Deskripsi Use Cases

### Pengunjung (Public User)
1. **UC1 - Lihat Proyek**: Melihat daftar semua proyek
2. **UC2 - Lihat Detail Proyek**: Melihat detail lengkap proyek termasuk tim dan anggota
3. **UC3 - Beri Rating Proyek**: Memberikan rating 1-5 untuk proyek
4. **UC4 - Beri Komentar Proyek**: Memberikan komentar pada proyek
5. **UC5 - Lihat Artikel**: Melihat daftar artikel dan berita
6. **UC6 - Lihat Detail Artikel**: Membaca artikel lengkap
7. **UC7 - Lihat Galeri**: Melihat galeri foto dan video
8. **UC8 - Lihat Mitra**: Melihat daftar mitra dan kolaborasi
9. **UC9 - Hubungi Kami**: Mengakses halaman kontak dan maps

### Editor
10. **UC10 - Login**: Login ke sistem admin
11. **UC11 - Kelola Proyek**: CRUD proyek (Create, Read, Update, Delete)
12. **UC12 - Kelola Artikel**: CRUD artikel
13. **UC13 - Kelola Galeri**: CRUD media galeri
14. **UC14 - Kelola Mitra**: CRUD data mitra
15. **UC15 - Kelola Komentar**: Moderasi komentar proyek
16. **UC17 - Lihat Dashboard**: Melihat statistik dan overview

### Admin (extends Editor)
17. **UC16 - Kelola Pengguna**: CRUD pengguna (Admin dan Editor)

