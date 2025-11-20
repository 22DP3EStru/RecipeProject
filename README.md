# Recepšu Aplikācija

Īss apraksts
------------
Vienkārša Laravel bāzēta recepšu tīmekļa vietne, kas ļauj reģistrētiem lietotājiem izveidot, rediģēt, skatīt un dzēst receptes. Vietne piedāvā kategorizāciju, meklēšanu, iecienītāko (favorites) sistēmu un administratora paneli lietotāju un recepšu pārvaldībai.

Kas šī vietne nodrošina
------------------------
- Lietotāju reģistrācija un autentifikācija.
- Receptes CRUD (izveide, lasīšana, rediģēšana, dzēšana).
- Kategorijas — receptes var tikt grupētas pēc veida (piem., brokastis, vakariņas, deserti).
- Meklēšana un filtri pēc kategorijas un grūtības.
- Iecienītākās receptes (favorites) — lietotāji var atzīmēt receptes.
- Admin panelis — pārvaldīt lietotājus, receptes un piešķirt admin tiesības.

Kā vietne strādā (lietotāja plūsma)
-----------------------------------
1. Lietotājs reģistrējas vai piesakās.
2. Var pārlūkot receptes pēc kategorijām vai meklēt pēc atslēgvārdiem.
3. Receptes lapā var redzēt sastāvdaļas, instrukcijas un saistītās receptes.
4. Piesakoties, lietotājs var saglabāt receptes kā iecienītākās, kā arī pievienot un rediģēt savas receptes.
5. Administrators redz papildus pārvaldības lapu, kur iespējams dzēst receptes vai lietotājus un mainīt admin statusus.

Tehniskais pārskats
-------------------
- Backend: Laravel (PHP)
- Datubāze: MySQL / MariaDB (konfigurējama .env)
- Modeļi: User, Recipe, Favorite (un opc. Category)
- Skati: Blade template faili resources/views/
- Maršruti: routes/web.php
- Middleware: admin — aizsargā admin sadaļu

Uzstādīšana lokāli (ātra)
--------------------------
1. Nokopēt .env piemēru un iestatīt DB datus:
   cp .env.example .env
2. Instalēt atkarības:
   composer install
3. Ģenerēt app key un migrēt DB:
   php artisan key:generate
   php artisan migrate
4. (Ja nepieciešams) palaist projektu:
   php artisan serve

Piezīmes par drošību un datiem
------------------------------
- Pārliecinieties, ka sessions un CSRF ir pareizi konfigurēti (.env SESSION_DRIVER, SESSION_DOMAIN).
- Datu dublēšana ir ieteicama pirms nozīmīgām izmaiņām vai migrācijām.
- Admin tiesības piešķirt uzmanīgi — tikai uzticamiem kontiem.

Kur skatīt kodu
---------------
- Maršruti: routes/web.php
- Kontrolieri: app/Http/Controllers/
- Modeļi: app/Models/
- Skati: resources/views/

Dokumentācija : https://1drv.ms/w/c/e89a595db40b3546/ER993AF-T2FAqoGI6sv4PcoB2hhob859BA-QqS8gtjH-pQ?e=NTs7I3
