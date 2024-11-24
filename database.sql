-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 08:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animal`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `aname` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `aname`, `species`) VALUES
(1, 'Lajos', 'donkey'),
(2, 'Csuri', 'sparrow'),
(3, 'Böske', 'horse'),
(4, 'Bark', 'fox'),
(5, 'Csámpás', 'donkey'),
(6, 'Csett', 'shrike'),
(7, 'Kata', 'hen'),
(8, 'Tanti', 'owl'),
(9, 'Csimbók', 'dog'),
(10, 'Pagát', 'dog'),
(11, 'Szú', 'hedgehog'),
(12, 'Őz Egon', 'deer'),
(13, 'Vu', 'owl'),
(14, 'Őzy Egon', 'deer'),
(15, 'Szimba Msenzi', 'lion'),
(16, 'Cin', 'mouse'),
(17, 'Ri', 'swallow'),
(18, 'Hóka', 'horse'),
(19, 'Szi', 'snake'),
(20, 'Kag', 'fox'),
(21, 'Kurra', 'dog'),
(22, 'Mú', 'cattle'),
(23, 'Panna', 'fox'),
(24, 'Bikfic', 'dog'),
(25, 'Tücsök', 'dog'),
(26, 'Uccu', 'dog'),
(27, 'Killi', 'goshawk'),
(28, 'Csetnik', 'dog'),
(29, 'Elemér', 'horse'),
(30, 'Duhaj', 'cattle'),
(31, 'Mici', 'cat'),
(32, 'Balambér', 'donkey'),
(33, 'Csusz', 'lizard'),
(34, 'Nyu', 'wolf'),
(35, 'Náci', 'cat'),
(36, 'Kalán', 'rabbit'),
(37, 'Ede', 'bear'),
(38, 'Kakat', 'pheasant'),
(39, 'Ráró', 'eagle'),
(40, 'fox Gyuri', 'fox'),
(41, 'Dörmögő Dömötör', 'bear'),
(42, 'Nyusziné Kalán Eleonóra', 'rabbit'),
(43, 'Kocáriné Koca', 'wild boar'),
(44, 'Ci-nyi', 'mouse'),
(45, 'Fickó', 'dog'),
(46, 'Matyi', 'jay'),
(47, 'Lupi', 'dog'),
(48, 'Professzor úr', 'owl'),
(49, 'Bob', 'dog'),
(50, 'Nerr', 'sparrowhawk'),
(51, 'Csutak', 'dog'),
(52, 'fox Elek', 'fox'),
(53, 'Mátyás', 'jay'),
(54, 'Tódor', 'lamb'),
(55, 'Pipincs', 'monkey'),
(56, 'Nagykigláb', 'stork'),
(57, 'Kerecsen', 'falcon'),
(58, 'Mackó', 'dog'),
(59, 'Uhu', 'owl'),
(60, 'Embrió', 'horse'),
(61, 'Karr', 'falcon'),
(62, 'Csibor', 'dog'),
(63, 'Miska', 'horse'),
(64, 'Pi', 'ground squirrel'),
(65, 'Vuk', 'fox'),
(66, 'Csuvik', 'owl'),
(67, 'Bogáncs', 'dog'),
(68, 'Fáni', 'cattle'),
(69, 'Rigó', 'horse'),
(70, 'Zsuzsi', 'donkey'),
(71, 'Tala', 'vulture'),
(72, 'Ruca', 'horse'),
(73, 'Nyaú', 'cat'),
(74, 'Kiri', 'kestrel'),
(75, 'Ravasz', 'fox'),
(76, 'Bubi', 'horse'),
(77, 'Bee', 'lamb'),
(78, 'Kiz', 'rat'),
(79, 'Oszkár', 'crow'),
(80, 'Miska', 'dog'),
(81, 'Vé', 'stork'),
(82, 'Rá', 'crow'),
(83, 'Kanalas Ágoston', 'rabbit'),
(84, 'Mérges', 'dog'),
(85, 'Kiő', 'buzzard'),
(86, 'Toró', 'crow'),
(87, 'Szimba', 'lion'),
(88, 'Gyuri', 'hen'),
(89, 'Holhorse', 'horse'),
(90, 'Bu', 'cattle'),
(91, 'Dorottya', 'bear'),
(92, 'Sári', 'horse'),
(93, 'Marcsa', 'horse'),
(94, 'Csuvik Aladár', 'owl'),
(95, 'Vica', 'cattle'),
(96, 'Juci', 'cat'),
(97, 'Föcske', 'dog'),
(98, 'Csirik', 'weasel'),
(99, 'Vak Toportyán', 'wolf'),
(100, 'János', 'crow'),
(101, 'Káró', 'dog'),
(102, 'Csele', 'fox'),
(103, 'Kurri', 'hen'),
(104, 'Szarka Ákos', 'magpie'),
(105, 'Julcsa', 'cattle'),
(106, 'Sárkány', 'horse'),
(107, 'Kró', 'raven'),
(108, 'ja Uleja', 'lion'),
(109, 'Paták', 'horse'),
(110, 'Bagó', 'dog'),
(111, 'Íny', 'fox'),
(112, 'Pici', 'dog'),
(113, 'Fergeteg', 'horse'),
(114, 'Csikasz', 'dog'),
(115, 'Cse', 'swallow'),
(116, 'Vörös', 'fox'),
(117, 'Pepi', 'marten'),
(118, 'Manci', 'horse'),
(119, 'Dzsinn', 'leopard'),
(120, 'Vit', 'swallow'),
(121, 'Sármány', 'horse'),
(122, 'Csákó', 'cattle'),
(123, 'Citér', 'tit'),
(124, 'Füstös', 'thrush'),
(125, 'Kanalas Boriska', 'rabbit'),
(126, 'Hú', 'owl'),
(127, 'Csám', 'wild boar'),
(128, 'Suó', 'falcon'),
(129, 'Parpu', 'heron'),
(130, 'Csufi', 'dog'),
(131, 'Küllő', 'woodpecker'),
(132, 'Tás', 'wild duck'),
(133, 'Bruku', 'pigeon'),
(134, 'Fecske', 'dog'),
(135, 'Zu', 'fly'),
(136, 'Borzas', 'dog'),
(137, 'Szeles', 'horse'),
(138, 'Mirci', 'cat'),
(139, 'Csipet', 'dog'),
(140, 'Sut', 'fox'),
(141, 'Kele', 'stork'),
(142, 'Harat', 'eagle'),
(143, 'Vahúr', 'dog'),
(144, 'Kati', 'horse'),
(145, 'Treff', 'dog'),
(146, 'Talpas', 'wolf'),
(147, 'Mari', 'thrush'),
(148, 'Sajó', 'dog'),
(149, 'Csisz', 'bat'),
(150, 'Unka', 'frog'),
(151, 'Zsivány', 'cattle'),
(152, 'Dáma', 'dog'),
(153, 'Muki', 'marten'),
(154, 'Peták', 'dog'),
(155, 'Jakab', 'dog'),
(156, 'Finánc', 'dog'),
(157, 'Lutra', 'otter'),
(158, 'Csillag', 'horse'),
(159, 'Miska', 'donkey'),
(160, 'Csilli', 'warbler'),
(161, 'Szidike', 'dog'),
(162, 'Ordas Csikasz', 'wolf'),
(163, 'Betyár', 'dog'),
(164, 'Brozovics Borz', 'badger'),
(165, 'Pille', 'butterfly'),
(166, 'Labanc', 'dog'),
(167, 'Gege', 'wild goose'),
(168, 'Morzsa', 'dog'),
(169, 'Szarvas Menyhért', 'stag'),
(170, 'Kanalas Gusztáv', 'rabbit'),
(171, 'Szultán', 'lion'),
(172, 'Tanár úr', 'owl'),
(173, 'Kanalas Őrvezető', 'rabbit'),
(174, 'Maros', 'dog'),
(175, 'Kapitány', 'horse'),
(176, 'Ravaszdi', 'fox'),
(177, 'Tecs', 'magpie'),
(178, 'Bába', 'stork'),
(179, 'Bimbó', 'cattle'),
(180, 'Hektor', 'dog'),
(181, 'Gub', 'cattle'),
(182, 'Bagamér', 'wild boar'),
(183, 'Vá', 'crow'),
(184, 'Patás', 'deer'),
(185, 'Vadász', 'horse'),
(186, 'Hollo', 'raven'),
(187, 'Agancsos', 'stag'),
(188, 'Retek', 'rabbit'),
(189, 'Vak', 'crow'),
(190, 'Cseres', 'dog'),
(191, 'Rigolyás Lipót', 'stag'),
(192, 'Szel', 'dog'),
(193, 'Ezüst', 'fox'),
(194, 'Puma', 'dog'),
(195, 'Farkas', 'wolf'),
(196, 'Majtényi Mackó', 'bear'),
(197, 'Mukk', 'sheep'),
(198, 'Kutya', 'dog'),
(199, 'Unoka', 'horse'),
(200, 'Fut', 'swallow'),
(209, 'Lion', 'Mammal');

-- --------------------------------------------------------

--
-- Table structure for table `connecting`
--

CREATE TABLE `connecting` (
  `animalid` int(11) NOT NULL,
  `novelid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `connecting`
