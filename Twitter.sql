-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 24 Mar 2017, 12:42
-- Wersja serwera: 5.7.17-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `Twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tweetId` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `text` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `Comment`
--

INSERT INTO `Comment` (`id`, `userId`, `tweetId`, `creationDate`, `text`) VALUES
(1, 1, 3, '2017-03-23 09:04:54', 'Pierwszy komentarz'),
(2, 1, 2, '2017-03-23 09:05:06', 'pierwszy komenatrz!!!'),
(3, 1, 1, '2017-03-23 09:05:20', 'Kolejny komentarz'),
(4, 2, 3, '2017-03-23 09:06:11', 'Fajny Tweet'),
(5, 2, 2, '2017-03-23 09:06:29', 'Też komentuję Tweet'),
(6, 3, 5, '2017-03-23 12:59:59', 'Sam sobie komentuje'),
(8, 3, 3, '2017-03-23 13:00:15', 'Zgadzam się'),
(9, 3, 1, '2017-03-23 13:00:30', 'Potwierdzam');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Messages`
--

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `Messages`
--

INSERT INTO `Messages` (`id`, `senderId`, `receiverId`, `creationDate`, `status`, `text`) VALUES
(1, 2, 3, '2017-03-23 23:50:58', 0, 'dobra wiadomość!!!'),
(2, 2, 3, '2017-03-23 23:52:40', 0, 'Kolejna dobra wiadomość!!!'),
(3, 2, 3, '2017-03-23 23:53:13', 0, 'I kolejna'),
(4, 2, 3, '2017-03-23 23:55:19', 0, 'Przesyałam info'),
(5, 2, 1, '2017-03-23 23:55:52', 0, 'Do CIebie też wiadomość'),
(6, 2, 1, '2017-03-23 23:57:32', 0, 'Wysyłam'),
(7, 4, 2, '2017-03-24 09:50:23', 1, 'Witam nowego usera'),
(8, 4, 2, '2017-03-24 12:27:40', 1, 'Test1'),
(9, 4, 2, '2017-03-24 12:27:50', 0, 'Test 2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE `Tweet` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `userId`, `text`, `creationDate`) VALUES
(1, 1, 'To pierwszy Tweet', '2017-03-23 09:04:29'),
(2, 1, 'To drugi Tweet', '2017-03-23 09:04:37'),
(3, 1, 'To trzeci Tweet', '2017-03-23 09:04:43'),
(5, 3, 'To mój pierwszy Tweet na temat globalnego ocieplenia!!!', '2017-03-23 12:59:49'),
(6, 3, 'Kolejny tweet newuser!', '2017-03-23 13:03:54');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`) VALUES
(1, 'nowy123', 'nowy@nowy.com', '$2y$11$BoSVkD.8YOSetKZ4wzZU1.OWgCqEoZoByVdJh8ZIYbCJ1IjRpeNMC'),
(2, 'yeti1', 'yeti@yeti.pl', '$2y$11$ZXzx.ON9KIZ0LWewE7MNQukAnblwYxi0bTweEfpN4AYQ3aOUVhHES'),
(3, 'newuser123', 'new@user.com', '$2y$11$noW3Kvo5jmoJmVCcFDFOXOg7jVEZt/c8dnGwaEooerMedbEynyKCm'),
(4, 'wiadomosci', 'info@info.pl', '$2y$11$jckpkxBrMpRVquwamY8TqO2zxbU8NlitugckHodUGmqi9FrT1fN2.');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Comment_ibfk_1` (`userId`),
  ADD KEY `Comment_ibfk_2` (`tweetId`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Messages_ibfk_1` (`senderId`),
  ADD KEY `Messages_ibfk_2` (`receiverId`);

--
-- Indexes for table `Tweet`
--
ALTER TABLE `Tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Tweet_ibfk_1` (`userId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`tweetId`) REFERENCES `Tweet` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
