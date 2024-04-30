# E&B Podcast Foglalási rendszer backend

Frontend: [https://github.com/KovacsBalazs-Lefti/EandBPodcastStudio-frontend](https://github.com/KovacsBalazs-Lefti/EandBPodcastStudio-frontend)

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
```plain
php artisan migrate 
