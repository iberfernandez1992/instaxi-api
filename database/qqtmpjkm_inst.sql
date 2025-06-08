-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-06-2025 a las 14:59:31
-- Versión del servidor: 10.6.21-MariaDB-cll-lve
-- Versión de PHP: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `qqtmpjkm_inst`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direction_riders`
--

CREATE TABLE `direction_riders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `id_rider` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direction_riders`
--

INSERT INTO `direction_riders` (`id`, `nombre`, `direccion`, `lat`, `lng`, `id_rider`, `created_at`, `updated_at`) VALUES
(3, 'Casa de Iber', 'HRCX+6Q2, Diego Quic, Cochabamba, Bolivia', -17.4293701, -66.1505891, 11, '2025-05-31 01:37:47', '2025-05-31 01:37:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_24_220505_create_services_table', 2),
(6, '2025_05_24_221904_create_service_categories_table', 2),
(7, '2025_05_24_233901_create_vehicle_types_table', 2),
(8, '2025_05_25_080411_create_vehicle_information_table', 3),
(9, '2025_05_26_030039_create_vehicle_galeries_table', 3),
(10, '2025_05_26_192717_add_service_columns_to_users_table', 3),
(11, '2025_05_28_201409_create_zonas_table', 4),
(12, '2025_05_29_035008_create_settings_table', 5),
(13, '2025_05_30_141812_create_direction_riders_table', 6),
(14, '2025_05_31_220449_create_notifications_custom_table', 7),
(15, '2025_06_01_221637_create_ride_requests_table', 8),
(16, '2025_06_02_004855_create_ride_request_notifications_table', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `data`, `name`, `created_at`, `updated_at`) VALUES
(21, NULL, 'driver', 'dasdasda', 'dsadsa', '2025-06-03 02:47:32', '2025-06-03 02:47:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'apptoken', 'c97fa51024a3582a7ddf0ddf8cfc252afb3f485f204b87de3cd16b2826b25bd6', '[\"*\"]', NULL, NULL, '2025-05-23 23:43:43', '2025-05-23 23:43:43'),
(2, 'App\\Models\\User', 1, 'apptoken', '0aaf46ee078e837364b59e86e335e961f7406b370bd471b13d2859d8eba73ca3', '[\"*\"]', NULL, NULL, '2025-05-23 23:44:06', '2025-05-23 23:44:06'),
(3, 'App\\Models\\User', 1, 'apptoken', '9108e4cadf435e9f20ef4d287e14e9f088caf91bf624d2eae09e61c94fd4ca79', '[\"*\"]', '2025-05-23 23:50:51', NULL, '2025-05-23 23:47:21', '2025-05-23 23:50:51'),
(4, 'App\\Models\\User', 1, 'apptoken', '8607b2105634d5d141086812e49fd8f7e0e6b74093b4e757b5da8e264ffbab38', '[\"*\"]', '2025-06-08 06:15:36', NULL, '2025-05-23 23:51:10', '2025-06-08 06:15:36'),
(5, 'App\\Models\\User', 2, 'apptoken', 'd3491968f22b53121539bd0ab1796cb4019826c361784bad75c5599482391783', '[\"*\"]', NULL, NULL, '2025-05-23 23:57:45', '2025-05-23 23:57:45'),
(6, 'App\\Models\\User', 3, 'apptoken', '695dc78f637ac32e37dde40374112cfdd4765fcaa1179f3f27204a076195e08b', '[\"*\"]', NULL, NULL, '2025-05-23 23:58:01', '2025-05-23 23:58:01'),
(7, 'App\\Models\\User', 4, 'apptoken', 'bc650a5d615edd2d59d206598af4eb66be603a5e2bff377843b9528c52c04eef', '[\"*\"]', NULL, NULL, '2025-05-23 23:58:26', '2025-05-23 23:58:26'),
(8, 'App\\Models\\User', 5, 'apptoken', 'b0fd3e3016afac81bd0faeeae0edebe233f1e9e25e2619a0bb196b32bceaf74a', '[\"*\"]', NULL, NULL, '2025-05-23 23:58:37', '2025-05-23 23:58:37'),
(9, 'App\\Models\\User', 6, 'apptoken', 'f2c9e97bbf504fea811e402cdf86718011c8702cc693d748b7c79351e8afa314', '[\"*\"]', NULL, NULL, '2025-05-23 23:59:47', '2025-05-23 23:59:47'),
(10, 'App\\Models\\User', 1, 'apptoken', '0aa60ebfe99af5b89589d77044cba404c4e907e7b0662c228d8dfc5fe6b3c3a5', '[\"*\"]', NULL, NULL, '2025-05-24 01:20:57', '2025-05-24 01:20:57'),
(11, 'App\\Models\\User', 1, 'apptoken', '1291003c790dfc500eb565bd407c67afd3a45887a01c65f0921a8e69c461b4b6', '[\"*\"]', '2025-06-02 05:21:12', NULL, '2025-05-24 09:54:40', '2025-06-02 05:21:12'),
(12, 'App\\Models\\User', 7, 'apptoken', '3ad0a9d65cd2836f680fbe79852da845bd7fa1fb054a56d0832b423905bd2ad4', '[\"*\"]', NULL, NULL, '2025-05-27 02:27:17', '2025-05-27 02:27:17'),
(13, 'App\\Models\\User', 8, 'apptoken', 'd29c5fe66540677ff7caaa358564c39ef3d684d8e5c71afb7575a314af9af418', '[\"*\"]', NULL, NULL, '2025-05-27 02:32:25', '2025-05-27 02:32:25'),
(14, 'App\\Models\\User', 9, 'apptoken', 'a918878b4e8844630d5059873d158c1cccb5fa901f4617f3e5066d1447067349', '[\"*\"]', NULL, NULL, '2025-05-27 02:36:44', '2025-05-27 02:36:44'),
(15, 'App\\Models\\User', 10, 'apptoken', 'da11a3861079fedde386c95c22795e850a4584e4e25ed42a71b213e0fd6fd119', '[\"*\"]', NULL, NULL, '2025-05-27 02:53:59', '2025-05-27 02:53:59'),
(16, 'App\\Models\\User', 1, 'apptoken', '78cc964426d5661da30a754cdb7ed4ad691615b1f962ecfe8be4c31405e6cc81', '[\"*\"]', '2025-06-08 06:33:03', NULL, '2025-05-28 01:53:44', '2025-06-08 06:33:03'),
(17, 'App\\Models\\User', 2, 'apptoken', 'f38a6918cafd359b9ada49ddf4fab8e0a01a9868a5e44dd630258487b5033f18', '[\"*\"]', '2025-05-29 23:23:26', NULL, '2025-05-29 10:20:47', '2025-05-29 23:23:26'),
(18, 'App\\Models\\User', 11, 'apptoken', '018917efb7721b1d0cd55719319d11b98680367e5721188f3d60c0390e10742d', '[\"*\"]', '2025-05-29 19:32:15', NULL, '2025-05-29 19:32:07', '2025-05-29 19:32:15'),
(19, 'App\\Models\\User', 11, 'apptoken', 'ccb16cf66a9de8ddf1b20c2ed010ecda6f8d19b0ba636c11c41d7a4d03c009f6', '[\"*\"]', '2025-05-29 23:02:08', NULL, '2025-05-29 23:01:17', '2025-05-29 23:02:08'),
(20, 'App\\Models\\User', 12, 'apptoken', 'a6e90a2ccb958d16c1230bccda1da895de951dcca6c2f8b772d1ef44b6332819', '[\"*\"]', '2025-05-29 23:21:38', NULL, '2025-05-29 23:21:37', '2025-05-29 23:21:38'),
(21, 'App\\Models\\User', 13, 'apptoken', '442d3137381d77dfa01a85881c0417ef84999418ce06372f953202a2db91bdb5', '[\"*\"]', '2025-05-30 07:20:08', NULL, '2025-05-29 23:27:03', '2025-05-30 07:20:08'),
(22, 'App\\Models\\User', 11, 'apptoken', 'b4823bcac05ae6160618fadba1a32231d5fc5eca0b86452a5f7a211cb7b0161f', '[\"*\"]', '2025-05-31 00:09:33', NULL, '2025-05-29 23:28:56', '2025-05-31 00:09:33'),
(23, 'App\\Models\\User', 11, 'apptoken', '2ede193bcf0e42ac67dce5e3fde543f1b80e4cb4137ea11ce875720e55d55719', '[\"*\"]', '2025-05-31 00:10:35', NULL, '2025-05-31 00:10:01', '2025-05-31 00:10:35'),
(24, 'App\\Models\\User', 11, 'apptoken', 'ad7c538010e221e56cd7eb3a94a7b0436e94d6fe358c87d1c50d25e5979a8fdb', '[\"*\"]', '2025-06-02 04:18:24', NULL, '2025-05-31 00:10:48', '2025-06-02 04:18:24'),
(25, 'App\\Models\\User', 1, 'apptoken', 'b4cd6cfde8dcf65a4f442efdbaf134f6fdf190d3d2f9934ece81fef499cdc94c', '[\"*\"]', '2025-06-06 06:34:36', NULL, '2025-05-31 02:59:20', '2025-06-06 06:34:36'),
(26, 'App\\Models\\User', 1, 'apptoken', 'e0abdaf0fd52ac1c20b2ffd690c029f827d44de287a53c46a7a0b1eab6815bb2', '[\"*\"]', '2025-05-31 03:48:15', NULL, '2025-05-31 03:29:11', '2025-05-31 03:48:15'),
(27, 'App\\Models\\User', 11, 'apptoken', 'dcabc965c8d76b33d96fd390105fa9da9cc3316ae370d11828e9fa1aff86cb0d', '[\"*\"]', '2025-06-01 06:37:24', NULL, '2025-06-01 05:54:52', '2025-06-01 06:37:24'),
(28, 'App\\Models\\User', 11, 'apptoken', 'dcdc7208482bc29a50d9a6ac9ed8af718d11a08856829db49c5e16cc16e4aa52', '[\"*\"]', '2025-06-01 07:36:46', NULL, '2025-06-01 06:38:01', '2025-06-01 07:36:46'),
(29, 'App\\Models\\User', 1, 'apptoken', 'f2c06b3dbdd31a1e4a729517d5225c07128222361c9101a1b7464b7b68ff24a0', '[\"*\"]', '2025-06-06 06:35:54', NULL, '2025-06-02 17:29:24', '2025-06-06 06:35:54'),
(30, 'App\\Models\\User', 11, 'apptoken', 'a61c747ac0df9a071f90fd9afabfd57a15a426578b342a43bde7084ad7ed4a7e', '[\"*\"]', '2025-06-03 06:15:07', NULL, '2025-06-02 17:34:10', '2025-06-03 06:15:07'),
(31, 'App\\Models\\User', 4, 'apptoken', '646d9138927bec604b994db04fc1f34261b22d47205debc65b82438ea4d67fa9', '[\"*\"]', '2025-06-05 18:03:47', NULL, '2025-06-03 02:05:09', '2025-06-05 18:03:47'),
(32, 'App\\Models\\User', 4, 'apptoken', '54a8118f01dc657747201383bf8ca36604e1adcddf1b0e4b69b4059f8a21d6ef', '[\"*\"]', '2025-06-03 02:09:19', NULL, '2025-06-03 02:07:34', '2025-06-03 02:09:19'),
(33, 'App\\Models\\User', 11, 'apptoken', '631474fcd3971ee23f673dfe3382689af38b36fccf03e9ee4bf06b05e5bd2f8e', '[\"*\"]', '2025-06-03 02:52:49', NULL, '2025-06-03 02:19:06', '2025-06-03 02:52:49'),
(34, 'App\\Models\\User', 4, 'apptoken', '43009afbe2cf81a5bc32ec21302667d5d953a5b0a8e152794b82002a2e1b5bc9', '[\"*\"]', '2025-06-03 06:03:22', NULL, '2025-06-03 02:27:20', '2025-06-03 06:03:22'),
(35, 'App\\Models\\User', 11, 'apptoken', '79077afce928790dffeca0a65a88020d3bbcf0a3103521e7b020b0080496518e', '[\"*\"]', '2025-06-03 06:16:30', NULL, '2025-06-03 06:16:23', '2025-06-03 06:16:30'),
(36, 'App\\Models\\User', 11, 'apptoken', 'e10f6615d69151044729403760802b8f426d5a043242f3282a6e96d9f5bd81ed', '[\"*\"]', '2025-06-08 06:37:08', NULL, '2025-06-06 02:07:02', '2025-06-08 06:37:08'),
(37, 'App\\Models\\User', 1, 'apptoken', 'dcafe328bdcb66cade8d7da3796e18b4283818ae09b10dd47fb9ad3dd9171d65', '[\"*\"]', NULL, NULL, '2025-06-06 06:56:12', '2025-06-06 06:56:12'),
(38, 'App\\Models\\User', 1, 'apptoken', 'b128439a01216481f9307d13b480f7a6c298ed290102f9df07c10d56237af509', '[\"*\"]', '2025-06-06 07:20:03', NULL, '2025-06-06 06:56:13', '2025-06-06 07:20:03'),
(39, 'App\\Models\\User', 1, 'apptoken', 'fcdebbbbfb92fb87c7033c29dcccf1ed11b99de3be389b59521bda78fe6c7270', '[\"*\"]', '2025-06-08 06:36:47', NULL, '2025-06-06 07:25:03', '2025-06-08 06:36:47'),
(40, 'App\\Models\\User', 1, 'apptoken', 'f8856ec88b97bf5e55f45e4dfa077b2b913b29bbbc7a87fc98ac1687c0151e37', '[\"*\"]', '2025-06-08 06:34:34', NULL, '2025-06-08 06:34:15', '2025-06-08 06:34:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ride_requests`
--

