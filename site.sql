-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 12 Septembre 2018 à 12:50
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `dateCreation` date NOT NULL,
  `infos` varchar(250) NOT NULL,
  `emailUtilisateur` varchar(100) NOT NULL,
  `nomRubrique` varchar(100) NOT NULL,
  `titre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `dateCreation`, `infos`, `emailUtilisateur`, `nomRubrique`, `titre`) VALUES
(1, '2018-09-12', '{"description": "voila un article"}', 'quentin.legrand.67@gmail.com', 'Allo Campus', 'Voici le titre');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `contenu` varchar(250) NOT NULL,
  `dateHeure` datetime NOT NULL,
  `emailUtilisateur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE `rubrique` (
  `nomRubrique` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 NOT NULL,
  `infos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `rubrique`
--

INSERT INTO `rubrique` (`nomRubrique`, `image`, `description`, `infos`) VALUES
('Allo Campus', 'img/allocampus.png', 'Vous trouverez dans cette rubrique les bon plans resto.', '{"A_addr: "Adresse du restaurant."", "S_resto": "Nom du restauurant"}'),
('BlaBla Campus', 'img/blablacampus.png', 'ccccc', '["@_depart", "@_arrive", "H_depart", "H_arrive", "D_date"]'),
('Le bon Campus', 'img/leboncampus.png', 'ccc', '["@_addr", "D_date"]');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email` varchar(100) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL DEFAULT 'img/profil_defaut.png',
  `mdp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `prenom`, `nom`, `annee`, `admin`, `image`, `mdp`) VALUES
('camille.boistel56@gmail.com', 'Camille', 'Boistel', 'B2', 0, 'img/profil_defaut.png', '157dc8d5858352c266de80d85ada012f'),
('charletguillaume161@gmail.com', 'Guillaume', 'Charlet', 'B2', 0, 'img/profil_defaut.png', '3c8db84b0e2fdd3a084920bbac61d5a6'),
('quentin.legrand.67@gmail.com', 'Quentin', 'Legrand', 'B1', 0, 'img/profils/quentin_legrand_67_gmail_com.png', '9df62e693988eb4e1e1444ece0578579'),
('quentin.legrand@epsi.fr', 'Quentin', 'Legrand', 'B1', 0, 'img/profil_defaut.png', '9df62e693988eb4e1e1444ece0578579');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emailUtilisateur` (`emailUtilisateur`),
  ADD KEY `nomRubrique` (`nomRubrique`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emailUtilisateur` (`emailUtilisateur`);

--
-- Index pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD PRIMARY KEY (`nomRubrique`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`emailUtilisateur`) REFERENCES `utilisateur` (`email`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`nomRubrique`) REFERENCES `rubrique` (`nomRubrique`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`emailUtilisateur`) REFERENCES `utilisateur` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
