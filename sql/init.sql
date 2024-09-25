-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 25 juil. 2024 à 05:23
-- Version du serveur : 8.3.0
-- Version de PHP : 8.3.8
USE maboutique2;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `maboutique2`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `qte` int NOT NULL,
  `reference` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `libelle`, `prix`, `qte`, `reference`) VALUES
(1, 'riz', 2000, 20, '#0000001'),
(2, 'savon', 800, 10, '#0000002'),
(3, 'bonbon', 300, 100, '#0000003');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `photo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `email`, `password`, `telephone`, `photo`) VALUES
(1, 'teste', 'teste', 'teste@teste.com', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '774448822', '668d1a650f101.JPG'),
(2, 'client1', 'client1', 'client1@gmail.com', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '771111111', '668d1a650f101.JPG'),
(3, 'client2', 'client2', 'client2@exemple.com', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '772222222', '668d1a650f101.JPG'),
(5, 'teste', 'teste', 'teste1@exemple.com', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '771112211', '668d1a650f101.JPG'),
(6, 'teate', 'teate', 'teate@teate.com', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '772161111', '66901d8f8e765.jpeg'),
(7, 'sdsds', 'sddsds', 'emao@jjj.co', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '772234433', '669020c5658a3.jpeg'),
(8, 'cli', 'cli', 'cli@cli.coo', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '762882211', '66926690d6db2.png');

-- --------------------------------------------------------

--
-- Structure de la table `detaildettes`
--

CREATE TABLE `detaildettes` (
  `id` int NOT NULL,
  `dette_id` int NOT NULL,
  `article_id` int NOT NULL,
  `prix` float NOT NULL,
  `qte` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `detaildettes`
--

INSERT INTO `detaildettes` (`id`, `dette_id`, `article_id`, `prix`, `qte`) VALUES
(45, 30, 2, 800, 20),
(46, 30, 1, 2000, 10);

-- --------------------------------------------------------

--
-- Structure de la table `dettes`
--

CREATE TABLE `dettes` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `date` date NOT NULL,
  `etat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dettes`
--

INSERT INTO `dettes` (`id`, `client_id`, `utilisateur_id`, `date`, `etat`) VALUES
(30, 1, 1, '2024-07-18', 'NON SOLDER');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` int NOT NULL,
  `dette_id` int NOT NULL,
  `montant` float NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `dette_id`, `montant`, `date`) VALUES
(35, 30, 30000, '2024-07-18');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `password`, `telephone`, `photo`, `role`) VALUES
(1, 'vendeur', 'vendeur', 'vendeur@boutique.com', '$2y$10$.8QejfHBnosGJylXl6LGWexg0CmZRXN4MOpppiQxbxxJLfrtV.EWe', '771111100', '668d1a650f101.JPG', 'vendeur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `libelle` (`libelle`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- Index pour la table `detaildettes`
--
ALTER TABLE `detaildettes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dette_id` (`dette_id`),
  ADD KEY `articles_id` (`article_id`);

--
-- Index pour la table `dettes`
--
ALTER TABLE `dettes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `boutiquier_id` (`utilisateur_id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dette_id` (`dette_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `detaildettes`
--
ALTER TABLE `detaildettes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `dettes`
--
ALTER TABLE `dettes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detaildettes`
--
ALTER TABLE `detaildettes`
  ADD CONSTRAINT `detaildettes_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `detaildettes_ibfk_2` FOREIGN KEY (`dette_id`) REFERENCES `dettes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `dettes`
--
ALTER TABLE `dettes`
  ADD CONSTRAINT `dettes_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `dettes_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_ibfk_1` FOREIGN KEY (`dette_id`) REFERENCES `dettes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
