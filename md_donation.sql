-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2021 at 10:54 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `md_donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `required_donations` int NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `max_donation` bigint NOT NULL DEFAULT '0',
  `min_donation` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consume_credits`
--

CREATE TABLE `consume_credits` (
  `id` bigint UNSIGNED NOT NULL,
  `result_id` bigint UNSIGNED DEFAULT NULL,
  `coins` bigint NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `user_id`, `name`, `email`, `contact_no`, `message`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 5, 'Kashif Saleem', 'kashif@gmail.com', '03042823804', 'Your worked really well', 0, '<p>Thanks</p>', '2021-05-30 09:39:47', '2021-05-30 09:47:58'),
(3, 6, 'Hassan', 'hassan@gmail.com', '030124674574', 'wfe0w9 uf09ewuf09weu fwdjwjfoiwjfoiejf', 0, NULL, '2021-05-30 12:49:29', '2021-05-30 12:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint UNSIGNED NOT NULL,
  `is_not_controlled_substance` tinyint(1) NOT NULL DEFAULT '0',
  `not_expire_in_5_month` tinyint(1) NOT NULL DEFAULT '0',
  `sealed_packaging` tinyint(1) NOT NULL DEFAULT '0',
  `not_require_refrigeration` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_paid` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `donation_weight` int NOT NULL DEFAULT '0',
  `donation_weight_standard` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `expected_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=pending; 1=recieved; 2=rejected;',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `is_not_controlled_substance`, `not_expire_in_5_month`, `sealed_packaging`, `not_require_refrigeration`, `shipping_paid`, `name`, `email`, `address`, `is_guest`, `user_id`, `donation_weight`, `donation_weight_standard`, `expected_cost`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 1, 0, 'Kashif Saleem', 'kashif@gmail.com', 'Rukanad Colony Gali no 6', 0, 5, 100, 'gram', '2000', 2, NULL, '2021-05-30 08:51:15', '2021-05-30 10:20:13'),
(2, 1, 0, 1, 1, 0, 'Kashif Saleem', 'kashif@gmail.com', 'Rukanabad Colony gali no 6', 0, 5, 10, 'gram', '200', 1, NULL, '2021-05-30 08:54:21', '2021-05-30 10:19:33'),
(3, 0, 0, 1, 1, 0, 'Kashif Saleem', 'kashif@gmail.com', 'oifsjg oi joij', 0, 5, 100, 'gram', '200', 2, NULL, '2021-05-30 11:24:27', '2021-05-30 12:57:32'),
(4, 1, 1, 1, 0, 1, 'Hassan', 'hassan@gmail.com', 'oxidjgs oij oiew', 0, 6, 100, 'gram', '2000', 1, NULL, '2021-05-30 12:47:13', '2021-05-30 12:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `donation_medicines`
--

CREATE TABLE `donation_medicines` (
  `id` bigint UNSIGNED NOT NULL,
  `donation_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ndc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'National Drug Code',
  `expire_date` date DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `quantity_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_medicines`
--

INSERT INTO `donation_medicines` (`id`, `donation_id`, `name`, `ndc`, `expire_date`, `quantity`, `quantity_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ciproxin', '123456789', '2021-08-05', 10, 'tablets', '2021-05-30 08:51:15', '2021-05-30 08:51:15'),
(2, 1, 'Brofyin 500', '234566543', '2021-07-22', 20, 'botels', '2021-05-30 08:51:15', '2021-05-30 08:51:15'),
(3, 2, 'Limda 500mg', '12345678765', '2021-05-12', 10, 'packs', '2021-05-30 08:54:21', '2021-05-30 08:54:21'),
(4, 3, 'Doxrinq 400MG', '1234567543', '2021-05-28', 20, 'Tabs', '2021-05-30 11:24:27', '2021-05-30 11:24:27'),
(5, 4, 'Ciproxin 500MG', '123456789', '2021-05-15', 10, 'packs', '2021-05-30 12:47:13', '2021-05-30 12:47:13'),
(6, 4, 'Doxrinq 400MG', '1234567543', '2021-05-28', 5, 'botels', '2021-05-30 12:47:13', '2021-05-30 12:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `donation_to_ngos`
--

CREATE TABLE `donation_to_ngos` (
  `id` bigint UNSIGNED NOT NULL,
  `donation_id` bigint UNSIGNED NOT NULL,
  `ngo_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_to_ngos`
--

INSERT INTO `donation_to_ngos` (`id`, `donation_id`, `ngo_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2021-05-30 11:24:27', '2021-05-30 11:24:27'),
(2, 4, 1, '2021-05-30 12:47:13', '2021-05-30 12:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED DEFAULT NULL,
  `clicks` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmln` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `type_of_license`, `dmln`, `address`, `created_at`, `updated_at`) VALUES
(1, 'ABC Manufacturer', 'Foundation', '145623456767', '<p>Chaki 4, Block 19, DGK</p>', '2021-05-30 10:53:40', '2021-05-30 10:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2021_01_20_103022_laratrust_setup_tables', 1),
(10, '2021_01_20_103827_create_preferences_table', 1),
(11, '2021_01_20_103858_create_categories_table', 1),
(12, '2021_01_20_103941_create_badges_table', 1),
(13, '2021_01_20_104049_create_faqs_table', 1),
(14, '2021_01_20_112411_create_student_badges_table', 1),
(15, '2021_01_20_112646_create_contact_us_table', 1),
(16, '2021_01_25_093230_create_comsume_credits_table', 1),
(17, '2021_01_27_060722_add_fields_in_badges_table', 1),
(20, '2021_05_29_164922_create_donations_table', 2),
(21, '2021_05_29_164950_create_donation_medicines_table', 2),
(22, '2021_05_30_153442_create_manufacturers_table', 3),
(23, '2021_05_30_153450_create_ngos_table', 3),
(24, '2021_05_30_154123_create_donation_to_ngos_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ngos`
--

CREATE TABLE `ngos` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ngos`
--

INSERT INTO `ngos` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Edhi Foundation', '2021-05-30 11:01:17', '2021-05-30 11:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(2, 'users-read', 'Read Users', 'Read Users', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(3, 'users-update', 'Update Users', 'Update Users', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(5, 'reported-issues-create', 'Create Reported-issues', 'Create Reported-issues', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(6, 'reported-issues-read', 'Read Reported-issues', 'Read Reported-issues', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(7, 'reported-issues-update', 'Update Reported-issues', 'Update Reported-issues', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(8, 'reported-issues-delete', 'Delete Reported-issues', 'Delete Reported-issues', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(9, 'feedback-create', 'Create Feedback', 'Create Feedback', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(10, 'feedback-read', 'Read Feedback', 'Read Feedback', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(11, 'feedback-update', 'Update Feedback', 'Update Feedback', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(12, 'feedback-delete', 'Delete Feedback', 'Delete Feedback', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(13, 'catalog-create', 'Create Catalog', 'Create Catalog', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(14, 'catalog-read', 'Read Catalog', 'Read Catalog', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(15, 'catalog-update', 'Update Catalog', 'Update Catalog', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(16, 'catalog-delete', 'Delete Catalog', 'Delete Catalog', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(17, 'category-create', 'Create Category', 'Create Category', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(18, 'category-read', 'Read Category', 'Read Category', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(19, 'category-update', 'Update Category', 'Update Category', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(20, 'category-delete', 'Delete Category', 'Delete Category', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(21, 'tools-create', 'Create Tools', 'Create Tools', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(22, 'tools-read', 'Read Tools', 'Read Tools', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(23, 'tools-update', 'Update Tools', 'Update Tools', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(24, 'tools-delete', 'Delete Tools', 'Delete Tools', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(25, 'general-create', 'Create General', 'Create General', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(26, 'general-read', 'Read General', 'Read General', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(27, 'general-update', 'Update General', 'Update General', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(28, 'general-delete', 'Delete General', 'Delete General', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(29, 'profile-read', 'Read Profile', 'Read Profile', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(30, 'profile-update', 'Update Profile', 'Update Profile', '2021-05-29 09:00:45', '2021-05-29 09:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(2, 2),
(3, 2),
(5, 2),
(6, 2),
(7, 2),
(9, 2),
(10, 2),
(11, 2),
(13, 2),
(14, 2),
(15, 2),
(17, 2),
(18, 2),
(19, 2),
(25, 2),
(26, 2),
(27, 2),
(29, 2),
(30, 2),
(14, 3),
(15, 3),
(26, 3),
(27, 3),
(29, 3),
(30, 3),
(29, 4),
(30, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'email_verification', '0', '2021-05-29 09:00:46', '2021-05-29 09:00:46'),
(2, 'sms_verification', '1', '2021-05-29 09:00:46', '2021-05-29 09:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', 'Administrator', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(2, 'manager', 'Manager', 'Manager', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(3, 'expert', 'Expert', 'Expert', '2021-05-29 09:00:46', '2021-05-29 09:00:46'),
(4, 'member', 'Member', 'Member', '2021-05-29 09:00:46', '2021-05-29 09:00:46'),
(5, 'abc-role', 'Abc role', NULL, '2021-05-30 12:52:07', '2021-05-30 12:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(2, 2, 'App\\Models\\User'),
(3, 3, 'App\\Models\\User'),
(4, 4, 'App\\Models\\User'),
(4, 5, 'App\\Models\\User'),
(4, 6, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` date DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_no`, `email_verified_at`, `phone_verified_at`, `password`, `admin_notes`, `source`, `last_login_at`, `profile_picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@app.com', NULL, NULL, NULL, '$2y$10$OP2QpkPdUmFYhPxkgcGUVONnP8DKcpLobSIeA8p60dkYwBwgB8kPu', NULL, NULL, NULL, NULL, 'lA7BTWAOdvTXY092Rmdtnhm9p8gE7S7JKBnE498smKWIP5fKkyRXt9meJLmN', '2021-05-29 09:00:45', '2021-05-29 09:00:45'),
(2, 'Manager', 'manager@app.com', NULL, NULL, NULL, '$2y$10$90s.AuGXzxTflfzkIPgVqObRygmd/X6WWDpvR3NA/xJbmKYcAhuXa', NULL, NULL, NULL, NULL, NULL, '2021-05-29 09:00:46', '2021-05-29 09:00:46'),
(3, 'Expert', 'expert@app.com', NULL, NULL, NULL, '$2y$10$RpGRMgRsY2xzl3t3.Lr.K.pY1G4jKu1ql0DTWKPIIf/xqHYRWvxIe', NULL, NULL, NULL, NULL, '5iClQoUABGbma3BKGIxBW5Tv2HAc5xSiEPtHOhpjNL4XiEUezwoVR3NZFy7x', '2021-05-29 09:00:46', '2021-05-29 09:00:46'),
(4, 'Member', 'member@app.com', NULL, NULL, NULL, '$2y$10$YCGk3fXWRmRMQzxSsn12q.B1Pb5qhjWj7jWUDLfO.E4e8cA15q67e', NULL, NULL, NULL, NULL, NULL, '2021-05-29 09:00:46', '2021-05-29 09:00:46'),
(5, 'Kashif Saleem', 'kashif@gmail.com', '03042823804', NULL, NULL, '$2y$10$Zgj02h93uSXZFZ1FPwYF7uGG4RCPyrjy.mr7rDANo/lGwoQKR1HX.', NULL, NULL, NULL, NULL, NULL, '2021-05-29 09:03:55', '2021-05-29 09:03:55'),
(6, 'Hassan', 'hassan@gmail.com', '030124674574', NULL, NULL, '$2y$10$2TtejGp.Ty9JliMljq0q4ubmsBftBTAuu9DtkQZCXns5opuk3I8Fy', NULL, NULL, NULL, NULL, NULL, '2021-05-30 12:42:10', '2021-05-30 12:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE `user_badges` (
  `id` bigint UNSIGNED NOT NULL,
  `badge_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consume_credits`
--
ALTER TABLE `consume_credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_medicines`
--
ALTER TABLE `donation_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_to_ngos`
--
ALTER TABLE `donation_to_ngos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngos`
--
ALTER TABLE `ngos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_contact_no_index` (`contact_no`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_contact_no_unique` (`contact_no`);

--
-- Indexes for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_badges_badge_id_foreign` (`badge_id`),
  ADD KEY `user_badges_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consume_credits`
--
ALTER TABLE `consume_credits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donation_medicines`
--
ALTER TABLE `donation_medicines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donation_to_ngos`
--
ALTER TABLE `donation_to_ngos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ngos`
--
ALTER TABLE `ngos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `user_badges_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`),
  ADD CONSTRAINT `user_badges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
