-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 09, 2022 la 06:01 PM
-- Versiune server: 10.4.21-MariaDB
-- Versiune PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `lucrare_atestat_muresan_mihai_xii_b`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `aprecieri`
--

DROP TABLE IF EXISTS `aprecieri`;
CREATE TABLE `aprecieri` (
  `id_user` int(11) NOT NULL,
  `id_postare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `aprecieri`
--

INSERT INTO `aprecieri` (`id_user`, `id_postare`) VALUES
(0, 2),
(0, 4),
(2, 5),
(2, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 2),
(4, 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `aprecieric`
--

DROP TABLE IF EXISTS `aprecieric`;
CREATE TABLE `aprecieric` (
  `id_user` int(11) NOT NULL,
  `id_comentariu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `aprecieric`
--

INSERT INTO `aprecieric` (`id_user`, `id_comentariu`) VALUES
(2, 13),
(3, 13),
(3, 12);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `comentarii`
--

DROP TABLE IF EXISTS `comentarii`;
CREATE TABLE `comentarii` (
  `id` int(11) NOT NULL,
  `id_postare` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `continut` text NOT NULL,
  `editat` tinyint(1) NOT NULL,
  `nr_aprecieri` int(6) NOT NULL,
  `timp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `comentarii`
--

INSERT INTO `comentarii` (`id`, `id_postare`, `id_user`, `continut`, `editat`, `nr_aprecieri`, `timp`) VALUES
(12, 5, 0, 'Suspendisse a purus mollis arcu congue mollis vitae quis lectus. Morbi non dui ac dolor dictum sagittis. Sed egestas leo sed urna blandit, et hendrerit dui ullamcorper.', 1, 1, '2022-05-09 18:56:44'),
(13, 2, 2, 'Donec tincidunt nec augue at vestibulum. Sed aliquet mi quis magna congue, a commodo velit pharetra. Nulla at justo sit amet metus consequat condimentum. ', 0, 2, '2022-05-09 18:57:43'),
(14, 5, 3, 'Nullam rutrum odio at volutpat convallis. Morbi vitae elementum nulla. Praesent quis arcu id arcu scelerisque dapibus nec quis lorem.', 0, 0, '2022-05-09 18:58:22'),
(15, 2, 3, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam faucibus vulputate odio. Aliquam imperdiet tellus a placerat placerat.', 0, 0, '2022-05-09 18:58:40'),
(16, 4, 4, 'Morbi purus magna, tempor eget egestas at, faucibus sed nisl. Phasellus ac auctor magna. Quisque molestie diam libero, ac tempus lorem sollicitudin a. In non leo eu nunc efficitur accumsan nec sit amet eros. Mauris a felis nec libero rhoncus volutpat non ut nulla.', 1, 0, '2022-05-09 18:59:42'),
(17, 3, 4, 'Nunc lacinia aliquam purus, non semper nulla lobortis et. Donec blandit vehicula nisl, non consectetur elit mollis quis. Phasellus lacinia a erat eget lacinia. Nulla egestas efficitur sapien posuere accumsan.', 0, 0, '2022-05-09 19:00:05');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `postari`
--

DROP TABLE IF EXISTS `postari`;
CREATE TABLE `postari` (
  `id` int(11) NOT NULL,
  `titlu` varchar(160) NOT NULL,
  `continut` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `timp` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `nr_aprecieri` int(6) NOT NULL,
  `nr_comentarii` int(8) NOT NULL,
  `editata` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `postari`
--

INSERT INTO `postari` (`id`, `titlu`, `continut`, `id_user`, `timp`, `nr_aprecieri`, `nr_comentarii`, `editata`) VALUES
(2, 'Test 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget massa semper, sagittis erat porta, fringilla nulla. Vivamus at tellus lorem. Quisque molestie diam libero, ac tempus lorem sollicitudin a. In non leo eu nunc efficitur accumsan nec sit amet eros. Mauris a felis nec libero rhoncus volutpat non ut nulla. Phasellus condimentum elementum lacus vel aliquam. Sed dictum massa mauris. Sed fringilla lorem ultrices, elementum quam vel, fringilla dui. Donec scelerisque auctor sapien in faucibus. Pellentesque hendrerit ipsum purus, eget posuere nisi tincidunt nec. Mauris porta posuere egestas.', 0, '2022-05-09 18:54:22', 3, 2, 0),
(3, 'Test 2', 'Maecenas vel tempus dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam faucibus vulputate odio.\r\n\r\nAliquam imperdiet tellus a placerat placerat. Praesent sit amet ipsum et ante vehicula efficitur. In luctus orci ut laoreet commodo. Suspendisse a purus mollis arcu congue mollis vitae quis lectus. Morbi non dui ac dolor dictum sagittis. Sed egestas leo sed urna blandit, et hendrerit dui ullamcorper. Donec tincidunt nec augue at vestibulum. Sed aliquet mi quis magna congue, a commodo velit pharetra. Nulla at justo sit amet metus consequat condimentum. Morbi purus magna, tempor eget egestas at, faucibus sed nisl. Phasellus ac auctor magna. ', 2, '2022-05-09 18:55:50', 1, 1, 1),
(4, 'Test 3', 'Nulla eu finibus sem. Nullam rutrum odio at volutpat convallis. Morbi vitae elementum nulla. Praesent quis arcu id arcu scelerisque dapibus nec quis lorem. Suspendisse sed metus facilisis, finibus quam ac, pretium risus. Duis vel scelerisque velit, ac euismod purus. Cras sollicitudin faucibus auctor. Cras pretium tempus elit. Nulla quis ornare ipsum. Phasellus imperdiet tempor ligula lobortis maximus. Nam vulputate ante sit amet venenatis euismod. ', 3, '2022-05-09 18:55:55', 3, 1, 0),
(5, 'Test 4', ' Integer orci risus, semper at nisl sit amet, tempor sodales nibh. Mauris ultricies dui at risus tincidunt condimentum. Pellentesque turpis augue, dignissim sit amet consequat eu, efficitur nec dui. Maecenas eu ullamcorper nunc. Vestibulum posuere urna odio, nec viverra diam hendrerit id. Donec sed porttitor purus. Suspendisse sodales feugiat vulputate. Donec gravida non tellus et commodo. Quisque non velit scelerisque, porta tellus a, elementum erat. Nunc lacinia aliquam purus, non semper nulla lobortis et. Donec blandit vehicula nisl, non consectetur elit mollis quis. Phasellus lacinia a erat eget lacinia. Nulla egestas efficitur sapien posuere accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;\r\n\r\nAenean velit leo, molestie et nisi ut, convallis malesuada felis. Ut vel nunc mi. Nunc sem nisi, consequat id imperdiet sit amet, efficitur non enim. Praesent dignissim dignissim pharetra. Nullam eget est at sem aliquam consectetur nec nec augue. In elementum, sapien eu auctor vehicula, felis mauris fringilla turpis, auctor fermentum justo odio vel lorem. Mauris fermentum facilisis nulla in fringilla. Donec velit nisi, elementum ac mi quis, vestibulum lacinia libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec ac elit ut justo vehicula pretium nec vitae arcu. Nunc egestas nibh sit amet odio consequat ullamcorper. ', 4, '2022-05-09 18:55:58', 2, 2, 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `utilizatori`
--

DROP TABLE IF EXISTS `utilizatori`;
CREATE TABLE `utilizatori` (
  `id` int(11) NOT NULL,
  `nume` varchar(25) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `data_inregistrarii` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `nume`, `parola`, `data_inregistrarii`) VALUES
(0, 'admin', '$2y$10$K9M7t912OR4QqqC8WeoMOOyNflRPtxt4YwBkHrWK58rAFtS6xr7Fq', '2000-01-01 00:00:00'),
(2, 'test2', '$2y$10$2xQAbdAJvFd.ByIn5/DCmuyxsoGGZYA26nSzkT32CLvZxaq8zysm6', '2016-09-15 11:13:19'),
(3, 'M1841', '$2y$10$lvKfkrn3raKaw0xKqwqlE.tb3AUf5kG.Ws7T0qcJ0ecWmrlevNu.G', '2003-09-05 08:23:16'),
(4, 'test4', '$2y$10$KEZ3R9CCka3gjxybnY1HO.qAoYmY6bFepj8V4eHy7bIsReHe1zo.i', '2022-02-09 12:03:16'),
(6, 'gg', '$2y$10$qDB4.julB1Ewvv0F.bb0UOelmU9KImnZqjKUFMdi6oK7VsVkP8uvu', '2022-04-02 16:22:47');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `comentarii`
--
ALTER TABLE `comentarii`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `postari`
--
ALTER TABLE `postari`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `comentarii`
--
ALTER TABLE `comentarii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pentru tabele `postari`
--
ALTER TABLE `postari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