--

INSERT INTO `connecting` (`animalid`, `novelid`) VALUES
(85, 20),
(123, 12),
(187, 11),
(141, 3),
(82, 20),
(149, 12),
(143, 11),
(157, 20),
(141, 20),
(167, 3),
(20, 20),
(36, 3),
(129, 12),
(61, 3),
(187, 20),
(7, 20),
(150, 20),
(36, 20),
(195, 20),
(111, 20),
(78, 20),
(71, 22),
(16, 12),
(45, 20),
(98, 20),
(135, 20),
(132, 20),
(61, 20),
(102, 20),
(157, 12),
(65, 20),
(77, 22),
(73, 20),
(187, 3),
(17, 3),
(126, 22),
(27, 12),
(126, 3),
(11, 20),
(78, 12),
(120, 3),
(140, 20),
(103, 20),
(150, 30),
(167, 20),
(33, 20),
(141, 11),
(127, 20),
(67, 15),
(74, 22),
(7, 15),
(143, 20),
(107, 12),
(19, 20),
(27, 3),
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `novels`
--

CREATE TABLE `novels` (
  `id` int(11) NOT NULL,
  `pyear` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `novels`
--

INSERT INTO `novels` (`id`, `pyear`, `title`, `publisher`) VALUES
(1, 1937, 'A koppányi aga testamentuma', 'Dante Könyvkiadó'),
(2, 1939, 'Zsellérek', 'Királyi Magyar Egyetemi Nyomda'),
(3, 1940, 'Csi. Történet állatokról és emberekről', 'Singer és Wolfner Irodalmi Intézet Rt'),
(4, 1941, 'Öreg utakon', 'Singer és Wolfner Irodalmi Intézet Rt.'),
(5, 1942, 'Hajnal Badányban', 'Singer és Wolfner Irodalmi Intézet Rt.'),
(7, 1944, 'Egy szem kukorica', 'Új Idők Irodalmi Intézet Rt. (Singer és Wolfner)'),
(8, 1944, 'Emberek között', 'Új Idők Kiadó'),
(9, 1946, 'Gyeplő nélkül', 'Új Idők Irodalmi Intézet Rt. (Singer és Wolfner)'),
(10, 1947, 'Tíz szál gyertya', 'Új Idők Irodalmi Intézet Rt. (Singer és Wolfner)'),
(11, 1955, 'Kele', 'Magvető Kiadó'),
(12, 1955, 'Lutra', 'Ifjúsági Könyvkiadó'),
(13, 1955, 'Halászat', 'Mezőgazdasági Kiadó'),
(14, 1957, 'Tüskevár', 'Móra Ferenc Könyvkiadó'),
(15, 1957, 'Bogáncs', 'Ifjúsági Könyvkiadó'),
(16, 1959, 'Téli berek', 'Móra Ferenc Könyvkiadó'),
(17, 1960, 'Pepi-kert. A szarvasi arborétum története és leírása', 'Mezőgazdasági Kiadó'),
(18, 1962, 'Őszi vásár', 'Magvető Könyvkiadó'),
(19, 1962, 'Kittenberger Kálmán élete', 'Móra Ferenc Könyvkiadó'),
(20, 1965, 'Vuk', 'Móra Ferenc Könyvkiadó'),
(21, 1965, 'Csend – 21 nap', 'Móra Kiadó'),
(22, 1966, 'Hu', 'Móra Könyvkiadó'),
(23, 1968, 'Barangolások', 'Móra Könyvkiadó'),
(24, 1970, 'Ballagó idő', 'Móra Ferenc Könyvkiadó'),
(25, 1973, 'Tarka rét', 'Móra Könyvkiadó.'),
(26, 1973, 'Rózsakunyhó', 'Móra Ferenc Ifjúsági Könyvkiadó'),
(27, 1987, 'Erdei utakon', 'Mezőgazdasági Kiadó'),
(28, 1988, 'Vadászatok erdőn-mezőn', 'Mezőgazdasági Kiadó'),
(29, 1993, 'Ci-Nyi', 'Nesztor'),
(30, 1994, 'Végtelen út', 'Nesztor'),
(31, 2005, 'Karácsony éjjel', 'Lazi Könyvkiadó'),
(32, 2006, 'Kísértés', 'Lazi Könyvkiadó'),
(33, 2006, 'Tűz mellett', 'Lazi Könyvkiadó'),
(34, 2006, 'Erdély', 'Lazi Könyvkiadó'),
(35, 2007, 'Fészekrablás', 'Lazi Könyvkiadó'),
(36, 2007, 'Tojáshéjdarabkák', 'Lazi Könyvkiadó'),
(37, 1997, 'A három uhu és más történetek', 'Nesztor'),
(38, 2000, 'A magam erdeiben', 'Új Ember Könyvkiadó'),
(39, 2000, 'Barros0', 'BARROS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `level` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `pass`, `level`) VALUES
(1, 'Dijanira Muachifi ', 'U2FELP', '$2y$10$dbvCxP2RPMY6IX2/xnUYdedw92yyuacd5qhnwPq9A4pn2P/XkhFXa', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
