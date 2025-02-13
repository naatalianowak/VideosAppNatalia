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

## Conclusió

Aquest projecte és una excel·lent pràctica per treballar amb Laravel i desenvolupar una aplicació web amb funcionalitats completes. Al llarg dels dos sprints, s'ha creat una estructura sòlida per gestionar vídeos, amb un enfocament en proves, estructura de dades i usabilitat.
