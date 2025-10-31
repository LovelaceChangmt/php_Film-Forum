# Host: localhost  (Version: 5.7.26)
# Date: 2025-06-18 21:07:22
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "juchang"
#

DROP TABLE IF EXISTS `juchang`;
CREATE TABLE `juchang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sno` int(11) NOT NULL COMMENT '序号',
  `cpname` varchar(100) NOT NULL COMMENT '组合名',
  `end` varchar(20) NOT NULL COMMENT '结局',
  `story` text NOT NULL COMMENT '故事内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='剧目信息表';

#
# Data for table "juchang"
#

INSERT INTO `juchang` VALUES (4,1,'孟许时分','he','他们在地铁上相识，最后甜蜜的走在了一起','2025-06-17 23:07:19','2025-06-17 23:07:19');

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "users"
#

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'aaa','$2y$10$cpI6O3ZpfjRyZziSo.Mg9OjKjzWPxoZQRf77tuckePxdJrmliQPEq','2025-06-17 22:21:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
