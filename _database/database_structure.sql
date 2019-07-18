-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Lip 2019, 20:02
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
-- Struktura tabeli dla tabeli `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(64) NOT NULL,
  `owner_ref` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `logo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `recipient` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `content` varchar(128) NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `displayed` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `open_hours`
--

CREATE TABLE `open_hours` (
  `id` int(11) NOT NULL,
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
  `company_ref` int(11) DEFAULT NULL,
  `staff_ref` int(11) DEFAULT NULL,
  `service_ref` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `open_hours_exceptions`
--

CREATE TABLE `open_hours_exceptions` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `disposable` tinyint(4) NOT NULL DEFAULT '1',
  `company_ref` int(11) DEFAULT NULL,
  `staff_ref` int(11) DEFAULT NULL,
  `service_ref` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
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
  `created` datetime NOT NULL,
  `lastchanged` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_ref` int(11) NOT NULL,
  `category_ref` int(11) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `unit` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
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
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_hours`
--
ALTER TABLE `open_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_hours_exceptions`
--
ALTER TABLE `open_hours_exceptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `open_hours`
--
ALTER TABLE `open_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `open_hours_exceptions`
--
ALTER TABLE `open_hours_exceptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
