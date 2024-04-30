-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Máj 01. 01:13
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `podcaststudio`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalas`
--

CREATE TABLE `foglalas` (
  `foglalasid` bigint(20) UNSIGNED NOT NULL,
  `user_felhasznaloid` bigint(20) UNSIGNED DEFAULT NULL,
  `szolgaltatasnev` varchar(255) NOT NULL,
  `letszam` int(11) NOT NULL,
  `foglalaskezdete` datetime NOT NULL,
  `foglalashossza` int(11) NOT NULL,
  `megjegyzes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `foglalas`
--

INSERT INTO `foglalas` (`foglalasid`, `user_felhasznaloid`, `szolgaltatasnev`, `letszam`, `foglalaskezdete`, `foglalashossza`, `megjegyzes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'eveniet est consequatur ut aut', 2, '2024-08-24 23:00:26', 5, 'Omnis voluptas non quasi eos. Illo alias rem mollitia deserunt quis porro ex.', '2024-04-27 21:00:26', '2024-04-27 21:00:26', NULL),
(2, 1, 'quia maxime et sit et', 1, '2025-03-04 23:00:26', 5, 'Consequatur pariatur assumenda commodi repellendus qui. Doloremque aliquid quae fugit voluptas.', '2024-04-27 21:00:26', '2024-04-27 21:00:26', NULL),
(4, 4, 'Basic Csomag Plusz', 5, '2024-05-29 13:00:00', 3, '33333555353535', '2024-04-29 08:57:07', '2024-04-29 09:20:26', '2024-04-29 09:20:26'),
(5, 4, 'Basic Csomag', 6, '2024-05-31 12:10:00', 1, NULL, '2024-04-29 13:31:11', '2024-04-29 13:31:50', '2024-04-29 13:31:50'),
(6, 7, 'Basic Csomag', 4, '2024-06-10 10:10:00', 3, 'Kávét kérek 4 főre', '2024-04-30 11:19:01', '2024-04-30 11:19:01', NULL),
(7, 7, 'Basic Csomag', 6, '2024-06-11 11:11:00', 3, 'Kérnék plusz egy fő technikai személyzetet', '2024-04-30 11:20:01', '2024-04-30 11:20:51', '2024-04-30 11:20:51'),
(8, 6, 'Basic Csomag.', 2, '2024-06-21 19:00:00', 1, 'Két kamera, mikfrofon, fények.', '2024-04-30 20:20:30', '2024-04-30 20:57:34', '2024-04-30 20:57:34'),
(9, 6, 'Basic Csomag Plusz', 2, '2024-06-21 19:00:00', 1, 'Két kamera, mikrofon, fények.', '2024-04-30 20:40:03', '2024-04-30 20:57:14', '2024-04-30 20:57:14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2024_04_05_110044_create_personal_access_tokens_table', 1),
(4, '2024_04_09_100859_create_foglalas_table', 1),
(5, '2024_04_09_223735_create_szolgaltatasok_table', 1),
(6, '2024_04_13_075801_add_softdeletees_to_foglalas_table', 1),
(7, '2024_04_27_205752_add_id_to_sessions_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `token` text NOT NULL,
  `abilities` text NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `expires_at`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 4, 'AuthToken', 'e2486588cace49b61808652dd0c944c683485d5bf40c4e2637a3f517a24cdc19', '[\"*\"]', NULL, '2024-04-29 06:27:14', '2024-04-29 05:59:47', '2024-04-29 06:27:14'),
(6, 'App\\Models\\User', 5, 'AuthToken', '15ea4433592c46b064fb8fda7c6e9f53af71083a8dd7a001681d6ec0f80d3a5a', '[\"*\"]', NULL, '2024-04-30 05:55:53', '2024-04-30 05:51:34', '2024-04-30 05:55:53'),
(7, 'App\\Models\\User', 5, 'AuthToken', 'c09d1d28c04fa18502d88a54e8bd8ca4e265ae4948f2b8312586cf57c08d2229', '[\"*\"]', NULL, '2024-04-30 05:56:01', '2024-04-30 05:54:01', '2024-04-30 05:56:01'),
(8, 'App\\Models\\User', 6, 'AuthToken', 'bba363c6f7316ea0fedbda4b99d45c8594fe9cad978365c88fad0427bf8a8619', '[\"*\"]', NULL, '2024-04-30 13:42:20', '2024-04-30 06:25:38', '2024-04-30 13:42:20'),
(10, 'App\\Models\\User', 6, 'AuthToken', 'fe1e6e9a7f5dfb6771aeadfa07f4335f1f4663dddf8287a30afbac0d52e33327', '[\"*\"]', NULL, NULL, '2024-04-30 17:33:36', '2024-04-30 17:33:36'),
(11, 'App\\Models\\User', 6, 'AuthToken', 'e92c6d8870917f1bc98559e752b2a64b9c23bb2c3c8459d98b601ec5e80079f5', '[\"*\"]', NULL, NULL, '2024-04-30 17:37:56', '2024-04-30 17:37:56'),
(12, 'App\\Models\\User', 6, 'AuthToken', 'a57403d66bf1bd9f1156d9305051db7988df830c98b26df7196fdd1b9d6a389d', '[\"*\"]', NULL, NULL, '2024-04-30 17:37:58', '2024-04-30 17:37:58'),
(13, 'App\\Models\\User', 6, 'AuthToken', '2bdc245d71e5117101574944c99f07a776aa47cff8a681455dc54b8d97cb55c3', '[\"*\"]', NULL, '2024-04-30 17:50:54', '2024-04-30 17:49:00', '2024-04-30 17:50:54'),
(14, 'App\\Models\\User', 6, 'AuthToken', 'eb7b170b470b8a4d2920262871e248d1236ed4caec5fe0be60aa2328bdd21634', '[\"*\"]', NULL, '2024-04-30 17:57:06', '2024-04-30 17:55:44', '2024-04-30 17:57:06'),
(15, 'App\\Models\\User', 6, 'AuthToken', '38f9394b04d21a36cfc5e9ebdfa047513d5a83f58b462cb87c5ebeca370b73f0', '[\"*\"]', NULL, NULL, '2024-04-30 18:44:01', '2024-04-30 18:44:01'),
(16, 'App\\Models\\User', 6, 'AuthToken', 'ca7ca30fb59830a0074668a2eb6b2ed425bb21b1be23b2a12583695b47c45f19', '[\"*\"]', NULL, NULL, '2024-04-30 18:59:41', '2024-04-30 18:59:41'),
(17, 'App\\Models\\User', 6, 'AuthToken', '1643ac0c75b3446832b91ba41cbcb72c863b3b91418c8c97bd4528503ea4e4bf', '[\"*\"]', NULL, NULL, '2024-04-30 19:34:17', '2024-04-30 19:34:17'),
(18, 'App\\Models\\User', 8, 'AuthToken', 'd06792f165a1a4ca54b223a2811aa367e1414325d578dd5088c908e068a76f4a', '[\"*\"]', NULL, NULL, '2024-04-30 19:37:04', '2024-04-30 19:37:04'),
(19, 'App\\Models\\User', 8, 'AuthToken', 'e0f550f085cae056c60fdbcd2c3251704832deaa294b15ccb30f28afbb8ab198', '[\"*\"]', NULL, NULL, '2024-04-30 19:42:10', '2024-04-30 19:42:10'),
(20, 'App\\Models\\User', 8, 'AuthToken', '6c87a118792524aaba33ad3de84e1a332a14c9bbc74ecf03758b0a24a34191d0', '[\"*\"]', NULL, '2024-04-30 19:49:22', '2024-04-30 19:45:28', '2024-04-30 19:49:22'),
(21, 'App\\Models\\User', 6, 'AuthToken', 'a43488cbef45b021d42cb0cbc2e89722ccc4ef3ff43797ba87a59fca8d473778', '[\"*\"]', NULL, '2024-04-30 20:45:41', '2024-04-30 20:20:11', '2024-04-30 20:45:41'),
(22, 'App\\Models\\User', 6, 'AuthToken', 'a8173262066f65261522bc5f985f23866e1a0b8daafc46324874c133bfc5bd92', '[\"*\"]', NULL, '2024-04-30 20:47:08', '2024-04-30 20:43:54', '2024-04-30 20:47:08'),
(23, 'App\\Models\\User', 6, 'AuthToken', '4b301d93a6e4fe05ce7109e962add3775c4e6b576e38ff893e7c962a54ffbf3f', '[\"*\"]', NULL, '2024-04-30 20:57:34', '2024-04-30 20:47:51', '2024-04-30 20:57:34');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szolgaltatasok`
--

CREATE TABLE `szolgaltatasok` (
  `szolgaltatasid` bigint(20) UNSIGNED NOT NULL,
  `szolgaltatasnev` varchar(100) NOT NULL,
  `leiras` text NOT NULL,
  `ar` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `szolgaltatasok`
--

INSERT INTO `szolgaltatasok` (`szolgaltatasid`, `szolgaltatasnev`, `leiras`, `ar`, `created_at`, `updated_at`) VALUES
(4, 'Basic Csomag', 'A csomag tartalma:mikrofonok, 2 db tablet2 db go pro kamera, fejhallgatók, Segítség a felvétel indításához és leállításához, Alapvető hangmérnöki támogatás, Utómunka, Vágatlan anyag átadása hozott adathordozón', '50000', '2024-04-29 06:01:12', '2024-04-29 06:01:12'),
(5, 'Basic Csomag Plusz', 'mikrofonok, 2 db go pro kamera, 2 db tablet, fejhallgatók, Segítség a felvétel indításához és leállításához, Hangmérnök bérlése, Felvétel professzionális kamarákkal (2db), Vágás,utómunka, Podcast műsor arculat tervezés, Vágatlan anyag átadása adathordozón és felhő szolgáltatáson keresztül', '180000', '2024-04-29 06:18:08', '2024-04-29 06:18:08'),
(6, 'Business Csomag', 'mikrofonok, 2 db go pro kamera, 2 db tablet, fejhallgatók, Segítség a felvétel indításához és leállításához,Hangmérnök bérlése, Felvétel professzionális kamarákkal (2db), Podcast műsor arculat tervezés,Live streaming, YouTube, Facebook felületekre, Élőben vágás, Vágatlan és vágott anyag átadása adathordozón és felhő szolgáltatáson keresztül', '250000', '2024-04-29 06:27:14', '2024-04-29 06:27:14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `felhasznaloid` bigint(20) UNSIGNED NOT NULL,
  `nev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `telefonszam` varchar(255) NOT NULL,
  `szemelyi_szam` varchar(255) NOT NULL,
  `szuletesi_datum` date NOT NULL,
  `ceg` tinyint(1) NOT NULL DEFAULT 0,
  `cegnev` varchar(255) DEFAULT NULL,
  `ceg_tipus` varchar(255) DEFAULT NULL,
  `ado_szam` varchar(255) DEFAULT NULL,
  `bankszamlaszam` varchar(255) DEFAULT NULL,
  `orszag` varchar(255) NOT NULL,
  `iranyitoszam` varchar(255) NOT NULL,
  `varos` varchar(255) NOT NULL,
  `utca` varchar(255) NOT NULL,
  `utca_jellege` varchar(255) NOT NULL,
  `hazszam` varchar(255) NOT NULL,
  `epulet` varchar(255) DEFAULT NULL,
  `lepcsohaz` varchar(255) DEFAULT NULL,
  `emelet` varchar(255) DEFAULT NULL,
  `ajto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`felhasznaloid`, `nev`, `email`, `jelszo`, `role`, `telefonszam`, `szemelyi_szam`, `szuletesi_datum`, `ceg`, `cegnev`, `ceg_tipus`, `ado_szam`, `bankszamlaszam`, `orszag`, `iranyitoszam`, `varos`, `utca`, `utca_jellege`, `hazszam`, `epulet`, `lepcsohaz`, `emelet`, `ajto`, `created_at`, `updated_at`) VALUES
(1, 'Desiree Zulauf', 'keira.crist@example.com', '$2y$12$JcJWRulJAm2AIPEN8Oo/5O5Bwgi/hijgV1lMC2zidVZreeEa8adU6', 'admin', '+1-757-598-3418', 'Db7eEpjo', '2001-07-30', 1, 'Runte, Sanford and Runolfsson', 'Zrt', '29761240', 'HU59741769841684767303079739', 'Magyarország', '32662', 'Haagstad', 'Abernathy Turnpike', 'utca', '37089', 'a', '6', '3', '1', '2024-04-27 21:00:24', '2024-04-27 21:00:24'),
(3, 'Mariam Schuster', 'cortez.reynolds@example.com', '$2y$12$saY2jZhxmACb4PSq6/EYzOtH1LwRWV9ozD90MmSESl1HSoWtG/DLG', 'admin', '+1 (712) 608-4535', 'fKEbA7nD', '2004-06-22', 0, 'Koss, Collier and Renner', 'Kft', '12376211', 'HU12112832189556871823360349', 'Magyarország', '55604', 'New Russelville', 'Leanne Station', 'út', '83377', 'n', '9', '7', '8', '2024-04-27 21:00:25', '2024-04-27 21:00:25'),
(4, 'tesztadmin', 'teszt@teszt.com', '$2y$12$OuJJ/mmNiePVhUifwiCyX.o587jY5nJgvdxxjM7BGe4QlqqiHAyim', 'user', '123456789', '12345678', '1990-01-01', 1, 'Acme Inc.', 'Kft.', '123456789', '12345678901234567890123456', 'Magyarország', '1234', 'Budapest', 'Kossuth utca', 'utca', '10', 'A', '1', '2', '3', '2024-04-29 05:52:49', '2024-04-29 05:52:49'),
(6, 'Kovács Balázs', 'kovibali@gmail.com', '$2y$12$6H9Kgv2t/IbWX4flo5ALPu7kHWNdkNEYJ4fXlRL2z/paur/9hothG', 'user', '123456789', '12345678', '1990-01-01', 1, 'Acme Inc.', 'Kft.', '123456789', '12345678901234567890123456', 'Magyarország', '1234', 'Budapest', 'Kossuth utca', 'utca', '10', 'A', '1', '2', '3', '2024-04-30 05:57:24', '2024-04-30 05:57:24'),
(7, 'Teszt Elek', 'tesztelek@tesztelek.hu', '$2y$12$BAcaZsXVVE354dDi5D7M6O.Lti0nQ1LogUgQvdU4BocbnS51F/kpm', 'user', '+36303379963', 'xps789321', '1979-02-05', 0, NULL, NULL, NULL, NULL, 'Magyarország', '1125', 'Budapest', 'József', 'utca', '7', '5', 'G', 'I', '5', '2024-04-30 11:18:00', '2024-04-30 11:18:00'),
(9, 'Postás Pet', 'postaspet@gmail.com', '$2y$12$.dlF3tZk/0Vyx7xjoDqZmu78bjY5FA0cvjyPxWlswzq8iSMjgAJ/C', 'user', '123456789', '12345678', '1990-01-01', 1, 'Acme Inc.', 'Kft.', '123456789', '12345678901234567890123456', 'Magyarország', '1234', 'Budapest', 'Kossuth utca', 'utca', '10', 'A', '1', '2', '3', '2024-04-30 20:03:00', '2024-04-30 20:03:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `foglalas`
--
ALTER TABLE `foglalas`
  ADD PRIMARY KEY (`foglalasid`),
  ADD KEY `foglalas_user_felhasznaloid_foreign` (`user_felhasznaloid`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  ADD PRIMARY KEY (`szolgaltatasid`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`felhasznaloid`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `foglalas`
--
ALTER TABLE `foglalas`
  MODIFY `foglalasid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  MODIFY `szolgaltatasid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `felhasznaloid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `foglalas`
--
ALTER TABLE `foglalas`
  ADD CONSTRAINT `foglalas_user_felhasznaloid_foreign` FOREIGN KEY (`user_felhasznaloid`) REFERENCES `users` (`felhasznaloid`) ON DELETE CASCADE;

--
-- Megkötések a táblához `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`felhasznaloid`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
