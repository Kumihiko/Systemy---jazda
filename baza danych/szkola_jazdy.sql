-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 08, 2025 at 06:59 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `szkola_jazdy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auta`
--

CREATE TABLE `auta` (
  `ID_Auta` int(11) NOT NULL,
  `Marka` varchar(50) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Rejestracja` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `egzaminy_probne`
--

CREATE TABLE `egzaminy_probne` (
  `ID_Egzaminu` int(11) NOT NULL,
  `ID_Kursanta` int(11) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Wynik` enum('Pozytywny','Negatywny') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `instruktorzy`
--

CREATE TABLE `instruktorzy` (
  `ID_Instruktora` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `Telefon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instruktorzy`
--

INSERT INTO `instruktorzy` (`ID_Instruktora`, `Imie`, `Nazwisko`, `Telefon`) VALUES
(1, 'marcin', 'myszka', '123123123'),
(2, 'katarzyna', 'konieczko', '333333333'),
(3, 'przemek', 'Malinowski', NULL),
(4, 'mariola', 'kacprzak', NULL),
(5, 'Piotr', 'Wiśniewski', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jazdy`
--

CREATE TABLE `jazdy` (
  `ID_Jazdy` int(11) NOT NULL,
  `ID_Kursanta` int(11) DEFAULT NULL,
  `ID_Instruktora` int(11) DEFAULT NULL,
  `ID_Auta` int(11) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Godzina` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursanci`
--

CREATE TABLE `kursanci` (
  `ID_Kursanta` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `ID_Instruktora` int(11) DEFAULT NULL,
  `Kategoria` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kursanci`
--

INSERT INTO `kursanci` (`ID_Kursanta`, `Imie`, `Nazwisko`, `ID_Instruktora`, `Kategoria`) VALUES
(10, 'Bartosz', 'Kruczkowski', NULL, 'B'),
(11, 'Oleksandr', 'Nikoliuk', 2, 'A'),
(15, 'marcin', 'kamionka', NULL, 'D'),
(16, 'ola', 'jakaśtam', 4, 'A');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje_teoretyczne`
--

CREATE TABLE `lekcje_teoretyczne` (
  `ID_Lekcji` int(11) NOT NULL,
  `ID_Instruktora` int(11) DEFAULT NULL,
  `Sala` varchar(20) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Godzina` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lekcje_teoretyczne`
--

INSERT INTO `lekcje_teoretyczne` (`ID_Lekcji`, `ID_Instruktora`, `Sala`, `Data`, `Godzina`) VALUES
(1, 2, 'Sala 101', '2025-04-15', '10:00:00'),
(2, 2, 'Sala 102', '2025-04-16', '12:00:00'),
(3, 1, 'Sala 103', '2025-04-17', '14:00:00'),
(4, 1, 'Sala 104', '2025-04-18', '16:00:00'),
(5, 1, 'Sala 105', '2025-04-19', '09:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje_teoretyczne_dane`
--

CREATE TABLE `lekcje_teoretyczne_dane` (
  `ID` int(11) NOT NULL,
  `ID_Lekcji` int(11) DEFAULT NULL,
  `Temat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `auta`
--
ALTER TABLE `auta`
  ADD PRIMARY KEY (`ID_Auta`);

--
-- Indeksy dla tabeli `egzaminy_probne`
--
ALTER TABLE `egzaminy_probne`
  ADD PRIMARY KEY (`ID_Egzaminu`),
  ADD KEY `ID_Kursanta` (`ID_Kursanta`);

--
-- Indeksy dla tabeli `instruktorzy`
--
ALTER TABLE `instruktorzy`
  ADD PRIMARY KEY (`ID_Instruktora`);

--
-- Indeksy dla tabeli `jazdy`
--
ALTER TABLE `jazdy`
  ADD PRIMARY KEY (`ID_Jazdy`),
  ADD KEY `ID_Kursanta` (`ID_Kursanta`),
  ADD KEY `ID_Instruktora` (`ID_Instruktora`),
  ADD KEY `ID_Auta` (`ID_Auta`);

--
-- Indeksy dla tabeli `kursanci`
--
ALTER TABLE `kursanci`
  ADD PRIMARY KEY (`ID_Kursanta`),
  ADD KEY `ID_Instruktora` (`ID_Instruktora`);

--
-- Indeksy dla tabeli `lekcje_teoretyczne`
--
ALTER TABLE `lekcje_teoretyczne`
  ADD PRIMARY KEY (`ID_Lekcji`),
  ADD KEY `ID_Instruktora` (`ID_Instruktora`);

--
-- Indeksy dla tabeli `lekcje_teoretyczne_dane`
--
ALTER TABLE `lekcje_teoretyczne_dane`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Lekcji` (`ID_Lekcji`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auta`
--
ALTER TABLE `auta`
  MODIFY `ID_Auta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `egzaminy_probne`
--
ALTER TABLE `egzaminy_probne`
  MODIFY `ID_Egzaminu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instruktorzy`
--
ALTER TABLE `instruktorzy`
  MODIFY `ID_Instruktora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jazdy`
--
ALTER TABLE `jazdy`
  MODIFY `ID_Jazdy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kursanci`
--
ALTER TABLE `kursanci`
  MODIFY `ID_Kursanta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lekcje_teoretyczne`
--
ALTER TABLE `lekcje_teoretyczne`
  MODIFY `ID_Lekcji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lekcje_teoretyczne_dane`
--
ALTER TABLE `lekcje_teoretyczne_dane`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `egzaminy_probne`
--
ALTER TABLE `egzaminy_probne`
  ADD CONSTRAINT `egzaminy_probne_ibfk_1` FOREIGN KEY (`ID_Kursanta`) REFERENCES `kursanci` (`ID_Kursanta`);

--
-- Constraints for table `jazdy`
--
ALTER TABLE `jazdy`
  ADD CONSTRAINT `jazdy_ibfk_1` FOREIGN KEY (`ID_Kursanta`) REFERENCES `kursanci` (`ID_Kursanta`),
  ADD CONSTRAINT `jazdy_ibfk_2` FOREIGN KEY (`ID_Instruktora`) REFERENCES `instruktorzy` (`ID_Instruktora`),
  ADD CONSTRAINT `jazdy_ibfk_3` FOREIGN KEY (`ID_Auta`) REFERENCES `auta` (`ID_Auta`);

--
-- Constraints for table `kursanci`
--
ALTER TABLE `kursanci`
  ADD CONSTRAINT `kursanci_ibfk_1` FOREIGN KEY (`ID_Instruktora`) REFERENCES `instruktorzy` (`ID_Instruktora`);

--
-- Constraints for table `lekcje_teoretyczne`
--
ALTER TABLE `lekcje_teoretyczne`
  ADD CONSTRAINT `lekcje_teoretyczne_ibfk_1` FOREIGN KEY (`ID_Instruktora`) REFERENCES `instruktorzy` (`ID_Instruktora`);

--
-- Constraints for table `lekcje_teoretyczne_dane`
--
ALTER TABLE `lekcje_teoretyczne_dane`
  ADD CONSTRAINT `lekcje_teoretyczne_dane_ibfk_1` FOREIGN KEY (`ID_Lekcji`) REFERENCES `lekcje_teoretyczne` (`ID_Lekcji`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
