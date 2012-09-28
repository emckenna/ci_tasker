
--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `task`
--
CREATE TABLE `task` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `recurrence` int(11) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `attendence`
--
CREATE TABLE `attendence` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `tid` (`tid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
