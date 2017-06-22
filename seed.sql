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

ALTER TABLE users
ADD FULLTEXT(first_name, last_name);

CREATE INDEX `login`
ON `users` (`email`, `pass`);

INSERT INTO `users` (`first_name`, `last_name`, `email`, `pass`, `title`, `institution`, `web_address`, `address1`, `address2`, `address3`, `postal_code`, `country`, `investigator_id`, `active`) VALUES
('Jean', 'Bastin', 'jean.bastin@inserm.fr', SHA1('Inform2017'), 'PhD', 'INSERM U1124, Université Paris Descartes', 'http://www.biomedicale.parisdescartes.fr/cicb-paris/spip.php?rubrique63&lang=fr', '45 Rue Des Saints-Pères', 'PARIS', '', '75006', 'France', 0, ''),
('Michael', 'Bennett', 'BENNETTMI@email.chop.edu', SHA1('Inform2017'), 'PhD', 'Children\'s Hospital of Philadelphia', 'http://www.chop.edu/', 'Room 5NW58, 34th Street & Civic Center Blvd', 'PHILADELPHIA', '', '', 'United States of America', 0, ''),
('Jason', 'Cataldo', 'JCataldo@ultragenyx.com', SHA1('Inform2017'), 'PhD', 'Ultragenyx Pharmaceutical', 'http://www.ultragenyx.com/', '60 Leveroni Court', 'NOVATO', '', '94949', 'United States of America', 0, ''),
('Jane', 'Dalley', 'Jane.Dalley@sch.nhs.uk', SHA1('Inform2017'), 'PhD', 'Sheffield Children\'s Hospital, UK', 'https://www.sheffieldchildrens.nhs.uk/', 'Western Park', 'SHEFFIELD', '', 'S10 5SH', 'UNITED KINGDOM', 0, ''),
('Areeg H.', 'El-Gharbawy', 'Areeg.elgharbawy@chp.edu', SHA1('Inform2017'), 'MD', 'Children\'s Hospital of Pittsburgh - University of Pittsburgh', 'http://www.chp.edu/', 'Children\'s Hospital of Pittsburgh of UPMC- 4401 Penn Ave', 'PITTSBURGH', 'PA', '15224', 'United States of America', 0, ''),
('Melanie', 'Gillingham', 'gillingm@ohsu.edu', SHA1('Inform2017'), 'PhD, RD', 'Oregon Health & Science University', 'http://www.ohsu.edu/xd/', '3181 SW Sam Jackson Park Road', 'PORTLAND', '', '97239', 'United States of America', 0, ''),
('Eric', 'Goetzman', 'eric.goetzman@chp.edu', SHA1('Inform2017'), 'PhD', 'Children\'s Hospital Of Pittsburgh', 'http://www.chp.edu/', '4401 Penn Ave', 'PITTSBURGH', '', '15224', 'United States of America', 0, ''),
('Niels', 'Gregersen', 'NIG@KI.AU.DK', SHA1('Inform2017'), 'PhD', 'MMF Aarhus University Hospital', 'http://clin.au.dk/en/research/forskningsomraader/core-faciliteter/mmfindex/', '8200 Aarhus N', '', '', '', 'Denmark', 0, ''),
('Matthew', 'Hirschey', 'matthew.hirschey@duke.edu', SHA1('Inform2017'), 'PhD', 'Duke Molecular Phsysiology Institute', 'http://dmpi.duke.edu/', '300 N. Duke Street', 'North Carolina', '', '27701', 'United States of America', 0, ''),
('Sander', 'Houten', 'sander.houten@mssm.edu', SHA1('Inform2017'), 'PhD', 'Icahn School Of Medicine', 'http://icahn.mssm.edu/', '1425 Madison Avenue', 'NEW YORK', '', '10029', 'United States of America', 0, ''),
('Guilhian', 'Leipnitz', 'guilhian.leipnitz@chp.edu', SHA1('Inform2017'), 'PhD', 'FederaL University Of Rio Grande Do Sul', 'http://www.ufrgs.br/english/home', 'Rua Ramiro Barcelos 2600 Anexo', 'PORTO ALEGRE', '', '90035-003', 'United States of America', 0, ''),
('Nicola', 'Longo', 'Nicola.Longo@hsc.utah.edu', SHA1('Inform2017'), 'MD, PhD', 'University Of Utah', 'https://www.utah.edu/', '295 Chipeta Wy', 'SALT LAKE CITY', '', '84108', 'United States of America', 0, ''),
('Al-Walid', 'Mohsen', 'Al-Walid.Mohsen@chp.edu', SHA1('Inform2017'), 'MD, PhD', 'University Of Pittsburgh', 'http://www.pitt.edu/', 'Children\'s Hospital Of Pittsburgh, Rangos 5157', 'PITTSBURGH', '', '15224', 'United States of America', 0, ''),
('Henry Joel', 'Mroczkowski', 'Mroczkowski@UTHSC.edu', SHA1('Inform2017'), 'MD, PhD', 'University Of Tennessee Health Science Center (UTHSC)', 'https://www.uthsc.edu/', '85 Harbor Village Drive', 'MEMPHIS', '', '38103', 'United States of America', 0, ''),
('Simon', 'Olpin', 'simon.olpin@sch.nhs.uk', SHA1('Inform2017'), 'PhD', 'Sheffield Children\'s Hospital', 'https://www.sheffieldchildrens.nhs.uk/about-us/sites/the-hospital.htm', 'Sheffield S10 2TH', 'Western Bank', '', '', 'UK', 0, ''),
('Ute', 'Spiekerkötter', 'ute.spiekerkoetter@uniklinik-freiburg.de', SHA1('Inform2017'), 'MD', 'University Children\'s Hospital Freiburg', 'https://www.uni-freiburg.de/universitaet-en/uniklinik', 'Mathildenstr. 1', 'FREIBURG', '', '79104', 'DEUTSCHLAND', 0, ''),
('Arnold', 'Strauss', 'arnold.strauss@cchmc.org', SHA1('Inform2017'), 'MD', 'Cincinnati Children\'s Hospital Medical Center', 'https://www.cincinnatichildrens.org/', '3333 Burnet Ave. MLC 3016', 'CINCINNATI', '', '45229', 'United States of America', 0, ''),
('Christine', 'Vianey-Saban', 'christine.saban@chu-lyon.fr', SHA1('Inform2017'), 'MD', 'Service Maladies Héréditaires Du Métabolisme Et Dépistage Néonatal', 'http://www.orpha.net/consor/cgi-bin/Directory_Institutions.php?lng=FR&data_id=92&title=Service-Maladies-hereditaires-du-metabolisme-et-depistage-neonatal&data_type=Test', 'Centre De Biologie Et De Pahologie Est', 'BRON CEDEX', '', '69677', 'FRANCE', 0, ''),
('Gepke', 'Visser', 'gvisser4@umcutrecht.nl', SHA1('Inform2017'), 'MD, PhD', 'Umcu', 'https://ddrmd.nl/general/centers/umcu', 'Lundlaan 6', 'UTRECHT', '', '5384 EA', 'NETHERLANDS', 0, ''),
('Jerry', 'Vockley', 'vockleyg@upmc.edu', SHA1('Inform2017'), 'MD, PhD', 'Children\'s Hospital of Pittsburgh', 'http://www.chp.edu/find-a-doctor/service-providers/gerard-vockley-50926', 'One Children\'s Hospital Drive, 4401 Penn Ave.', 'PITTSBURGH', 'PA', '15209', 'United States of America', 0, ''),
('Moacir', 'Wajner', 'mwajner@ufrgs.br', SHA1('Inform2017'), 'MD, PhD', 'FederaL University Of Rio Grande Do Sul', 'http://www.ufrgs.br/english/home', 'Rua Ramiro Barcelos 2600 Anexo', 'PORTO ALEGRE', '', '90035-003', 'BRAZIL', 0, ''),
('Ronald', 'Wanders', 'r.j.wanders@amc.uva.nl', SHA1('Inform2017'), 'MD, PhD', 'Academic Medical Center', 'http://www.ohsu.edu/xd/health/who-we-are/academic-health-center.cfm', 'Meibergdreef 9', 'AMSTERDAM', '', '1105 AZ', 'NETHERLANDS', 0, '');


CREATE TABLE `samples` (
  `sample_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `diagnosis` tinytext NOT NULL,
  `symptoms` varchar(255) NOT NULL,
  `genotype_a1` varchar(10) NOT NULL,
  `genotype_a1_code` tinytext NOT NULL,
  `genotype_a2` varchar(10) NOT NULL,
  `genotype_a2_code` tinytext NOT NULL,
  `phenotype` varchar(50) NOT NULL,
  `sample_date` date NOT NULL,
  `age_days` int(3) NOT NULL,
  `age_months` int(3) NOT NULL,
  `age_years` int(3) NOT NULL,
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
ADD FULLTEXT(diagnosis, symptoms, genotype_a1, genotype_a1_code, genotype_a2, genotype_a2_code, phenotype, sample_type, passage_num, age_at_sampling, prior_results, sick_or_well, fed_or_fasted, plasma_or_serum_or_dried, frozen_vs_fixed, prior_testing);

