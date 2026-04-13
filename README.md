# 🍲 Vecmāmiņas Receptes

## 📌 Projekta apraksts
**Vecmāmiņas Receptes** ir Laravel bāzēta tīmekļa lietotne recepšu pārvaldībai. Tā ļauj lietotājiem izveidot, meklēt un saglabāt receptes, kā arī nodrošina administratora paneli sistēmas pārvaldībai.

Projekts demonstrē tipisku Laravel aplikācijas arhitektūru ar autentifikāciju, CRUD funkcionalitāti un datubāzes migrācijām.

---

## ✨ Funkcionalitāte

- 🔐 Lietotāju reģistrācija un autentifikācija  
- 📖 Recepšu pārvaldība (CRUD)  
- 🗂️ Kategorijas (piem., brokastis, deserti u.c.)  
- 🔎 Meklēšana un filtrēšana  
- ❤️ Iecienītākās receptes (favorites)  
- 🛠️ Administratora panelis:
  - Lietotāju pārvaldība  
  - Recepšu pārvaldība  
  - Admin tiesību piešķiršana  

---

## 🧭 Lietotāja plūsma

1. Lietotājs reģistrējas vai piesakās  
2. Pārlūko vai meklē receptes  
3. Atver recepti un apskata detaļas  
4. Autorizēts lietotājs var:
   - pievienot receptes  
   - rediģēt savas receptes  
   - saglabāt favorītos  
5. Administrators var pārvaldīt sistēmu  

---

## 🧱 Tehnoloģijas

- **Backend:** Laravel (PHP)  
- **Frontend:** Blade + Tailwind CSS  
- **Datubāze:** MySQL / MariaDB  
- **Autentifikācija:** Laravel Auth  
- **Konteinerizācija:** Docker + Docker Compose  

---

## 📂 Projekta struktūra

```
app/
 ├── Http/Controllers/
 ├── Models/

resources/views/
routes/web.php
database/migrations/
public/
```

---

# 🚀 Palaišana ar Docker (ieteicamais veids)

## Prasības
- Docker
- Docker Compose

---

## 1. Klonēt projektu

```bash
git clone <repo-url>
cd recipe-app
```

---

## 2. Izveidot `.env`

```bash
cp .env.example .env
```

---

## 3. Palaist konteinerus

```bash
docker-compose up -d --build
```

---

## 4. Ieeja konteinerā

```bash
docker exec -it app bash
```

---

## 5. Instalēt atkarības

```bash
composer install
php artisan key:generate
```

---

## 6. Migrācijas

```bash
php artisan migrate
```

---

## 7. Atvērt aplikāciju

http://localhost:8000

---

## 🐳 Docker konfigurācija

`.env` failā jābūt:

```
DB_HOST=db
DB_DATABASE=recipe_app
DB_USERNAME=root
DB_PASSWORD=root
```

---

# 💻 Lokālā palaišana (bez Docker)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Aplikācija būs pieejama:

http://127.0.0.1:8000

---

# ⚠️ Biežākās problēmas

### Docker nepalaižas
- Pārbaudi vai Docker darbojas  
- Izmanto `--build`

### DB connection error
- Pārbaudi `.env`  
- Pārliecinies, ka DB konteiners darbojas  

### 500 / white screen
Pārbaudi logus:
```bash
storage/logs/laravel.log
```

---

# 🔒 Drošība

- CSRF aizsardzība aktivizēta pēc noklusējuma  
- `.env` failu nedrīkst publicēt  
- Admin tiesības piešķirt tikai uzticamiem lietotājiem  

---

# 📎 Dokumentācija

https://1drv.ms/w/c/e89a595db40b3546/IQAzKAeK-fvEQqDYZIph98acAV2lkiiDLd51d5KMupucvno?e=sq6s1I

---

# 👩‍💻 Autors

**Elīza Strūberga**  
Rīgas Valsts tehnikums  
4. kurss — datoriķi  
