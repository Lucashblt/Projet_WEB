-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 04 nov. 2023 à 18:25
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hublart_benzzine`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `idAvis` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `avis` text NOT NULL,
  `note` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`idAvis`, `idUtilisateur`, `idProduit`, `avis`, `note`) VALUES
(7, 9, 3, 'Très belle chaussure et très comfortable', 5),
(8, 9, 4, 'Chaussure très chaud et très résistante parfait pour l&#039;hiver', 4),
(9, 10, 1, 'Pas très confortable malheureusement vu le prix mis sur ces chaussure', 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nom`, `photo`) VALUES
(1, 'Vêtements', './img/imgBDD/categorie_vetements.jpg'),
(2, 'Chaussures', './img/imgBDD/categorie_chaussures.jpg'),
(3, 'Accessoires', './img/imgBDD/categorie_accessoires.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `idCommande` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateCommande` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` varchar(10) NOT NULL,
  `modePaiment` varchar(100) NOT NULL DEFAULT 'Carte Bancaire',
  `Status` varchar(255) NOT NULL DEFAULT 'En préparation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `idUtilisateur`, `dateCommande`, `total`, `modePaiment`, `Status`) VALUES
(4, 9, '2023-11-04 12:07:58', '60', 'Carte Bancaire', 'Expédiée'),
(5, 9, '2023-11-04 11:02:48', '620', 'Carte Bancaire', 'En préparation'),
(6, 9, '2023-11-04 14:37:36', '60', 'Carte Bancaire', 'En préparation'),
(7, 12, '2023-11-04 14:44:45', '20', 'Carte Bancaire', 'En préparation');

-- --------------------------------------------------------

--
-- Structure de la table `commandeslignes`
--

CREATE TABLE `commandeslignes` (
  `idCommandesLignes` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idDeclinaison` int(11) NOT NULL,
  `idPrix` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandeslignes`
--

INSERT INTO `commandeslignes` (`idCommandesLignes`, `idCommande`, `idDeclinaison`, `idPrix`, `quantite`) VALUES
(1, 4, 53, 97, 1),
(2, 5, 25, 92, 2),
(3, 5, 243, 243, 1),
(4, 5, 91, 100, 1),
(5, 6, 80, 94, 1),
(6, 7, 154, 152, 1);

-- --------------------------------------------------------

--
-- Structure de la table `couleurproduit`
--

CREATE TABLE `couleurproduit` (
  `idCouleur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `couleurproduit`
--

INSERT INTO `couleurproduit` (`idCouleur`, `nom`) VALUES
(1, 'Marron'),
(2, 'Bleu'),
(3, 'Blanc'),
(4, 'Noir'),
(5, 'Orange'),
(6, 'Rose'),
(7, 'Vert'),
(8, 'Violet'),
(9, 'Jaune'),
(10, 'Rouge'),
(11, 'Gris');

-- --------------------------------------------------------

--
-- Structure de la table `declinaisonproduit`
--

CREATE TABLE `declinaisonproduit` (
  `idDeclinaison` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idTaille` int(11) NOT NULL,
  `idCouleur` int(11) NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `declinaisonproduit`
--

INSERT INTO `declinaisonproduit` (`idDeclinaison`, `idProduit`, `idTaille`, `idCouleur`, `Stock`) VALUES
(1, 1, 1, 1, 1000),
(2, 1, 2, 1, 1000),
(3, 1, 3, 1, 1000),
(4, 1, 4, 1, 1000),
(5, 1, 5, 1, 1000),
(6, 1, 6, 1, 1000),
(7, 1, 7, 1, 1000),
(8, 1, 8, 1, 1000),
(9, 1, 9, 1, 1000),
(10, 1, 10, 1, 1000),
(11, 1, 11, 1, 1000),
(12, 1, 12, 1, 1000),
(13, 1, 13, 1, 1000),
(16, 3, 1, 3, 1000),
(17, 3, 2, 3, 1000),
(18, 3, 3, 3, 1000),
(19, 3, 4, 3, 1000),
(20, 3, 5, 3, 1000),
(21, 3, 6, 3, 1000),
(22, 3, 7, 3, 1000),
(23, 3, 8, 3, 1000),
(24, 3, 9, 3, 1000),
(25, 3, 10, 3, 1000),
(26, 3, 11, 3, 1000),
(27, 3, 12, 3, 1000),
(28, 3, 13, 3, 1000),
(31, 4, 67, 1, 1000),
(32, 4, 68, 1, 1000),
(33, 4, 69, 1, 1000),
(34, 4, 70, 1, 1000),
(35, 4, 71, 1, 1000),
(36, 4, 72, 1, 1000),
(37, 4, 73, 1, 1000),
(38, 4, 74, 1, 1000),
(39, 4, 75, 1, 1000),
(40, 4, 76, 1, 1000),
(41, 4, 77, 1, 1000),
(42, 4, 78, 1, 1000),
(43, 4, 79, 1, 1000),
(44, 8, 16, 3, 1000),
(45, 8, 17, 3, 1000),
(46, 8, 18, 3, 1000),
(47, 8, 19, 3, 1000),
(48, 8, 20, 3, 1000),
(51, 9, 16, 8, 1000),
(52, 9, 17, 8, 1000),
(53, 9, 18, 8, 1000),
(54, 9, 19, 8, 1000),
(55, 9, 20, 8, 1000),
(58, 10, 16, 4, 1000),
(59, 10, 17, 4, 1000),
(60, 10, 18, 4, 1000),
(61, 10, 19, 4, 1000),
(62, 10, 20, 4, 1000),
(65, 11, 1, 3, 1000),
(66, 11, 2, 3, 1000),
(67, 11, 3, 3, 1000),
(68, 11, 4, 3, 1000),
(69, 11, 5, 3, 1000),
(70, 11, 6, 3, 1000),
(71, 11, 7, 3, 1000),
(72, 11, 8, 3, 1000),
(73, 11, 9, 3, 1000),
(74, 11, 10, 3, 1000),
(75, 11, 11, 3, 1000),
(76, 11, 12, 3, 1000),
(77, 11, 13, 3, 1000),
(80, 5, 80, 4, 1000),
(81, 7, 16, 3, 1000),
(82, 7, 17, 3, 1000),
(83, 7, 18, 3, 1000),
(84, 7, 19, 3, 1000),
(85, 7, 20, 3, 1000),
(86, 7, 16, 4, 1000),
(87, 7, 17, 4, 1000),
(88, 7, 18, 4, 1000),
(89, 7, 19, 4, 1000),
(90, 7, 20, 4, 1000),
(91, 12, 1, 2, 1000),
(92, 12, 2, 2, 1000),
(93, 12, 3, 2, 1000),
(94, 12, 4, 2, 1000),
(95, 12, 5, 2, 1000),
(96, 12, 6, 2, 1000),
(97, 12, 7, 2, 1000),
(98, 12, 8, 2, 1000),
(99, 12, 9, 2, 1000),
(100, 12, 10, 2, 1000),
(101, 12, 11, 2, 1000),
(102, 12, 12, 2, 1000),
(103, 12, 13, 2, 1000),
(104, 12, 1, 3, 1000),
(105, 12, 2, 3, 1000),
(106, 12, 3, 3, 1000),
(107, 12, 4, 3, 1000),
(108, 12, 5, 3, 1000),
(109, 12, 6, 3, 1000),
(110, 12, 7, 3, 1000),
(111, 12, 8, 3, 1000),
(112, 12, 9, 3, 1000),
(113, 12, 10, 3, 1000),
(114, 12, 11, 3, 1000),
(115, 12, 12, 3, 1000),
(116, 12, 13, 3, 1000),
(117, 12, 1, 4, 1000),
(118, 12, 2, 4, 1000),
(119, 12, 3, 4, 1000),
(120, 12, 4, 4, 1000),
(121, 12, 5, 4, 1000),
(122, 12, 6, 4, 1000),
(123, 12, 7, 4, 1000),
(124, 12, 8, 4, 1000),
(125, 12, 9, 4, 1000),
(126, 12, 10, 4, 1000),
(127, 12, 11, 4, 1000),
(128, 12, 12, 4, 1000),
(129, 12, 13, 4, 1000),
(130, 12, 1, 10, 1000),
(131, 12, 2, 10, 1000),
(132, 12, 3, 10, 1000),
(133, 12, 4, 10, 1000),
(134, 12, 5, 10, 1000),
(135, 12, 6, 10, 1000),
(136, 12, 7, 10, 1000),
(137, 12, 8, 10, 1000),
(138, 12, 9, 10, 1000),
(139, 12, 10, 10, 1000),
(140, 12, 11, 10, 1000),
(141, 12, 12, 10, 1000),
(142, 12, 13, 10, 1000),
(143, 13, 52, 4, 1000),
(144, 13, 53, 4, 1000),
(145, 13, 54, 4, 1000),
(146, 13, 55, 4, 1000),
(147, 13, 56, 4, 1000),
(148, 13, 57, 4, 1000),
(149, 13, 58, 4, 1000),
(150, 13, 59, 4, 1000),
(151, 13, 60, 4, 1000),
(152, 13, 61, 4, 1000),
(153, 13, 62, 4, 1000),
(154, 13, 63, 4, 1000),
(155, 13, 64, 4, 1000),
(158, 14, 67, 1, 1000),
(159, 14, 68, 1, 1000),
(160, 14, 69, 1, 1000),
(161, 14, 70, 1, 1000),
(162, 14, 71, 1, 1000),
(163, 14, 72, 1, 1000),
(164, 14, 73, 1, 1000),
(165, 14, 74, 1, 1000),
(166, 14, 75, 1, 1000),
(167, 14, 76, 1, 1000),
(168, 14, 77, 1, 1000),
(169, 14, 78, 1, 1000),
(170, 14, 79, 1, 1000),
(173, 15, 1, 3, 1000),
(174, 15, 2, 3, 1000),
(175, 15, 3, 3, 1000),
(176, 15, 4, 3, 1000),
(177, 15, 5, 3, 1000),
(178, 15, 6, 3, 1000),
(179, 15, 7, 3, 1000),
(180, 15, 8, 3, 1000),
(181, 15, 9, 3, 1000),
(182, 15, 10, 3, 1000),
(183, 15, 11, 3, 1000),
(184, 15, 12, 3, 1000),
(185, 15, 13, 3, 1000),
(186, 15, 1, 6, 1000),
(187, 15, 2, 6, 1000),
(188, 15, 3, 6, 1000),
(189, 15, 4, 6, 1000),
(190, 15, 5, 6, 1000),
(191, 15, 6, 6, 1000),
(192, 15, 7, 6, 1000),
(193, 15, 8, 6, 1000),
(194, 15, 9, 6, 1000),
(195, 15, 10, 6, 1000),
(196, 15, 11, 6, 1000),
(197, 15, 12, 6, 1000),
(198, 15, 13, 6, 1000),
(204, 16, 1, 11, 1000),
(205, 16, 2, 11, 1000),
(206, 16, 3, 11, 1000),
(207, 16, 4, 11, 1000),
(208, 16, 5, 11, 1000),
(209, 16, 6, 11, 1000),
(210, 16, 7, 11, 1000),
(211, 16, 8, 11, 1000),
(212, 16, 9, 11, 1000),
(213, 16, 10, 11, 1000),
(214, 16, 11, 11, 1000),
(215, 16, 12, 11, 1000),
(216, 16, 13, 11, 1000),
(219, 17, 1, 11, 1000),
(220, 17, 2, 11, 1000),
(221, 17, 3, 11, 1000),
(222, 17, 4, 11, 1000),
(223, 17, 5, 11, 1000),
(224, 17, 6, 11, 1000),
(225, 17, 7, 11, 1000),
(226, 17, 8, 11, 1000),
(227, 17, 9, 11, 1000),
(228, 17, 10, 11, 1000),
(229, 17, 11, 11, 1000),
(230, 17, 12, 11, 1000),
(231, 17, 13, 11, 1000),
(234, 18, 1, 3, 1000),
(235, 18, 2, 3, 1000),
(236, 18, 3, 3, 1000),
(237, 18, 4, 3, 1000),
(238, 18, 5, 3, 1000),
(239, 18, 6, 3, 1000),
(240, 18, 7, 3, 1000),
(241, 18, 8, 3, 1000),
(242, 18, 9, 3, 1000),
(243, 18, 10, 3, 1000),
(244, 18, 11, 3, 1000),
(245, 18, 12, 3, 1000),
(246, 18, 13, 3, 1000),
(297, 22, 1, 10, 1000),
(298, 22, 2, 10, 1000),
(299, 22, 3, 10, 1000),
(300, 22, 4, 10, 1000),
(301, 22, 5, 10, 1000),
(302, 22, 6, 10, 1000),
(303, 22, 7, 10, 1000),
(304, 22, 8, 10, 1000),
(305, 22, 9, 10, 1000),
(306, 22, 10, 10, 1000),
(307, 22, 11, 10, 1000),
(308, 22, 12, 10, 1000),
(309, 22, 13, 10, 1000),
(312, 23, 1, 3, 1000),
(313, 23, 2, 3, 1000),
(314, 23, 3, 3, 1000),
(315, 23, 4, 3, 1000),
(316, 23, 5, 3, 1000),
(317, 23, 6, 3, 1000),
(318, 23, 7, 3, 1000),
(319, 23, 8, 3, 1000),
(320, 23, 9, 3, 1000),
(321, 23, 10, 3, 1000),
(322, 23, 11, 3, 1000),
(323, 23, 12, 3, 1000),
(324, 23, 13, 3, 1000),
(325, 23, 1, 4, 1000),
(326, 23, 2, 4, 1000),
(327, 23, 3, 4, 1000),
(328, 23, 4, 4, 1000),
(329, 23, 5, 4, 1000),
(330, 23, 6, 4, 1000),
(331, 23, 7, 4, 1000),
(332, 23, 8, 4, 1000),
(333, 23, 9, 4, 1000),
(334, 23, 10, 4, 1000),
(335, 23, 11, 4, 1000),
(336, 23, 12, 4, 1000),
(337, 23, 13, 4, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idFournisseur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `codePostale` varchar(10) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `Pays` varchar(100) NOT NULL,
  `numTelephone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`idFournisseur`, `nom`, `adresse`, `codePostale`, `ville`, `Pays`, `numTelephone`) VALUES
(1, 'Nike', '1 Bowerman Dr', '97005', 'Beaverton', 'États-Unis', ''),
(3, 'Adidas', '1234 Sneaker Street', '12345', 'Herzogenaurach', 'Allemagne', ''),
(4, 'Puma', '567 Sportswear Road', '54321', 'Herzogenaurach', 'Allemagne', ''),
(5, 'Converse', '789 Chuck Taylor Street', '67890', 'Boston', 'États-Unis', ''),
(6, 'Reebok', '101 Classic Avenue', '12345', 'Canton', 'États-Unis', ''),
(7, 'Levi\'s', '456 Denim Drive', '98765', 'San Francisco', 'États-Unis', ''),
(8, 'New Balance', '321 Athletic Street', '34567', 'Boston', 'États-Unis', ''),
(9, 'Timberland', '78 Ech. des Argonautes', '21000', 'Dijon', 'France', ''),
(10, 'LEVELS', '49 Featherstone Street', 'EC1Y 8SY', 'LONDON', 'UK', ''),
(12, 'The North Face', '1 Kevin Durant', '50405', 'Washington', 'États-Unis', '');

-- --------------------------------------------------------

--
-- Structure de la table `prixproduit`
--

CREATE TABLE `prixproduit` (
  `idPrix` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL DEFAULT '2100-01-01',
  `prixBrut` float NOT NULL,
  `remise` int(11) DEFAULT 0,
  `prixNet` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prixproduit`
--

INSERT INTO `prixproduit` (`idPrix`, `idProduit`, `dateDebut`, `dateFin`, `prixBrut`, `remise`, `prixNet`) VALUES
(91, 1, '2023-11-02', '2100-01-01', 150, 0, 150),
(92, 3, '2023-11-02', '2100-01-01', 100, 0, 100),
(93, 4, '2023-11-02', '2100-01-01', 220, 0, 220),
(94, 5, '2023-11-02', '2100-01-01', 60, 0, 60),
(95, 7, '2023-11-02', '2100-01-01', 50, 0, 50),
(96, 8, '2023-11-02', '2100-01-01', 60, 0, 60),
(97, 9, '2023-11-02', '2100-01-01', 60, 0, 60),
(98, 10, '2023-11-02', '2100-01-01', 60, 0, 60),
(99, 11, '2023-11-02', '2100-01-01', 150, 0, 150),
(100, 12, '2023-11-03', '2100-01-01', 120, 0, 120),
(152, 13, '2023-11-03', '2100-01-01', 20, 0, 20),
(167, 14, '2023-11-03', '2100-01-01', 200, 0, 200),
(182, 15, '2023-11-03', '2100-01-01', 124.99, 0, 124.99),
(213, 16, '2023-11-03', '2100-01-01', 99.99, 0, 99.99),
(228, 17, '2023-11-03', '2100-01-01', 109.99, 0, 109.99),
(243, 18, '2023-11-03', '2100-01-01', 299.99, 0, 299.99),
(258, 22, '2023-11-03', '2100-01-01', 79.99, 0, 79.99),
(273, 23, '2023-11-03', '2100-01-01', 119.99, 0, 119.99);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int(5) NOT NULL,
  `idCategorie` int(5) NOT NULL,
  `idFournisseur` int(5) NOT NULL,
  `idType` int(5) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `photoProduit` varchar(1000) NOT NULL,
  `matiereProduit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `idCategorie`, `idFournisseur`, `idType`, `nom`, `description`, `photoProduit`, `matiereProduit`) VALUES
(1, 2, 1, 3, 'Nike x Carhartt', 'Pour la première fois, Carhartt WIP et Nike ont uni leurs forces, créant une collection de chaussures qui combine l’esthétique unique des deux marques ', './img/imgBDD/chaussure1.jpg', 'Cuir 100%'),
(3, 2, 1, 3, 'Nike Air', 'Nike Air est notre innovation emblématique qui utilise l\'air pressurisé dans une membrane souple et résistante pour offrir un amorti en toute légèreté.', './img/imgBDD/chaussure2.jpg', 'Cuir 100%'),
(4, 2, 9, 9, 'Timberland', 'Inspirées par le style de vie urbain, nos collections Timberland sont parfaites pour n\'importe quelle occasion cet automne et cet hiver. Conçue pour être polyvalente et durable, notre collection de chaussures gardera vos pieds confortables à chaque pas.', './img/imgBDD/chaussure3.jpg', 'Cuir 100%'),
(5, 3, 10, 6, 'Sac à dos LEVELS', ' Sac à dos 40lt avec compartiment principal et intermédiaires séparés. Grande poche devant avec attaches. Bretelles et panneau arrière rembourrés. Base résistante et imperméable plus une housse de pluie.', './img/imgBDD/accesoire1.jpg', 'Nylon 100%'),
(7, 1, 5, 2, 'Selfie', 'Pulls Selfie parfait pour l\'automne ', './img/imgBDD/vetement1.jpg', 'Laine 100%'),
(8, 1, 6, 2, '#Wolf', 'Pulls au design original chaud et doux pour toutes les saisons ', './img/imgBDD/vetement2.jpg', 'Laine 50%\nCoton 50%'),
(9, 1, 12, 2, 'The North Face', 'Pulls au design original chaud et doux pour l\'hiver ', './img/imgBDD/vetement3.png', 'Laine 100%'),
(10, 1, 4, 2, 'Toronto Canada 1994', 'Pulls parfait pour toutes les saisons', './img/imgBDD/vetement4.jpg', 'Laine 100%'),
(11, 2, 3, 3, 'Adidas Forum low blanc et bleu', 'Plus qu\'une chaussure, c\'est un message. La chaussure adidas Forum a fait son apparition en 1984 et s\'est faite remarquer sur les parquets et dans le monde de la musique. Cette chaussure classique ravive l\'attitude des 80\'s, l\'énergie explosive des parquets et l\'iconique design avec une bride en X à la cheville, dans une version basse conçue pour la rue.', './img/imgBDD/chaussure4.jpg', 'Cuir 100%'),
(12, 2, 4, 3, 'Puma Suede', 'Plus qu\'une chaussure, c\'est un message.', './img/imgBDD/chaussure5.jpg', 'Cuir 100%'),
(13, 2, 4, 5, 'Tong Havaianas', 'Plus qu\'une chaussure, c\'est un message.', './img/imgBDD/chaussure6.jpg', 'Caoutchouc 100%'),
(14, 2, 4, 9, 'Escarpin', 'Chaussure en cuir marron très elegantee', './img/imgBDD/chaussure7.jpg', 'Cuir 100%'),
(15, 2, 1, 3, 'Nike Air Force 1', 'Chaussure nike plein de couleur et de vie', './img/imgBDD/chaussure8.jpg', 'Cuir 100%'),
(16, 2, 5, 3, 'Converse Heart', 'Chaussure converse de la Saint-Valentin', './img/imgBDD/chaussure9.jpg', 'Tissu 100%'),
(17, 2, 8, 3, 'New Balance 997', 'Chaussure new balance grise', './img/imgBDD/chaussure10.jpg', 'Tissu 100%'),
(18, 2, 1, 3, 'Nike Air New Delhi', 'Chaussure nike personnalisé venu d\'Inde et plus précisément New Delhi', './img/imgBDD/chaussure11.jpg', 'Cuir 100%'),
(22, 2, 8, 3, 'New Balance 327', 'Chaussure new balance', './img/imgBDD/chaussure12.jpg', 'Cuir 100%'),
(23, 2, 5, 3, 'Converse All Star', 'Chaussure Converse All Star', './img/imgBDD/chaussure13.jpg', 'Tissu 100%');

-- --------------------------------------------------------

--
-- Structure de la table `tailleproduit`
--

CREATE TABLE `tailleproduit` (
  `idTaille` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `taille` varchar(5) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tailleproduit`
--

INSERT INTO `tailleproduit` (`idTaille`, `idType`, `taille`) VALUES
(1, 3, '35'),
(2, 3, '36'),
(3, 3, '37'),
(4, 3, '38'),
(5, 3, '39'),
(6, 3, '40'),
(7, 3, '41'),
(8, 3, '42'),
(9, 3, '43'),
(10, 3, '44'),
(11, 3, '45'),
(12, 3, '46'),
(13, 3, '47'),
(16, 2, 'S'),
(17, 2, 'M'),
(18, 2, 'L'),
(19, 2, 'XL'),
(20, 2, 'XXL'),
(23, 1, 'S'),
(24, 1, 'M'),
(25, 1, 'L'),
(26, 1, 'XL'),
(27, 1, 'XXL'),
(30, 8, 'S'),
(31, 8, 'M'),
(32, 8, 'L'),
(33, 8, 'XL'),
(34, 8, 'XXL'),
(37, 4, '35'),
(38, 4, '36'),
(39, 4, '37'),
(40, 4, '38'),
(41, 4, '39'),
(42, 4, '40'),
(43, 4, '41'),
(44, 4, '42'),
(45, 4, '43'),
(46, 4, '44'),
(47, 4, '45'),
(48, 4, '46'),
(49, 4, '47'),
(52, 5, '35'),
(53, 5, '36'),
(54, 5, '37'),
(55, 5, '38'),
(56, 5, '39'),
(57, 5, '40'),
(58, 5, '41'),
(59, 5, '42'),
(60, 5, '43'),
(61, 5, '44'),
(62, 5, '45'),
(63, 5, '46'),
(64, 5, '47'),
(67, 9, '35'),
(68, 9, '36'),
(69, 9, '37'),
(70, 9, '38'),
(71, 9, '39'),
(72, 9, '40'),
(73, 9, '41'),
(74, 9, '42'),
(75, 9, '43'),
(76, 9, '44'),
(77, 9, '45'),
(78, 9, '46'),
(79, 9, '47'),
(80, 6, '-');

-- --------------------------------------------------------

--
-- Structure de la table `typeproduit`
--

CREATE TABLE `typeproduit` (
  `idType` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typeproduit`
--

INSERT INTO `typeproduit` (`idType`, `idCategorie`, `nom`) VALUES
(1, 1, 'Tee-shirt'),
(2, 1, 'Sweatshirt'),
(3, 2, 'Sneakers'),
(4, 2, 'Claquette'),
(5, 2, 'Tong'),
(6, 3, 'Sac à dos'),
(7, 3, 'Casquette'),
(8, 1, 'Vestes'),
(9, 2, 'Chaussure de ville');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateNaissance` date NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Client',
  `adresse` varchar(255) DEFAULT NULL,
  `codePostal` varchar(10) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `mdp`, `email`, `dateNaissance`, `role`, `adresse`, `codePostal`, `ville`, `pays`) VALUES
(9, 'Hublart', 'Lucas', 'Nosake', '925fcbb99aa0ce4847aa5abbd49d811c', 'hublartlucas@gmail.com', '2003-01-10', 'Client', '19 avenue wilson', '90001', 'Belfort', 'France'),
(10, 'Hublart2', 'Agnes', 'maman', '4792cb8c4540464597b0b2363426fb4b', 'ahublart@free.fr', '1977-11-01', 'Client', '4 rue Philibert de Mare', '21560', 'Couternon', 'France'),
(11, 'Hublart', 'Fred', 'papa2', '99dd74473c34d6953df167fa206a60c5', 'fhublart@free.fr', '1976-07-11', 'Client', '4 rue Philibert de Mare', '21560', 'Couternon', 'France'),
(12, 'Covez', 'Thomas', 'Thomas_cvz', '925fcbb99aa0ce4847aa5abbd49d811c', 'covezthomas@gmail.com', '2005-12-25', 'Client', '21 rue des fougeres', '95540', 'Mery-Sur-Oise', 'France');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`idAvis`),
  ADD KEY `fk_avis_utilisateur` (`idUtilisateur`),
  ADD KEY `fk_avis_produit` (`idProduit`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `fk_commandes_utilisateur` (`idUtilisateur`);

--
-- Index pour la table `commandeslignes`
--
ALTER TABLE `commandeslignes`
  ADD PRIMARY KEY (`idCommandesLignes`),
  ADD KEY `fk_commandeslignes_commandes` (`idCommande`),
  ADD KEY `fk_commandeslignes_declinaisonproduit` (`idDeclinaison`),
  ADD KEY `fk_commandeslignes_prixproduit` (`idPrix`);

--
-- Index pour la table `couleurproduit`
--
ALTER TABLE `couleurproduit`
  ADD PRIMARY KEY (`idCouleur`);

--
-- Index pour la table `declinaisonproduit`
--
ALTER TABLE `declinaisonproduit`
  ADD PRIMARY KEY (`idDeclinaison`),
  ADD KEY `fk_declinaisonproduit_couleurproduit` (`idCouleur`),
  ADD KEY `fk_declinaisonproduit_produit` (`idProduit`),
  ADD KEY `id_declinaisonproduit_tailleproduit` (`idTaille`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`idFournisseur`);

--
-- Index pour la table `prixproduit`
--
ALTER TABLE `prixproduit`
  ADD PRIMARY KEY (`idPrix`),
  ADD KEY `fk_prixproduit_produit` (`idProduit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `fk_produit_categorie` (`idCategorie`),
  ADD KEY `fk_produit_fournisseur` (`idFournisseur`),
  ADD KEY `fk_produit_typeproduit` (`idType`);

--
-- Index pour la table `tailleproduit`
--
ALTER TABLE `tailleproduit`
  ADD PRIMARY KEY (`idTaille`),
  ADD KEY `fk_tailleproduit_typeproduit` (`idType`);

--
-- Index pour la table `typeproduit`
--
ALTER TABLE `typeproduit`
  ADD PRIMARY KEY (`idType`),
  ADD KEY `fk_typeproduit_categorie` (`idCategorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `verifEmail` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `idAvis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commandeslignes`
--
ALTER TABLE `commandeslignes`
  MODIFY `idCommandesLignes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `couleurproduit`
--
ALTER TABLE `couleurproduit`
  MODIFY `idCouleur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `declinaisonproduit`
--
ALTER TABLE `declinaisonproduit`
  MODIFY `idDeclinaison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idFournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `prixproduit`
--
ALTER TABLE `prixproduit`
  MODIFY `idPrix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `tailleproduit`
--
ALTER TABLE `tailleproduit`
  MODIFY `idTaille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT pour la table `typeproduit`
--
ALTER TABLE `typeproduit`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `fk_avis_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`),
  ADD CONSTRAINT `fk_avis_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_commandes_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `commandeslignes`
--
ALTER TABLE `commandeslignes`
  ADD CONSTRAINT `fk_commandeslignes_commandes` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `fk_commandeslignes_declinaisonproduit` FOREIGN KEY (`idDeclinaison`) REFERENCES `declinaisonproduit` (`idDeclinaison`),
  ADD CONSTRAINT `fk_commandeslignes_prixproduit` FOREIGN KEY (`idPrix`) REFERENCES `prixproduit` (`idPrix`);

--
-- Contraintes pour la table `declinaisonproduit`
--
ALTER TABLE `declinaisonproduit`
  ADD CONSTRAINT `fk_declinaisonproduit_couleurproduit` FOREIGN KEY (`idCouleur`) REFERENCES `couleurproduit` (`idCouleur`),
  ADD CONSTRAINT `fk_declinaisonproduit_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`),
  ADD CONSTRAINT `id_declinaisonproduit_tailleproduit` FOREIGN KEY (`idTaille`) REFERENCES `tailleproduit` (`idTaille`);

--
-- Contraintes pour la table `prixproduit`
--
ALTER TABLE `prixproduit`
  ADD CONSTRAINT `fk_prixproduit_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`),
  ADD CONSTRAINT `fk_produit_fournisseur` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`idFournisseur`),
  ADD CONSTRAINT `fk_produit_typeproduit` FOREIGN KEY (`idType`) REFERENCES `typeproduit` (`idType`);

--
-- Contraintes pour la table `tailleproduit`
--
ALTER TABLE `tailleproduit`
  ADD CONSTRAINT `fk_tailleproduit_typeproduit` FOREIGN KEY (`idType`) REFERENCES `typeproduit` (`idType`);

--
-- Contraintes pour la table `typeproduit`
--
ALTER TABLE `typeproduit`
  ADD CONSTRAINT `fk_typeproduit_categorie` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
