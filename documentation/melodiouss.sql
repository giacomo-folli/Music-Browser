-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 18, 2023 alle 16:06
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `melodiouss`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `image` varchar(1024) DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `album`
--

INSERT INTO `album` (`id`, `title`, `image`, `date`, `user_id`) VALUES
(0, '', NULL, '0000-00-00', NULL),
(1, 'magari', NULL, '2023-07-17', 7),
(3, 'Night Session', NULL, '2023-07-18', 9),
(4, 'Night Session 2', NULL, '2023-07-18', 9),
(5, 'MILANO EP', NULL, '2023-07-18', 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file` varchar(1024) NOT NULL,
  `image` varchar(1024) NOT NULL,
  `title` varchar(100) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `downloads` int(11) NOT NULL DEFAULT 0,
  `popularity` int(11) NOT NULL DEFAULT 0,
  `date` datetime DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `songs`
--

INSERT INTO `songs` (`id`, `user_id`, `file`, `image`, `title`, `views`, `downloads`, `popularity`, `date`, `album_id`) VALUES
(10, 7, 'uploads/8 temporale bonus cover.mp3', 'uploads/1629886061942.jpg', 'Temporale', 0, 0, 0, '2023-07-18 13:37:21', 1),
(11, 7, 'uploads/2 MAGARIPirati.mp3', 'uploads/1629886061942.jpg', 'Pirati', 0, 0, 0, '2023-07-18 13:38:04', 1),
(12, 7, 'uploads/7 A&A acoustica.mp3', 'uploads/1629886061942.jpg', 'A&A', 1, 0, 0, '2023-07-18 13:38:37', 1),
(13, 7, 'uploads/4 animals & autotune.mp3', 'uploads/1629886061942.jpg', 'Animals & Autotunes', 1, 0, 0, '2023-07-18 13:39:17', 1),
(14, 7, 'uploads/5 MAGARIFantasia.mp3', 'uploads/1629886061942.jpg', 'Fantasia', 0, 0, 0, '2023-07-18 13:40:06', 1),
(15, 7, 'uploads/3 MAGARIMHDUF Live.mp3', 'uploads/1629886061942.jpg', 'Mi han detto', 0, 0, 0, '2023-07-18 13:40:44', 1),
(16, 9, 'uploads/01 - akom - intro.mp3', 'uploads/Copertina CD.png', 'Intro', 0, 0, 0, '2023-07-18 13:44:51', 3),
(17, 9, 'uploads/03 - akom - woods battle (1).mp3', 'uploads/Copertina CD.png', 'Woods Battle', 0, 0, 0, '2023-07-18 13:45:56', 3),
(18, 9, 'uploads/04 - akom - Fauna.mp3', 'uploads/Copertina CD.png', 'Fauna', 0, 0, 0, '2023-07-18 13:47:42', 3),
(19, 9, 'uploads/05 - akom - my broken recorder (outro).mp3', 'uploads/Copertina CD.png', 'Outro', 0, 0, 0, '2023-07-18 13:48:19', 3),
(20, 11, 'uploads/NSNS The same.mp3', 'uploads/Tavola.png', 'The Same', 1, 0, 0, '2023-07-18 13:50:57', NULL),
(21, 11, 'uploads/sad_song.mp3', 'uploads/IMG_20210226_094012.jpg', 'Sad Song', 0, 0, 0, '2023-07-18 13:52:09', NULL),
(22, 11, 'uploads/Sospesi.mp3', 'uploads/Tavola da disegno 4.png', 'Sospesi', 1, 0, 0, '2023-07-18 13:53:22', NULL),
(23, 11, 'uploads/Title and Registration.mp3', 'uploads/Tavola da disegno 6.png', 'Forte Inizio', 1, 0, 0, '2023-07-18 13:59:03', NULL),
(24, 11, 'uploads/Youth.mp3', 'uploads/Tavola da disegno 3.png', 'Palazzi di Sabbia', 7, 0, 0, '2023-07-18 14:01:23', NULL),
(25, 11, 'uploads/Maschera.mp3', 'uploads/Tavola da disegno 5.png', 'Maschera', 0, 0, 0, '2023-07-18 14:05:14', NULL),
(26, 9, 'uploads/NSNS Senza te.mp3', 'uploads/Studio_Project.png', 'Senza Te', 5, 0, 0, '2023-07-18 14:10:06', 4),
(27, 9, 'uploads/NSNS Mia matti.mp3', 'uploads/Studio_Project.png', 'Mia matti', 1, 0, 0, '2023-07-18 14:11:05', 4),
(28, 12, 'uploads/Atmosfera.mp3', 'uploads/1634041042280.png', 'Atmosfera', 0, 0, 0, '2023-07-18 14:28:58', NULL),
(29, 12, 'uploads/blackstar.mp3', 'uploads/1661940216142.jpg', 'Blackstar', 0, 0, 0, '2023-07-18 14:29:54', NULL),
(30, 12, 'uploads/voglio da te.mp3', 'uploads/16507206387m04.png', 'Voglio da te', 0, 0, 0, '2023-07-18 14:33:30', NULL),
(31, 13, 'uploads/Elefanti.mp3', 'uploads/Rasta.PNG', 'Da vicino', 0, 0, 0, '2023-07-18 14:38:57', 5),
(32, 13, 'uploads/HOME INTRUDERS.mp3', 'uploads/Rasta.PNG', 'Strana Storia', 0, 0, 0, '2023-07-18 14:40:18', 5),
(33, 13, 'uploads/Vincenzo.mp3', 'uploads/Rasta.PNG', 'Dicembre', 0, 0, 0, '2023-07-18 14:40:59', 5),
(34, 13, 'uploads/Milano.mp3', 'uploads/Rasta.PNG', 'Milano', 0, 0, 0, '2023-07-18 14:41:50', 5),
(35, 13, 'uploads/ciottoli.mp3', 'uploads/Rasta.PNG', 'Ciottoli', 4, 0, 0, '2023-07-18 14:42:51', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(5) NOT NULL,
  `biog` varchar(2000) DEFAULT NULL,
  `date` datetime NOT NULL,
  `image` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `role`, `biog`, `date`, `image`) VALUES
(7, 'paco', 'Giacomo', 'Folli', 'giacomofolli01@gmail.com', '$2y$10$6JOMidSSAZPTMBs8/TJMjuB5QUC7qlfRvgnYE.tKKMzRh0ZqKknda', 'music', '', '2023-07-18 13:33:46', 'uploads/Riugio_Astass-35.jpg'),
(9, 'matti', 'Mattia', 'Macchidani', 'mattimacchi@gmail.com', '$2y$10$L2w1zLDBWRox8GjWzQf1j.4QC.hyZBC3jfh72irnqTgNFLlG.oQa6', 'music', '', '2023-07-18 13:34:46', 'uploads/AprileChill-11.png'),
(11, 'tommi', 'Tommaso', 'Garlaschelli', 'gabbogarla@gmail.com', '$2y$10$RRwS/8AE233VeliYTStsBuvf1CY72uMxKNKbvwEDHAHl2Sg5tD0Se', 'music', '', '2023-07-18 13:35:48', 'uploads/Cena_Sara-7.jpg'),
(12, 'tea', 'Teresa', 'Folli', 'teafolli@gmail.com', '$2y$10$niYjqKpNEBLS1rCeUor.FO6QSxbMh14ukaD/MTGYQbDdNHRazyBOa', 'music', '', '2023-07-18 14:27:23', 'uploads/IMG_20220407_173710.png'),
(13, 'alex', 'Alex', 'Prandi', 'alex@gmail.com', '$2y$10$IfmQdKE.xIJjTdc2Oo7IxuX0VOpU1iMNkDQILJ2V9jjA5clxQQsHm', 'music', '', '2023-07-18 14:27:53', 'uploads/-5859254240323680373_121.jpg'),
(14, 'pedro', 'Pietro', 'Spaccaroccia', 'pietrospacca@gmail.com', '$2y$10$A8si0kHMn/xeEOx3Vnh58uuxgBVjBiQJK2fkv4L/u86PvHVwj5Ace', 'music', '', '2023-07-18 15:02:00', 'uploads/Milano_Feb-29.jpg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `US_IDR` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `views` (`views`),
  ADD KEY `downloads` (`downloads`),
  ADD KEY `popularity` (`popularity`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `id` (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `USR` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
