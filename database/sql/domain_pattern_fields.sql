SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `domain_pattern_fields`;
SET FOREIGN_KEY_CHECKS = 1;

-- VIDEOS --

-- youtube.com
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "video_id", "script", "ytInitialPlayerResponse", "json", "videoDetails->videoId");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "channel_id", "script", "ytInitialPlayerResponse", "json", "videoDetails->channelId");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "channel_url", "script", "ytInitialPlayerResponse", "json", "microformat->playerMicroformatRenderer->ownerProfileUrl");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "title", "script", "ytInitialPlayerResponse", "json", "videoDetails->title");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "author", "script", "ytInitialPlayerResponse", "json", "videoDetails->author");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "date", "script", "ytInitialPlayerResponse", "json", "microformat->playerMicroformatRenderer->publishDate");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "category", "script", "ytInitialPlayerResponse", "json", "microformat->playerMicroformatRenderer->category");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "keywords", "script", "ytInitialPlayerResponse", "json", "videoDetails->keywords");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "short_description", "script", "ytInitialPlayerResponse", "json", "videoDetails->shortDescription");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "view_count", "script", "ytInitialPlayerResponse", "json", "videoDetails->viewCount");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "length", "script", "ytInitialPlayerResponse", "json", "videoDetails->lengthSeconds");
INSERT INTO `domain_pattern_fields` VALUES (NULL, 1, "thumb", "script", "ytInitialPlayerResponse", "json", "videoDetails->thumbnail->thumbnails");

-- ARTICLES --

-- www.telepolis.pl
INSERT INTO `domain_pattern_fields` VALUES (NULL, 3, "title", "css", ".artykul h1", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 3, "date", "css", ".artykul time", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 3, "author", "css", ".artykul p:nth-child(2)", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 3, "content", "css", ".artykul-content", "html", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 3, "category", "css", ".artykul p:nth-child(3)", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 3, "image", "css", ".artykul-content img", "src", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 3, "tags", "css", ".artykul-tagi a", "multi_text", NULL);

-- www.ppe.pl/(blog|news|promocje)/
INSERT INTO `domain_pattern_fields` VALUES (NULL, 4, "title", "css", ".news-section h1", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 4, "date", "css", ".author-with-avatar span", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 4, "author", "css", ".author-with-avatar a", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 4, "content", "css", ".news-section", "html", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 4, "category", "css", ".labels .label", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 4, "image", "css", ".news-image img", "src", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 4, "tags", "css", ".news-section a.tag", "multi_text", NULL);

-- www.ppe.pl/(publicystyka|recenzje)/
INSERT INTO `domain_pattern_fields` VALUES (NULL, 5, "title", "css", "h1.title-in-photo", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 5, "date", "css", ".review-author span", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 5, "author", "css", ".review-author a", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 5, "content", "css", ".review-content", "html", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 5, "category", "css", ".labels-and-title .label", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 5, "image", "css", ".picture-wrapper img", "src", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 5, "tags", "css", ".tags a.tag", "multi_text", NULL);

-- businessinsider.com.pl
INSERT INTO `domain_pattern_fields` VALUES (NULL, 6, "title", "css", "h1.article_title", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 6, "date", "css", ".article-article_date time", "datetime", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 6, "author", "css", ".article-author_details .article-author_text", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 6, "content", "css", "article > .main", "multi_html", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 6, "category", "css", ".breadcrumbs a:nth-child(2)", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 6, "image", "css", ".article_image img", "src", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 6, "tags", "css", ".article-tags a", "multi_text", NULL);

-- businessinsider.com.pl (PREMIUM)
INSERT INTO `domain_pattern_fields` VALUES (NULL, 7, "title", "css", "h1.article_title", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 7, "date", "css", ".article-article_date time", "datetime", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 7, "author", "css", ".article-author_details .article-author_text", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 7, "content", "css", "article > .main", "multi_html", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 7, "category", "css", ".breadcrumbs a:nth-child(2)", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 7, "image", "css", ".article--bs_picture img", "src", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 7, "tags", "css", ".article-tags a", "multi_text", NULL);

-- spidersweb.pl/plus/
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "title", "css", "h1.post-title", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "date", "css", "article.container time", "datetime", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "author", "css", "article.container .post-author", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "content", "css", "article.container", "html", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "category", "css", ".post-source li:nth-child(2)", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "image", "css", "article.container img", "src", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "tags", "css", ".PostTags_singleTags__O8k34 a", "multi_text", NULL);

-- spidersweb.pl
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "title", "css", "h1.post-title", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "date", "css", "article.container time", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "author", "css", "article.container .post-author", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "content", "css", "article.container", "html", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "category", "css", ".post-source li:nth-child(2)", "text", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "image", "css", "article.container img", "src", NULL);
INSERT INTO `domain_pattern_fields` VALUES (NULL, 8, "tags", "css", ".PostTags_singleTags__O8k34 a", "multi_text", NULL);
