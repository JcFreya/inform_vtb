SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-05:00"; -- EST

DROP DATABASE IF EXISTS `inform_vtb`;
CREATE DATABASE `inform_vtb`;
USE `inform_vtb`;

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL UNIQUE KEY,
  `pass` char(40) NOT NULL,
  `title` varchar(20) NOT NULL,
  `institution` tinytext NOT NULL,
  `web_address` tinytext NOT NULL,
  `address1` tinytext NOT NULL,
  `address2` tinytext NOT NULL,
  `address3` tinytext NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(40) NOT NULL,
  `investigator_id` int(10) UNSIGNED NOT NULL,
  `active` char(32) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE INDEX `login`
ON `users` (`email`, `pass`);

INSERT INTO `users` (`first_name`, `last_name`, `email`, `pass`, `title`, `institution`, `web_address`, `address1`, `address2`, `address3`, `postal_code`, `country`, `investigator_id`, `active`) VALUES
('Jerry', 'Vockley', 'vockleyg@upmc.edu', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'MD, PhD', 'Children\'s Hospital of Pittsburgh', 'http://www.chp.edu/find-a-doctor/service-providers/gerard-vockley-50926', 'One Children\'s Hospital Drive, 4401 Penn Ave.', 'PITTSBURGH', 'PA', '15209', 'United States of America', 0, ''),
('Jean', 'Bastin', 'jean.bastin@inserm.fr', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'PhD', 'INSERM U1124, Université Paris Descartes', 'http://www.biomedicale.parisdescartes.fr/cicb-paris/spip.php?rubrique63&lang=fr', '45 Rue Des Saints-Pères', 'PARIS', '', '75006', 'France', 0, '');


CREATE TABLE `samples` (
  `sample_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `diagnosis` tinytext NOT NULL,
  `symptoms` varchar(50) NOT NULL,
  `genotype_a1` varchar(10) NOT NULL,
  `genotype_a1_code` tinytext NOT NULL,
  `genotype_a2` varchar(10) NOT NULL,
  `genotype_a2_code` tinytext NOT NULL,
  `phenotype` varchar(50) NOT NULL,
  `sample_date` date NOT NULL,
  `age` int(3) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `ethnic` varchar(80) NOT NULL,
  `sample_type` varchar(10) NOT NULL,
  `type` tinytext DEFAULT NULL,
  `passage_num` tinytext DEFAULT NULL,
  `age_at_sampling` tinytext DEFAULT NULL,
  `prior_results` text DEFAULT NULL,
  `sick_or_well` varchar(10) DEFAULT NULL,
  `fed_or_fasted` varchar(10) DEFAULT NULL,
  `plasma_or_serum_or_dried` varchar(20) DEFAULT NULL,
  `frozen_vs_fixed` varchar(10) DEFAULT NULL,
  `prior_testing` text DEFAULT NULL,
  `consent` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE samples
ADD FULLTEXT(diagnosis, symptoms, genotype_a1, genotype_a1_code, genotype_a2, genotype_a2_code, phenotype, type, passage_num, age_at_sampling, prior_results, sick_or_well, fed_or_fasted, plasma_or_serum_or_dried, frozen_vs_fixed, prior_testing);

