-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 mai 2024 à 17:53
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stock_dk`
--

-- --------------------------------------------------------

--
-- Structure de la table `boutique`
--

CREATE TABLE `boutique` (
  `id` int(11) NOT NULL,
  `nom` text COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `adresse` text COLLATE utf8mb4_bin NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `boutique`
--



-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `categorie`
--



-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` text COLLATE utf8mb4_bin NOT NULL,
  `postnom` text COLLATE utf8mb4_bin NOT NULL,
  `prenom` text COLLATE utf8mb4_bin NOT NULL,
  `genre` text COLLATE utf8mb4_bin NOT NULL,
  `adresse` text COLLATE utf8mb4_bin NOT NULL,
  `telephone` text COLLATE utf8mb4_bin NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `client`
--



-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `dates` date NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--



-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE `depense` (
  `id` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `dates` date NOT NULL,
  `montant` double NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `supprimer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `depense`
--


-- --------------------------------------------------------

--
-- Structure de la table `dettes`
--

CREATE TABLE `dettes` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `montant` double NOT NULL,
  `commande` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `dettes`
--


-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE `entree` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `stock_general` int(11) NOT NULL,
  `boutique` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `entree`
--


-- --------------------------------------------------------

--
-- Structure de la table `fornisseur`
--

CREATE TABLE `fornisseur` (
  `id` int(11) NOT NULL,
  `nom` text COLLATE utf8mb4_bin NOT NULL,
  `postnom` text COLLATE utf8mb4_bin NOT NULL,
  `prenom` text COLLATE utf8mb4_bin NOT NULL,
  `genre` text COLLATE utf8mb4_bin NOT NULL,
  `adresse` text COLLATE utf8mb4_bin NOT NULL,
  `telephone` text COLLATE utf8mb4_bin NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `fornisseur`
--


-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `montant` double NOT NULL,
  `commande` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `paiement`
--


-- --------------------------------------------------------

--
-- Structure de la table `paiement_dettes`
--

CREATE TABLE `paiement_dettes` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `montant` double NOT NULL,
  `dettes` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `paiement_dettes`
--



-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `entree` int(11) NOT NULL,
  `commande` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `panier`
--



-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` text COLLATE utf8mb4_bin NOT NULL,
  `seuil` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `produit`
--



-- --------------------------------------------------------

--
-- Structure de la table `stock_general`
--

CREATE TABLE `stock_general` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `quantite` double NOT NULL,
  `prix_unitaire` double NOT NULL,
  `produit` int(11) NOT NULL,
  `frounisseur` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `stock_general`
--



-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` text COLLATE utf8mb4_bin NOT NULL,
  `postnom` text COLLATE utf8mb4_bin NOT NULL,
  `prenom` text COLLATE utf8mb4_bin NOT NULL,
  `genre` text COLLATE utf8mb4_bin NOT NULL,
  `adresse` text COLLATE utf8mb4_bin NOT NULL,
  `telephone` text COLLATE utf8mb4_bin NOT NULL,
  `email` text COLLATE utf8mb4_bin NOT NULL,
  `pwd` text COLLATE utf8mb4_bin NOT NULL,
  `boutique` int(11) NOT NULL,
  `fonction` text COLLATE utf8mb4_bin NOT NULL,
  `photo` text COLLATE utf8mb4_bin NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `utilisateur`
--

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boutique`
--
ALTER TABLE `boutique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dettes`
--
ALTER TABLE `dettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fornisseur`
--
ALTER TABLE `fornisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement_dettes`
--
ALTER TABLE `paiement_dettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_general`
--
ALTER TABLE `stock_general`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boutique`
--
ALTER TABLE `boutique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
