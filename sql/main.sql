CREATE TABLE IF NOT EXISTS `__prefix__mediaembedder_cache` (
    `id` integer AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `hash` varchar(255) NOT NULL UNIQUE,
    `data` longtext NOT NULL
) ENGINE = innodb CHARACTER SET utf8 COLLATE utf8_general_ci;