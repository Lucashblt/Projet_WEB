-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 29 oct. 2023 à 12:50
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

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `declinaisonproduit`
--

CREATE TABLE `declinaisonproduit` (
  `idDeclinaison` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idTaille` int(11) NOT NULL,
  `idCouleur` int(11) NOT NULL,
  `idPrix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `prixproduit`
--

CREATE TABLE `prixproduit` (
  `idPrix` int(11) NOT NULL,
  `idDeclinaison` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `prixBrut` int(11) NOT NULL,
  `remise` int(11) NOT NULL,
  `prixNet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `tailleproduit`
--

CREATE TABLE `tailleproduit` (
  `idTaille` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `taille` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typeproduit`
--

CREATE TABLE `typeproduit` (
  `idType` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateNaissance` date NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Client',
  `adresse` varchar(255) DEFAULT NULL,
  `codePostale` varchar(10) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `pseudo`, `password`, `email`, `dateNaissance`, `role`, `adresse`, `codePostale`, `ville`, `pays`) VALUES
(9, 'Hublart', 'Lucas', 'Nosake', '925fcbb99aa0ce4847aa5abbd49d811c', 'hublartlucas@gmail.com', '2003-01-10', 'Client', '19 avenue wilson', '90000', 'Belfort', 'France');

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
  ADD KEY `fk_declinaisonproduit_prixproduit` (`idPrix`),
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
  ADD KEY `fk_prixproduit_declinaisonproduit` (`idDeclinaison`);

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
  MODIFY `idAvis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idCouleur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `declinaisonproduit`
--
ALTER TABLE `declinaisonproduit`
  MODIFY `idDeclinaison` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idFournisseur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prixproduit`
--
ALTER TABLE `prixproduit`
  MODIFY `idPrix` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tailleproduit`
--
ALTER TABLE `tailleproduit`
  MODIFY `idTaille` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeproduit`
--
ALTER TABLE `typeproduit`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `fk_declinaisonproduit_prixproduit` FOREIGN KEY (`idPrix`) REFERENCES `prixproduit` (`idPrix`),
  ADD CONSTRAINT `fk_declinaisonproduit_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`),
  ADD CONSTRAINT `id_declinaisonproduit_tailleproduit` FOREIGN KEY (`idTaille`) REFERENCES `tailleproduit` (`idTaille`);

--
-- Contraintes pour la table `prixproduit`
--
ALTER TABLE `prixproduit`
  ADD CONSTRAINT `fk_prixproduit_declinaisonproduit` FOREIGN KEY (`idDeclinaison`) REFERENCES `declinaisonproduit` (`idDeclinaison`);

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
