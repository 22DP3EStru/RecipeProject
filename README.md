# Vecmāmiņas Receptes

## Īss apraksts
Vienkārša **Laravel bāzēta recepšu tīmekļa vietne**, kas ļauj reģistrētiem lietotājiem izveidot, rediģēt, skatīt un dzēst receptes. Vietne piedāvā kategorizāciju, meklēšanu, iecienītāko (favorites) sistēmu un administratora paneli lietotāju un recepšu pārvaldībai.

Šis projekts demonstrē tipisku Laravel aplikācijas struktūru ar autentifikāciju, CRUD funkcionalitāti un datubāzes migrācijām.

---

# Kas šī vietne nodrošina

- Lietotāju reģistrāciju un autentifikāciju
- Receptes CRUD (izveide, lasīšana, rediģēšana, dzēšana)
- Kategorijas — receptes var tikt grupētas pēc veida (piem., brokastis, vakariņas, deserti)
- Meklēšanu un filtrus pēc kategorijas un grūtības
- Iecienītākās receptes (favorites) — lietotāji var atzīmēt receptes
- Administratora paneli — pārvaldīt lietotājus, receptes un piešķirt admin tiesības

---

# Kā vietne strādā (lietotāja plūsma)

1. Lietotājs reģistrējas vai piesakās.
2. Var pārlūkot receptes pēc kategorijām vai meklēt pēc atslēgvārdiem.
3. Receptes lapā var redzēt sastāvdaļas, instrukcijas un saistītās receptes.
4. Piesakoties, lietotājs var:
   - saglabāt receptes kā iecienītākās
   - pievienot savas receptes
   - rediģēt savas receptes
5. Administrators redz papildus pārvaldības lapu, kur iespējams dzēst receptes vai lietotājus un mainīt admin statusus.

---

# Tehniskais pārskats

- **Backend:** Laravel (PHP)
- **Datubāze:** MySQL / MariaDB (konfigurējama `.env`)
- **Modeļi:** `User`, `Recipe`, `Favorite`, `Category`
- **Skati:** Blade template faili `resources/views/`
- **Maršruti:** `routes/web.php`
- **Middleware:** `admin` — aizsargā admin sadaļu
- **Frontend:** Tailwind CSS

---

# Projekta struktūra

Svarīgākās projekta mapes:

```
app/Http/Controllers/   # Kontrolieri
app/Models/             # Modeļi
resources/views/        # Blade skati
routes/web.php          # Web maršruti
database/migrations/    # Datubāzes migrācijas
public/                 # Publiskie faili
```

---

# Uzstādīšana lokāli (ātra)

### 1. Nokopēt `.env` piemēru

```bash
cp .env.example .env
```

### 2. Instalēt atkarības

```bash
composer install
```

### 3. Ģenerēt aplikācijas atslēgu

```bash
php artisan key:generate
```

### 4. Konfigurēt datubāzi

`.env` failā iestatīt:

```
DB_DATABASE=recipe_app
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrēt datubāzi

```bash
php artisan migrate
```

### 6. Palaist projektu

```bash
php artisan serve
```

Pēc tam aplikācija būs pieejama:

```
http://127.0.0.1:8000
```

---

# Piezīmes par drošību un datiem

- Pārliecinieties, ka **sessions un CSRF** ir pareizi konfigurēti (`SESSION_DRIVER`, `SESSION_DOMAIN`).
- Pirms migrācijām ieteicams veikt **datubāzes dublēšanu**.
- **Admin tiesības** piešķirt tikai uzticamiem lietotājiem.

---

# Kur skatīt kodu

- **Maršruti:** `routes/web.php`
- **Kontrolieri:** `app/Http/Controllers/`
- **Modeļi:** `app/Models/`
- **Skati:** `resources/views/`

---

# Autors

Elīza Strūberga
Rīgas Valsts tehnikums
4.kurss datoriķi