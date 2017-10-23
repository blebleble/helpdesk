-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Paź 2017, 13:57
-- Wersja serwera: 10.1.24-MariaDB
-- Wersja PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `hd`
--
CREATE DATABASE IF NOT EXISTS `hd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hd`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `attachment`
--

CREATE TABLE `attachment` (
  `att_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `size` int(11) NOT NULL,
  `task_ID` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `attachment`
--

INSERT INTO `attachment` (`att_ID`, `name`, `type`, `size`, `task_ID`, `description`) VALUES
(3, '17101913335611903695_967660986606515_3784587976557799151_n.jpg', 'image/jpeg', 69321, 50, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cats`
--

CREATE TABLE `cats` (
  `ID` int(11) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `cats`
--

INSERT INTO `cats` (`ID`, `link`) VALUES
(1, 'https://media.giphy.com/media/JIX9t2j0ZTN9S/giphy.gif'),
(2, 'https://media.giphy.com/media/l4KibK3JwaVo0CjDO/giphy.gif'),
(3, 'https://media.giphy.com/media/13CoXDiaCcCoyk/giphy.gif'),
(4, 'https://media.giphy.com/media/WPWrU2AeK3aV2/giphy.gif'),
(5, 'https://media.giphy.com/media/RJDmEeLNgzgxW/giphy.gif'),
(6, 'https://media.giphy.com/media/VIcgtjYlDLfkk/giphy.gif'),
(7, 'https://media.giphy.com/media/wPud2z0g029Xy/giphy.gif'),
(8, 'https://media.giphy.com/media/NwzLnMN3YaWZ2/giphy.gif'),
(9, 'https://media.giphy.com/media/BeGJ3IXngxyeY/giphy.gif'),
(10, 'https://media.giphy.com/media/XVHVUJm4ElVbq/giphy.gif'),
(11, 'http://www.catgifpage.com/gifs/323.gif'),
(12, 'http://www.catgifpage.com/gifs/298.gif'),
(13, 'http://www.catgifpage.com/gifs/280.gif'),
(14, 'http://www.catgifpage.com/gifs/272.gif');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `functions`
--

CREATE TABLE `functions` (
  `function_ID` int(11) NOT NULL,
  `function_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `functions`
--

INSERT INTO `functions` (`function_ID`, `function_description`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'grafik'),
(4, 'wykonawca'),
(5, 'montażysta');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `message_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `task_ID` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `notification_ID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `notifications`
--

INSERT INTO `notifications` (`notification_ID`, `date`, `type`) VALUES
(122, '2017-08-17 09:37:27', 4),
(123, '2017-08-17 09:39:26', 7),
(124, '2017-08-17 09:41:29', 6),
(125, '2017-08-17 09:46:24', 3),
(126, '2017-08-17 09:46:48', 7),
(127, '2017-08-17 09:47:28', 3),
(128, '2017-08-17 09:47:50', 3),
(129, '2017-08-17 09:54:27', 3),
(130, '2017-08-17 09:54:48', 3),
(131, '2017-08-17 09:59:19', 3),
(132, '2017-08-17 10:00:03', 3),
(133, '2017-08-17 10:02:31', 3),
(134, '2017-08-17 10:18:36', 4),
(135, '2017-08-17 10:19:57', 3),
(136, '2017-08-17 10:21:16', 3),
(137, '2017-08-17 10:23:37', 3),
(138, '2017-08-17 10:24:53', 3),
(139, '2017-09-15 09:22:55', 4),
(140, '2017-10-18 08:28:55', 1),
(141, '2017-10-18 08:48:03', 1),
(142, '2017-10-18 08:53:44', 2),
(143, '2017-10-19 08:27:01', 4),
(144, '2017-10-19 08:27:33', 8),
(145, '2017-10-19 08:38:58', 7),
(146, '2017-10-19 08:39:14', 8),
(147, '2017-10-19 08:42:00', 5),
(148, '2017-10-19 13:13:21', 2),
(149, '2017-10-19 13:33:56', 2),
(150, '2017-10-19 13:33:56', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nots_user`
--

CREATE TABLE `nots_user` (
  `nots_ID` int(11) NOT NULL,
  `notification_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `task_ID` int(11) NOT NULL,
  `subtask_ID` int(11) NOT NULL,
  `read_nots` int(11) NOT NULL,
  `delete_n` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nots_user`
--

INSERT INTO `nots_user` (`nots_ID`, `notification_ID`, `user_ID`, `task_ID`, `subtask_ID`, `read_nots`, `delete_n`) VALUES
(104, 143, 5, 50, 56, 0, 0),
(105, 144, 5, 50, 56, 0, 0),
(106, 145, 5, 50, 56, 0, 0),
(107, 146, 5, 50, 56, 0, 0),
(108, 147, 5, 50, 56, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subtask`
--

CREATE TABLE `subtask` (
  `subtask_ID` int(11) NOT NULL,
  `task_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `user_ID` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `subtask`
--

INSERT INTO `subtask` (`subtask_ID`, `task_ID`, `name`, `start_date`, `end_date`, `description`, `user_ID`, `done`, `confirmed`, `blocked`) VALUES
(56, 50, 'hheheheehhehehehehehhe', '2017-10-05', '2017-10-26', 'rrrrr', 5, 0, 1, 1),
(57, 46, 'hheheheehhehehehehehhe', '2017-10-05', '2017-10-26', 'rrrrr', 5, 0, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `task_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_ID` int(11) NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `hang` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`task_ID`, `name`, `description`, `start_date`, `end_date`, `user_ID`, `priority`, `done`, `hang`) VALUES
(46, 'ccc', '        fff', '2017-08-17', '2017-08-20', 17, 0, 1, 0),
(49, 'ccccccccccccccc', 'fffff', '2017-08-19', '2017-08-26', 22, 0, 1, 0),
(50, 'huehuehue', 'fffff', '2017-09-22', '2017-10-26', 5, 0, 1, 0),
(52, 'eeeee', 'eeeee', '2017-09-01', '2017-09-22', 22, 0, 1, 0),
(53, 'yyyyyy', 'fff', '2017-09-15', '2017-09-16', 22, 0, 0, 0),
(54, 'mmmmmm', 'cccc', '2017-09-15', '2017-09-29', 22, 0, 0, 0),
(55, 'jjjjjj', 'heheheh', '2017-09-29', '2017-10-01', 22, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `user_function` int(11) NOT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_ID`, `first_name`, `last_name`, `email`, `login`, `password`, `user_function`, `pic`) VALUES
(5, 'pan i władca', 'helpdesku', 'lol@lol.lol', 'aaa', 'b2ca678b4c936f905fb82f2733f5297f', 2, 'http://dailycat.net/cats/2016/10/b9be13e0399cfdb44ed1ce8bfb009e46.gif'),
(17, 'Jan', 'Kowalski', 'email@lajs', 'qwe', '202cb962ac59075b964b07152d234b70', 1, 'http://dailycat.net/cats/2016/10/b9be13e0399cfdb44ed1ce8bfb009e46.gif'),
(22, 'Lolaa', 'Lol', 'lol@lol.lol', 'lol', '41df0f088fcc2e16ff5bb349470a7c8c', 2, 'http://dailycat.net/cats/2016/10/b9be13e0399cfdb44ed1ce8bfb009e46.gif');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`att_ID`),
  ADD KEY `task_ID` (`task_ID`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`function_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `task_ID` (`task_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_ID`);

--
-- Indexes for table `nots_user`
--
ALTER TABLE `nots_user`
  ADD PRIMARY KEY (`nots_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `notification_ID` (`notification_ID`),
  ADD KEY `task_ID` (`task_ID`),
  ADD KEY `subtask_ID` (`subtask_ID`);

--
-- Indexes for table `subtask`
--
ALTER TABLE `subtask`
  ADD PRIMARY KEY (`subtask_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `task_ID` (`task_ID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `user_function` (`user_function`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `attachment`
--
ALTER TABLE `attachment`
  MODIFY `att_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `cats`
--
ALTER TABLE `cats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT dla tabeli `functions`
--
ALTER TABLE `functions`
  MODIFY `function_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT dla tabeli `nots_user`
--
ALTER TABLE `nots_user`
  MODIFY `nots_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT dla tabeli `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subtask_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nots_user`
--
ALTER TABLE `nots_user`
  ADD CONSTRAINT `nots_user_ibfk_1` FOREIGN KEY (`notification_ID`) REFERENCES `notifications` (`notification_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nots_user_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nots_user_ibfk_3` FOREIGN KEY (`subtask_ID`) REFERENCES `subtask` (`subtask_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nots_user_ibfk_4` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `subtask`
--
ALTER TABLE `subtask`
  ADD CONSTRAINT `subtask_ibfk_1` FOREIGN KEY (`task_ID`) REFERENCES `task` (`task_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subtask_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_function`) REFERENCES `functions` (`function_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
