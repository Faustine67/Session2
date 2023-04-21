-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour session
CREATE DATABASE IF NOT EXISTS `session` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `session`;

-- Listage de la structure de la table session. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.categorie : ~2 rows (environ)
INSERT INTO `categorie` (`id`, `nom`) VALUES
	(1, 'Enseignement'),
	(2, 'Pratique');

-- Listage de la structure de la table session. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.doctrine_migration_versions : ~3 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20230421124844', '2023-04-21 12:49:15', 682),
	('DoctrineMigrations\\Version20230421125121', '2023-04-21 12:51:30', 52),
	('DoctrineMigrations\\Version20230421130118', '2023-04-21 13:01:29', 250),
	('DoctrineMigrations\\Version20230421135935', '2023-04-21 13:59:51', 917);

-- Listage de la structure de la table session. formateur
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.formateur : ~2 rows (environ)
INSERT INTO `formateur` (`id`, `nom`, `prenom`, `date_naissance`, `ville`, `email`, `telephone`) VALUES
	(1, 'Murmann', 'Mickael', '1985-01-17', 'Colmar', 'mickael.murmann@gmail.com', '0611223344'),
	(2, 'Matthieu', 'Quentin', '1990-04-14', 'Strasbourg', 'quentin.matthieu@exemple.fr', '0799887766');

-- Listage de la structure de la table session. formation
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.formation : ~6 rows (environ)
INSERT INTO `formation` (`id`, `nom`, `image`) VALUES
	(1, 'Catamaran', 'https://www.c-cat-france.fr/wp-content/uploads/2021/10/catamaran-c-cat-48-1.jpeg'),
	(2, 'Paddle', 'https://www.nikaiaglisse.com/wp-content/uploads/2018/04/stand-up-paddle-location-balade-en-mer-nice-cote-d-azur-06-paca-02.jpg'),
	(3, 'Plongee', 'https://i.f1g.fr/media/cms/616x347_cropupscale/2022/05/23/02d3444bcb629cfde8349a033c0d8f28da34efb326d5e53e21404aeb10cdf5b1.jpg'),
	(4, 'Surf', 'https://img.redbull.com/images/c_crop,x_0,y_502,h_3078,w_5472/c_fill,w_1200,h_700/q_auto,f_auto/redbullcom/2020/5/1/mqgjwevxveuc6fcqvdfc/carissa-moore-surf-vague-tahiti'),
	(5, 'Wakeboard', 'https://www.c-and-a.com/shop-img/c_scale,w_0.5,c_limit,w_1024/content/2020/wake-boarding.jpg'),
	(6, 'Yoga', 'https://cdn.pixabay.com/photo/2019/01/20/20/54/sunset-3944688_960_720.jpg');

-- Listage de la structure de la table session. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.messenger_messages : ~0 rows (environ)

-- Listage de la structure de la table session. module
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `many_to_one` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C242628BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_C242628BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.module : ~5 rows (environ)
INSERT INTO `module` (`id`, `nom`, `details`, `categorie_id`, `many_to_one`) VALUES
	(1, 'Enseignement du language marins et des allures', 'zaetrzetertery', 1, ''),
	(2, 'Enseignement du réglage de la voile', 'dfhdfhgf', 1, ''),
	(3, 'Séance de catamaran', 'drydfuyfyu', 2, ''),
	(4, 'Parcours de régate', 'rtyurdtuftyu', 2, ''),
	(5, 'Séance de windsurf', 'rtyurtutui', 2, '');

-- Listage de la structure de la table session. programmation
CREATE TABLE IF NOT EXISTS `programmation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `nombre_jours` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E9F80E3613FECDF` (`session_id`),
  KEY `IDX_5E9F80E3AFC2B591` (`module_id`),
  CONSTRAINT `FK_5E9F80E3613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_5E9F80E3AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.programmation : ~6 rows (environ)
INSERT INTO `programmation` (`id`, `session_id`, `module_id`, `nombre_jours`) VALUES
	(1, 1, 1, 0),
	(2, 1, 2, 0),
	(3, 1, 3, 0),
	(4, 1, 4, 0),
	(5, 1, 5, 0),
	(6, 2, 5, 0);

-- Listage de la structure de la table session. session
CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nombre_places` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D45200282E` (`formation_id`),
  CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.session : ~7 rows (environ)
INSERT INTO `session` (`id`, `intitule`, `date_debut`, `date_fin`, `nombre_places`, `formation_id`) VALUES
	(1, 'Initiation Catamaran', '2023-06-03', '2023-06-10', 10, 1),
	(2, 'Initiation Surf', '2023-06-10', '2023-06-17', 15, 4),
	(3, 'Intermediaire Catamaran', '2023-06-17', '2023-06-24', 10, 1),
	(4, 'Perfectionnement Yoga', '2023-06-17', '2023-06-24', 10, 6),
	(5, 'Initiation Catamaran', '2023-06-10', '2023-06-17', 15, 1),
	(6, 'Intermediaire Catamaran', '2023-06-17', '2023-06-24', 10, 1),
	(7, 'Perfectionnement Catamaran', '2023-06-24', '2023-07-01', 15, 1);

-- Listage de la structure de la table session. session_stagiaire
CREATE TABLE IF NOT EXISTS `session_stagiaire` (
  `session_id` int(11) NOT NULL,
  `stagiaire_id` int(11) NOT NULL,
  PRIMARY KEY (`session_id`,`stagiaire_id`),
  KEY `IDX_C80B23B613FECDF` (`session_id`),
  KEY `IDX_C80B23BBBA93DD6` (`stagiaire_id`),
  CONSTRAINT `FK_C80B23B613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C80B23BBBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table session.session_stagiaire : ~0 rows (environ)

-- Listage de la structure de la table session. stagiaire
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table session.stagiaire : ~0 rows (environ)
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `date_naissance`, `ville`, `email`, `telephone`) VALUES
	(1, 'Michel', 'Faustine', '1993-05-12', 'Strasbourg', 'michelfaustine@gmail.com', '0600112233');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
