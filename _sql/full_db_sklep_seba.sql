-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Wersja serwera:               10.3.14-MariaDB - mariadb.org binary distribution
-- Serwer OS:                    Win64
-- HeidiSQL Wersja:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Zrzut struktury bazy danych sklep
CREATE DATABASE IF NOT EXISTS `sklep` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sklep`;

-- Zrzut struktury tabela sklep.elementy_zam
CREATE TABLE IF NOT EXISTS `elementy_zam` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Zamowienia` int(11) NOT NULL,
  `ID_Produktu` int(11) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `Wartosc_Brutto` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.elementy_zam: ~0 rows (około)
DELETE FROM `elementy_zam`;
/*!40000 ALTER TABLE `elementy_zam` DISABLE KEYS */;
/*!40000 ALTER TABLE `elementy_zam` ENABLE KEYS */;

-- Zrzut struktury tabela sklep.klienci
CREATE TABLE IF NOT EXISTS `klienci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `adres` text NOT NULL,
  `miejscowosc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.klienci: ~2 rows (około)
DELETE FROM `klienci`;
/*!40000 ALTER TABLE `klienci` DISABLE KEYS */;
INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `login`, `haslo`, `adres`, `miejscowosc`) VALUES
	(2, 'dfsdfs', 'sdffds', 'fdssdf', 'dsfds', 'dsfds', 'dfsfds'),
	(3, 'test', 'test', 'test', 'test', 'test', 'test'),
	(4, 'Andrzej', 'Newton', 'andrew123', 'lol1234', 'Lipowa', 'Wolsztyn');
/*!40000 ALTER TABLE `klienci` ENABLE KEYS */;

-- Zrzut struktury tabela sklep.produkty
CREATE TABLE IF NOT EXISTS `produkty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategoria` text NOT NULL,
  `nazwa` text NOT NULL,
  `cena` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.produkty: ~0 rows (około)
DELETE FROM `produkty`;
/*!40000 ALTER TABLE `produkty` DISABLE KEYS */;
INSERT INTO `produkty` (`id`, `kategoria`, `nazwa`, `cena`) VALUES
	(2, 'sport', 'test', 13);
/*!40000 ALTER TABLE `produkty` ENABLE KEYS */;

-- Zrzut struktury tabela sklep.status
CREATE TABLE IF NOT EXISTS `status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nazwa` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.status: ~6 rows (około)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`ID`, `Nazwa`) VALUES
	(1, 'Usunięte'),
	(2, 'Anulowane'),
	(3, 'Nowe'),
	(4, 'W realizacji'),
	(5, 'Przygotowane do wysyłki'),
	(6, 'Zakończone (wysłane)');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Zrzut struktury tabela sklep.zamowienia
CREATE TABLE IF NOT EXISTS `zamowienia` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Klienta` int(11) NOT NULL,
  `Data_Zlozenia` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT -1,
  `Imie` varchar(50) NOT NULL,
  `Nazwisko` varchar(50) NOT NULL,
  `Ulica` varchar(50) NOT NULL,
  `Miejscowosc` varchar(50) NOT NULL,
  `Kod_Pocztowy` varchar(50) NOT NULL,
  `Nr_Telefonu` varchar(50) NOT NULL,
  `Kwota` float NOT NULL,
  `zamowienie` text NOT NULL,
  `opcja` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.zamowienia: ~2 rows (około)
DELETE FROM `zamowienia`;
/*!40000 ALTER TABLE `zamowienia` DISABLE KEYS */;
INSERT INTO `zamowienia` (`ID`, `ID_Klienta`, `Data_Zlozenia`, `Status`, `Imie`, `Nazwisko`, `Ulica`, `Miejscowosc`, `Kod_Pocztowy`, `Nr_Telefonu`, `Kwota`, `zamowienie`, `opcja`) VALUES
	(1, 4, '2019-06-17 20:12:17', 6, 'Andrzej', 'Newton', 'Podgórna 16', 'Wolsztyn', '64-200', '600 700 800', 400.8, 'wtf', 'wtf'),
	(2, 4, '2019-06-17 20:30:48', 3, 'Andrzej', 'Newton', 'Podgórna', 'Wolsztyn', '64-200', '600 700 800', 244.99, 'wtf', 'wtf');
/*!40000 ALTER TABLE `zamowienia` ENABLE KEYS */;

-- Zrzut struktury tabela sklep.zap_konwersacja
CREATE TABLE IF NOT EXISTS `zap_konwersacja` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Zapytania` int(11) NOT NULL DEFAULT -1,
  `ID_Uzytkownika` int(11) NOT NULL DEFAULT -1,
  `Data_Wyslania` datetime DEFAULT NULL,
  `Tresc` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.zap_konwersacja: ~3 rows (około)
DELETE FROM `zap_konwersacja`;
/*!40000 ALTER TABLE `zap_konwersacja` DISABLE KEYS */;
INSERT INTO `zap_konwersacja` (`ID`, `ID_Zapytania`, `ID_Uzytkownika`, `Data_Wyslania`, `Tresc`) VALUES
	(1, 1, 4, '2019-06-18 17:06:29', 'Witam!<br>\r\n<br>\r\nCo się dzieje z moim zamówieniem? <br>\r\nOd 3 dni nie zmienił się status! <br>\r\nProszę o interwencję!<br>\r\n<br>\r\nPozdrawiam'),
	(2, 2, 4, '2019-06-18 17:15:00', 'Dzień dobry!<br>Proszę o udzielenie rabatu na zamówienie.'),
	(3, 1, -1, '2019-06-18 17:52:35', 'Dzień dobry!<br><br>\r\nNajmocniej przeraszamy, błąd systemu.<br>\r\nProsimy uzbroić się w cierpliwość.<br>\r\n<br>\r\nPozdrawiamy,<br>Zespół Shoply'),
	(4, 2, -1, '2019-06-18 17:43:03', 'Dzień dobry<br>Niestety, nie możemy udzielić rabatu.<br>Pozdrawiamy');
/*!40000 ALTER TABLE `zap_konwersacja` ENABLE KEYS */;

-- Zrzut struktury tabela sklep.zap_status
CREATE TABLE IF NOT EXISTS `zap_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nazwa` varchar(50) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.zap_status: ~4 rows (około)
DELETE FROM `zap_status`;
/*!40000 ALTER TABLE `zap_status` DISABLE KEYS */;
INSERT INTO `zap_status` (`ID`, `Nazwa`) VALUES
	(1, 'Nowe'),
	(2, 'Odpowiedź klienta'),
	(3, 'Odpowiedź ze sklepu'),
	(4, 'Zamknięte');
/*!40000 ALTER TABLE `zap_status` ENABLE KEYS */;

-- Zrzut struktury tabela sklep.zap_zapytania
CREATE TABLE IF NOT EXISTS `zap_zapytania` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Klienta` int(11) NOT NULL DEFAULT -1,
  `Data_Utworzenia` datetime NOT NULL,
  `Status` int(11) NOT NULL,
  `Temat` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli sklep.zap_zapytania: ~0 rows (około)
DELETE FROM `zap_zapytania`;
/*!40000 ALTER TABLE `zap_zapytania` DISABLE KEYS */;
INSERT INTO `zap_zapytania` (`ID`, `ID_Klienta`, `Data_Utworzenia`, `Status`, `Temat`) VALUES
	(1, 4, '2019-06-18 17:05:57', 1, 'Status wysyłki'),
	(2, 4, '2019-06-18 17:44:08', 4, 'Rabat');
/*!40000 ALTER TABLE `zap_zapytania` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
