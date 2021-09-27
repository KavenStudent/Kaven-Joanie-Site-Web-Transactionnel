-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 27 sep. 2021 à 19:52
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdfilmsjoaniekaven`
--
CREATE DATABASE IF NOT EXISTS `bdfilmsjoaniekaven` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bdfilmsjoaniekaven`;

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `idMembre` int(11) NOT NULL,
  `courriel` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `statut` int(11) NOT NULL,
  `role` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`idMembre`, `courriel`, `motDePasse`, `statut`, `role`) VALUES
(1, 'admin@KaJo.com', 'Admin-12', 1, 'A');

-- --------------------------------------------------------

--
-- Structure de la table `filmgenre`
--

CREATE TABLE `filmgenre` (
  `idFilm` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `idFilm` int(11) NOT NULL,
  `titre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `realisateurs` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `acteurs` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `idGenre` int(11) NOT NULL,
  `nomGenre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historiquelocation`
--

CREATE TABLE `historiquelocation` (
  `idFilm` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `dateAchat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `idFilm` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `dateAchat` date NOT NULL,
  `dureeLocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `idMembre` int(11) NOT NULL,
  `prenom` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `nom` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `courriel` varchar(256) COLLATE utf32_unicode_ci NOT NULL,
  `sexe` varchar(11) COLLATE utf32_unicode_ci NOT NULL,
  `dateDeNaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`idMembre`, `prenom`, `nom`, `courriel`, `sexe`, `dateDeNaissance`) VALUES
(1, 'admin', 'admin', 'admin@KaJo.com', 'M', '2000-09-01');

-- --------------------------------------------------------

--
-- Structure de la table `paiment`
--

CREATE TABLE `paiment` (
  `idPaiment` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `datePaiment` date NOT NULL,
  `prixFilm` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD UNIQUE KEY `idMembre` (`idMembre`);

--
-- Index pour la table `filmgenre`
--
ALTER TABLE `filmgenre`
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idGenre` (`idGenre`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`idFilm`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idGenre`);

--
-- Index pour la table `historiquelocation`
--
ALTER TABLE `historiquelocation`
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idMembre` (`idMembre`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idMembre` (`idMembre`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idMembre`);

--
-- Index pour la table `paiment`
--
ALTER TABLE `paiment`
  ADD PRIMARY KEY (`idPaiment`),
  ADD KEY `idMembre` (`idMembre`),
  ADD KEY `idFilm` (`idFilm`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `idFilm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `idGenre` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

  ALTER TABLE `connexion`
  MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `paiment`
--
ALTER TABLE `paiment`
  MODIFY `idPaiment` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historiquelocation`
--
ALTER TABLE `historiquelocation`
  ADD CONSTRAINT `idFilmFK` FOREIGN KEY (`idFilm`) REFERENCES `films` (`idFilm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idMembre` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FkIdFilm` FOREIGN KEY (`idFilm`) REFERENCES `films` (`idFilm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FkIdMembre` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiment`
--
ALTER TABLE `paiment`
  ADD CONSTRAINT `FkIdFilmP` FOREIGN KEY (`idFilm`) REFERENCES `films` (`idFilm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FkIdMembreP` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