CREATE TABLE `ride_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rider_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `locations` longtext DEFAULT NULL,
  `location_coordinates` longtext DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `distance` varchar(255) DEFAULT NULL,
  `distance_unit` varchar(255) DEFAULT NULL,
  `ride_fare` double DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `status` enum('pending','accepted','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ride_requests`
--

INSERT INTO `ride_requests` (`id`, `rider_id`, `service_id`, `vehicle_type_id`, `service_category_id`, `locations`, `location_coordinates`, `duration`, `distance`, `distance_unit`, `ride_fare`, `description`, `start_time`, `end_time`, `status`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 1, 4, 6, '[\"HV64+29F, Av. Petrolera, Cochabamba, Bolivia\",\"Plaza Tika, Tika 30, Cochabamba, Bolivia\"]', '[{\"lat\":-17.440010000000000900399754755198955535888671875,\"lng\":-66.1437760000000025684130378067493438720703125},{\"lat\":-17.3700508867930665246603894047439098358154296875,\"lng\":-66.1773056354101214537877240218222141265869140625}]', 'Duración estimada: 26 minutos', '11', 'km', 35, 'Recoger paquete en la tienda y entregarlo al cliente.', '2025-06-02 00:18:02', NULL, 'pending', 11, '2025-06-02 04:18:24', '2025-06-02 04:18:24', NULL),
(2, 11, 1, 1, 6, '[\"HV64+8Q6, Cochabamba, Bolivia\",\"HQWR+85H, Cochabamba, Bolivia\"]', '[{\"lat\":-17.438887376676003526654312736354768276214599609375,\"lng\":-66.1438452181492948511731810867786407470703125},{\"lat\":-17.404317992442098983474352280609309673309326171875,\"lng\":-66.20833849322303876760997809469699859619140625}]', 'Duración estimada: 25 minutos', '12.2', 'km', 30, 'Recoger paquete en la tienda y entregarlo al cliente.', '2025-06-02 13:36:20', NULL, 'pending', 11, '2025-06-02 17:38:39', '2025-06-02 17:38:39', NULL),
(4, 11, 1, 1, 6, '[\"HV64+8Q6, Cochabamba, Bolivia\",\"Av. Capit\\u00e1n V\\u00edctor Ust\\u00e1riz 1583, Cochabamba, Bolivia\"]', '[{\"lat\":-17.4394357076190544830751605331897735595703125,\"lng\":-66.142691725796112223179079592227935791015625},{\"lat\":-17.39670682221474606876654434017837047576904296875,\"lng\":-66.1739362165989035702295950613915920257568359375}]', 'Duración estimada: 17 minutos', '7', 'km', 20, 'Recoger paquete en la tienda y entregarlo al cliente.', '2025-06-02 22:51:52', NULL, 'pending', 11, '2025-06-03 02:53:56', '2025-06-03 02:53:56', NULL),
(8, 11, 1, 4, 6, '[\"HV64+29F, Av. Petrolera, Cochabamba, Bolivia\",\"HRXF+GPQ, Av. Chaco, Cochabamba, Bolivia\"]', '[{\"lat\":-17.43977699999999941837813821621239185333251953125,\"lng\":-66.143585000000001627995516173541545867919921875},{\"lat\":-17.400733466065897658836547634564340114593505859375,\"lng\":-66.17513568428825010414584539830684661865234375}]', 'Duración estimada: 15 minutos', '6.3', 'km', 15, 'Recoger paquete en la tienda y entregarlo al cliente.', '2025-06-02 23:26:21', NULL, 'pending', 11, '2025-06-03 03:43:20', '2025-06-03 03:43:20', NULL),
(9, 11, 1, 2, 6, '[\"HV64+29F, Av. Petrolera, Cochabamba, Bolivia\",\"Manuela Ferrufino 0265, Cochabamba, Bolivia\"]', '[{\"lat\":-17.439963999999999799683791934512555599212646484375,\"lng\":-66.143730000000005020410753786563873291015625},{\"lat\":-17.415938490519028647440791246481239795684814453125,\"lng\":-66.156327730674320264370180666446685791015625}]', 'Duración estimada: 7 minutos', '3.3', 'km', 10, 'Recoger paquete en la tienda y entregarlo al cliente.', '2025-06-03 01:54:27', NULL, 'pending', 11, '2025-06-03 06:02:22', '2025-06-03 06:02:22', NULL),
(10, 11, 1, 2, 6, '[\"HV64+29F, Av. Petrolera, Cochabamba, Bolivia\",\"Manuela Ferrufino 0265, Cochabamba, Bolivia\"]', '[{\"lat\":-17.439963999999999799683791934512555599212646484375,\"lng\":-66.143730000000005020410753786563873291015625},{\"lat\":-17.415938490519028647440791246481239795684814453125,\"lng\":-66.156327730674320264370180666446685791015625}]', 'Duración estimada: 7 minutos', '3.3', 'km', 10, 'Recoger paquete en la tienda y entregarlo al cliente.', '2025-06-03 01:54:27', NULL, 'pending', 11, '2025-06-03 06:03:43', '2025-06-03 06:03:43', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ride_request_notifications`
--

CREATE TABLE `ride_request_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ride_request_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected','expired','offered') NOT NULL DEFAULT 'pending',
  `notified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `responded_at` timestamp NULL DEFAULT NULL,
  `response_time_sec` int(11) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `fcm_token_snapshot` text DEFAULT NULL,
  `price_offer` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ride_request_notifications`
--

INSERT INTO `ride_request_notifications` (`id`, `ride_request_id`, `driver_id`, `status`, `notified_at`, `responded_at`, `response_time_sec`, `device_type`, `fcm_token_snapshot`, `price_offer`, `created_at`, `updated_at`) VALUES
(3, 10, 4, 'accepted', '2025-06-08 02:18:25', NULL, NULL, NULL, 'dmsO9d6WSsqDG_sCPKOucA:APA91bFoH9fKHPu1bh1AJPEqWFMowXpkocHsC6_UWkZN0EKSHp0xdI84p3iRuvx4z6jllVyCRX8lEhbTp6s9EWLb2ka2NkceiC8BzuXEaNHJFwZoFx2EHPg', 20.00, '2025-06-03 06:03:44', '2025-06-03 06:03:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `service_image` varchar(255) DEFAULT NULL,
  `service_icon` varchar(255) DEFAULT NULL,
  `type` enum('taxi','paqueteria') NOT NULL DEFAULT 'taxi',
  `status` int(11) NOT NULL DEFAULT 1,
  `is_primary` int(11) NOT NULL DEFAULT 0,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `description`, `service_image`, `service_icon`, `type`, `status`, `is_primary`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Taxi', 'taxi', 'TAXI', 'services/images/u0rzFEpvlVba24NfcvSdZWne41sHxqgdFbjNHBri.png', 'services/icons/JKym5RfacgeANuJqhwAGsfmzqfDGtYAz5Cl1hCZq.png', 'taxi', 1, 1, NULL, '2025-05-25 05:23:53', '2025-05-29 10:25:19', NULL),
(2, 'Paqueteria', 'paqueteria', 'ddfsfs', NULL, NULL, 'paqueteria', 1, 1, NULL, '2025-05-25 05:26:04', '2025-05-25 07:45:49', '2025-05-25 07:45:49'),
(3, 'Paqueteria', 'paqueteria', 'dsadsadsad', 'services/images/eWyaFLrAdzzTNQ9bz59WVxTIY9jaXKN8yCQWYgh0.png', 'services/icons/MUoksnjtrWqe9fvyk9cYyuLik2wSoxdSVWSKiB4x.png', 'taxi', 1, 1, NULL, '2025-05-25 05:31:16', '2025-05-25 06:41:08', '2025-05-25 06:41:08'),
(4, 'test', 'test', 'dsadasda', NULL, NULL, 'taxi', 1, 0, NULL, '2025-05-25 07:37:04', '2025-05-25 07:37:50', '2025-05-25 07:37:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `service_category_image_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `slug`, `type`, `service_id`, `description`, `service_category_image_id`, `status`, `created_by_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sdadsa', 'sdadsa', NULL, 1, 'dasdadsa', 'service_category_images/JvvU01yxy9S8uaDYbMJQGBrsibB4YSBTCz966Kfa.png', 1, NULL, '2025-05-25 07:38:18', '2025-05-25 07:46:41', '2025-05-25 07:46:41'),
(2, 'dsadsad', 'dsadsad', NULL, 1, 'sadsadsad', NULL, 1, NULL, '2025-05-25 07:42:36', '2025-05-25 07:46:34', '2025-05-25 07:46:34'),
(3, 'dsadsad', 'dsadsad', NULL, 1, 'asdasdsa', NULL, 1, NULL, '2025-05-25 07:46:52', '2025-05-25 07:49:29', '2025-05-25 07:49:29'),
(4, 'dasdad', 'dasdad', NULL, 1, 'adadsa', NULL, 1, NULL, '2025-05-25 07:49:41', '2025-05-25 07:51:15', '2025-05-25 07:51:15'),
(5, 'dsadsad', 'dsadsad', NULL, 1, 'sadsadas', 'service_category_images/ozXS8m1LPPoqTI3TRxa6ml5IJMSjKzxUPJGIPARE.png', 1, NULL, '2025-05-25 07:51:02', '2025-05-25 07:51:11', '2025-05-25 07:51:11'),
(6, 'Carrera Rapida', 'carrera-rapida', NULL, 1, 'Viaje', 'service_category_images/KiO8OdGK9VsAR2iIt7SsnR5GijNVyFaRkSC9LDYU.png', 1, NULL, '2025-05-25 07:52:00', '2025-05-29 10:36:21', NULL),
(7, 'Provincia', 'provincia', NULL, 1, 'inter', 'service_category_images/qZhWePTBBWOpXLGlOtdIrR3FU3HRLg159wgJeSAc.png', 1, NULL, '2025-05-25 07:52:27', '2025-05-29 18:33:26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `values` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `values`, `created_at`, `updated_at`) VALUES
(1, '{\"aceptar_rechazar\":30,\"cupon\":true,\"radio_medidor\":5000,\"radio_segundos\":200}', '2025-05-29 08:35:25', '2025-05-29 08:35:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image_id` bigint(20) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `role` varchar(255) DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_online` int(11) NOT NULL DEFAULT 0,
  `is_on_ride` int(11) NOT NULL DEFAULT 0,
  `location` longtext DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `country_code`, `phone`, `password`, `profile_image_id`, `is_verified`, `status`, `role`, `referral_code`, `fcm_token`, `lat`, `lng`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `is_online`, `is_on_ride`, `location`, `service_id`, `service_category_id`) VALUES
(1, 'Nuevo Nombre', 'nuevo_username', 'juan@example.com', NULL, '52', '1234567890', '$2y$12$IE8kDKcPEP4FsxLze156IeCk324InIPchyd9qHXrLVwoOws94K3a2', 10, 0, 1, 'admin', NULL, 'token_de_firebase', NULL, NULL, NULL, NULL, '2025-05-23 23:43:43', '2025-05-23 23:53:52', 0, 0, '{\"lat\":19.4326,\"lng\":-99.1332}', NULL, NULL),
(2, 'Juan Pérez 2', 'juan123', 'juan2@example.com', NULL, '+591', '70000000', '$2y$12$CXPlGTR2YYquaMcQ5cx8ietoE1bTswCE4.gpWUuHgdQSeBfihJtoe', NULL, 0, 1, 'rider', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-23 23:57:45', '2025-05-27 02:56:37', 0, 0, NULL, NULL, NULL),
(3, 'Juan Pérez 3', 'juan1233', 'juan3@example.com', NULL, '+591', '74500000', '$2y$12$yhydwuzFKOG0V27eXIUsRer39uxpgDOU3D6ta/gT9nReS81q.9THa', NULL, 0, 1, 'rider', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-23 23:58:01', '2025-05-27 02:56:41', 0, 0, NULL, NULL, NULL),
(4, 'Juan Pérez 4', 'juan1234', 'juan4@example.com', NULL, '+591', '70330000', '$2y$12$Q/VbL5585cJxsCYNPnxzUuMtwfWI3UUt3eQCD44qQ1DaCMdxEmCi6', NULL, 1, 1, 'driver', NULL, 'dmsO9d6WSsqDG_sCPKOucA:APA91bFoH9fKHPu1bh1AJPEqWFMowXpkocHsC6_UWkZN0EKSHp0xdI84p3iRuvx4z6jllVyCRX8lEhbTp6s9EWLb2ka2NkceiC8BzuXEaNHJFwZoFx2EHPg', -17.43996400, -66.14373000, NULL, NULL, '2025-05-23 23:58:26', '2025-06-06 07:28:04', 1, 0, NULL, NULL, NULL),
(5, 'Juan Pérez 5', 'juan1534', 'juan5@example.com', NULL, '+591', '70000000', '$2y$12$SyxQfFEOx7AyOlHmkCf0GebB5sAX.bWyNPNBNspLL6NQ2WKWJ9gF6', NULL, 0, 1, 'driver', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-23 23:58:37', '2025-05-24 22:31:04', 0, 0, NULL, NULL, NULL),
(10, 'Ilka Natala Torrico Villarroel', 'ilkita', 'ilka@gmail.com', NULL, NULL, '78337840', '$2y$12$vHfWtIGvWKpDcgZWncug.eVUqtDfQUcfGmUx3PqvNkAxXXywPiuf2', NULL, 1, 1, 'driver', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-27 02:53:59', '2025-05-27 02:57:56', 0, 0, NULL, 1, NULL),
(11, 'Iber Arnol Fernandez Mercado', 'ibersito', 'iber.fernandez1992@gmail.com', NULL, '+591', '76499880', '$2y$12$Lg5/NkUnC7lVkLRuIlQh..m/akbkLnTd5XhFt/2ZHcSTP03MEvCXy', 0, 0, 1, 'rider', NULL, 'eOF7rF6WS_Ok_TWNXnyxJX:APA91bFSuMj-f7UxB02BHajxwxr3g-H_3GYmn9PcJfCBS5NYmoCjYu66ntV3aBG1R-cnffQZyMc4q83G5RyT0vc7HRglJHruw3o6I88PuScUGFxemso5vfI', -17.43996400, -66.14373000, NULL, NULL, '2025-05-29 19:32:07', '2025-06-08 06:37:07', 0, 0, NULL, NULL, NULL),
(12, 'prueba', 'prueba', 'pruebita123@gmail.com', NULL, '+591', '75215544', '$2y$12$ozlPGoH0FJLuSNh/r2Mey.rss2416kyZ/TgyZ9RChZLCBHIfYNVnO', NULL, 0, 1, 'rider', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-29 23:21:37', '2025-05-29 23:21:37', 0, 0, NULL, NULL, NULL),
(13, 'jzjsjdjj', 'jsjsjsj', 'hdhd@gmail.com', NULL, '+591', '75820202', '$2y$12$2AVkm4ujxSKcdYeWSjBXQu6PTNjf.CjnuZJxej/UVY3biuYwSINtu', NULL, 0, 1, 'rider', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-29 23:27:03', '2025-05-29 23:27:03', 0, 0, '[{\"lat\":-17.44144144144144092933856882154941558837890625,\"lng\":-66.158850601218119891200331039726734161376953125}]', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle_galeries`
--

CREATE TABLE `vehicle_galeries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `soat_photo` varchar(255) DEFAULT NULL,
  `ci_photo` varchar(255) DEFAULT NULL,
  `address_voucher_photo` varchar(255) DEFAULT NULL,
  `matricula_photo` varchar(255) DEFAULT NULL,
  `driver_license_photo` varchar(255) DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id_vehicle` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle_information`
--

CREATE TABLE `vehicle_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `amb_per_dist_fees` double DEFAULT NULL,
  `plate_number` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `vehicle_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehicle_information`
--

INSERT INTO `vehicle_information` (`id`, `name`, `description`, `amb_per_dist_fees`, `plate_number`, `color`, `model`, `seat`, `vehicle_type_id`, `driver_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Nissan', 'djklsajdkla', 2, 'klsaj', 'djklsa', 'djsakl', 3, 1, NULL, '2025-05-27 02:54:00', '2025-05-27 02:54:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `service_category_id` int(10) UNSIGNED DEFAULT NULL,
  `vehicle_image` varchar(255) DEFAULT NULL,
  `vehicle_map_icon` varchar(255) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `name`, `service_id`, `service_category_id`, `vehicle_image`, `vehicle_map_icon`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Automovil', 1, 6, 'vehicle_images/dBsQK5QBQyeun1C1Jm5BRc98ASOm7h8GHj03OLYJ.png', 'vehicle_map_icons/V3V2ZKGhixma1wx1yZE0xPDac7dw2vJBK6Cdq5vu.png', 'automovil', 1, '2025-05-25 11:30:46', '2025-05-30 08:23:17', NULL),
(2, 'Motocicleta', 1, 6, 'vehicle_images/Dm0evmvgNUHPJBh3v8SQEeoQC0hgNNUOQ9S6vyyC.png', 'vehicle_map_icons/n2088Dfla4URBl13NoO29c4wei09xT8tNuJYh7Un.png', 'motocicleta', 1, '2025-05-25 11:50:29', '2025-05-30 08:23:28', NULL),
(3, 'dasdassa', 1, 7, 'vehicle_images/LHzsWiy7mcjOWIpYl2trgcYpkk11jqS1VuKoitOw.png', 'vehicle_map_icons/4AGiP2LH6qXQ8ldz2ZkkexHcQhJElPtodUNBqSnE.png', 'dasdassa', 0, '2025-05-25 11:58:02', '2025-05-25 11:59:03', '2025-05-25 11:59:03'),
(4, 'Vagoneta', 1, 6, 'vehicle_images/JSrgV66fXKKjHKAmRmnfDj0ZsZsbkfGeYMLBMuU0.png', 'vehicle_map_icons/PnGKLEkdaVwsuhQUaR7Fsz9BpVaAD0xPiheXzMFo.png', 'vagoneta', 1, '2025-05-30 08:36:15', '2025-05-30 08:36:15', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `place_points` geometry DEFAULT NULL,
  `locations` longtext DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1,
  `distance_type` enum('mile','km') NOT NULL DEFAULT 'mile',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `name`, `place_points`, `locations`, `amount`, `status`, `distance_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Oruro', 0x000000000103000000010000000e000000cda1a755afc750c00df0a5ccceee31c0cda1a795bac750c0b3b4b1a5fff531c0cda1a7b57cc750c043a95537e1f731c0cda1a7d5c5c750c0b32057c903fb31c0cda1a7e500c850c0fe00a58025fd31c0cda1a7351ac850c0473ead473d0032c0cda1a70569c750c0a26f3696c7ff31c0cda1a7a5bac650c057fa80c8070032c0cda1a76582c650c080a2d6cc5bfe31c0cda1a7f5f2c550c0fd83063019fb31c0cda1a755edc550c033c7ac1e5ff531c0cda1a7e56bc650c0182c72791bf131c0cda1a7d5e4c650c0e321ca776eee31c0cda1a755afc750c00df0a5ccceee31c0, '[{\"lat\":-17.932843008529790296279315953142940998077392578125,\"lng\":-67.1200765740424714067557943053543567657470703125},{\"lat\":-17.960932117352694348255681688897311687469482421875,\"lng\":-67.1207632195502839067557943053543567657470703125},{\"lat\":-17.968280275739072493479397962801158428192138671875,\"lng\":-67.1169866692573151567557943053543567657470703125},{\"lat\":-17.980526527186793117607521708123385906219482421875,\"lng\":-67.1214498650580964067557943053543567657470703125},{\"lat\":-17.98885349300780234216290409676730632781982421875,\"lng\":-67.1250547539741120317557943053543567657470703125},{\"lat\":-18.000935058398933819034937187097966670989990234375,\"lng\":-67.1265997063666901567557943053543567657470703125},{\"lat\":-17.99913920239453801741547067649662494659423828125,\"lng\":-67.1157850396186432817557943053543567657470703125},{\"lat\":-18.000118762482397727353600203059613704681396484375,\"lng\":-67.1051420342475495317557943053543567657470703125},{\"lat\":-17.99358825912577231065370142459869384765625,\"lng\":-67.1017088067084870317557943053543567657470703125},{\"lat\":-17.980853082266538223166207899339497089385986328125,\"lng\":-67.0929540764838776567557943053543567657470703125},{\"lat\":-17.958482663328322104234757716767489910125732421875,\"lng\":-67.0926107537299714067557943053543567657470703125},{\"lat\":-17.941825476049501730813062749803066253662109375,\"lng\":-67.1003355156928620317557943053543567657470703125},{\"lat\":-17.931373106812213080729634384624660015106201171875,\"lng\":-67.1077169549018464067557943053543567657470703125}]', 2.00, 1, 'km', '2025-05-31 03:05:15', '2025-05-31 03:05:15', NULL),
(11, 'Cochabamba', 0x0000000001030000000100000008000000006d0b74728a50c09f46ae7ac15931c0006d0bf4ed8e50c0b2f792f2135831c0006d0b743f9050c0f2f651c57f6531c0006d0b74158d50c0f4b76a53866931c0006d0bf4d48950c0d605febfed7431c0006d0bf4128850c047c4586bf27731c0006d0bf45e8750c0d7b3c300d46431c0006d0b74728a50c09f46ae7ac15931c0, '[{\"lat\":-17.350608508632486604028599685989320278167724609375,\"lng\":-66.16323567500876379199326038360595703125},{\"lat\":-17.34405437553477469236895558424293994903564453125,\"lng\":-66.23327351680563879199326038360595703125},{\"lat\":-17.39648087740983584126297500915825366973876953125,\"lng\":-66.25387288204001379199326038360595703125},{\"lat\":-17.4122058997672439772941288538277149200439453125,\"lng\":-66.20443440547751379199326038360595703125},{\"lat\":-17.45675277663925584192838869057595729827880859375,\"lng\":-66.15362263789938879199326038360595703125},{\"lat\":-17.468542775317725812556091113947331905364990234375,\"lng\":-66.12615681758688879199326038360595703125},{\"lat\":-17.393859908846788897562873899005353450775146484375,\"lng\":-66.11517048946188879199326038360595703125}]', 3.50, 1, 'km', '2025-06-02 01:02:08', '2025-06-08 06:34:34', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `direction_riders`
--
ALTER TABLE `direction_riders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direction_riders_id_rider_foreign` (`id_rider`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `ride_requests`
--
ALTER TABLE `ride_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_requests_rider_id_index` (`rider_id`),
  ADD KEY `ride_requests_service_id_index` (`service_id`),
  ADD KEY `ride_requests_vehicle_type_id_index` (`vehicle_type_id`),
  ADD KEY `ride_requests_service_category_id_index` (`service_category_id`),
  ADD KEY `ride_requests_created_by_id_index` (`created_by_id`);

--
-- Indices de la tabla `ride_request_notifications`
--
ALTER TABLE `ride_request_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_request_notifications_ride_request_id_foreign` (`ride_request_id`),
  ADD KEY `ride_request_notifications_driver_id_foreign` (`driver_id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_categories_created_by_id_index` (`created_by_id`),
  ADD KEY `service_categories_service_category_image_id_index` (`service_category_image_id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_referral_code_index` (`referral_code`),
  ADD KEY `users_service_id_index` (`service_id`),
  ADD KEY `users_service_category_id_index` (`service_category_id`);

--
-- Indices de la tabla `vehicle_galeries`
--
ALTER TABLE `vehicle_galeries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_galeries_driver_id_foreign` (`driver_id`),
  ADD KEY `vehicle_galeries_id_vehicle_foreign` (`id_vehicle`);

--
-- Indices de la tabla `vehicle_information`
--
ALTER TABLE `vehicle_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_information_vehicle_type_id_foreign` (`vehicle_type_id`),
  ADD KEY `vehicle_information_driver_id_foreign` (`driver_id`);

--
-- Indices de la tabla `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_types_slug_index` (`slug`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zonas_name_index` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `direction_riders`
--
ALTER TABLE `direction_riders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `ride_requests`
--
ALTER TABLE `ride_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ride_request_notifications`
--
ALTER TABLE `ride_request_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `vehicle_galeries`
--
ALTER TABLE `vehicle_galeries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vehicle_information`
--
ALTER TABLE `vehicle_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direction_riders`
--
ALTER TABLE `direction_riders`
  ADD CONSTRAINT `direction_riders_id_rider_foreign` FOREIGN KEY (`id_rider`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ride_request_notifications`
--
ALTER TABLE `ride_request_notifications`
  ADD CONSTRAINT `ride_request_notifications_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ride_request_notifications_ride_request_id_foreign` FOREIGN KEY (`ride_request_id`) REFERENCES `ride_requests` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vehicle_galeries`
--
ALTER TABLE `vehicle_galeries`
  ADD CONSTRAINT `vehicle_galeries_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicle_galeries_id_vehicle_foreign` FOREIGN KEY (`id_vehicle`) REFERENCES `vehicle_information` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `vehicle_information`
--
ALTER TABLE `vehicle_information`
  ADD CONSTRAINT `vehicle_information_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicle_information_vehicle_type_id_foreign` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
