DROP TABLE IF EXISTS `all_good_inventory`;
CREATE TABLE `all_good_inventory` (
  `inv_id` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL,
  `m_parent` int(11) DEFAULT NULL,
  `width` decimal(11,2) DEFAULT '1',
  `height` decimal(11,2) DEFAULT '1',
  `weight` decimal(11,2) DEFAULT '0', 
  `quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `all_good_inventory` (`inv_id`, `m_id`, `m_parent`, `width`, `height`, `weight`, `quantity`) VALUES
(1, 1, NULL, 3, 8, 2, 12),
(2, 135, 4, 9, 4, 5, 5),
(3, 2, 123, 6, 5, 10, 20),
(4, 6, NULL, 3, 3, 19, 15),
(5, 22, 7, 1, 2, 3, 9);