-- --------------------------------------------------------
-- Host:                         sql.project-uz.nazwa.pl
-- Wersja serwera:               10.1.38-MariaDB - mariadb.org binary distribution
-- Serwer OS:                    debian-linux-gnu
-- HeidiSQL Wersja:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Zrzut struktury bazy danych project-uz_shop
CREATE DATABASE IF NOT EXISTS `project-uz_shop` /*!40100 DEFAULT CHARACTER SET latin2 */;
USE `project-uz_shop`;

-- Zrzut struktury tabela project-uz_shop.atrybuty
CREATE TABLE IF NOT EXISTS `atrybuty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rozmiar` text NOT NULL,
  `kolor` text NOT NULL,
  `marka` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

-- Zrzucanie danych dla tabeli project-uz_shop.atrybuty: ~0 rows (około)
/*!40000 ALTER TABLE `atrybuty` DISABLE KEYS */;
/*!40000 ALTER TABLE `atrybuty` ENABLE KEYS */;

-- Zrzut struktury tabela project-uz_shop.kategoria
CREATE TABLE IF NOT EXISTS `kategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

-- Zrzucanie danych dla tabeli project-uz_shop.kategoria: ~0 rows (około)
/*!40000 ALTER TABLE `kategoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategoria` ENABLE KEYS */;

-- Zrzut struktury tabela project-uz_shop.klienci
CREATE TABLE IF NOT EXISTS `klienci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `adres` text NOT NULL,
  `miejscowosc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli project-uz_shop.klienci: ~4 rows (około)
/*!40000 ALTER TABLE `klienci` DISABLE KEYS */;
REPLACE INTO `klienci` (`id`, `imie`, `nazwisko`, `login`, `haslo`, `adres`, `miejscowosc`) VALUES
	(0, 'michal1', 'michael321', 'Michal', 'Brycz', 'Polna 20', 'Zielona G&oacute;ra'),
	(2, 'dfsdfs', 'sdffds', 'fdssdf', 'dsfds', 'dsfds', 'dfsfds'),
	(3, 'test', 'test', 'test', 'test', 'test', 'test'),
	(4, 'test123', 'test123', 'qwerty', 'asd', 'qq', 'qq');
/*!40000 ALTER TABLE `klienci` ENABLE KEYS */;

-- Zrzut struktury tabela project-uz_shop.produkty
CREATE TABLE IF NOT EXISTS `produkty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategoria` text NOT NULL,
  `nazwa` text NOT NULL,
  `cena` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli project-uz_shop.produkty: ~0 rows (około)
/*!40000 ALTER TABLE `produkty` DISABLE KEYS */;
REPLACE INTO `produkty` (`id`, `kategoria`, `nazwa`, `cena`) VALUES
	(2, 'sport', 'test', 13);
/*!40000 ALTER TABLE `produkty` ENABLE KEYS */;

-- Zrzut struktury tabela project-uz_shop.zamowienia
CREATE TABLE IF NOT EXISTS `zamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nr_zamowienia` int(11) NOT NULL,
  `test` text NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `adres` text NOT NULL,
  `miejscowosc` text NOT NULL,
  `zamowienie` text NOT NULL,
  `kwota` float NOT NULL,
  `opcja` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli project-uz_shop.zamowienia: ~0 rows (około)
/*!40000 ALTER TABLE `zamowienia` DISABLE KEYS */;
/*!40000 ALTER TABLE `zamowienia` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
