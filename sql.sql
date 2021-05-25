CREATE TABLE `sermonTextFormat` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `author` varchar(150) NOT NULL DEFAULT 'Rev. Dr. Fred Kerbem',
  `title` varchar(255) NOT NULL,
  `slug_url` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dateOfSermon` date NOT NULL,
  `datePosted` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` TIMESTAMP  NULL,
  `published` tinyint NOT NULL DEFAULT 0,
  `deleted` tinyint NOT NULL DEFAULT 0

);

CREATE TABLE `sermonAudioFormat` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `author` varchar(150) NOT NULL DEFAULT 'Rev. Dr. Fred Kerbem',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug_url` varchar(255) NOT NULL,
  `audio` text NOT NULL,
  `audioSize` int(22) NOT NULL,
  `dateOfSermon` date NOT NULL,
  `datePosted` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` TIMESTAMP  NULL,
  `published` tinyint NOT NULL DEFAULT 0,
  `deleted` tinyint NOT NULL DEFAULT 0

);
