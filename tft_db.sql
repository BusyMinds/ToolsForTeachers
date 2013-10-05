-- CREATE DATABASE `tft_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
CREATE TABLE `competencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade_level` tinyint(4) unsigned NOT NULL,
  `subject` varchar(16) NOT NULL,
  `teachers` varchar(64) NOT NULL,
  `quarter` tinyint(4) NOT NULL,
  `competencies` text NOT NULL,
  `total_meetings` tinyint(3) unsigned NOT NULL,
  `max_meetings` tinyint(3) unsigned NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `grade_subject_index` (`grade_level`,`subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;