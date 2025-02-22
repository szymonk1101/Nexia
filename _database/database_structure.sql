-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Lis 2019, 20:33
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `nexia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `breaks`
--

DROP TABLE IF EXISTS `breaks`;
CREATE TABLE IF NOT EXISTS `breaks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_ref` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(64) NOT NULL,
  `owner_ref` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `logo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `recipient` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `content` varchar(128) NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `displayed` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oh_refs`
--

DROP TABLE IF EXISTS `oh_refs`;
CREATE TABLE IF NOT EXISTS `oh_refs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oh_ref` int(11) NOT NULL,
  `company_ref` int(11) DEFAULT NULL,
  `staff_ref` int(11) DEFAULT NULL,
  `service_ref` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `open_hours`
--

DROP TABLE IF EXISTS `open_hours`;
CREATE TABLE IF NOT EXISTS `open_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mon_from` time DEFAULT NULL,
  `mon_to` time DEFAULT NULL,
  `tue_from` time DEFAULT NULL,
  `tue_to` time DEFAULT NULL,
  `wed_from` time DEFAULT NULL,
  `wed_to` time DEFAULT NULL,
  `thu_from` time DEFAULT NULL,
  `thu_to` time DEFAULT NULL,
  `fri_from` time DEFAULT NULL,
  `fri_to` time DEFAULT NULL,
  `sat_from` time DEFAULT NULL,
  `sat_to` time DEFAULT NULL,
  `sun_from` time DEFAULT NULL,
  `sun_to` time DEFAULT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  `company_ref` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `open_hours_exceptions`
--

DROP TABLE IF EXISTS `open_hours_exceptions`;
CREATE TABLE IF NOT EXISTS `open_hours_exceptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `fullday` tinyint(4) NOT NULL DEFAULT '0',
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `disposable` tinyint(4) NOT NULL DEFAULT '1',
  `company_ref` int(11) DEFAULT NULL,
  `staff_ref` int(11) DEFAULT NULL,
  `service_ref` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `permissions_staff`
--

DROP TABLE IF EXISTS `permissions_staff`;
CREATE TABLE IF NOT EXISTS `permissions_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_ref` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ref` int(11) NOT NULL,
  `company_ref` int(11) NOT NULL,
  `service_ref` int(11) NOT NULL,
  `staff_ref` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time DEFAULT NULL,
  `status` int(11) NOT NULL,
  `confirmed` int(11) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `payment_method` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `lastchanged` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `company_ref` int(11) NOT NULL,
  `category_ref` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `unit` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services_categories`
--

DROP TABLE IF EXISTS `services_categories`;
CREATE TABLE IF NOT EXISTS `services_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_ref` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `value_str` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ref` int(11) NOT NULL,
  `company_ref` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `result` tinyint(4) NOT NULL,
  `err` varchar(64) DEFAULT NULL,
  `crc` varchar(128) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userdata`
--

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE IF NOT EXISTS `userdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ref` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` varchar(16) NOT NULL,
  `city` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `token_expdate` bigint(20) NOT NULL,
  `remember_code` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `type` int(11) NOT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `login_attempts` int(11) NOT NULL DEFAULT '0',
  `last_login_attempt` int(11) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `rank` varchar(128) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
