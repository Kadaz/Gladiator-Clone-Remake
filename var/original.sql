-- phpMyAdmin SQL Dump
-- version 3.3.5.1
-- http://www.phpmyadmin.net
--
-- Host: mysql2.ugu.pl
-- Czas wygenerowania: 19 Lis 2010, 19:24
-- Wersja serwera: 5.0.89
-- Wersja PHP: 5.2.14-ugu1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `db148568`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `gracze`
--

CREATE TABLE IF NOT EXISTS `gracze` (
  `gracz` int(11) NOT NULL auto_increment,
  `login` varchar(24) collate utf8_polish_ci NOT NULL,
  `haslo` varchar(40) collate utf8_polish_ci NOT NULL,
  `email` varchar(40) collate utf8_polish_ci NOT NULL,
  `plec` varchar(1) collate utf8_polish_ci NOT NULL,
  `klasa` text collate utf8_polish_ci NOT NULL,
  `sila` int(1) NOT NULL,
  `zrecznosc` int(1) NOT NULL,
  `wyrzymalosc` int(1) NOT NULL,
  `atak` int(5) NOT NULL,
  `obrona` int(3) NOT NULL,
  `inteligencja` int(11) NOT NULL,
  `zycie` int(100) NOT NULL,
  `zycie_max` int(100) NOT NULL,
  `obrazenia_min` int(1) NOT NULL,
  `obrazenia_max` int(3) NOT NULL,
  `zloto` int(100) NOT NULL,
  `zloto_skarbiec` int(11) NOT NULL,
  `punkty` int(11) NOT NULL,
  `pracuje` int(11) NOT NULL,
  `ostatnia_walka_pvp` int(11) NOT NULL,
  `ostatnia_walka_pvc` int(11) NOT NULL,
  `ostatnio_zregenerowano` int(11) NOT NULL,
  `avatar` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`gracz`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `gracze`
--

INSERT INTO `gracze` (`gracz`, `login`, `haslo`, `email`, `plec`, `klasa`, `sila`, `zrecznosc`, `wyrzymalosc`, `atak`, `obrona`, `inteligencja`, `zycie`, `zycie_max`, `obrazenia_min`, `obrazenia_max`, `zloto`, `zloto_skarbiec`, `punkty`, `pracuje`, `ostatnia_walka_pvp`, `ostatnia_walka_pvc`, `ostatnio_zregenerowano`, `avatar`) VALUES
(1, 'testowy', 'f86bdb19deb2c5ab632734b8d884ce06', 'test@tlen.pl', 'M', 'Mag', 6, 6, 0, 40, 278, 8, 320, 320, 6, 10, 336, 0, 30, 0, 1289666663, 1289666690, 1289666704, 0),
(8, 'xxxxxxxxxx', '336311a016184326ddbdd61edd4eeb52', '', 'M', 'Wojownik', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'xxxxx', '9addbf544119efa4a64223b649750a510f0d463f', '', 'M', 'Wojownik', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `ID` int(11) NOT NULL auto_increment,
  `tekst` text NOT NULL,
  `autor` text NOT NULL,
  `date` bigint(20) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `news`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `potwory`
--

CREATE TABLE IF NOT EXISTS `potwory` (
  `potwor` int(11) NOT NULL auto_increment,
  `nazwa` text collate utf8_polish_ci NOT NULL,
  `obrazek` text collate utf8_polish_ci NOT NULL,
  `atak` int(11) NOT NULL,
  `obrona` int(11) NOT NULL,
  `zycie` int(11) NOT NULL,
  `obrazenia_min` int(11) NOT NULL,
  `obrazenia_max` int(11) NOT NULL,
  `punkty` int(11) NOT NULL,
  `zloto` int(11) NOT NULL,
  PRIMARY KEY  (`potwor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `potwory`
--

INSERT INTO `potwory` (`potwor`, `nazwa`, `obrazek`, `atak`, `obrona`, `zycie`, `obrazenia_min`, `obrazenia_max`, `punkty`, `zloto`) VALUES
(1, 'Bandyta', 'images/goblin.jpg', 10, 10, 10, 4, 5, 5, 100),
(2, 'Barbarzyńca ', 'images/ork.jpg', 25, 30, 50, 7, 10, 10, 250);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `przedmioty`
--

CREATE TABLE IF NOT EXISTS `przedmioty` (
  `przedmiot` int(11) NOT NULL auto_increment,
  `nazwa` text collate utf8_polish_ci NOT NULL,
  `typ` varchar(12) collate utf8_polish_ci NOT NULL,
  `cena_kup` int(11) NOT NULL,
  `cena_sprzedaj` int(11) NOT NULL,
  `atak` int(11) NOT NULL,
  `obrona` int(11) NOT NULL,
  `zycie_max` int(11) NOT NULL,
  `obrazenia_min` int(11) NOT NULL,
  `obrazenia_max` int(11) NOT NULL,
  `obrazek` varchar(40) character set utf8 NOT NULL default 'www/przedmioty/pusty.png',
  PRIMARY KEY  (`przedmiot`),
  KEY `typ` (`typ`,`cena_kup`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `przedmioty`
--

INSERT INTO `przedmioty` (`przedmiot`, `nazwa`, `typ`, `cena_kup`, `cena_sprzedaj`, `atak`, `obrona`, `zycie_max`, `obrazenia_min`, `obrazenia_max`, `obrazek`) VALUES
(1, 'Miecz Tytan', 'bron', 100, 50, 30, 0, 0, 1, 5, 'www/przedmioty/miecz1.png'),
(2, 'Topór ', 'bron', 150, 75, 10, 0, 0, 4, 8, 'www/przedmioty/pusty.png'),
(3, 'Puklerz ', 'tarcza', 70, 35, 0, 15, 0, 0, 0, 'www/przedmioty/pusty.png'),
(4, 'Złota Tarcza ', 'tarcza', 150, 75, 0, 50, 0, 0, 0, 'www/przedmioty/pusty.png'),
(5, 'Lekka zbroja', 'zbroja', 250, 125, 0, 70, 50, 0, 0, 'www/przedmioty/pusty.png'),
(6, 'Ciężka Zbroja ', 'zbroja', 500, 250, 0, 200, 100, 0, 0, 'www/przedmioty/pusty.png'),
(7, 'Drewniany Chełm ', 'helm', 25, 12, 0, 5, 0, 0, 0, 'www/przedmioty/pusty.png'),
(8, 'Gladiator Chełm ', 'helm', 50, 25, 0, 10, 0, 0, 0, 'www/przedmioty/pusty.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `przedmioty_gracze`
--

CREATE TABLE IF NOT EXISTS `przedmioty_gracze` (
  `id` int(11) NOT NULL auto_increment,
  `gracz_id` int(11) NOT NULL,
  `przedmiot_id` int(11) NOT NULL,
  `zalozony` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `gracz_id` (`gracz_id`,`przedmiot_id`,`zalozony`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `przedmioty_gracze`
--

INSERT INTO `przedmioty_gracze` (`id`, `gracz_id`, `przedmiot_id`, `zalozony`) VALUES
(1, 1, 2, 1),
(2, 1, 4, 1),
(3, 1, 6, 1),
(4, 1, 8, 1),
(5, 1, 4, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `raporty`
--

CREATE TABLE IF NOT EXISTS `raporty` (
  `raport` int(11) NOT NULL auto_increment,
  `gracz` int(11) NOT NULL,
  `tytul` text NOT NULL,
  `opis` text NOT NULL,
  PRIMARY KEY  (`raport`),
  KEY `gracz` (`gracz`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `raporty`
--

