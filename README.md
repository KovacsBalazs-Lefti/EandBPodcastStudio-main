# E&B Podcast Foglalási rendszer backend

Frontend: [https://github.com/KovacsBalazs-Lefti/EandBPodcastStudio-frontend](https://github.com/KovacsBalazs-Lefti/EandBPodcastStudio-frontend)

## Követelmények

- PHP 8.2

- repóba feltöltve wikipage

## Thunderclient export 2 db

- Előfizetési módosítások miatt 2db

## Adatbázis export a rootban

## Telepítés lépései

- Csomagok telepítése

```sh
composer install
```

- .env állomány létrehozása

```sh
cp .env.example .env
```

- App kulcs generálása

```sh
php artisan key:generate
```

- Public storage linkelése

```sh
php artisan storage:link
```

- Migrációk futtatása

```sh
php artisan migrate 
```
