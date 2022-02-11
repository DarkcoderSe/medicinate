-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 01, 2022 at 10:04 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipt_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `created_at`, `updated_at`, `name`, `email`, `charge_id`, `transaction_id`, `amount`, `description`, `recipt_url`, `last4`, `stripe_status`, `status`) VALUES
(1, '2022-01-30 11:43:54', '2022-01-30 11:43:54', 'Nhs', 'nhs@app.com', 'ch_3KNboyBT9ZQqIPsm1293p1ep', 'txn_3KNboyBT9ZQqIPsm1oDJftPO', '100', 'Donation payment.', 'https://pay.stripe.com/receipts/acct_1KFN2cBT9ZQqIPsm/ch_3KNboyBT9ZQqIPsm1293p1ep/rcpt_L3jHT2PRY2HwOeM1SBYasCPK0d3nqus', '4242', 'succeeded', 0),
(2, '2022-01-30 12:01:15', '2022-01-30 12:01:15', 'Nhs', 'nhs@app.com', 'ch_3KNc5nBT9ZQqIPsm0f5j4NZ0', 'txn_3KNc5nBT9ZQqIPsm0epq8kvS', '100', 'Donation payment.', 'https://pay.stripe.com/receipts/acct_1KFN2cBT9ZQqIPsm/ch_3KNc5nBT9ZQqIPsm0f5j4NZ0/rcpt_L3jY3X2q1WOvwgCLAxHnKVn4wZ8M0Hy', '4242', 'succeeded', 0),
(3, '2022-01-30 12:27:06', '2022-01-30 12:27:06', 'Nhs', 'nhs@app.com', 'ch_3KNcUnBT9ZQqIPsm2GME9YbP', 'txn_3KNcUnBT9ZQqIPsm2V3bHlVv', '10', 'Donation payment.', 'https://pay.stripe.com/receipts/acct_1KFN2cBT9ZQqIPsm/ch_3KNcUnBT9ZQqIPsm2GME9YbP/rcpt_L3jyFpv1T1TzZgTkWOE1UoYcPCvSaHT', '4242', 'succeeded', 0),
(4, '2022-01-30 12:41:40', '2022-01-30 12:41:40', 'Nhs', 'nhs@app.com', 'ch_3KNcitBT9ZQqIPsm0UYwgoe6', 'txn_3KNcitBT9ZQqIPsm0MQmYzND', '10', 'Donation payment.', 'https://pay.stripe.com/receipts/acct_1KFN2cBT9ZQqIPsm/ch_3KNcitBT9ZQqIPsm0UYwgoe6/rcpt_L3kDs0tfiGkVV7BDSLTJs7t3Vo5wAPX', '4242', 'succeeded', 0),
(5, '2022-01-30 14:24:25', '2022-01-30 14:24:25', 'Nhs', 'nhs@app.com', 'ch_3KNeKKBT9ZQqIPsm0zG5PP9j', 'txn_3KNeKKBT9ZQqIPsm0Y5UnZCe', '70', 'Donation payment.', 'https://pay.stripe.com/receipts/acct_1KFN2cBT9ZQqIPsm/ch_3KNeKKBT9ZQqIPsm0zG5PP9j/rcpt_L3ls5iaPrGxVGJjdiH3RwcareMOxohP', '4242', 'succeeded', 0),
(6, '2022-02-01 10:03:44', '2022-02-01 10:03:44', 'Administrator', 'administrator@app.com', 'ch_3KOJD9BT9ZQqIPsm2jkw92o1', 'txn_3KOJD9BT9ZQqIPsm25SobpWl', '40', 'Donation payment.', 'https://pay.stripe.com/receipts/acct_1KFN2cBT9ZQqIPsm/ch_3KOJD9BT9ZQqIPsm2jkw92o1/rcpt_L4S7V6mu4YQvc34Vp5RvLoTacrkqvd1', '4242', 'succeeded', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
