# 🎬 FILMOTEKA – Online Filmska Biblioteka

## 📌 Opis projekta

**FILMOTEKA** je web aplikacija za online filmsku biblioteku koja omogućava korisnicima pregled, pretragu i upravljanje filmovima.

Aplikacija je razvijena u sklopu DWS predmeta koristeći:
- PHP (backend logika)
- MySQL (baza podataka)
- JavaScript, HTML i CSS (frontend)
- XAMPP lokalni server okruženje

Sistem omogućava registraciju i prijavu korisnika, različite uloge (Admin i Guest), te CRUD operacije nad filmskim podacima.

---

## 👥 Tim

- **Rijad Ferhatović**
- **Alen Hajrić**
- **Amar Humić**

---

## 🧩 Doprinos članova

**Rijad Ferhatović**
- Backend PHP logika (login, registracija)
- Session handling i autentikacija
- MySQL povezivanje i SQL upiti
- Admin panel CRUD funkcionalnosti

**Alen Hajrić**
- Frontend dizajn (HTML/CSS)
- Responsive layout i UI/UX
- Kontakt stranica + Google Maps integracija
- Validacija formi (JS)

**Amar Humić**
- Filmski modul (prikaz, pretraga, detalji)
- JavaScript logika i DOM manipulacija
- Povezivanje frontend-a sa backend-om
- Testiranje funkcionalnosti

---

## 🧰 Tech Stack

- PHP 8.4
- MySQL (MariaDB – XAMPP)
- JavaScript (Vanilla JS)
- HTML5
- CSS3
- XAMPP (Apache server)
- phpMyAdmin

---

## 🏗️ Arhitektura sistema

![arhitektura](slike/arhitektura.png)

---

## 🎨 Dizajn sistem

### 🎨 Paleta boja
- Primarna: tamna siva
- Sekundarna: crvena
- Akcent: ružičasta
- Boja slova: bijela

### ✍️ Fontovi
- Headings: **Poppins**
- Body: **Arial / system font**

---

## 🔐 Korisničke uloge

### 👤 Guest
- Registracija i prijava
- Pregled filmova
- Pretraga filmova po search-u
- Pretraga filmova po žanrovima
- Sačuvanje filmova u kolekcije
- Gledanje informacija o filmovima

### 🛠 Admin
- Upravljanje korisnicima
- Pristup admin panelu
- Banovanje korisnika
- Brisanje ili čuvanje feedback-ova

---

## 🚀 Pokretanje projekta (lokalno)

### 📦 Preduvjeti
- XAMPP (Apache + MySQL)
- PHP 8+
- MySQL (phpMyAdmin)

---

### ⚙️ Instalacija

1. Pokrenuti XAMPP:
   - Start Apache
   - Start MySQL

2. Kopirati projekat u:
C:\xampp\htdocs\filmoteka

3. Import baze:
- Otvoriti `phpmyadmin`
- Kreirati bazu: `filmoteka_db`
- Importovati `filmoteka_db.sql`

---

### ▶️ Pokretanje aplikacije

Otvoriti u browseru:
http://localhost/filmoteka

---

## 🗄️ Baza podataka

Baza sadrži tabele:
- korisnici
- filmovi
- feedback
- zbirke
- zbirka_stavke
- banovani_korisnici
- postavke_sistema

---

## 📍 Google Maps

Kontakt stranica koristi Google Maps embed iframe za prikaz lokacije uz mogućnost zoom i pan interakcije.

---

## 🧪 Funkcionalnosti

- Registracija i login sistema
- Session-based autentikacija
- Admin panel (CRUD filmova)
- Pretraga i filtriranje filmova
- Kontakt forma sa validacijom
- Responsive design
- JavaScript validacija formi
- MySQL dinamičko čuvanje podataka

---

## 📸 Screenshots
- Landing page

![Landing_page](slike/landing.PNG)

- Login

![Login](slike/login.PNG)

- Registracija

![Registracija](slike/registracija.PNG)

- Početna

![Početna](slike/pocetna.PNG)

- Admin panel

![admin_panel_1](slike/admin_panel1.PNG)
![admin_panel_2](slike/admin_panel2.PNG)

---

