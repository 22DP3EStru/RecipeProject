# RecepÅu AplikÄcija

ÄŖss apraksts
------------
VienkÄrÅa Laravel bÄzÄ“ta recepÅu tÄ«mekÄ¼a vietne, kas Ä¼auj reÄ£istrÄ“tiem lietotÄjiem izveidot, rediÄ£Ä“t, skatÄ«t un dzÄ“st receptes. Vietne piedÄvÄ kategorizÄciju, meklÄ“Åanu, iecienÄ«tÄko (favorites) sistÄ“mu un administratora paneli lietotÄju un recepÅu pÄrvaldÄ«bai.

Kas ÅÄ« vietne nodroÅina
------------------------
- LietotÄju reÄ£istrÄcija un autentifikÄcija.
- Receptes CRUD (izveide, lasÄ«Åana, rediÄ£Ä“Åana, dzÄ“Åana).
- Kategorijas ā€” receptes var tikt grupÄ“tas pÄ“c veida (piem., brokastis, vakariÅ†as, deserti).
- MeklÄ“Åana un filtri pÄ“c kategorijas un grÅ«tÄ«bas.
- IecienÄ«tÄkÄs receptes (favorites) ā€” lietotÄji var atzÄ«mÄ“t receptes.
- Admin panelis ā€” pÄrvaldÄ«t lietotÄjus, receptes un pieÅÄ·irt admin tiesÄ«bas.

KÄ vietne strÄdÄ (lietotÄja plÅ«sma)
-----------------------------------
1. LietotÄjs reÄ£istrÄ“jas vai piesakÄs.
2. Var pÄrlÅ«kot receptes pÄ“c kategorijÄm vai meklÄ“t pÄ“c atslÄ“gvÄrdiem.
3. Receptes lapÄ var redzÄ“t sastÄvdaÄ¼as, instrukcijas un saistÄ«tÄs receptes.
4. Piesakoties, lietotÄjs var saglabÄt receptes kÄ iecienÄ«tÄkÄs, kÄ arÄ« pievienot un rediÄ£Ä“t savas receptes.
5. Administrators redz papildus pÄrvaldÄ«bas lapu, kur iespÄ“jams dzÄ“st receptes vai lietotÄjus un mainÄ«t admin statusus.

Tehniskais pÄrskats
-------------------
- Backend: Laravel (PHP)
- DatubÄze: MySQL / MariaDB (konfigurÄ“jama .env)
- ModeÄ¼i: User, Recipe, Favorite (un opc. Category)
- Skati: Blade template faili resources/views/
- MarÅruti: routes/web.php
- Middleware: admin ā€” aizsargÄ admin sadaÄ¼u

UzstÄdÄ«Åana lokÄli (Ätra)
--------------------------
1. NokopÄ“t .env piemÄ“ru un iestatÄ«t DB datus:
   cp .env.example .env
2. InstalÄ“t atkarÄ«bas:
   composer install
3. Ä¢enerÄ“t app key un migrÄ“t DB:
   php artisan key:generate
   php artisan migrate
4. (Ja nepiecieÅams) palaist projektu:
   php artisan serve

PiezÄ«mes par droÅÄ«bu un datiem
------------------------------
- PÄrliecinieties, ka sessions un CSRF ir pareizi konfigurÄ“ti (.env SESSION_DRIVER, SESSION_DOMAIN).
- Datu dublÄ“Åana ir ieteicama pirms nozÄ«mÄ«gÄm izmaiÅ†Äm vai migrÄcijÄm.
- Admin tiesÄ«bas pieÅÄ·irt uzmanÄ«gi ā€” tikai uzticamiem kontiem.

Kur skatÄ«t kodu
---------------
- MarÅruti: routes/web.php
- Kontrolieri: app/Http/Controllers/
- ModeÄ¼i: app/Models/
- Skati: resources/views/

DokumentÄcija : https://1drv.ms/w/c/e89a595db40b3546/ER993AF-T2FAqoGI6sv4PcoB2hhob859BA-QqS8gtjH-pQ?e=NTs7I3

