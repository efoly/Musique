-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 16 Juillet 2017 à 19:28
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `musique`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `artisteId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `album`
--

INSERT INTO `album` (`id`, `libelle`, `annee`, `artisteId`) VALUES
(1, 'Tetra', 2012, 1),
(2, 'Les Inconnus', 1992, 4),
(3, 'The Bastards', 2015, 7),
(4, 'Losing Sleep', 2009, 3),
(6, 'Phrazes For The Young', 2009, 6);

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE `artiste` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genreId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `artiste`
--

INSERT INTO `artiste` (`id`, `nom`, `genreId`) VALUES
(1, 'C2C', 5),
(3, 'Parachute', 3),
(4, 'Les Inconnus', 2),
(6, 'Julian Casablancas', 4),
(7, 'Radical Face', 1);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `Id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`Id`, `nom`) VALUES
(1, 'independent'),
(2, 'humour'),
(3, 'pop'),
(4, 'rock'),
(5, 'electro');

-- --------------------------------------------------------

--
-- Structure de la table `titre`
--

CREATE TABLE `titre` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `albumId` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `chemin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` float NOT NULL DEFAULT '0.99'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `titre`
--

INSERT INTO `titre` (`id`, `libelle`, `albumId`, `numero`, `chemin`, `prix`) VALUES
(1, 'The Cell', 1, 1, 'morceaux/C2C/Tetra/The Cell.mp3', 0.99),
(2, 'Down The Road', 1, 2, 'morceaux/C2C/Tetra/Down The Road.mp3', 1.29),
(4, 'Glass', 6, 7, 'morceaux/Julian Casablancas/Phrazes For The Young/Glass.mp3', 1.29),
(5, 'Rap Tout Vampire', 2, 1, 'morceaux/Les Inconnus/Les Inconnus/Rap Tout Vampire.mp3', 1.29),
(6, 'C\'Est Toi Que Je T\'Aime', 2, 2, 'morceaux/Les Inconnus/Les Inconnus/C\'Est Toi Que Je T\'Aime.mp3', 0.99),
(7, 'Auteuil Neuilly Passy', 2, 3, 'morceaux/Les Inconnus/Les Inconnus/Auteuil Neuilly Passy.mp3', 1.29),
(8, 'All That I Am', 4, 1, 'morceaux/Parachute/Losing Sleep/All That I Am.mp3', 1.29),
(9, 'Back Again', 4, 2, 'morceaux/Parachute/Losing Sleep/Back Again.mp3', 0.99),
(10, 'She (For Liz)', 4, 3, 'morceaux/Parachute/Losing Sleep/She (For Liz).mp3', 1.29),
(11, 'Sisters', 3, 1, 'morceaux/Radical Face/The Bastards/Sisters.mp3', 1.29),
(13, 'Nightclothes', 3, 11, 'morceaux/Radical Face/The Bastards/Nightclothes.mp3', 1.29);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `nom`, `prenom`) VALUES
(1, 'alpha@alpha.fr', '1234', 'admin', 'Alpha', 'Alfred'),
(2, 'beta@beta.fr', '5678', 'user', 'Beta', 'Eric');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `titre`
--
ALTER TABLE `titre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `artiste`
--
ALTER TABLE `artiste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `titre`
--
ALTER TABLE `titre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
