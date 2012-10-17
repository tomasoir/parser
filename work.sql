CREATE TABLE IF NOT EXISTS `work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Budget_range` varchar(100) NOT NULL,
  `Starting_Date` varchar(100) NOT NULL,
  `Length_of_job` varchar(100) NOT NULL,
  `Posting_date` varchar(100) NOT NULL,
  `Required_Skills` varchar(200) NOT NULL,
  `Required_tools` varchar(200) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;