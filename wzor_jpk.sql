-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 10 Maj 2022, 13:58
-- Wersja serwera: 8.0.29-0ubuntu0.20.04.3
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `jpk_minti`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `22_01`
--

CREATE TABLE `22_01` (
  `LpSprzedazy` int NOT NULL,
  `NrKontrahenta` text CHARACTER SET utf8mb3 COLLATE utf8_polish_ci NOT NULL,
  `NazwaKontrahenta` text CHARACTER SET utf8mb3 COLLATE utf8_polish_ci NOT NULL,
  `AdresKontrahenta` text CHARACTER SET utf8mb3 COLLATE utf8_polish_ci NOT NULL,
  `DowodSprzedazy` text CHARACTER SET utf8mb3 COLLATE utf8_polish_ci NOT NULL,
  `DataWystawienia` date NOT NULL,
  `DataSprzedazy` date NOT NULL,
  `K_13` decimal(14,2) NOT NULL,
  `K_15` decimal(14,2) NOT NULL,
  `K_16` decimal(14,2) NOT NULL,
  `K_17` decimal(14,2) NOT NULL,
  `K_18` decimal(14,2) NOT NULL,
  `K_19` decimal(14,2) NOT NULL,
  `K_20` decimal(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `22_01`
--

INSERT INTO `22_01` (`LpSprzedazy`, `NrKontrahenta`, `NazwaKontrahenta`, `AdresKontrahenta`, `DowodSprzedazy`, `DataWystawienia`, `DataSprzedazy`, `K_13`, `K_15`, `K_16`, `K_17`, `K_18`, `K_19`, `K_20`) VALUES
(1, 'BRAK', 'AAA', 'BBB', 'CCC', '2022-01-26', '2022-02-28', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(2, 'BRAK', 'AAA', 'BBB', 'CCC', '2022-01-26', '2022-02-28', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(3, 'BRAK', 'AAA', 'BBB', 'CCC', '2022-01-26', '2022-02-28', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
