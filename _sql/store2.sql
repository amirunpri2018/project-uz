-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Czas generowania: 20 Cze 2019, 14:45
-- Wersja serwera: 5.7.25
-- Wersja PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Baza danych: `store`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_number_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_number_id`, `article_id`, `price`, `quantity`) VALUES
(57, 35, 1, 1, 1),
(58, 35, 1, 1, 1),
(59, 36, 1, 1, 1),
(60, 36, 1, 1, 1),
(61, 36, 1, 1, 1),
(62, 36, 1, 1, 1),
(63, 36, 1, 1, 1),
(64, 36, 1, 1, 1),
(65, 36, 1, 1, 1),
(66, 37, 1, 1, 1),
(67, 37, 1, 1, 1),
(68, 37, 1, 1, 1),
(69, 37, 1, 1, 1),
(70, 38, 1, 1, 1),
(71, 38, 1, 1, 1),
(72, 39, 1, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED896F468C26A5E8` (`order_number_id`),
  ADD KEY `IDX_ED896F467294869C` (`article_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_ED896F467294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_ED896F468C26A5E8` FOREIGN KEY (`order_number_id`) REFERENCES `order` (`id`);
