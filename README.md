# 🎬 Filmoteka

Filmoteka je cjelovita web aplikacija za pretraživanje, pregled i organizaciju filmskog i TV sadržaja, razvijena kao integrisani projekat za predmete **Dizajn web stranica (DWS)** i **Operativni sistemi i računarstvo u oblaku (OSiRuO)**. 

Aplikacija omogućava korisnicima kreiranje personalizovanih zbirki filmova (javnih ili privatnih), pregled detaljnih informacija i trendova u realnom vremenu putem eksterne integracije s TMDB API-jem, te posjeduje napredni administrativni panel. Sistem je u potpunosti kontejnerizovan pomoću Dockera, posjeduje automatizovan CI/CD pipeline i hostovan je na Google Cloud Platformi (GCP).

---

## 👥 Članovi tima i raspodjela doprinosa

Prezime i ime studenta | Doprinos u okviru predmeta **DWS** | Doprinos u okviru predmeta **OSiRuO**
---|---|---
**Ferhatović Rijad** | • Razvoj PHP backend arhitekture (sesije, autentikacija, autorizacija).<br>• Projektovanje i normalizacija MySQL baze podataka (`db.php`).<br>• Implementacija admin panela (upravljanje profilima, ban sistem, feedback). | • Pisanje višenivojskog `Dockerfile`-a za PHP/Apache i optimizacija layera.<br>• Konfiguracija i povezivanje s Google Cloud SQL instance-om.<br>• Pisanje shell skripte za provjeru zdravlja sistema (`health-check.sh`).
**Hajrić Alen** | • Kreiranje responzivnog korisničkog interfejsa (UI) u čistom HTML5/CSS3 kodu.<br>• Asinhrono povlačenje podataka sa eksternog TMDB API-ja pomoću JavaScripta.<br>• Implementacija dinamičkih slidera i hamburger menija za mobilne uređaje. | • Konfiguracija CI/CD pipeline-a unutar GitHub Actions (`.github/workflows`).<br>• Automatizacija push-ovanja Docker image-a u Google Artifact Registry.<br>• Postavljanje i deployment servisa na Google Cloud Run platformu.

---

## 🛠️ Tehnički Stack (Tech Stack & Verzije)

* **Frontend:** HTML5, CSS3 (Vanilla CSS s potpunom responzivnošću), JavaScript (ES6+, Asinhroni Fetch API)
* **Backend:** PHP 8.2.x (Apache Web Server)
* **Baza podataka:** MySQL 8.0.x / Google Cloud SQL (Relaciona baza podataka)
* **Kontejnerizacija:** Docker 24.x (Docker Engine, multi-stage build koncept)
* **CI/CD:** GitHub Actions (Automated Build, Test & Deploy pipeline)
* **Cloud Platforma (GCP):** Google Cloud Run (Kontejnerski serverless servis), Google Artifact Registry, Google Cloud SQL

---

## 📐 Arhitekturni dijagram aplikacije

Sljedeći dijagram prikazuje cjelokupnu topologiju sistema, tok podataka od klijenta do servera u oblaku, te integraciju s bazom i eksternim TMDB servisom:

![Arhitektura Aplikacije](assets/arhitektura.png)

---

## 🎨 Dizajn sistem (Paleta boja i fontovi)

* **Paleta boja:**
    * `Pozadina aplikacije:` `#0b0b0b` (Izrazito tamna, kino/Netflix estetika koja smanjuje zamor očiju)
    * `Primarna akcentna boja:` `#e50914` (Snažna crvena boja rezervisana za logotip, primarnu dugmad i hover efekte)
    * `Tekst (Glavni):` `#ffffff` (Čista bijela boja za maksimalan kontrast i čitljivost)
    * `Tekst (Sekundarni):` `#ccc` / `#aaa` (Svijetlo sive nijanse namijenjene meta-podacima, opisima filmova i manje važnim oznakama)
* **Tipografija:**
    * Glavni font: **Montserrat** (Sans-Serif porodica fontova preuzeta preko Google Fonts platforme; korištene debljine: 400, 500, 600, 700, 800 i 900 za hijerarhiju naslova).

---

## 🔐 Korisničke uloge i prava pristupa

Aplikacija posjeduje ugrađen sistem autorizacije na osnovu uloga (RBAC) koji striktno kontroliše pristup PHP rutama:

1.  **Gost / Anonimni posjetitelj:**
    * Pristup landing stranici (`landing.php`) na kojoj se prikazuju trenutni kinematografski trendovi.
    * Mogućnost registracije novog računa (`registracija.php`) i prijave na sistem (`login.php`).
    * Pregled statičkih informativnih stranica "O nama" (`o_nama.php`) i "Kontakt" (`kontakt.php`).
