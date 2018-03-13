############################################
#        Dump time:2014-11-24 09:27:25     #
#                <?php exit() ?>           #
############################################
DROP TABLE IF EXISTS `t_webconfig`;
CREATE TABLE `t_webconfig` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `logo` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `keywords` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `icpno` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `contact` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `t_webconfig`(`id`,`title`,`logo`,`keywords`,`description`,`icpno`,`contact`)VALUES('1','腾讯微博','54728936a8ca7.png','php,linux,javascript,jquery','测试网站','沪ICP备14007530号-1','邮箱：1141056911@qq.com');

