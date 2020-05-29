-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Mai 2020 um 14:01
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webdb`
--

DELIMITER $$
--
-- Prozeduren
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_fullTextSearch` (IN `search_term` VARCHAR(255))  BEGIN

SELECT 
    id,
    name,
    author,
    isbn,
    verlag,
    preis,
    genre_name
FROM (
    SELECT
        p.id,
        p.name,
        p.author,
        p.isbn,
        p.verlag,
        p.preis,
        g.genre_name,
        MATCH(p.name, p.author, p.verlag, p.isbn) AGAINST (CONCAT('*', search_term, '*') IN BOOLEAN MODE) AS MATCH1,
        MATCH(g.genre_name) AGAINST (CONCAT('*', search_term, '*') IN BOOLEAN MODE) AS MATCH2
    FROM produkt p
    INNER JOIN genre g ON g.id = p.genre_id
) AS q
WHERE q.MATCH1 > 0 OR q.MATCH2 > 0;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `treuepunkte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen`
--

CREATE TABLE `bestellungen` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `bestelldatum` datetime NOT NULL,
  `produkt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `genre`
--

INSERT INTO `genre` (`id`, `genre_name`) VALUES
(1, 'roman'),
(2, 'krimi'),
(3, 'science fiction'),
(4, 'historische romane'),
(5, 'liebesromane'),
(6, 'familienleben'),
(7, 'comic und cartoon'),
(8, 'belletristik'),
(9, 'lyrik'),
(10, 'thriller'),
(11, 'fantasy'),
(12, 'familiensaga'),
(13, 'erotik'),
(14, 'sportromane'),
(15, 'musik'),
(16, 'spekulative literatur'),
(17, 'horror'),
(18, 'legenden'),
(19, 'abenteuerromane'),
(20, 'lifestyle'),
(21, 'satiere'),
(22, 'religion'),
(23, 'biografie'),
(24, 'sozial'),
(25, 'sprache'),
(26, 'naturwissenschaft'),
(27, 'ladwirtschaft'),
(28, 'tatsachenbericht'),
(29, 'reden'),
(30, 'politik'),
(31, 'nachschlagewerk'),
(32, 'umweltwissenschaft'),
(33, 'it'),
(34, 'memoiren'),
(35, 'kultur'),
(36, 'geschichte'),
(37, 'wirtschaft'),
(38, 'recht'),
(39, 'technik'),
(40, 'körper'),
(41, 'magie'),
(42, 'medizin'),
(43, 'gesundheit'),
(44, 'partnerschaft');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `id` int(11) NOT NULL,
  `vorname` varchar(45) NOT NULL,
  `nachname` varchar(45) NOT NULL,
  `geburtsdatum` date NOT NULL,
  `nummer` int(11) NOT NULL,
  `bundesland` varchar(45) NOT NULL,
  `plz` varchar(5) NOT NULL,
  `ort` varchar(45) NOT NULL,
  `strasse` varchar(45) NOT NULL,
  `hausnummer` varchar(50) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunden_interesse`
--

CREATE TABLE `kunden_interesse` (
  `id` int(11) NOT NULL,
  `genre` varchar(45) NOT NULL,
  `ausgeliehen` int(11) NOT NULL,
  `gekauft` int(11) NOT NULL,
  `kunden_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkt`
--

CREATE TABLE `produkt` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `verlag` varchar(45) NOT NULL,
  `isbn` varchar(45) NOT NULL,
  `preis` float NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `produkt`
--

INSERT INTO `produkt` (`id`, `name`, `author`, `verlag`, `isbn`, `preis`, `genre_id`) VALUES
(1, '1965 – Der erste Fall für Thomas Engel', 'Thomas Cristos', 'blanvalet', '978-3-7645-0719-0', 20, 1),
(2, '1q84', 'Ursula Graefe', 'shinchosa', '973-3-442-74362-9', 16, 1),
(3, 'Blackout – morgen ist es zu spät', 'Marc Elsberg', 'blanvalet', '978-3442380299', 10.99, 1),
(4, 'Zero – Sie wissen, was du tust', 'Marc Elsberg', 'blanvalet', '978-3734100932', 10.99, 1),
(5, 'Helix – Sie werden uns ersetzen', 'Marc Elsberg', 'blanvalet', '978-3734105579', 10.99, 1),
(6, '9 Stunden Angst', 'Max Kinings', 'ebook', '978-317-105579', 8.99, 2),
(7, 'Abendlied für einen Moerder', 'Maruizio deGiovanni', 'goldmann', '978-3-442-31463-8', 20, 2),
(8, '1. Preis: Allmaechtigkeit', 'Robert Sheckley', 'ebook', '978-417-105579', 2.99, 3),
(9, '2012 – Die Prophezeiung', 'Steve Alten', 'ebook', '978-317-101-579', 9.99, 3),
(10, 'Alexander', 'Gisbert Haefs', 'heyne', '978-3-453-47116-0', 9.99, 4),
(11, 'Alexanders Erbe', 'Gisbert Haefs', 'heyne', '978-3-453-47129-0', 9.99, 4),
(12, 'Arena', 'Simon Scarrow', 'heyne', '978-3-453-47128-3', 9.99, 4),
(13, 'Blut Schwerter', 'Simon Scarrow', 'heyne', '978-3-453-47328-3', 9.99, 4),
(14, 'Abingdon Hall- Der letzte Sommer', 'Phillip Rock', 'ebook', '978-317-165579', 9.99, 5),
(15, '4 Seasons – Labyrinth des Begehres', 'Vina Jackson', 'calis book', '978-3-641-14970-3', 9.99, 5),
(16, '4 Seasons – Naechte der Leidenschaft', 'Vina Jackson', 'calis book', '978-3-641-14990-3', 9.99, 5),
(17, '4 Seasons – Zeiten der Lust', 'Vina Jackson', 'calis book', '978-3-641-14150-3', 9.99, 5),
(18, 'Andersens Maerchen', 'Christia Andersen', 'anaconda', '978-3-86647-546-5', 9.95, 18),
(19, 'Bechtsteins Maerchen', 'Ludwi Bechtstein', 'anaconda', '978-3-7306-0670-4', 14.99, 18),
(20, 'Wikinger Mythen', 'Peter Archer', 'anaconda', '978-3-7306-0629-2', 9.95, 18);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_bestellungen_produkt` (`produkt_id`),
  ADD KEY `FK_account_bestellung` (`account_id`);

--
-- Indizes für die Tabelle `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `genre` ADD FULLTEXT KEY `genre_name` (`genre_name`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kunde_account` (`account_id`);

--
-- Indizes für die Tabelle `kunden_interesse`
--
ALTER TABLE `kunden_interesse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_kunden_interesse` (`kunden_id`);

--
-- Indizes für die Tabelle `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_produkt_genre` (`genre_id`);
ALTER TABLE `produkt` ADD FULLTEXT KEY `name` (`name`,`author`,`isbn`,`verlag`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kunden_interesse`
--
ALTER TABLE `kunden_interesse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `produkt`
--
ALTER TABLE `produkt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD CONSTRAINT `FK_account_bestellung` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `FK_bestellungen_produkt` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`id`);

--
-- Constraints der Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD CONSTRAINT `FK_kunde_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);

--
-- Constraints der Tabelle `kunden_interesse`
--
ALTER TABLE `kunden_interesse`
  ADD CONSTRAINT `FK_kunden_interesse` FOREIGN KEY (`kunden_id`) REFERENCES `kunde` (`id`);

--
-- Constraints der Tabelle `produkt`
--
ALTER TABLE `produkt`
  ADD CONSTRAINT `FK_produkt_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
