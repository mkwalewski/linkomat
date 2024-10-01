SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `domain_patterns`;
SET FOREIGN_KEY_CHECKS = 1;


INSERT INTO `domain_patterns` VALUES (1, 1, ".*(youtube.com/watch|youtu.be)", "YoutubeParser", false);
-- INSERT INTO `domain_patterns` VALUES (2, 1, "youtu.be", "YoutubeParser", false);
INSERT INTO `domain_patterns` VALUES (3, 2, "www.telepolis.pl", "ArticleParser", false);
INSERT INTO `domain_patterns` VALUES (4, 3, "www.ppe.pl/(blog|news|promocje)/", "ArticleParser", false);
INSERT INTO `domain_patterns` VALUES (5, 3, "www.ppe.pl/(publicystyka|recenzje)/", "ArticleParser", false);
INSERT INTO `domain_patterns` VALUES (6, 4, "businessinsider.com.pl", "ArticleParser", false);
INSERT INTO `domain_patterns` VALUES (7, 4, "businessinsider.com.pl", "ArticleParser", true);
INSERT INTO `domain_patterns` VALUES (8, 5, "spidersweb.pl", "ArticleParser", false);
