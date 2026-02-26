-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 06:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wildtrace`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('wildtrace-cache-2a4fd7f4eac9ac83a80a8aa4645cbca3', 'i:1;', 1769875705),
('wildtrace-cache-2a4fd7f4eac9ac83a80a8aa4645cbca3:timer', 'i:1769875705;', 1769875705),
('wildtrace-cache-b75f2afad277518ce06d6e465ecbe8f1', 'i:1;', 1769791313),
('wildtrace-cache-b75f2afad277518ce06d6e465ecbe8f1:timer', 'i:1769791313;', 1769791313),
('wildtrace-cache-d5f22960eaaee0562a209d6d4013b28d', 'i:1;', 1769634493),
('wildtrace-cache-d5f22960eaaee0562a209d6d4013b28d:timer', 'i:1769634493;', 1769634493);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(191) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_07_135656_add_two_factor_columns_to_users_table', 1),
(5, '2026_01_07_135725_create_personal_access_tokens_table', 1),
(6, '2026_01_08_112000_create_photographers_table', 1),
(7, '2026_01_08_112817_create_products_table', 1),
(8, '2026_01_08_112827_add_is_admin_to_users_table', 1),
(9, '2026_01_13_101119_create_orders_table', 1),
(10, '2026_01_13_101128_create_order_items_table', 1),
(11, '2026_01_14_143611_create_milestones_table', 2),
(12, '2026_01_14_145844_create_favorites_table', 3),
(13, '2026_01_14_145846_create_carts_table', 3),
(14, '2026_01_14_180220_add_address_fields_to_users_table', 4),
(15, '2026_01_14_181237_add_country_code_to_users_table', 5),
(16, '2026_01_16_041900_add_product_id_to_order_items_table', 6),
(17, '2026_01_16_042321_modify_city_column_in_users_table', 7),
(18, '2026_01_16_043130_change_description_to_text_in_products_table', 8),
(19, '2026_01_16_043712_reorganize_users_table_columns', 9),
(20, '2026_01_16_050146_add_product_image_to_order_items_table', 10),
(21, '2026_01_16_052543_add_payment_status_to_orders_table', 11),
(22, '2026_01_17_064137_create_subscribers_table', 12),
(23, '2026_01_28_192425_add_size_to_carts_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `year`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '2018', 'The Beginning', 'Founded by lead photographer Vinsara with a humble exhibition in Colombo, showcasing the untamed beauty of the island.', '2026-01-14 09:07:34', '2026-01-14 09:07:34'),
(2, '2020', 'Global Recognition', 'Featured in National Geographic\'s \"Best of Wildlife\" series for documenting the endangered Snow Leopard.', '2026-01-14 09:07:34', '2026-01-14 09:07:34'),
(3, '2023', 'Trace Foundation', 'Launched our conservation arm, dedicating 10% of all profits to wildlife protection units across Sri Lanka.', '2026-01-14 09:07:34', '2026-01-14 09:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `payment_status` varchar(191) NOT NULL DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `session_id` varchar(191) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `payment_status`, `total_price`, `session_id`, `shipping_address`, `created_at`, `updated_at`) VALUES
(9, 2, 'declined', 'declined', 85.00, 'cs_test_a1Myl2XjLlZNEobuAc4hvOsSbgOXDrwueFTyVFFMCk1itfwygPdryPqYO3', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-28 15:39:22', '2026-01-28 15:47:19'),
(10, 2, 'declined', 'declined', 190.00, 'cs_test_a1kePHNgmGuhIlLWE5zdFXMeo9Kerg96pWAYJZuHGCGcnCtkLLm5Fs0LLE', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-29 00:52:13', '2026-01-30 10:04:10'),
(11, 2, 'declined', 'declined', 140.00, NULL, 'safasf, Saf, 11111', '2026-01-29 00:54:16', '2026-01-30 10:35:17'),
(12, 2, 'declined', 'pending', 910.00, NULL, 'safasf, Saf, 11111', '2026-01-30 10:46:58', '2026-01-30 10:48:49'),
(13, 2, 'declined', 'declined', 525.00, 'cs_test_a1SGh6L1usgokB16wqC0FtszcAPCkNyX9KuLmPMZKfju7e5GwUe1A7Q6r0', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-30 10:47:40', '2026-01-30 10:48:27'),
(14, 2, 'declined', 'pending', 150.00, NULL, 'safasf, Saf, 11111', '2026-01-30 10:49:31', '2026-01-30 11:03:35'),
(15, 2, 'declined', 'declined', 140.00, 'cs_test_a1bHJy0W0TJNlJ1exwiUCMITN9iIk99XC1O2wwgWIiq16RtPgAFaFYEt4p', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-30 10:51:34', '2026-01-30 11:04:44'),
(16, 2, 'declined', 'declined', 385.00, 'cs_test_a1zpBhbZgSuS30x89T6Ss6BiiObqHZOhsThSvpIOy1jCRzYOymSmFdi1kN', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-30 10:54:44', '2026-01-30 11:03:30'),
(17, 2, 'declined', 'declined', 55.00, 'cs_test_a1pMQ97mQ9LZcYCKOYo5G3jqxKTjYOe20LT6Oh2gEVlMH0yjXWpP3zICm9', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-30 10:56:21', '2026-01-30 11:03:26'),
(18, 3, 'declined', 'pending', 130.00, NULL, 'asa, sass, 11111111', '2026-01-30 11:10:06', '2026-01-30 11:11:01'),
(19, 3, 'declined', 'declined', 390.00, NULL, 'asa, sass, 11111111', '2026-01-30 11:32:41', '2026-01-30 11:33:06'),
(20, 2, 'processing', 'paid', 140.00, NULL, 'safasf, Saf, 11111', '2026-01-31 08:10:28', '2026-01-31 08:46:35'),
(21, 2, 'paid', 'confirmed', 150.00, 'cs_test_a1BxgGY8TlcbFs53nbdfCOKdzf0SiRbJvS2QE5vBl6HvgIQ5yA6rS9UbYi', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-31 09:26:51', '2026-01-31 09:27:25'),
(22, 2, 'paid', 'paid', 130.00, NULL, 'safasf, Saf, 11111', '2026-01-31 09:32:23', '2026-01-31 09:32:23'),
(23, 2, 'paid', 'confirmed', 150.00, 'cs_test_a1Mye5pv36Ixr3LszJiwNwZe2SNCvN6dVfIonqDECLVv3PZiLOlkVUNSk5', '{\"full_name\":\"Pavan\",\"email\":\"pavan@gmail.com\",\"address\":\"safasf\",\"city\":\"Saf\",\"contact_number\":\"111111111\",\"postal_code\":\"11111\",\"country\":\"SL\"}', '2026-01-31 10:41:41', '2026-01-31 10:42:10'),
(24, 2, 'paid', 'paid', 140.00, NULL, 'safasf, Saf, 11111', '2026-01-31 11:00:36', '2026-01-31 11:00:36'),
(25, 2, 'paid', 'paid', 55.00, NULL, 'safasf, Saf, 11111', '2026-01-31 11:10:56', '2026-01-31 11:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_image` varchar(191) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_image`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(9, 9, 9, 'Kingfisher Dive (12 x 18 in)', 'http://127.0.0.1:8000/images/product9.jpg', 85.00, 1, '2026-01-28 15:39:22', '2026-01-28 15:39:22'),
(10, 10, 11, 'Sea Turtle Glide (24 x 36 in)', 'http://127.0.0.1:8000/images/product11.jpg', 95.00, 2, '2026-01-29 00:52:13', '2026-01-29 00:52:13'),
(11, 11, 6, 'Red-Eyed Tree Frog', 'http://10.0.2.2:8000/images/product6.jpg', 70.00, 2, '2026-01-29 00:54:16', '2026-01-29 00:54:16'),
(12, 12, 4, 'Blue Morpho Flight', 'http://10.0.2.2:8000/images/product4.jpg', 130.00, 2, '2026-01-30 10:46:58', '2026-01-30 10:46:58'),
(13, 13, 15, 'Baobab Silhouette (40 x 60 in)', 'http://127.0.0.1:8000/images/product15.jpg', 175.00, 3, '2026-01-30 10:47:40', '2026-01-30 10:47:40'),
(14, 14, 3, 'African Lion Monarch', 'http://10.0.2.2:8000/images/product3.jpg', 150.00, 1, '2026-01-30 10:49:31', '2026-01-30 10:49:31'),
(15, 15, 2, 'Clownfish in Anemone (12 x 18 in)', 'http://127.0.0.1:8000/images/product2.jpg', 140.00, 1, '2026-01-30 10:51:34', '2026-01-30 10:51:34'),
(16, 16, 7, 'Orchid of the Mist (40 x 60 in)', 'http://127.0.0.1:8000/images/product7.jpg', 385.00, 1, '2026-01-30 10:54:44', '2026-01-30 10:54:44'),
(17, 17, 5, 'Scarlet Macaw Portrait (12 x 18 in)', 'http://127.0.0.1:8000/images/product5.jpg', 55.00, 1, '2026-01-30 10:56:21', '2026-01-30 10:56:21'),
(18, 18, 4, 'Blue Morpho Flight', 'http://10.0.2.2:8000/images/product4.jpg', 130.00, 1, '2026-01-30 11:10:06', '2026-01-30 11:10:06'),
(19, 19, 5, 'Scarlet Macaw Portrait', 'http://10.0.2.2:8000/images/product5.jpg', 55.00, 2, '2026-01-30 11:32:41', '2026-01-30 11:32:41'),
(20, 20, 2, 'Clownfish in Anemone', 'http://10.0.2.2:8000/images/product2.jpg', 140.00, 1, '2026-01-31 08:10:28', '2026-01-31 08:10:28'),
(21, 21, 3, 'African Lion Monarch (12 x 18 in)', 'http://127.0.0.1:8000/images/product3.jpg', 150.00, 1, '2026-01-31 09:26:51', '2026-01-31 09:26:51'),
(22, 22, 4, 'Blue Morpho Flight', 'http://10.0.2.2:8000/images/product4.jpg', 130.00, 1, '2026-01-31 09:32:23', '2026-01-31 09:32:23'),
(23, 23, 16, 'Dart Frog Warning (24 x 36 in)', 'http://127.0.0.1:8000/images/product16.jpg', 150.00, 1, '2026-01-31 10:41:41', '2026-01-31 10:41:41'),
(24, 24, 2, 'Clownfish in Anemone', 'http://10.0.2.2:8000/images/product2.jpg', 140.00, 1, '2026-01-31 11:00:36', '2026-01-31 11:00:36'),
(25, 25, 5, 'Scarlet Macaw Portrait', 'http://10.0.2.2:8000/images/product5.jpg', 55.00, 1, '2026-01-31 11:10:56', '2026-01-31 11:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'WildTraceApp', '2d5216068a8c8694ad5fc57464108d19565b694268d08e9798945e5a3fae0ac9', '[\"*\"]', NULL, NULL, '2026-01-28 06:52:06', '2026-01-28 06:52:06'),
(2, 'App\\Models\\User', 2, 'WildTraceApp', '71423bbb42f8cfc10fc52cfc63825c94469dd842bbc70cf7daf370b3a5055d0e', '[\"*\"]', '2026-01-28 07:03:53', NULL, '2026-01-28 07:03:47', '2026-01-28 07:03:53'),
(3, 'App\\Models\\User', 2, 'WildTraceApp', 'ae60d9126a49504d5acf4b32efbc7a4c20545b71ee6c64e84d0c9233a9e266d8', '[\"*\"]', NULL, NULL, '2026-01-28 07:22:21', '2026-01-28 07:22:21'),
(4, 'App\\Models\\User', 2, 'WildTraceApp', 'e30df600bafa59ae82f48e3a35221af6548d9b9d9de06542e25fef09c81ae81b', '[\"*\"]', NULL, NULL, '2026-01-28 07:22:30', '2026-01-28 07:22:30'),
(5, 'App\\Models\\User', 2, 'WildTraceApp', 'f52f93095a0c3d5222a9c39c4434c389445adb0aa91e811bd8f79d8f985d359b', '[\"*\"]', '2026-01-28 07:23:52', NULL, '2026-01-28 07:22:53', '2026-01-28 07:23:52'),
(6, 'App\\Models\\User', 2, 'WildTraceApp', 'e15a7e8eb5053f316eadf6f525a3a8cced131ed0ae7921edbc84597380521c6d', '[\"*\"]', '2026-01-28 07:44:34', NULL, '2026-01-28 07:44:33', '2026-01-28 07:44:34'),
(7, 'App\\Models\\User', 2, 'WildTraceApp', 'bd058589bdd7ca7811bf039f4af45b7b77cf5f5db789e2f2323f7543bae31e50', '[\"*\"]', '2026-01-28 07:44:46', NULL, '2026-01-28 07:44:45', '2026-01-28 07:44:46'),
(8, 'App\\Models\\User', 2, 'WildTraceApp', '64f17b8d716e9f96d79178e512daeddb54a8a2d45b063b81e3ea228273c40e7b', '[\"*\"]', '2026-01-28 07:44:51', NULL, '2026-01-28 07:44:50', '2026-01-28 07:44:51'),
(9, 'App\\Models\\User', 2, 'WildTraceApp', '540f96f6b73aa25203f146d9a39bda13d6d7be72ff2ea9d07f4284d6d593df52', '[\"*\"]', NULL, NULL, '2026-01-28 07:47:36', '2026-01-28 07:47:36'),
(10, 'App\\Models\\User', 2, 'WildTraceApp', 'e42fc7df02c62a7b84c3fe08015a1df42a48687080433b41d17c94cc0d84f967', '[\"*\"]', '2026-01-28 08:56:52', NULL, '2026-01-28 08:37:14', '2026-01-28 08:56:52'),
(11, 'App\\Models\\User', 2, 'WildTraceApp', 'b8f35d3a7ab90e19a4997e7fe9d8bbbc85fcd1066b05d946ebe7db21c9e81630', '[\"*\"]', '2026-01-29 11:47:06', NULL, '2026-01-28 14:16:51', '2026-01-29 11:47:06'),
(12, 'App\\Models\\User', 2, 'WildTraceApp', '472588cc52977dac2f0a10d10ca54c041764c45c1fcd90059c0f36b0a9865e5d', '[\"*\"]', '2026-01-30 11:07:36', NULL, '2026-01-30 09:59:10', '2026-01-30 11:07:36'),
(13, 'App\\Models\\User', 3, 'WildTraceApp', 'd753c4e445b37f532db4b0b1312e7bf63e98340ff6b11015fe0d1bb3f7edaa76', '[\"*\"]', '2026-01-30 12:41:24', NULL, '2026-01-30 11:09:30', '2026-01-30 12:41:24'),
(14, 'App\\Models\\User', 2, 'WildTraceApp', '47c6b0b0472477518a0ec648da695ce3b08a946596a6e61a71a332576b3b349b', '[\"*\"]', '2026-01-31 10:30:03', NULL, '2026-01-31 08:04:43', '2026-01-31 10:30:03'),
(15, 'App\\Models\\User', 2, 'WildTraceApp', '0156d7a4376eca6ee0aa8b3175cbe320e9cadcdb335248143a57df09d20337fa', '[\"*\"]', '2026-01-31 11:26:30', NULL, '2026-01-31 10:37:09', '2026-01-31 11:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `photographers`
--

CREATE TABLE `photographers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `profession` varchar(191) NOT NULL,
  `achievement` varchar(191) DEFAULT NULL,
  `quote` varchar(191) DEFAULT NULL,
  `post` varchar(191) DEFAULT NULL,
  `image` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographers`
--

INSERT INTO `photographers` (`id`, `name`, `profession`, `achievement`, `quote`, `post`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Vinsara Senanayake', 'Founder & Lead', 'NWPY Winner', 'Nature doesn\'t need a filter, it just needs a witness.', 'Canon Ambassador', 'images/teammember1.jpg', '2026-01-14 02:58:34', '2026-01-14 02:58:34'),
(2, 'Kavindu Gunawardhane', 'Wildlife Photographer', 'Wild Sri Lanka Winner', 'Every shutter click is a promise to protect what we see.', 'Nat Geo Featured', 'images/teammember2.jpg', '2026-01-14 02:58:34', '2026-01-14 02:58:34'),
(3, 'Kumara Senanayake', 'Wildlife Photographer', 'AWPC WILD Featured', 'I don\'t just take pictures; I collect stories of survival.', 'Nikon Ambassador', 'images/teammember3.jpg', '2026-01-14 02:58:34', '2026-01-14 02:58:34'),
(4, 'Ravi Shanker', 'Wildlife Photographer', 'DJMPC Winner', 'From above, the earth tells a fragile story.', 'BBC Earth Featured', 'images/teammember4.jpg', '2026-01-14 02:58:34', '2026-01-14 02:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image_url` varchar(191) NOT NULL,
  `category` varchar(191) NOT NULL,
  `location` varchar(191) DEFAULT NULL,
  `photographer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `aperture` varchar(191) DEFAULT NULL,
  `shutter_speed` varchar(191) DEFAULT NULL,
  `iso` varchar(191) DEFAULT NULL,
  `focal_length` varchar(191) DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `long_description`, `price`, `image_url`, `category`, `location`, `photographer_id`, `aperture`, `shutter_speed`, `iso`, `focal_length`, `options`, `created_at`, `updated_at`) VALUES
(1, 'Emerald Green Tree Python', 'Ideally camouflaged in the canopy, this serpent waits in perfect stillness. Its vibrant scales mimic the lush leaves of the tropical rainforest, providing a near-perfect disguise from both predator and prey. A marvel of evolutionary adaptation, it remains coiled for days, embodying the patient rhythm of the deep jungle.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 90.00, 'images/product1.jpg', 'reptiles', 'Udawalawe National Park', 2, 'f/5.6', '1/2000s', '6400', '85mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":90},{\"size\":\"18 x 24 in\",\"price\":135},{\"size\":\"24 x 36 in\",\"price\":180},{\"size\":\"40 x 60 in\",\"price\":315}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(2, 'Clownfish in Anemone', 'A vibrant symbiosis beneath the waves, where life dances in a delicate balance. The clownfish finds refuge among the stinging tentacles, protected by its unique mucosal layer that renders it invisible to the anemone\'s bite. This striking scene captures the intricate relationships that sustain the vast and mysterious ecosystems of the coral reef.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 140.00, 'images/product2.jpg', 'aquatics', 'Kumana National Park', 1, 'f/8', '1/500s', '200', '200mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":140},{\"size\":\"18 x 24 in\",\"price\":210},{\"size\":\"24 x 36 in\",\"price\":280},{\"size\":\"40 x 60 in\",\"price\":490}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(3, 'African Lion Monarch', 'The king surveys his golden savannah kingdom with eyes that have seen the rise and fall of countless seasons. His powerful presence commands respect across the endless plains, a symbol of raw power and natural authority. This moment captures the quiet dignity of a predator at peace, overlooking the land that sustains his pride.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 150.00, 'images/product3.jpg', 'mammals', 'Yala National Park', 4, 'f/1.8', '1/4000s', '100', '400mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":150},{\"size\":\"18 x 24 in\",\"price\":225},{\"size\":\"24 x 36 in\",\"price\":300},{\"size\":\"40 x 60 in\",\"price\":525}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(4, 'Blue Morpho Flight', 'Iridescent wings flashing through the rainforest, creating a rhythmic pulse of brilliant azure against the emerald shadows. The sudden bursts of color serve as both a dazzling display and a clever defense mechanism against forest predators. This image freezes the ethereal beauty of a creature that seems to be made of pure light and sky.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 130.00, 'images/product4.jpg', 'butterflies', 'Sinharaja Forest', 4, 'f/1.8', '1/500s', '100', '105mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":130},{\"size\":\"18 x 24 in\",\"price\":195},{\"size\":\"24 x 36 in\",\"price\":260},{\"size\":\"40 x 60 in\",\"price\":455}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(5, 'Scarlet Macaw Portrait', 'Vivid colors high in the Amazon canopy announce the presence of these intelligent and social wanderers. Their brilliant plumage is a testament to the sheer diversity of life found within the world\'s most vital carbon sink. Each feather is a brushstroke of nature\'s finest art, reflecting the untamed spirit of the wild tropics.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 55.00, 'images/product5.jpg', 'birds', 'Horton Plains', 3, 'f/16', '1/1000s', '100', '600mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":55},{\"size\":\"18 x 24 in\",\"price\":85},{\"size\":\"24 x 36 in\",\"price\":110},{\"size\":\"40 x 60 in\",\"price\":195}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(6, 'Red-Eyed Tree Frog', 'A flash of color in the deep green night, these amphibians are the silent sentinels of the humid lowlands. Their iconic crimson eyes are a startling contrast to their lime-green bodies, serving as a secondary defense that can startle birds and small mammals. Capturing this creature requires immense patience and a deep appreciation for the miniature wonders of the forest floor.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 70.00, 'images/product6.jpg', 'amphibians', 'Horton Plains', 2, 'f/11', '1/4000s', '400', '85mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":70},{\"size\":\"18 x 24 in\",\"price\":105},{\"size\":\"24 x 36 in\",\"price\":140},{\"size\":\"40 x 60 in\",\"price\":245}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(7, 'Orchid of the Mist', 'Delicate beauty thriving in the cloud forest, where moisture-laden air sustains a hidden garden of exotic flora. These ancient plants have adapted to high-altitude environments, producing blooms that are as complex as they are beautiful. This photograph honors the fragile resilience of mountain ecosystems that are often hidden from the human eye.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 110.00, 'images/product7.jpg', 'flora', 'Horton Plains', 2, 'f/16', '1/4000s', '6400', '24mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":110},{\"size\":\"18 x 24 in\",\"price\":165},{\"size\":\"24 x 36 in\",\"price\":220},{\"size\":\"40 x 60 in\",\"price\":385}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(8, 'Elephant Matriarch', 'Wisdom and strength leading the herd across vast distances in search of water and sustenance. She carries the memories of generations, knowing the hidden paths and ancient wells that ensure the survival of her family. Her massive frame and gentle movements represent the profound emotional depth and social complexity of these magnificent titans.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 60.00, 'images/product8.jpg', 'mammals', 'Sinharaja Forest', 2, 'f/5.6', '1/4000s', '800', '50mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":60},{\"size\":\"18 x 24 in\",\"price\":90},{\"size\":\"24 x 36 in\",\"price\":120},{\"size\":\"40 x 60 in\",\"price\":210}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(9, 'Kingfisher Dive', 'A splash of blue hunting in the river, moving with a speed that defies the human eye\'s ability to track. In a fraction of a second, the bird enters the water and emerges with its prize, a perfect hunter in a world of reflections. This image captures the precise moment where air, water, and predator converge in a display of natural perfection.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 85.00, 'images/product9.jpg', 'birds', 'Horton Plains', 4, 'f/8', '1/250s', '6400', '50mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":85},{\"size\":\"18 x 24 in\",\"price\":130},{\"size\":\"24 x 36 in\",\"price\":170},{\"size\":\"40 x 60 in\",\"price\":300}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(10, 'Komodo Dragon Stride', 'An ancient predator walking the earth, a living relic from a time when giant reptiles ruled the islands. Its powerful limbs and flicking tongue are tools of a master hunter, adapted to a harsh and sun-drenched landscape. This photograph captures the primal energy of a creature that bridges the gap between the prehistoric past and our modern world.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 105.00, 'images/product10.jpg', 'reptiles', 'Sinharaja Forest', 4, 'f/11', '1/500s', '3200', '105mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":105},{\"size\":\"18 x 24 in\",\"price\":160},{\"size\":\"24 x 36 in\",\"price\":210},{\"size\":\"40 x 60 in\",\"price\":370}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(11, 'Sea Turtle Glide', 'Graceful navigator of the ocean currents, embarking on a journey that spans entire hemispheres. These ancient mariners have existed for millions of years, witnessing the changing tides of the world\'s great oceans. Their peaceful movements through the blue depths remind us of the vast, quiet wilderness that exists beneath the surface of our planet.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 95.00, 'images/product11.jpg', 'aquatics', 'Udawalawe National Park', 1, 'f/4', '1/1000s', '400', '85mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":95},{\"size\":\"18 x 24 in\",\"price\":145},{\"size\":\"24 x 36 in\",\"price\":190},{\"size\":\"40 x 60 in\",\"price\":335}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(12, 'Leopard in Ambush', 'Silent shadow in the dappled light, a master of concealment waiting for the perfect moment to strike. Every muscle is tensed, every sense tuned to the subtle movements of the forest, making it the most elusive of the big cats. This shot preserves the breathtaking tension of a wild encounter where life and death are separated by only a heartbeat.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 90.00, 'images/product12.jpg', 'mammals', 'Sinharaja Forest', 2, 'f/5.6', '1/2000s', '6400', '24mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":90},{\"size\":\"18 x 24 in\",\"price\":135},{\"size\":\"24 x 36 in\",\"price\":180},{\"size\":\"40 x 60 in\",\"price\":315}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(13, 'Monarch Migration', 'A quiet blizzard of orange wings, millions of butterflies embarking on a multi-generational odyssey across a continent. This incredible feat of navigation and endurance is one of nature\'s most spectacular displays of collective survival. Each individual is a fragile miracle, contributing to a massive movement that has inspired wonder for centuries.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 130.00, 'images/product13.jpg', 'butterflies', 'Udawalawe National Park', 1, 'f/8', '1/125s', '3200', '105mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":130},{\"size\":\"18 x 24 in\",\"price\":195},{\"size\":\"24 x 36 in\",\"price\":260},{\"size\":\"40 x 60 in\",\"price\":455}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(14, 'Owl in Twilight', 'Silent wings under the moon, a nocturnal hunter emerging from the shadows to claim the night. Its large, soulful eyes are designed to capture the faintest light, making it a master of the darkness. This image evokes the mysterious beauty of the twilight hours, where the world belongs to those who move without a sound.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 110.00, 'images/product14.jpg', 'birds', 'Wilpattu National Park', 3, 'f/1.8', '1/250s', '1600', '35mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":110},{\"size\":\"18 x 24 in\",\"price\":165},{\"size\":\"24 x 36 in\",\"price\":220},{\"size\":\"40 x 60 in\",\"price\":385}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(15, 'Baobab Silhouette', 'The tree of life against a setting sun, standing as a timeless monument in the arid African landscape. These ancient giants can live for thousands of years, providing shelter and life-giving water to countless species of birds and animals. Their unique shapes reach toward the darkening sky, telling a story of survival in the harshest of environments.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 50.00, 'images/product15.jpg', 'flora', 'Yala National Park', 1, 'f/1.8', '1/500s', '3200', '50mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":50},{\"size\":\"18 x 24 in\",\"price\":75},{\"size\":\"24 x 36 in\",\"price\":100},{\"size\":\"40 x 60 in\",\"price\":175}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(16, 'Dart Frog Warning', 'Small but mighty, a warning in yellow hidden amongst the damp leaves of the jungle floor. Its brilliant hue is a biological signal to all potential predators that a single touch could be fatal. This photograph captures the intense beauty and dangerous power that can be found in even the smallest corner of the wild world.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 75.00, 'images/product16.jpg', 'amphibians', 'Kumana National Park', 3, 'f/8', '1/2000s', '3200', '600mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":75},{\"size\":\"18 x 24 in\",\"price\":115},{\"size\":\"24 x 36 in\",\"price\":150},{\"size\":\"40 x 60 in\",\"price\":265}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(17, 'Giraffe Tower', 'Gentle giants reaching for the sky, their long necks allowing them to feast on the highest branches of the acacia trees. They move across the savannah with a slow, swaying grace that is unlike any other creature on earth. This image celebrates the unique elegance and towering presence of one of nature\'s most distinctive and beloved inhabitants.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 110.00, 'images/product17.jpg', 'mammals', 'Sinharaja Forest', 3, 'f/1.8', '1/125s', '100', '200mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":110},{\"size\":\"18 x 24 in\",\"price\":165},{\"size\":\"24 x 36 in\",\"price\":220},{\"size\":\"40 x 60 in\",\"price\":385}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04'),
(18, 'Coral Reef Panorama', 'A bustling metropolis of marine life, where every inch of the reef is filled with activity and color. From the smallest polyp to the largest reef shark, this ecosystem represents the incredible productivity and beauty of our oceans. This photograph is a tribute to the underwater cities that protect our coastlines and provide a home for a quarter of all marine species.', 'Behind the Lens\n\nThis artifact captures a moment of raw, untamed beauty. A testament to the patient observation and deep respect for the wildlife in their natural habitat.', 70.00, 'images/product18.jpg', 'aquatics', 'Udawalawe National Park', 4, 'f/1.8', '1/4000s', '800', '35mm', '{\"frames\":[{\"size\":\"12 x 18 in\",\"price\":70},{\"size\":\"18 x 24 in\",\"price\":105},{\"size\":\"24 x 36 in\",\"price\":140},{\"size\":\"40 x 60 in\",\"price\":245}]}', '2026-01-14 02:58:34', '2026-01-28 05:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GJdxQrrcQ4VzMoDdPTXLRMpqDzhsYZNUxGS69oRy', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoia3JuaUppVG1sMGxEV2ZDa3pzdjJRWkdYcUlmSTlVWHo1RUdHQmVZUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0IjtzOjU6InJvdXRlIjtzOjEwOiJjYXJ0LmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjQ6ImI0YmM4MzY1OTE5NzkwZGE2OTAwYjMyNjkwYmIzMTAxNDIzNzU2M2EyYWMzNjFiYTVlYjI2NmQ0NDIyNGM4MTgiO3M6NDoiY2FydCI7YTowOnt9fQ==', 1769796690),
('qtvcEbrwPgMWKQJNj0e8iF18zumsiB9gFe5f5Eku', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibG5KZ2Nqb3g3c0RXQ1dIQnlDdUVsVDVpblh3RXNQM3F2TGJ5YmhiZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjQ6IjY1MjE1ZjY2NWE3NDIzM2IxNjZlZGZiNTE5MmY2YzdhZjVkMTBiMjA0OWMwMGJlZjgzMjQyMmNkNGNmNjE4NTEiO3M6NDoiY2FydCI7YTowOnt9fQ==', 1769878588);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'pavan@gmail.com', '2026-01-17 01:57:15', '2026-01-17 01:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_number`, `address`, `city`, `postal_code`, `country`, `is_admin`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Vinsara', 'vinsara@gmail.com', '771234567', '123 Wild Trace Avenue', 'Colombo', '10100', 'Sri Lanka', 1, NULL, '$2y$12$ia7qQ6pM20B.g1LYdttnwOJ3qmeKtEW1VE3.Av/tK9Niv5YLMUHk6', NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-14 02:58:34', '2026-01-15 23:11:33'),
(2, 'pavan', 'pavan@gmail.com', '111111111', 'safasf', 'Saf', '11111', 'Sri Lanka', 0, NULL, '$2y$12$juNwApkfxPzwmm.qM2MG/.0v0KgJuAPygNy/RawqqY79kHzz0XifS', NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-14 09:48:32', '2026-01-17 03:48:08'),
(3, 'Nawon', 'nawon@gmail.com', '771231452', 'asa', 'sass', '11111111', NULL, 0, NULL, '$2y$12$.NvYF7rMEDPu85Mbor4MXu2.2W7R0jJMWLi9Rebux0vlfnLK9cfhC', NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-30 11:09:30', '2026-01-30 11:09:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `photographers`
--
ALTER TABLE `photographers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_photographer_id_foreign` (`photographer_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `photographers`
--
ALTER TABLE `photographers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_photographer_id_foreign` FOREIGN KEY (`photographer_id`) REFERENCES `photographers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
