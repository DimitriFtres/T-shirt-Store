-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 11 juin 2021 à 01:05
-- Version du serveur :  10.3.25-MariaDB-0+deb10u1
-- Version de PHP : 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fastr1522145`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Date_premiere_participation` datetime NOT NULL DEFAULT current_timestamp(),
  `Flag_Sup` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Flag_sup` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `ID` int(11) NOT NULL,
  `Date_commande` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Livraison` datetime DEFAULT NULL,
  `Etat_Livraison` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etat_livraison`
--

CREATE TABLE `etat_livraison` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modeles`
--

CREATE TABLE `modeles` (
  `ID` int(11) NOT NULL,
  `Modele` varchar(255) NOT NULL,
  `Flag_sup` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modele_disponible`
--

CREATE TABLE `modele_disponible` (
  `ID` int(11) NOT NULL,
  `ID_modele` int(11) NOT NULL,
  `ID_teeshirt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tailles`
--

CREATE TABLE `tailles` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Flag_sup` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tailles_disponible`
--

CREATE TABLE `tailles_disponible` (
  `ID` int(11) NOT NULL,
  `ID_Taille` int(11) NOT NULL,
  `ID_Teeshirt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `teeshirts`
--

CREATE TABLE `teeshirts` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prix` float NOT NULL,
  `Quantite_stock` int(11) NOT NULL,
  `Image` text NOT NULL,
  `Categorie` int(11) NOT NULL,
  `Auteur` int(11) NOT NULL,
  `Date_supp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `teeshirt_commande`
--

CREATE TABLE `teeshirt_commande` (
  `ID` int(11) NOT NULL,
  `ID_commande` int(11) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL,
  `ID_modele` int(11) NOT NULL,
  `ID_teeshirt` int(11) NOT NULL,
  `ID_taille` int(11) NOT NULL,
  `Quantite_commande` int(11) NOT NULL,
  `flag_annule` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `CP` varchar(255) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `Numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `etat_livraison`
--
ALTER TABLE `etat_livraison`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `modeles`
--
ALTER TABLE `modeles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `modele_disponible`
--
ALTER TABLE `modele_disponible`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tailles`
--
ALTER TABLE `tailles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `tailles_disponible`
--
ALTER TABLE `tailles_disponible`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `teeshirts`
--
ALTER TABLE `teeshirts`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `teeshirt_commande`
--
ALTER TABLE `teeshirt_commande`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etat_livraison`
--
ALTER TABLE `etat_livraison`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modeles`
--
ALTER TABLE `modeles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modele_disponible`
--
ALTER TABLE `modele_disponible`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tailles`
--
ALTER TABLE `tailles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tailles_disponible`
--
ALTER TABLE `tailles_disponible`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `teeshirts`
--
ALTER TABLE `teeshirts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `teeshirt_commande`
--
ALTER TABLE `teeshirt_commande`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
