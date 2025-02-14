# Guia del Projecte - VideosApp

## Descripció del Projecte

El projecte **VideosApp** és una aplicació web creada utilitzant **Laravel**, amb l'objectiu de gestionar vídeos en una plataforma. Els vídeos tenen atributs com títol, descripció, URL, data de publicació i la relació entre vídeos (anterior i següent). A més, permet organitzar els vídeos en sèries i realitzar operacions CRUD sobre ells.

El projecte es desenvolupa en dos sprints, on cada sprint té objectius específics i funcionalitats a implementar.

## Sprint 1: Configuració Inicial i Creació de Funcionalitats Bàsiques

Durant el primer sprint, es va dur a terme la creació del projecte i la configuració de la base de dades, juntament amb algunes funcionalitats inicials. Els objectius principals van ser:

1. **Creació del Projecte Laravel**:
   - Es va crear un nou projecte de Laravel anomenat **VideosApp**.
   - Es van configurar les opcions de Jetstream amb **Livewire**, **PHPUnit**, i **SQLite** com a base de dades.
   
2. **Creació d'Usuaris i Equips**:
   - Es van configurar dos tipus d'usuaris: un usuari per defecte i un professor per defecte.
   - Els usuaris es van associar a un equip utilitzant el sistema d'equips de Jetstream.

3. **Creació de Helpers**:
   - Es van crear *helpers* personalitzats per generar els vídeos i usuaris per defecte.

4. **Configuració de Proves**:
   - Es van escriure proves utilitzant **PHPUnit** per verificar la creació d'usuaris i l'assignació a equips.

## Sprint 2: Desenvolupament de Funcionalitats Avançades

Al segon sprint, es van implementar funcionalitats més avançades relacionades amb la gestió de vídeos, incloent la creació de migracions, controladors, models i proves. Els principals objectius van ser:

1. **Migració de Videos**:
   - Es va crear la migració per a la taula `videos`, amb camps com `title`, `description`, `url`, `published_at`, `previous`, `next`, i `series_id`.

2. **Controlador de Videos**:
   - Es va implementar el **VideosController** amb funcions per mostrar els detalls d'un vídeo i per obtenir els vídeos en diferents formats.

3. **Model de Videos**:
   - El model `Video` es va configurar amb tres mètodes que retornen la data de publicació de diferents maneres utilitzant la llibreria **Carbon**:
     - `getFormattedPublishedAtAttribute()`: Mostra la data en format llegible (ex. "13 de gener de 2025").
     - `getFormattedForHumansPublishedAtAttribute()`: Mostra la data en un format relatiu (ex. "fa 2 hores").
     - `getPublishedAtTimestampAttribute()`: Mostra el timestamp Unix de la data de publicació.

4. **Creació de la Vista del Video**:
   - Es va crear la vista per mostrar els detalls d'un vídeo, incloent el seu títol, descripció i la data de publicació.

5. **Proves de Videos**:
   - Es van crear proves per verificar la correcta creació i visualització dels vídeos.
   - Es van verificar la correcta funcionalitat dels mètodes de format de data i la visualització de vídeos a través de proves unitàries i d'integració.

6. **Implementació d'Eines d'Anàlisi de Codi**:
   - Es va instal·lar i configurar **Larastan** per detectar errors en el codi i millorar la qualitat del mateix.

## Sprint 3
1. **Corregir errors del 2n sprint:**
    - Vaig començar corregint els errors del segon sprint que havien aparegut durant les proves inicials.

2. **Instal·lació del paquet `spatie/laravel-permission`:**
    - Vaig instal·lar aquest paquet per gestionar els permisos i rols dels usuaris a l'aplicació. Seguint les instruccions de la [documentació d'instal·lació](https://spatie.be/docs/laravel-permission/v6/installation-laravel), vaig afegir-lo correctament al projecte.

3. **Migració per afegir el camp `super_admin` a la taula `users`:**
    - Vaig crear una migració per afegir el camp `super_admin` a la taula d'usuaris, per poder identificar quins usuaris tenen el rol de superadministrador.

4. **Actualització del Model `User`:**
    - Al model d'usuaris, vaig afegir les funcions `testedBy()` i `isSuperAdmin()` per facilitar la verificació de permisos i rols.

5. **Afegir el superadmin al professor a la funció `create_default_professor`:**
    - Vaig actualitzar aquesta funció a `helpers` per afegir el superadmin al professor per defecte i separar la creació de l'equip del codi de creació dels usuaris mitjançant la nova funció `add_personal_team()`.

6. **Creació de funcions per a usuaris regulars i de gestió de vídeos:**
    - Vaig crear diverses funcions per crear usuaris regulars, gestors de vídeos i superadministradors. Això inclou funcions com `create_regular_user()`, `create_video_manager_user()`, i `create_superadmin_user()` amb valors predeterminats per cada tipus d'usuari.

7. **Definir polítiques i portes d'accés a `AppServiceProvider`:**
    - A la funció `book` de `AppServiceProvider`, vaig registrar les polítiques d'autorització i definir les portes d'accés per controlar qui pot veure o modificar què a l'aplicació.

8. **Posar permisos i usuaris per defecte al `DatabaseSeeder`:**
    - Vaig afegir els permisos i usuaris (superadmin, regular user i video manager) al `DatabaseSeeder`, per garantir que aquests usuaris estiguin disponibles a la base de dades inicialment.

9. **Publicar els stubs per personalitzar-los:**
    - Vaig seguir la guia per [personalitzar els stubs](https://laravel-news.com/customizing-stubs-in-laravel) per adaptar el codi generat per Laravel a les necessitats del projecte.

10. **Crear el test 'VideoManagerTest' per provar les funcions del gestor de vídeos:**
    - Vaig crear un nou test per provar les funcions del gestor de vídeos, com ara la creació, edició i eliminació de vídeos. Aquest test va ser útil per verificar que les funcions del gestor de vídeos funcionaven correctament.

11. **Crear el test `UserTest`:**
    - A la carpeta `tests/Unit`, vaig crear el test `UserTest` i vaig afegir la funció `isSuperAdmin()` per verificar que es detectés correctament si un usuari és superadministrador.

12. **Afegir un registre a `resources/markdown/terms`:**
    - Vaig actualitzar el fitxer de termes per incloure tot el que s'ha fet fins al moment en aquest sprint, per mantenir la documentació al dia.

13. **Comprovar els fitxers amb Larastan:**
    - Vaig utilitzar **Larastan** per analitzar tot el codi creat i detectar possibles errors de tipus i altres problemes en el codi.


## Conclusió

Durant aquests sprints, vaig aconseguir configurar l'estructura bàsica del projecte, implementar una gestió robusta de permisos, i escriure proves per garantir el bon funcionament del sistema. Això ha permès millorar la seguretat i funcionalitat del projecte, amb un enfocament en la gestió d'usuaris i la gestió de vídeos dins de l'aplicació.







