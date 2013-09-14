CREATE TABLE `{prefix}_{dirname}_generator` (
  `generator_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `category_id` mediumint(8) unsigned NOT NULL,
  `original_id` mediumint(8) unsigned NOT NULL,
  `description` text NOT NULL,
  `items` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`generator_id`)) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_page` (
  `page_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `category_id` mediumint(8) unsigned NOT NULL,
  `description` text NOT NULL,
  `posttime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`page_id`)) ENGINE=MyISAM;

CREATE TABLE `{prefix}_{dirname}_link` (
  `link_id` int(11) unsigned NOT NULL  auto_increment,
  `title` varchar(255) NOT NULL,
  `page_id` int(11) unsigned NOT NULL,
  `generator_id` int(11) unsigned NOT NULL,
  `weight` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`link_id`)) ENGINE=MyISAM;

