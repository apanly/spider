CREATE TABLE `partTime` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `price` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
 `tasktitle` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
 `taskcontent` text COLLATE utf8_unicode_ci NOT NULL,
 `taskuri` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
 `md5hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
 `type` int(1) DEFAULT '1',
 PRIMARY KEY (`id`),
 KEY `md5hash` (`md5hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci