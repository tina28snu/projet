-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2017 at 01:23 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projetzend2`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
`Id` int(11) NOT NULL,
  `Nom` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Description` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `IdUser` int(11) DEFAULT NULL,
  `IdCategory` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `annonce`
--

INSERT INTO `annonce` (`Id`, `Nom`, `Description`, `Prix`, `IdUser`, `IdCategory`) VALUES
(5, 'Chaise Relax Bébé', 'Chaise Relax Bébé, multicolore, marque: Brevi Italie', '25.00', 1, 5),
(6, 'Garde robe avec miroirs', 'Garde robe avec deux miroirs, mesures: 150/200 cm. ', '40.00', 1, 1),
(7, 'Playstation 3 - 1 manette -2 jeux', 'Playstation 3 - 120 GB - 2 Jeux (voir photos ) - 1 Manettes !', '100.00', 1, 8),
(8, 'Projecteur led. hdmi. usb. sd. vga. av. neuf', 'Produit neuf dans sa boite\r\n\r\nSpécification\r\n\r\nMode de Projection Vidéoprojecteur de Cinéma\r\nType de lampe LED\r\nTechonologie Relative à la Vidéoprojection\r\nRésolution Native WVGA (800x480)\r\nRésolution Compatible 1080P (1920x1080)\r\nCorrection Keystone ±15°\r\nLuminosité (lumens) 800lm\r\nChamp de Luminosité 100 - 999 Lumens\r\nDurée de Vie de la Lampe 20000 (Heures)\r\nObjectifs 125mm\r\nContraste 33.33402777777778\r\nFormat d''Image 4:3\r\nDistance de Projection (m) 1-3.8\r\nTaille Ecran de Projection (pouces) 34''''-130"\r\nFormat vidéo MPEG, VOB, MOV, AVI, MP4, H.264, FLV, RMVB\r\nEnceintes Incluses Oui, Intégrée\r\nFormat audio OGG, ACC/ACC+, WMA, MP3\r\nFormat Photo PNG, BMP, JPEG\r\nConnecteurs Jack 3.5mm stéréo, Entrée HDMI, USB, Entrée AV 3-en-1\r\nConnectique Avec fil\r\nTension d''Entrée (V) 100-240V\r\nConsommation d''énergie (W) 55W\r\nDimension (cm) 20*15*6.8\r\nCouleur Noir\r\nPoids Net (kg) 1.0 ', '95.00', 1, 9),
(9, 'Pots et plantes', 'les pots et les plantes ,15 euros la pièces ', '15.00', 1, 3),
(10, 'Relax pivotant+réglable neuf avec repose-pied', '(emballé) jamais ouvert\r\n• Dimensions: Largeur : 66,5 cm Hauteur : 98 cm Profondeur : 80 cm Largeur d''assise : 47,5 cm Hauteur d''assise : 45 cm Profondeur d''assise : 51 cm Tabouret (largeur x hauteur x profondeur) : 48,5 x 38 x 41,5 cm\r\n• État à la livraison: À monter\r\n\r\nDesign :\r\n• Design élégant et fonctions intelligentes\r\n• Meuble classique pour une ambiance distinguée\r\n• Formes élégamment arquées avec pieds pivotants\r\nFonction :\r\n• Pivotant à 360°\r\n• Dossier à réglage continu grâce au poids de votre corps.\r\nConfort d''assise :\r\n• Position assise et relaxation ergonomiques\r\n• Rembourrage volumineux pour un confort d''assise optimal\r\n• Repose-pieds confortable à positionner librement\r\n• Charge maximale de 120 kg\r\n• Structure en acier stable ', '100.00', 2, 1),
(11, 'Bureau avec tiroir 140 x 60 cm', 'bureau avec tiroir\r\n140 cm x 60 cm\r\nà venir chercher sur Bruxelles\r\nen l''état ', '10.00', 2, 1),
(12, 'Cafetiere Dolce Gusto', 'Je mets en vente une cafetiere dolce Gusto marque Krups en très très bon état elle fanctionne très très bien. Le prix 35€. Evere. Bruxelles. Pour + d''information vous pouvez me cancacte sur mon numéro. ', '35.00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`Id` int(11) NOT NULL,
  `Nom` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id`, `Nom`) VALUES
(1, 'Meubles et décorations'),
(2, 'Electroménageres'),
(3, 'Jardin'),
(4, 'Bricolage et construction'),
(5, 'Enfant et bébé'),
(6, 'Vêtements et accessoires'),
(7, 'Informatique'),
(8, 'Consoles et jeux vidéo'),
(9, 'Films et TV'),
(10, 'Musique et audio'),
(11, 'Animaux'),
(12, 'Livres');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
`Id` int(11) NOT NULL,
  `Chemin` varchar(255) COLLATE utf8_bin NOT NULL,
  `IdAnnonce` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`Id`, `Chemin`, `IdAnnonce`) VALUES
(10, '1487234365121715014279829.jpg', 6),
(11, '1487234555121715017814534.jpg', 7),
(12, '1487234555120715018203373.jpg', 7),
(13, '1487235537131716010653240.jpg', 8),
(14, '1487235537130716012830058.jpg', 8),
(15, '1487235537136716013685277.jpg', 8),
(17, '1487235636127715011296125.jpg', 9),
(18, '1487242236138716013769622.jpg', 10),
(19, '1487242236139716012397085.jpg', 10),
(20, '1487242236130716010920404.jpg', 10),
(21, '1487242517120715013155975.jpg', 11),
(22, '1487242517129715018104470.jpg', 11),
(23, '1487242704131716010066564.jpg', 12),
(38, '1487589585137716010316473.jpg', 8),
(39, '1487589609127715017556166.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`Id` int(11) NOT NULL,
  `Nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `Prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `Telephone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Adresse` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Password` varchar(512) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Nom`, `Prenom`, `Email`, `Telephone`, `Adresse`, `Password`) VALUES
(1, 'Snu', 'Tina', 'tina28snu@yahoo.com', '0477504500', 'Rue Vanderkindere 560, 1180 Bruxelles, Belgique', '$2y$12$GdS.woy3YAjxrcEbgFL9E.EiO.Lg6h9F2xZoWCIWhXbyuDXD9q8j2'),
(2, 'Sa', 'Gabriela', 'gabriela.sa@yahoo.com', '0477504501', 'Avenue Penelope 28, 1190 Bruxelles, Belgique', '$2y$12$XiGTqSWhcE2wSQGXkhQYLOfw3vS6OxR7BuzS9LZYDRZ02AgaTRONy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annonce`
--
ALTER TABLE `annonce`
 ADD PRIMARY KEY (`Id`), ADD KEY `IdUser` (`IdUser`), ADD KEY `IdCategory` (`IdCategory`), ADD KEY `IdUser_2` (`IdUser`), ADD KEY `IdUser_3` (`IdUser`,`IdCategory`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
 ADD PRIMARY KEY (`Id`), ADD KEY `IdAnnonce` (`IdAnnonce`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annonce`
--
ALTER TABLE `annonce`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonce`
--
ALTER TABLE `annonce`
ADD CONSTRAINT `FK-annonce-category` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`Id`),
ADD CONSTRAINT `FK-annonce-user` FOREIGN KEY (`IdUser`) REFERENCES `user` (`Id`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
ADD CONSTRAINT `FK_photo_annonce` FOREIGN KEY (`IdAnnonce`) REFERENCES `annonce` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
