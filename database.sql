
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(250) NOT NULL DEFAULT '',
    `password` varchar(200) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(4, 'c@mail.org', '$2y$10$5UjPPK3ucjgciwOtx5zYG.eyrihyyxJPS7xDZCf0H1sFi1WxTXm0O');

  
UNLOCK TABLES;