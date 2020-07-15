-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: docker
-- ------------------------------------------------------
-- Server version	10.4.13-MariaDB-1:10.4.13+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album`
(
    `id`     int(11)      NOT NULL AUTO_INCREMENT,
    `artist` varchar(100) NOT NULL,
    `title`  varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 307
  DEFAULT CHARSET = latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album`
    DISABLE KEYS */;
INSERT INTO `album`
VALUES (1, 'The Military Wives', 'In My Dreams (Live)'),
       (2, 'Adele', '19'),
       (3, 'Bruce Springsteen', 'Wrecking Ball (Deluxe)'),
       (4, 'Lana Del Rey', 'Born To Die'),
       (6, 'Senses Fail', 'Still Searching'),
       (157, 'David Bowie', 'The Next Day (Deluxe Version)'),
       (158, 'Bastille', 'Bad Blood'),
       (159, 'Bruno Mars', 'Unorthodox Jukebox'),
       (160, 'Emeli Sandé', 'Our Version of Events (Special Edition)'),
       (161, 'Bon Jovi', 'What About Now (Deluxe Version)'),
       (162, 'Justin Timberlake', 'The 20/20 Experience (Deluxe Version)'),
       (163, 'Bastille', 'Bad Blood (The Extended Cut)'),
       (164, 'P!nk', 'The Truth About Love'),
       (165, 'Sound City - Real to Reel', 'Sound City - Real to Reel'),
       (166, 'Jake Bugg', 'Jake Bugg'),
       (167, 'Various Artists', 'The Trevor Nelson Collection'),
       (168, 'David Bowie', 'The Next Day'),
       (169, 'Mumford & Sons', 'Babel'),
       (170, 'The Lumineers', 'The Lumineers'),
       (171, 'Various Artists', 'Get Ur Freak On - R&B Anthems'),
       (172, 'The 1975', 'Music For Cars EP'),
       (173, 'Various Artists', 'Saturday Night Club Classics - Ministry of Sound'),
       (174, 'Hurts', 'Exile (Deluxe)'),
       (175, 'Various Artists', 'Mixmag - The Greatest Dance Tracks of All Time'),
       (176, 'Ben Howard', 'Every Kingdom'),
       (177, 'Stereophonics', 'Graffiti On the Train'),
       (178, 'The Script', '#3'),
       (179, 'Stornoway', 'Tales from Terra Firma'),
       (180, 'David Bowie', 'Hunky Dory (Remastered)'),
       (181, 'Worship Central', 'Let It Be Known (Live)'),
       (182, 'Ellie Goulding', 'Halcyon'),
       (183, 'Various Artists', 'Dermot O\'Leary Presents the Saturday Sessions 2013'),
       (184, 'Stereophonics', 'Graffiti On the Train (Deluxe Version)'),
       (185, 'Dido', 'Girl Who Got Away (Deluxe)'),
       (186, 'Hurts', 'Exile'),
       (187, 'Bruno Mars', 'Doo-Wops & Hooligans'),
       (188, 'Calvin Harris', '18 Months'),
       (189, 'Olly Murs', 'Right Place Right Time'),
       (190, 'Alt-J (?)', 'An Awesome Wave'),
       (191, 'One Direction', 'Take Me Home'),
       (192, 'Various Artists', 'Pop Stars'),
       (193, 'Various Artists', 'Now That\'s What I Call Music! 83'),
       (194, 'John Grant', 'Pale Green Ghosts'),
       (195, 'Paloma Faith', 'Fall to Grace'),
       (196, 'Laura Mvula', 'Sing To the Moon (Deluxe)'),
       (197, 'Duke Dumont', 'Need U (100%) [feat. A*M*E] - EP'),
       (198, 'Watsky', 'Cardboard Castles'),
       (199, 'Blondie', 'Blondie: Greatest Hits'),
       (200, 'Foals', 'Holy Fire'),
       (201, 'Maroon 5', 'Overexposed'),
       (202, 'Bastille', 'Pompeii (Remixes) - EP'),
       (203, 'Imagine Dragons', 'Hear Me - EP'),
       (204, 'Various Artists', '100 Hits: 80s Classics'),
       (205, 'Various Artists', 'Les Misérables (Highlights From the Motion Picture Soundtrack)'),
       (206, 'Mumford & Sons', 'Sigh No More'),
       (207, 'Frank Ocean', 'Channel ORANGE'),
       (208, 'Bon Jovi', 'What About Now'),
       (209, 'Various Artists', 'BRIT Awards 2013'),
       (210, 'Taylor Swift', 'Red'),
       (211, 'Fleetwood Mac', 'Fleetwood Mac: Greatest Hits'),
       (212, 'David Guetta', 'Nothing But the Beat Ultimate'),
       (213, 'Various Artists', 'Clubbers Guide 2013 (Mixed By Danny Howard) - Ministry of Sound'),
       (214, 'David Bowie', 'Best of Bowie'),
       (215, 'Laura Mvula', 'Sing To the Moon'),
       (216, 'ADELE', '21'),
       (217, 'Of Monsters and Men', 'My Head Is an Animal'),
       (218, 'Rihanna', 'Unapologetic'),
       (219, 'Various Artists', 'BBC Radio 1\'s Live Lounge - 2012'),
       (220, 'Avicii & Nicky Romero', 'I Could Be the One (Avicii vs. Nicky Romero)'),
       (221, 'The Streets', 'A Grand Don\'t Come for Free'),
       (222, 'Tim McGraw', 'Two Lanes of Freedom'),
       (223, 'Foo Fighters', 'Foo Fighters: Greatest Hits'),
       (224, 'Various Artists', 'Now That\'s What I Call Running!'),
       (225, 'Swedish House Mafia', 'Until Now'),
       (226, 'The xx', 'Coexist'),
       (227, 'Five', 'Five: Greatest Hits'),
       (228, 'Jimi Hendrix', 'People, Hell & Angels'),
       (229, 'Biffy Clyro', 'Opposites (Deluxe)'),
       (230, 'The Smiths', 'The Sound of the Smiths'),
       (231, 'The Saturdays', 'What About Us - EP'),
       (232, 'Fleetwood Mac', 'Rumours'),
       (233, 'Various Artists', 'The Big Reunion'),
       (234, 'Various Artists', 'Anthems 90s - Ministry of Sound'),
       (235, 'The Vaccines', 'Come of Age'),
       (236, 'Nicole Scherzinger', 'Boomerang (Remixes) - EP'),
       (237, 'Bob Marley', 'Legend (Bonus Track Version)'),
       (238, 'Josh Groban', 'All That Echoes'),
       (239, 'Blue', 'Best of Blue'),
       (240, 'Ed Sheeran', '+'),
       (241, 'Olly Murs', 'In Case You Didn\'t Know (Deluxe Edition)'),
       (242, 'Macklemore & Ryan Lewis', 'The Heist (Deluxe Edition)'),
       (243, 'Various Artists', 'Defected Presents Most Rated Miami 2013'),
       (244, 'Gorgon City', 'Real EP'),
       (245, 'Mumford & Sons', 'Babel (Deluxe Version)'),
       (246, 'Various Artists', 'The Music of Nashville: Season 1, Vol. 1 (Original Soundtrack)'),
       (247, 'Various Artists', 'The Twilight Saga: Breaking Dawn, Pt. 2 (Original Motion Picture Soundtrack)'),
       (248, 'Various Artists', 'Mum - The Ultimate Mothers Day Collection'),
       (249, 'One Direction', 'Up All Night'),
       (250, 'Bon Jovi', 'Bon Jovi Greatest Hits'),
       (251, 'Agnetha Fältskog', 'A'),
       (252, 'Fun.', 'Some Nights'),
       (253, 'Justin Bieber', 'Believe Acoustic'),
       (254, 'Atoms for Peace', 'Amok'),
       (255, 'Justin Timberlake', 'Justified'),
       (256, 'Passenger', 'All the Little Lights'),
       (257, 'Kodaline', 'The High Hopes EP'),
       (258, 'Lana Del Rey', 'Born to Die'),
       (259, 'JAY Z & Kanye West', 'Watch the Throne (Deluxe Version)'),
       (260, 'Biffy Clyro', 'Opposites'),
       (261, 'Various Artists', 'Return of the 90s'),
       (262, 'Gabrielle Aplin', 'Please Don\'t Say You Love Me - EP'),
       (263, 'Various Artists', '100 Hits - Driving Rock'),
       (264, 'Jimi Hendrix', 'Experience Hendrix - The Best of Jimi Hendrix'),
       (265, 'Various Artists', 'The Workout Mix 2013'),
       (266, 'The 1975', 'Sex'),
       (267, 'Chase & Status', 'No More Idols'),
       (268, 'Rihanna', 'Unapologetic (Deluxe Version)'),
       (269, 'The Killers', 'Battle Born'),
       (270, 'Olly Murs', 'Right Place Right Time (Deluxe Edition)'),
       (271, 'A$AP Rocky', 'LONG.LIVE.A$AP (Deluxe Version)'),
       (272, 'Various Artists', 'Cooking Songs'),
       (273, 'Haim', 'Forever - EP'),
       (274, 'Lianne La Havas', 'Is Your Love Big Enough?'),
       (275, 'Michael Bublé', 'To Be Loved'),
       (276, 'Daughter', 'If You Leave'),
       (277, 'The xx', 'xx'),
       (278, 'Eminem', 'Curtain Call'),
       (279, 'Kendrick Lamar', 'good kid, m.A.A.d city (Deluxe)'),
       (280, 'Disclosure', 'The Face - EP'),
       (281, 'Palma Violets', '180'),
       (282, 'Cody Simpson', 'Paradise'),
       (283, 'Ed Sheeran', '+ (Deluxe Version)'),
       (284, 'Michael Bublé', 'Crazy Love (Hollywood Edition)'),
       (285, 'Bon Jovi', 'Bon Jovi Greatest Hits - The Ultimate Collection'),
       (286, 'Rita Ora', 'Ora'),
       (287, 'g33k', 'Spabby'),
       (288, 'Various Artists', 'Annie Mac Presents 2012'),
       (289, 'David Bowie', 'The Platinum Collection'),
       (290, 'Bridgit Mendler', 'Ready or Not (Remixes) - EP'),
       (291, 'Dido', 'Girl Who Got Away'),
       (292, 'Various Artists', 'Now That\'s What I Call Disney'),
       (293, 'The 1975', 'Facedown - EP'),
       (294, 'Kodaline', 'The Kodaline - EP'),
       (295, 'Various Artists', '100 Hits: Super 70s'),
       (296, 'Fred V & Grafix', 'Goggles - EP'),
       (297, 'Biffy Clyro', 'Only Revolutions (Deluxe Version)'),
       (298, 'Train', 'California 37'),
       (299, 'Ben Howard', 'Every Kingdom (Deluxe Edition)'),
       (300, 'Various Artists', 'Motown Anthems'),
       (301, 'Courteeners', 'ANNA'),
       (302, 'Johnny Marr', 'The Messenger'),
       (303, 'Rodriguez', 'Searching for Sugar Man'),
       (304, 'Jessie Ware', 'Devotion'),
       (305, 'Bruno Mars', 'Unorthodox Jukebox'),
       (306, 'Various Artists', 'Call the Midwife (Music From the TV Series)');
/*!40000 ALTER TABLE `album`
    ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2020-07-14 23:57:35