2.  **Registrovani korisnik:**
    * Pristup glavnoj aplikaciji (`index.php`), pretrazi filmova po žanrovima (`zanr.php`) i detaljnim stranicama (`detalji.php`).
    * Mogućnost kreiranja, modifikacije, čišćenja i potpunog brisanja sopstvenih zbirki filmova kroz `akcije_zbirka.php`.
    * Uređivanje sopstvenog profila (`edit_profil.php`), uključujući promjenu biografije i upload profilne slike.
3.  **Administrator sistema:**
    * Sva prava registrovanog korisnika unutar sistema.
    * Ekskluzivan pristup zaštićenom administrativnom panelu (`admin_panel.php`).
    * Mogućnost trajnog banovanja korisnika uz unošenje obaveznog obrazloženja koje se upisuje u bazu.
    * Pregled, analiza i brisanje korisničkih poruka i feedbacka pristiglih preko kontakt forme (`admin_feedback.php`).

---

## 🚀 Uputstvo za lokalno pokretanje (Step-by-Step)

### Preduslovi (Prerequisites)
Prije pokretanja potrebno je imati instaliran **Docker Desktop** (opcija 1) ILI **XAMPP** razvojno okruženje s PHP 8.x i MySQL serverom (opcija 2).

### Opcija 1: Pokretanje unutar lokalnog Docker kontejnera (Preporučeno)
1.  Otvorite terminal (ili komandnu liniju) unutar korijenskog foldera projekta.
2.  Izgradite Docker image na osnovu priloženog `Dockerfile`-a:
    ```bash
    docker build -t filmoteka-app .
    ```
3.  Pokrenite kontejner i mapirajte portove (lokalni port 8080 preusmjerava na port 80 unutar kontejnera):
    ```bash
    docker run -d -p 8080:80 --name filmoteka-kontejner filmoteka-app
    ```
4.  Otvorite pretraživač i pristupite aplikaciji na adresi: `http://localhost:8080/landing.php`

### Opcija 2: Pokretanje putem XAMPP okruženja
1.  Klonirajte ili kopirajte kompletan izvorni kod u direktorijum: `C:/xampp/htdocs/filmoteka/`
2.  Pokrenite **Apache** i **MySQL** servise u XAMPP kontrolnoj tabli.
3.  Otvorite `phpMyAdmin` na adresi `http://localhost/phpmyadmin/`.
4.  Kreirajte novu bazu podataka pod nazivom `filmoteka_db`.
5.  Uvezite SQL strukturu tabela (struktura je definisana u kodu unutar `db.php`).
6.  Otvorite pretraživač i posjetite: `http://localhost/DWSProjekat/landing.php`

---

## 🌐 Produkcijski URL (Google Cloud Platform)

Aplikacija je u potpunosti integrisana sa GCP infrastrukturom, prošla je kroz automatizovani GitHub Actions build i aktivno se izvršava u serverless okruženju:

🔗 **[KLIKNI OVDJE ZA PRISTUP FILMOTECI NA GCP-U](https://filmoteka-aplikacija-tvoj-id.run.app)** *(Zamijeniti stvarnim URL-om nakon deploymenta)*

---

## 📸 Snimci ekrana radne aplikacije (Screenshots)

*Sve slike se nalaze unutar lokalnog foldera `assets/` koji je sastavni dio repozitorijuma.*

### 1. Landing stranica (Početni prikaz za goste)
Opis: Prikaz dinamičkog slidera s najnovijim filmovima povučenim s TMDB API-ja i opcijama za registraciju/prijavu.
![Landing Stranica](assets/landing.png)

### 2. Autentikacija (Prijava na sistem)
Opis: Forma za prijavu sa validacijom unesenih podataka i zaštićenim sesijama, uključujući i restriktivni ekran u slučaju bana.
![Prijava](assets/prijava.png)

### 3. Admin Panel (Upravljanje korisničkim ulogama i ban sistem)
Opis: Administrativni interfejs dostupan isključivo korisnicima s `admin` rolom, omogućava uvid u profile i njihovo blokiranje.
![Admin Panel](assets/admin.png)

### 4. Mobilni prikaz (Dokaz responzivnosti na ekranu širine 480px)
Opis: Pregled aplikacije na mobilnom uređaju. Navigacioni meni se transformiše u hamburger ikonicu, a grid kartica se fluidno prilagođava širini ekrana.
![Mobilni Prikaz](assets/mobilni.png)

### 5. GCP Cloud Run konzola (Dokaz uspješnog deploymenta u oblaku)
Opis: Snimak ekrana iz Google Cloud konzole koji prikazuje aktivno stanje Cloud Run servisa, iskorištenost resursa i povezanost s Artifact Registry-jem.
![GCP Konzola](assets/gcp_console.png)