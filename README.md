# Final Project WEB

Repozitář pro finální společný projekt z předmětu Webové aplikace.

## Seznam externích knihoven

- **Bootstrap 5.3.8** -- https://getbootstrap.com/ - licence: MIT
  - License: https://github.com/twbs/bootstrap/blob/main/LICENSE
- **Motiv Litera (Bootswatch) 5.3.8** -- https://bootswatch.com/litera/ - licence: MIT
  - License: https://github.com/thomaspark/bootswatch/blob/master/LICENSE
- **Font Awesome Free 4.7.0** -- https://fontawesome.com/v4/ - licence: ikony: CC BY 4.0, fonty: SIL OFL 1.1, kód: MIT
  - Repo / info: https://github.com/FortAwesome/Font-Awesome
- **TinyMCE 8.5.1 (CDN)** -- https://www.tiny.cloud/ - licence: viz projekt (link níže)
  - License / repo: https://github.com/tinymce/tinymce/blob/main/LICENSE.md
  - Použito přes CDN v pohledech (viz `app/Views/admin/films/create.php` a `edit.php`).
- **jQuery 3.7.1 (CDN)** -- https://jquery.com/ - licence: MIT
  - License: https://github.com/jquery/jquery/blob/main/LICENSE.txt
- **CodeIgniter 4 (framework)** -- https://codeigniter.com/ - licence: MIT
  - Ve `composer.json`: `codeigniter4/framework` (verze ^4.7)
- **Ion Auth (benedmunds/codeigniter-ion-auth)** -- autentizace uživatelů (v `composer.json`).
- **Vývojové nástroje / testy**: `phpunit/phpunit`, `fakerphp/faker` (viz `composer.json`).

## GitHub repozitář

https://github.com/Brecim/finalWebProject

## Rozdělení práce

### Marek Reich

- Založení repozitáře
- Vytvoření ukazatele postupu
- Vytvoření tabulky
- Vytvoření karet a souvisejících popisků
- Import knihovny TinyMCE
- Vytvoření textového pole se zabudovaným editorem typu WYSIWYG
- Vytvoření fontových objektů (ikonek) související s knihovnou Font Awesome
- Spoluvytváření dokumentace (rozdělení práce, seznam nástrojů, popis metod a knihoven, konfigurací)


### Ondřej Tomáštík

- Import knihoven Bootstrap, Motiv Litera pro Bootstrap (Bootswatch), Font Awesome, jQuery
- Určení designu celých stránek
- Vytvoření a upravení navigační lišty
- Vytvoření carouselu a popisků s ním související
- Vytvoření textu na stránce index.html související s tématem
- Vytvoření formuláře pro registraci
- Vytvoření formuláře pro přihlášení
- Vytvoření multiselectu
- Zprovoznění hostingu
- Založení a úprava detailů dokumentace

## Popis hlavních souborů a metod (stručně)

- `app/Controllers/Home.php`:
  - `index()` — načte seznam filmů s paginací a předá do view `home`.
  - `showFilm($id)` — načte detail konkrétního filmu a pomocí `FilmTools` doplní informace o hercích a počtu rolí; zobrazí view `film`.

- `app/Controllers/FilmManagementController.php`:
  - `index()` — administrativní seznam všech filmů (view `admin/films/list`).
  - `createForm()` — zobrazení formuláře pro vytvoření filmu.
  - `create()` — validace vstupu, uložení posteru přes `FilmTools::storePosterImage()`, vložení do DB.
  - `edit($id)` — zobrazení formuláře pro editaci filmu, načtení dostupných osob a rolí.
  - `update($id)` — validace, případná výměna posteru, aktualizace záznamu.
  - `delete($id)` — odstranění filmu a smazání posteru (pokud existuje).
  - `addPerson($filmId)` — přidání osoby s rolí k filmu (vkládá do pivot tabulky `persons_has_films`).
  - `removePerson($filmId, $personId)` — odebrání osoby z filmu.

- `app/Controllers/LoginController.php`:
  - `initController()` — inicializuje `IonAuth` a pomocné helpery.
  - `login()` — zobrazení login stránky (pokud není přihlášen).
  - `auth()` — zpracování přihlášení (podpora přihlášení emailem nebo uživatelským jménem).
  - `register()` / `registerForm()` — registrace uživatele s validací polí.
  - `logout()` — odhlášení uživatele.
  - `profile()` — zobrazení profilu přihlášeného uživatele a jeho skupin.

- `app/Libraries/FilmTools.php` (vlastní knihovna):
  - `storePosterImage(UploadedFile $posterImage, ?string $oldPosterImage = null): string` — uloží poster do `csfd_pictures`, smaže starý pokud je předán.
  - `deletePosterImage(?string $posterImage): void` — smaže soubor pokud existuje.
  - `getFilmPeopleWithRoles(int $filmId): array` — vrátí seznam osob a jejich rolí spojených s daným filmem.
  - `getFilmCastCount(int $filmId): int` — spočítá počet přiřazených rolí (záznamů) pro film.

## Konfigurační proměnné (vybrané)

- `Pager->perPage` — počet položek na stránku pro paginaci (použito v `Home::index()`).
- Databázové připojení a další konfigurace jsou ve standardních souborech CodeIgniteru (`app/Config/Database.php`, `app/Config/App.php`, atd.).

## Zdroje / reference

- Kódy a licence knihoven jsou odkazovány v sekci "Seznam externích knihoven".
- CDN odkazy (použity v pohledech):
  - TinyMCE (použito verze 8.5.1 v `app/Views/admin/films/create.php` a `edit.php`)
  - jQuery 3.7.1 (použito v `app/Views/admin/films/edit.php`)

