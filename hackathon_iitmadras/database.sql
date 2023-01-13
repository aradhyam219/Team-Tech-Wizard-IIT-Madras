-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2023 at 12:54 PM
-- Server version: 5.7.40-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smilewellnessfoundation`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_category`
--

CREATE TABLE `account_category` (
  `account_type_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `account_type` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `service_available` varchar(255) NOT NULL DEFAULT 'available',
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_category`
--

INSERT INTO `account_category` (`account_type_id`, `admin_username`, `account_type`, `description`, `service_available`, `create_datetime`) VALUES
(1, 'ritwik1234', 'saving account', 'saving account for 18+', 'available', '2023-01-04 22:49:46'),
(2, 'ritwik1234', 'current account ', 'work best for traders and entrepreneurs', 'available', '2023-01-05 17:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_creation_time` datetime NOT NULL,
  `token_email` varchar(255) NOT NULL,
  `verification_status` int(1) NOT NULL DEFAULT '1',
  `password_code` int(11) NOT NULL,
  `password_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `email`, `password`, `account_creation_time`, `token_email`, `verification_status`, `password_code`, `password_token`) VALUES
(2, 'ritwik1234', 'dalmiaritwik@gmail.com', '$2y$10$mdk5LabgcP1bXkExiuhOeuWbKk4MpRVSXS6VRi24.Ml2yNinu622.', '2023-01-05 17:19:12', 'a60830b8bc84a098d228acfd5c39f1', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_id` int(11) NOT NULL,
  `login_username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `Mno` bigint(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `verification_status` int(11) NOT NULL DEFAULT '0',
  `aadhar_card` varchar(16) NOT NULL,
  `pan_card` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL DEFAULT 'pending',
  `apply_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `login_username`, `full_name`, `email_id`, `Mno`, `password`, `account_type`, `branch_name`, `ifsc_code`, `country`, `token`, `verification_status`, `aadhar_card`, `pan_card`, `permission`, `apply_time`) VALUES
(20, 'ritwikdalmia', 'ritwik dalmia', 'dalmiaritwik@gmail.com', 9971655508, '$2y$10$2Yhs1bu7x2rMkmQldEZswOoYRO9XSngY5hqZHo17gwxmMnckb./e6', 'saving account', 'Mumbai', 'TWIZ001', 'india', '0', 1, '9150 9600 9807 ', 'GMFPD0251K', 'approved', '2023-01-11 02:31:29'),
(21, 'ritwikesports', 'ritwik esports', 'ritwik.esports@gmail.com', 8076784960, '$2y$10$eG3aBjnF3/xL6nlKi/H2pO7mT.Vy1V8y2kSf0TClfITCoG.AehdoG', 'saving account', 'Mumbai', 'TWIZ001', 'india', '0', 1, '9150 9600 9808 ', 'GMFPD0251H', 'approved', '2023-01-11 02:42:19'),
(22, 'codingdalmia', 'coding dalmia', 'codingwithdalmia@gmail.com', 9650697521, '$2y$10$r93Groiom307A1p1vwnZO.5eeNhDc/MicpyWNMYM74GvhAClI7F1S', 'saving account', 'london', 'TWL001', 'uk', '0', 1, '0984 7464 6412 ', 'GMFPD0251L', 'approved', '2023-01-11 17:08:40'),
(32, 'markaragnos304', 'Marka Ragnos', 'markaragnos219@gmail.com', 1001100109, '$2y$10$LaMimw5erbPn1z0SDY6.Zun5mzSs0iPpq5o1K/2UNWw6SnhfAWVGm', 'saving account', 'Mumbai', 'TWIZ001', 'india', '0', 1, '9999 8888 7777 6', '9876543210', 'approved', '2023-01-13 01:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `branch_detail`
--

CREATE TABLE `branch_detail` (
  `branch_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `service_available` varchar(255) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_detail`
--

INSERT INTO `branch_detail` (`branch_id`, `admin_username`, `branch_name`, `ifsc_code`, `country`, `service_available`) VALUES
(4, 'ritwik1234', 'Mumbai', 'TWIZ001', 'india', 'available'),
(5, 'ritwik1234', 'london', 'TWL001', 'uk', 'available'),
(6, 'ritwik1234', 'delhi', 'TWDZ001', 'india', 'available'),
(7, 'ritwik1234', 'dubai', 'TWU001', 'UAE', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `card_account_details`
--

CREATE TABLE `card_account_details` (
  `card_id` int(11) NOT NULL,
  `login_username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `account_number` bigint(15) NOT NULL,
  `debit_card` varchar(255) NOT NULL,
  `validity` varchar(255) NOT NULL,
  `expiry` varchar(255) NOT NULL,
  `cvv` int(3) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `transaction_pin` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '2000',
  `transaction_attempts` int(11) NOT NULL DEFAULT '0',
  `password_code` int(11) NOT NULL,
  `password_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_account_details`
--

INSERT INTO `card_account_details` (`card_id`, `login_username`, `full_name`, `email_id`, `account_number`, `debit_card`, `validity`, `expiry`, `cvv`, `branch_name`, `ifsc_code`, `country`, `transaction_pin`, `balance`, `transaction_attempts`, `password_code`, `password_token`) VALUES
(41, 'ritwikesports', 'ritwik esports', 'ritwik.esports@gmail.com', 3290104586, '8149 4712 5570 7480 ', '10/23', '9/30', 721, 'Mumbai', 'TWIZ001', 'india', '$2y$10$Mj.vzLanD3go0GyeNcDJQuenr4qpdB.qpESJNbrv8E49LmoUjKNpK', 28601, 0, 0, ''),
(42, 'codingdalmia', 'coding dalmia', 'codingwithdalmia@gmail.com', 5428568230, '8967 7818 2184 8652 ', '6/22', '5/28', 331, 'london', 'TWL001', 'uk', '$2y$10$Z2fdwXhcgSqVDQtS7sL4Uul.mgM8sV1G7BcLTpsuFZw6icEfiZ042', 37900, 0, 0, ''),
(43, 'markaragnos304', 'Marka Ragnos', 'markaragnos219@gmail.com', 9183151048, '3190 1756 1971 9323 ', '6/22', '8/28', 872, 'Mumbai', 'TWIZ001', 'india', '$2y$10$GjNOlkeaXxi1yIJRb8Bz2.DpWR.TiUUcldJNzg75d/kCJe1wrghUu', 503100, 0, 0, ''),
(47, 'ritwikdalmia', 'ritwik dalmia', 'dalmiaritwik@gmail.com', 5366649665, '1459 9520 7741 8649 ', '8/23', '7/28', 279, 'Mumbai', 'TWIZ001', 'india', '$2y$10$BeERxccjOW6PLh8.yIaGe.c6M72xeogs7wSn79gTlqGX50gsiKP52', 1159, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `login_username` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `account_number` bigint(15) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `balance` int(7) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `deposit_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `transaction_id`, `login_username`, `email_id`, `account_number`, `full_name`, `ifsc_code`, `balance`, `ip_address`, `deposit_time`) VALUES
(23, 672249, 'ritwikdalmia', 'dalmiaritwik@gmail.com', 4383087959, 'ritwik dalmia', 'TWIZ001', 100000, '119.226.22.162', '2023-01-12 17:17:36'),
(24, 447128, 'ritwikdalmia', 'dalmiaritwik@gmail.com', 4383087959, 'ritwik dalmia', 'TWIZ001', 100, '119.226.22.162', '2023-01-13 01:46:20'),
(25, 530834, 'markaragnos304', 'markaragnos219@gmail.com', 9183151048, 'Marka Ragnos', 'TWIZ001', 500000, '103.201.151.165', '2023-01-13 02:24:35'),
(26, 908220, 'ritwikdalmia', 'dalmiaritwik@gmail.com', 7413119898, 'ritwik dalmia', 'TWIZ001', 100, '119.226.22.162', '2023-01-13 03:37:56'),
(27, 237054, 'ritwikdalmia', 'dalmiaritwik@gmail.com', 7413119898, 'ritwik dalmia', 'TWIZ001', 1000, '119.226.22.162', '2023-01-13 05:46:25'),
(28, 206663, 'ritwikdalmia', 'dalmiaritwik@gmail.com', 7413119898, 'ritwik dalmia', 'TWIZ001', 1000, '119.226.22.162', '2023-01-13 05:54:39'),
(29, 290784, 'ritwikdalmia', 'dalmiaritwik@gmail.com', 7413119898, 'ritwik dalmia', 'TWIZ001', 1000, '119.226.22.162', '2023-01-13 11:50:05'),
(30, 622102, 'ritwikdalmia', 'dalmiaritwik@gmail.com', 5366649665, 'ritwik dalmia', 'TWIZ001', 220, '119.226.22.162', '2023-01-13 23:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `login_username` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `Mno` bigint(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`login_username`, `email_id`, `Mno`, `full_name`, `address`, `state`, `city`, `zip`) VALUES
('codingdalmia', 'codingwithdalmia@gmail.com', 9650697521, 'coding dalmia', '', '', '', 0),
('markaragnos304', 'markaragnos219@gmail.com', 1001100109, 'Marka Ragnos', '', '', '', 0),
('ritwikdalmia', 'dalmiaritwik@gmail.com', 9971655508, 'ritwik dalmia', '', '', '', 0),
('ritwikesports', 'ritwik.esports@gmail.com', 8076784960, 'ritwik esports', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transfer_id` int(11) NOT NULL,
  `tid_id` int(11) NOT NULL,
  `login_username` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `account_number` bigint(15) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `transfer_amount` int(11) NOT NULL,
  `balance` int(7) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `balance_type` varchar(255) NOT NULL,
  `activity_type` varchar(255) NOT NULL DEFAULT 'legit',
  `transaction_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transfer_id`, `tid_id`, `login_username`, `email_id`, `account_number`, `ifsc_code`, `country`, `full_name`, `transfer_amount`, `balance`, `ip_address`, `balance_type`, `activity_type`, `transaction_time`) VALUES
(187, 708735, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 1859, '119.226.22.162', 'debit', 'legit', '2023-01-13'),
(188, 708735, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 100, 27181, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(189, 787385, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 1759, '119.226.22.162', 'debit', 'legit', '2023-01-13'),
(190, 787385, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 100, 27281, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(191, 864057, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 1659, '119.226.22.162', 'debit', 'legit', '2023-01-13'),
(192, 864057, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'India', 'ritwik dalmia', 100, 27381, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(193, 164139, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 1559, '119.226.22.162', 'debit', 'fraud/suspicious', '2023-01-13'),
(194, 164139, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 100, 27481, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(195, 793101, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 1459, '119.226.22.162', 'debit', 'fraud/suspicious', '2023-01-13'),
(196, 793101, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 100, 27581, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(199, 656918, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 859, '119.226.22.162', 'debit', 'fraud/suspicious', '2023-01-13'),
(200, 656918, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 100, 28181, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(201, 609116, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 759, '119.226.22.162', 'debit', 'fraud/suspicious', '2023-01-13'),
(202, 609116, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 100, 28281, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(203, 922539, 'ritwikdalmia', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 659, '119.226.22.162', 'debit', 'fraud/suspicious', '2023-01-13'),
(204, 922539, 'ritwikesports', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 100, 28381, '119.226.22.162', 'credit', 'legit', '2023-01-13'),
(211, 512866, 'codingdalmia', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 500, 38500, '119.226.22.162', 'debit', 'legit', '2023-01-14'),
(212, 512866, 'ritwikdalmia', 'codingwithdalmia@gmail.com', 5428568230, 'TWL001', 'uk', 'coding dalmia', 500, 959, '119.226.22.162', 'credit', 'legit', '2023-01-14'),
(215, 626527, 'codingdalmia', 'dalmiaritwik@gmail.com', 5366649665, 'TWIZ001', 'india', 'ritwik dalmia', 200, 38100, '119.226.22.162', 'debit', 'legit', '2023-01-14'),
(216, 626527, 'ritwikdalmia', 'codingwithdalmia@gmail.com', 5428568230, 'TWL001', 'uk', 'coding dalmia', 200, 1159, '119.226.22.162', 'credit', 'legit', '2023-01-14'),
(219, 551833, 'codingdalmia', 'dalmiaritwik@gmail.com', 5416979745, 'TWIZ001', 'india', 'ritwik dalmia', 200, 37900, '119.226.22.162', 'debit', 'fraud/suspicious', '2023-01-14'),
(220, 551833, 'ritwikdalmia', 'codingwithdalmia@gmail.com', 5428568230, 'TWL001', 'uk', 'coding dalmia', 200, 200, '119.226.22.162', 'credit', 'legit', '2023-01-14'),
(221, 827701, 'ritwikesports', 'markaragnos219@gmail.com', 9183151048, 'TWIZ001', 'india', 'Marka Ragnos', 100, 28901, '119.226.22.162', 'debit', 'legit', '2023-01-14'),
(222, 827701, 'markaragnos304', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'India', 'ritwik esports', 100, 502800, '119.226.22.162', 'credit', 'legit', '2023-01-14'),
(223, 763308, 'ritwikesports', 'markaragnos219@gmail.com', 9183151048, 'TWIZ001', 'india', 'Marka Ragnos', 100, 28801, '119.226.22.162', 'debit', 'legit', '2023-01-14'),
(224, 763308, 'markaragnos304', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'India', 'ritwik esports', 100, 502900, '119.226.22.162', 'credit', 'legit', '2023-01-14'),
(225, 432802, 'ritwikesports', 'markaragnos219@gmail.com', 9183151048, 'TWIZ001', 'india', 'Marka Ragnos', 100, 28701, '119.226.22.162', 'debit', 'legit', '2023-01-14'),
(226, 432802, 'markaragnos304', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'India', 'ritwik esports', 100, 503000, '119.226.22.162', 'credit', 'legit', '2023-01-14'),
(227, 574018, 'ritwikesports', 'markaragnos219@gmail.com', 9183151048, 'TWIZ001', 'india', 'Marka Ragnos', 100, 28601, '119.226.22.162', 'debit', 'fraud/suspicious', '2023-01-14'),
(228, 574018, 'markaragnos304', 'ritwik.esports@gmail.com', 3290104586, 'TWIZ001', 'india', 'ritwik esports', 100, 503100, '119.226.22.162', 'credit', 'legit', '2023-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login_username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `Mno` bigint(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` int(6) NOT NULL,
  `verification_status` int(11) NOT NULL DEFAULT '1',
  `password_token` varchar(255) NOT NULL,
  `password_code` int(11) NOT NULL,
  `login_attempts` int(11) NOT NULL DEFAULT '0',
  `disabled_account` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login_username`, `full_name`, `email_id`, `Mno`, `password`, `token`, `verification_status`, `password_token`, `password_code`, `login_attempts`, `disabled_account`) VALUES
(8, 'ritwikesports', 'ritwik esports', 'ritwik.esports@gmail.com', 8076784960, '$2y$10$eG3aBjnF3/xL6nlKi/H2pO7mT.Vy1V8y2kSf0TClfITCoG.AehdoG', 0, 1, '', 0, 0, 1),
(9, 'codingdalmia', 'coding dalmia', 'codingwithdalmia@gmail.com', 9650697521, '$2y$10$r93Groiom307A1p1vwnZO.5eeNhDc/MicpyWNMYM74GvhAClI7F1S', 0, 1, '', 0, 0, 1),
(10, 'markaragnos304', 'Marka Ragnos', 'markaragnos219@gmail.com', 1001100109, '$2y$10$bU38rwPFIfFSkKtoBgp4fOBeyRVp0eAAfSF9LipCM5CG/btL4WcGO', 0, 1, '3744700440fd77eb0f19631da6ab58', 1, 0, 1),
(12, 'ritwikdalmia', 'ritwik dalmia', 'dalmiaritwik@gmail.com', 9971655508, '$2y$10$2Yhs1bu7x2rMkmQldEZswOoYRO9XSngY5hqZHo17gwxmMnckb./e6', 697055, 1, 'c2c0de1cdee67d39235bb93cd8c2ed', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_category`
--
ALTER TABLE `account_category`
  ADD PRIMARY KEY (`account_type_id`),
  ADD UNIQUE KEY `account_type` (`account_type`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`),
  ADD UNIQUE KEY `login_username` (`login_username`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD UNIQUE KEY `Mno` (`Mno`),
  ADD UNIQUE KEY `aadhar_card` (`aadhar_card`,`pan_card`);

--
-- Indexes for table `branch_detail`
--
ALTER TABLE `branch_detail`
  ADD PRIMARY KEY (`branch_id`),
  ADD UNIQUE KEY `branch_name` (`branch_name`,`ifsc_code`);

--
-- Indexes for table `card_account_details`
--
ALTER TABLE `card_account_details`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `account_number` (`account_number`),
  ADD UNIQUE KEY `debit_card` (`debit_card`),
  ADD UNIQUE KEY `card_id` (`card_id`),
  ADD UNIQUE KEY `login_username` (`login_username`),
  ADD UNIQUE KEY `full_name` (`full_name`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`login_username`),
  ADD UNIQUE KEY `login_username` (`login_username`,`email_id`,`Mno`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transfer_id`,`tid_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login_username` (`login_username`),
  ADD UNIQUE KEY `email_id` (`email_id`,`Mno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_category`
--
ALTER TABLE `account_category`
  MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `branch_detail`
--
ALTER TABLE `branch_detail`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `card_account_details`
--
ALTER TABLE `card_account_details`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
