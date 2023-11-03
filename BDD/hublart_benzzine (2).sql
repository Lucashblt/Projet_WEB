-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 nov. 2023 à 23:26
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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` int(10) NOT NULL,
  `modePaiment` varchar(100) NOT NULL DEFAULT 'Carte Bancaire'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `idCouleur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `declinaisonproduit`
--

INSERT INTO `declinaisonproduit` (`idDeclinaison`, `idProduit`, `idTaille`, `idCouleur`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(16, 3, 1, 3),
(17, 3, 2, 3),
(18, 3, 3, 3),
(19, 3, 4, 3),
(20, 3, 5, 3),
(21, 3, 6, 3),
(22, 3, 7, 3),
(23, 3, 8, 3),
(24, 3, 9, 3),
(25, 3, 10, 3),
(26, 3, 11, 3),
(27, 3, 12, 3),
(28, 3, 13, 3),
(31, 4, 67, 1),
(32, 4, 68, 1),
(33, 4, 69, 1),
(34, 4, 70, 1),
(35, 4, 71, 1),
(36, 4, 72, 1),
(37, 4, 73, 1),
(38, 4, 74, 1),
(39, 4, 75, 1),
(40, 4, 76, 1),
(41, 4, 77, 1),
(42, 4, 78, 1),
(43, 4, 79, 1),
(44, 8, 16, 3),
(45, 8, 17, 3),
(46, 8, 18, 3),
(47, 8, 19, 3),
(48, 8, 20, 3),
(51, 9, 16, 8),
(52, 9, 17, 8),
(53, 9, 18, 8),
(54, 9, 19, 8),
(55, 9, 20, 8),
(58, 10, 16, 4),
(59, 10, 17, 4),
(60, 10, 18, 4),
(61, 10, 19, 4),
(62, 10, 20, 4),
(65, 11, 1, 3),
(66, 11, 2, 3),
(67, 11, 3, 3),
(68, 11, 4, 3),
(69, 11, 5, 3),
(70, 11, 6, 3),
(71, 11, 7, 3),
(72, 11, 8, 3),
(73, 11, 9, 3),
(74, 11, 10, 3),
(75, 11, 11, 3),
(76, 11, 12, 3),
(77, 11, 13, 3),
(80, 5, 80, 4),
(81, 7, 16, 3),
(82, 7, 17, 3),
(83, 7, 18, 3),
(84, 7, 19, 3),
(85, 7, 20, 3),
(86, 7, 16, 4),
(87, 7, 17, 4),
(88, 7, 18, 4),
(89, 7, 19, 4),
(90, 7, 20, 4);

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
  `Pays` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`idFournisseur`, `nom`, `adresse`, `codePostale`, `ville`, `Pays`) VALUES
(1, 'Nike', 'One Bowerman Dr', '97005', 'Beaverton', 'États-Unis'),
(3, 'Adidas', '1234 Sneaker Street', '12345', 'Herzogenaurach', 'Allemagne'),
(4, 'Puma', '567 Sportswear Road', '54321', 'Herzogenaurach', 'Allemagne'),
(5, 'Converse', '789 Chuck Taylor Street', '67890', 'Boston', 'États-Unis'),
(6, 'Reebok', '101 Classic Avenue', '12345', 'Canton', 'États-Unis'),
(7, 'Levi\'s', '456 Denim Drive', '98765', 'San Francisco', 'États-Unis'),
(8, 'New Balance', '321 Athletic Street', '34567', 'Boston', 'États-Unis'),
(9, 'Timberland', '78 Ech. des Argonautes', '21000', 'Dijon', 'France'),
(10, 'LEVELS', '49 Featherstone Street', 'EC1Y 8SY', 'LONDON', 'UK'),
(12, 'The North Face', 'One KB', '50405', 'Washington', 'États-Unis');

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
(99, 11, '2023-11-02', '2100-01-01', 150, 0, 150);

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
  `photoProduit` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `idCategorie`, `idFournisseur`, `idType`, `nom`, `description`, `photoProduit`) VALUES
(1, 2, 1, 3, 'Nike x Carhartt', 'Pour la première fois, Carhartt WIP et Nike ont uni leurs forces, créant une collection de chaussures qui combine l’esthétique unique des deux marques ', './img/imgBDD/chaussure1.jpg'),
(3, 2, 1, 3, 'Nike Air', 'Nike Air est notre innovation emblématique qui utilise l\'air pressurisé dans une membrane souple et résistante pour offrir un amorti en toute légèreté.', './img/imgBDD/chaussure2.jpg'),
(4, 2, 9, 9, 'Timberland', 'Inspirées par le style de vie urbain, nos collections Timberland sont parfaites pour n\'importe quelle occasion cet automne et cet hiver. Conçue pour être polyvalente et durable, notre collection de chaussures gardera vos pieds confortables à chaque pas.', './img/imgBDD/chaussure3.jpg'),
(5, 3, 10, 6, 'Sac à dos LEVELS', ' Sac à dos 40lt avec compartiment principal et intermédiaires séparés. Grande poche devant avec attaches. Bretelles et panneau arrière rembourrés. Base résistante et imperméable plus une housse de pluie.', './img/imgBDD/accesoire1.jpg'),
(7, 1, 5, 2, 'Selfie', 'Pulls Selfie parfait pour l\'automne ', './img/imgBDD/vetement1.jpg'),
(8, 1, 6, 2, '#Wolf', 'Pulls au design original chaud et doux pour toutes les saisons ', './img/imgBDD/vetement2.jpg'),
(9, 1, 12, 2, 'The North Face', 'Pulls au design original chaud et doux pour l\'hiver ', './img/imgBDD/vetement3.png'),
(10, 1, 4, 2, 'Toronto Canada 1994', 'Pulls parfait pour toutes les saisons', './img/imgBDD/vetement4.jpg'),
(11, 2, 3, 3, 'Adidas Forum low blanc et bleu', 'Plus qu\'une chaussure, c\'est un message. La chaussure adidas Forum a fait son apparition en 1984 et s\'est faite remarquer sur les parquets et dans le monde de la musique. Cette chaussure classique ravive l\'attitude des 80\'s, l\'énergie explosive des parquets et l\'iconique design avec une bride en X à la cheville, dans une version basse conçue pour la rue.', './img/imgBDD/chaussure4.jpg');

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
(11, 'Hublart', 'Fred', 'papa2', '99dd74473c34d6953df167fa206a60c5', 'fhublart@free.fr', '1976-07-11', 'Client', '4 rue Philibert de Mare', '21560', 'Couternon', 'France');

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
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandeslignes`
--
ALTER TABLE `commandeslignes`
  MODIFY `idCommandesLignes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `couleurproduit`
--
ALTER TABLE `couleurproduit`
  MODIFY `idCouleur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `declinaisonproduit`
--
ALTER TABLE `declinaisonproduit`
  MODIFY `idDeclinaison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idFournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `prixproduit`
--
ALTER TABLE `prixproduit`
  MODIFY `idPrix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
