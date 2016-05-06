-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Maj 2016, 14:29
-- Wersja serwera: 5.6.21
-- Wersja PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `engine`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_city`
--

CREATE TABLE IF NOT EXISTS `game_city` (
`id` int(11) NOT NULL,
  `city_name` varchar(32) NOT NULL,
  `city_text` text NOT NULL,
  `city_weather` varchar(32) NOT NULL DEFAULT 'Sunny',
  `city_weapons` int(11) NOT NULL,
  `city_armors` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `game_city`
--

INSERT INTO `game_city` (`id`, `city_name`, `city_text`, `city_weather`, `city_weapons`, `city_armors`) VALUES
(1, 'Eastcliff', 'Welcome in the Eastcliff the first town in this world.', 'Sunny', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_expeditions`
--

CREATE TABLE IF NOT EXISTS `game_expeditions` (
`id` int(11) NOT NULL,
  `expedition_name` varchar(32) NOT NULL,
  `expedition_text` text NOT NULL,
  `expedition_gold` int(11) NOT NULL,
  `expedition_chance` int(11) NOT NULL,
  `expedition_time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `game_expeditions`
--

INSERT INTO `game_expeditions` (`id`, `expedition_name`, `expedition_text`, `expedition_gold`, `expedition_chance`, `expedition_time`) VALUES
(1, 'Cave', 'You just come to the cave, in the end of the tunnel you find a box with gold :)', 5, 50, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_items`
--

CREATE TABLE IF NOT EXISTS `game_items` (
`id` int(11) NOT NULL,
  `item_name` varchar(32) NOT NULL,
  `item_type` varchar(16) NOT NULL,
  `item_str` int(11) NOT NULL,
  `item_int` int(11) NOT NULL,
  `item_dex` int(11) NOT NULL,
  `item_cha` int(11) NOT NULL,
  `item_dir` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `game_items`
--

INSERT INTO `game_items` (`id`, `item_name`, `item_type`, `item_str`, `item_int`, `item_dex`, `item_cha`, `item_dir`) VALUES
(1, 'Stick', 'weapon', 1, 0, 0, 0, 'stick');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_shops`
--

CREATE TABLE IF NOT EXISTS `game_shops` (
`id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `shop_item_id` int(11) NOT NULL,
  `shop_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `game_shops`
--

INSERT INTO `game_shops` (`id`, `shop_id`, `shop_item_id`, `shop_price`) VALUES
(1, 1, 1, 15),
(2, 1, 1, 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_travel`
--

CREATE TABLE IF NOT EXISTS `game_travel` (
`id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `travel_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `game_travel`
--

INSERT INTO `game_travel` (`id`, `travel_id`, `travel_time`) VALUES
(1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_accounts`
--

CREATE TABLE IF NOT EXISTS `users_accounts` (
`id` int(11) NOT NULL,
  `user_login` varchar(32) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_gender` varchar(16) NOT NULL,
  `user_class` varchar(32) NOT NULL DEFAULT 'Beginner',
  `user_gold` int(11) NOT NULL DEFAULT '25',
  `user_city` int(11) NOT NULL DEFAULT '1',
  `user_lastlogin` datetime NOT NULL,
  `user_accountlevel` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_accounts`
--

INSERT INTO `users_accounts` (`id`, `user_login`, `user_password`, `user_email`, `user_gender`, `user_class`, `user_gold`, `user_city`, `user_lastlogin`, `user_accountlevel`) VALUES
(1, 'Bleo', '202cb962ac59075b964b07152d234b70', 'test@test.test', 'Male', 'Beginner', 814, 1, '2016-05-06 14:27:15', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_backpacks`
--

CREATE TABLE IF NOT EXISTS `users_backpacks` (
`id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_backpack_id` int(11) NOT NULL,
  `users_item_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_backpacks`
--

INSERT INTO `users_backpacks` (`id`, `users_id`, `users_backpack_id`, `users_item_id`) VALUES
(1, 1, 1, 1),
(4, 1, 2, 1),
(5, 1, 3, 1),
(6, 1, 4, 1),
(7, 1, 5, 1),
(8, 1, 6, 1),
(9, 1, 7, 1),
(10, 1, 8, 1),
(11, 1, 9, 1),
(12, 1, 10, 1),
(13, 1, 11, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_equipment`
--

CREATE TABLE IF NOT EXISTS `users_equipment` (
`id` int(11) NOT NULL,
  `user_head` varchar(32) NOT NULL,
  `user_body` varchar(32) NOT NULL,
  `user_legs` varchar(32) NOT NULL,
  `user_foots` varchar(32) NOT NULL,
  `user_lefthand` varchar(32) NOT NULL,
  `user_righthand` varchar(32) NOT NULL,
  `user_ring` varchar(32) NOT NULL,
  `user_necklace` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_equipment`
--

INSERT INTO `users_equipment` (`id`, `user_head`, `user_body`, `user_legs`, `user_foots`, `user_lefthand`, `user_righthand`, `user_ring`, `user_necklace`) VALUES
(1, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_messages`
--

CREATE TABLE IF NOT EXISTS `users_messages` (
`id` int(11) NOT NULL,
  `messages_userId` int(11) NOT NULL,
  `messages_by` int(11) NOT NULL,
  `messages_subject` varchar(64) NOT NULL,
  `messages_text` text NOT NULL,
  `messages_readStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_messages`
--

INSERT INTO `users_messages` (`id`, `messages_userId`, `messages_by`, `messages_subject`, `messages_text`, `messages_readStatus`) VALUES
(1, 1, 0, 'Expedition Report', 'cfcd208495d565ef66e7dff9f98764da', 1),
(2, 1, 0, 'Expedition Report', 'a2ef406e2c2351e0b9e80029c909242d', 1),
(3, 1, 0, 'Expedition Report', 'b4b147bc522828731f1a016bfa72c073', 1),
(4, 1, 0, 'Expedition Report', 'a2ef406e2c2351e0b9e80029c909242d', 0),
(5, 1, 0, 'Expedition Report', '96a3be3cf272e017046d1b2674a52bd3', 1),
(6, 1, 0, 'Expedition Report', '751d31dd6b56b26b29dac2c0e1839e34', 0),
(7, 1, 0, 'Expedition Report', '05', 1),
(8, 1, 0, 'Expedition Report', 'You just come to the cave, in the end of the tunnel you find a box with gold :)<br>Reward: Gold = 3', 1),
(9, 1, 0, 'Expedition Report', 'You just come to the cave, in the end of the tunnel you find a box with gold :)<br>Reward: Gold = 1', 1),
(10, 1, 0, 'Expedition Report', 'You just come to the cave, in the end of the tunnel you find a box with gold :)<br>Reward: Gold = 1', 1),
(11, 1, 0, 'Expedition Report Fail', 'This time you have no chance do that expedition', 1),
(12, 1, 0, 'Expedition Report Fail', 'This time you have no chance do that expedition', 1),
(13, 1, 0, 'Expedition Report Fail', 'This time you have no chance do that expedition', 1),
(14, 1, 0, 'Expedition Report', 'You just come to the cave, in the end of the tunnel you find a box with gold :)<br>Reward: Gold = 0', 1),
(15, 1, 0, 'Expedition Report Fail', 'This time you have no chance do that expedition', 1),
(16, 1, 0, 'Expedition Report', 'You just come to the cave, in the end of the tunnel you find a box with gold :)<br>Reward: Gold = 4', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_stats`
--

CREATE TABLE IF NOT EXISTS `users_stats` (
`id` int(11) NOT NULL,
  `user_str` int(11) NOT NULL DEFAULT '1',
  `user_know` int(11) NOT NULL DEFAULT '1',
  `user_dex` int(11) NOT NULL DEFAULT '1',
  `user_charisma` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_stats`
--

INSERT INTO `users_stats` (`id`, `user_str`, `user_know`, `user_dex`, `user_charisma`) VALUES
(1, 1, 1, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `game_city`
--
ALTER TABLE `game_city`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_expeditions`
--
ALTER TABLE `game_expeditions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_items`
--
ALTER TABLE `game_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_shops`
--
ALTER TABLE `game_shops`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_travel`
--
ALTER TABLE `game_travel`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users_accounts`
--
ALTER TABLE `users_accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_backpacks`
--
ALTER TABLE `users_backpacks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_equipment`
--
ALTER TABLE `users_equipment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_messages`
--
ALTER TABLE `users_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_stats`
--
ALTER TABLE `users_stats`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `game_city`
--
ALTER TABLE `game_city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `game_expeditions`
--
ALTER TABLE `game_expeditions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `game_items`
--
ALTER TABLE `game_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `game_shops`
--
ALTER TABLE `game_shops`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `game_travel`
--
ALTER TABLE `game_travel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users_accounts`
--
ALTER TABLE `users_accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users_backpacks`
--
ALTER TABLE `users_backpacks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `users_equipment`
--
ALTER TABLE `users_equipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `users_messages`
--
ALTER TABLE `users_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `users_stats`
--
ALTER TABLE `users_stats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
