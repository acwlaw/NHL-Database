-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2018 at 12:15 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhl`
--

-- --------------------------------------------------------

--
-- Table structure for table `active`
--

CREATE TABLE `active` (
  `name` char(200) NOT NULL,
  `team_name` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active`
--

INSERT INTO `active` (`name`, `team_name`) VALUES
('Nathan Mackinnon', 'Avalanche'),
('Patrick Kane', 'Blackhawks'),
('Artemi Panarin', 'Blue Jackets'),
('Brayden Schenn', 'Blues'),
('Brad Marchand', 'Bruins'),
('Brendan Gallagher', 'Canadiens'),
('Brock Boeser', 'Canucks'),
('Jacob Markstrom', 'Canucks'),
('Alex Ovechkin', 'Capitals'),
('Clayton Keller', 'Coyotes'),
('Taylor Hall', 'Devils'),
('Rickard Rakell', 'Ducks'),
('Alex Law', 'Flames'),
('Johnny Gaudreau', 'Flames'),
('Sean Monahan', 'Flames'),
('Claude Giroux', 'Flyers'),
('Jonathan Marchessault', 'Golden Knights'),
('Marc-Andre Fleury', 'Golden Knights'),
('Sebastian Aho', 'Hurricanes'),
('John Tavares', 'Islanders'),
('Tony Chen', 'Islanders'),
('Blake Wheeler', 'Jets'),
('Anze Kopitar', 'Kings'),
('Drew Doughty', 'Kings'),
('Dylan Wang', 'Lightning'),
('Nikita Kucherov', 'Lightning'),
('Ryan Kamimura', 'Lightning'),
('Steven Stamkos', 'Lightning'),
('Mitchell Marner', 'Maple Leafs'),
('Cam Talbot', 'Oilers'),
('Connor McDavid', 'Oilers'),
('Toe Knee Shin', 'Oilers'),
('Aleksander Barkov', 'Panthers'),
('Roberto Luongo', 'Panthers'),
('Brendon Chiang', 'Penguins'),
('Evgeni Malkin', 'Penguins'),
('Phil Kessel', 'Penguins'),
('Viktor Arvidsson', 'Predators'),
('Mats Zuccarello', 'Rangers'),
('Dylan Larkin', 'Red Wings'),
('Jack Eichel', 'Sabres'),
('Erik Karlsson', 'Senators'),
('Mark Stone', 'Senators'),
('Brent Burns', 'Sharks'),
('Kari Lehtonen', 'Stars'),
('Tyler Seguin', 'Stars'),
('Eric Staal', 'Wild');

-- --------------------------------------------------------

--
-- Table structure for table `free_agent`
--

CREATE TABLE `free_agent` (
  `name` char(200) NOT NULL,
  `last_team` char(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `free_agent`
--

INSERT INTO `free_agent` (`name`, `last_team`) VALUES
('Cam Ward', 'Hurricanes'),
('Eddie Lack', 'Devils'),
('Jaroslav Halak', 'Islanders'),
('Jonathan Bernier', 'Avalanche'),
('Kari Lehtonen', 'Stars');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `date` char(10) NOT NULL,
  `time` char(10) NOT NULL,
  `location` char(40) NOT NULL,
  `teamA_score` int(11) DEFAULT NULL,
  `teamB_score` int(11) DEFAULT NULL,
  `teamA_name` char(200) NOT NULL,
  `teamB_name` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`date`, `time`, `location`, `teamA_score`, `teamB_score`, `teamA_name`, `teamB_name`) VALUES
('03/14/18', '17:00', 'Air Canada Centre', 3, 6, 'Hurricanes', 'Maple Leafs'),
('2018-01-01', '17:00', 'Rogers Arena', 3, 6, 'Jets', 'Canucks'),
('2018-01-02', '17:00', 'Air Canada Centre', 3, 6, 'Bruins', 'Maple Leafs'),
('2018-01-04', '17:00', 'Rogers Arena', 3, 6, 'Flyers', 'Canucks'),
('2018-01-15', '17:00', 'Rogers Arena', 3, 6, 'Blue Jackets', 'Canucks'),
('2018-02-14', '17:00', 'Air Canada Centre', 3, 6, 'Blue Jackets', 'Maple Leafs'),
('2018-02-14', '19:00', 'Rogers Arena', 4, 3, 'Panthers', 'Canucks'),
('2018-02-15', '15:00', 'SAP Centre', 1, 4, 'Canucks', 'Sharks'),
('2018-02-15', '17:00', 'T-Mobile Arena', 1, 4, 'Oilers', 'Golden Knights'),
('2018-03-01', '17:00', 'Air Canada Centre', 3, 6, 'Avalanche', 'Maple Leafs'),
('2018-03-01', '17:00', 'Rogers Arena', 3, 6, 'Avalanche', 'Canucks'),
('2018-03-02', '17:00', 'Air Canada Centre', 3, 6, 'Blackhawks', 'Maple Leafs'),
('2018-03-02', '17:00', 'Rogers Arena', 3, 6, 'Blackhawks', 'Canucks'),
('2018-03-03', '17:00', 'Air Canada Centre', 3, 6, 'Blues', 'Maple Leafs'),
('2018-03-03', '17:00', 'Rogers Arena', 3, 6, 'Blues', 'Canucks'),
('2018-03-04', '17:00', 'Rogers Arena', 3, 6, 'Bruins', 'Canucks'),
('2018-03-05', '17:00', 'Air Canada Centre', 3, 6, 'Canadiens', 'Maple Leafs'),
('2018-03-05', '17:00', 'Rogers Arena', 3, 6, 'Canadiens', 'Canucks'),
('2018-03-06', '17:00', 'Air Canada Centre', 3, 6, 'Canucks', 'Maple Leafs'),
('2018-03-07', '17:00', 'Air Canada Centre', 3, 6, 'Capitals', 'Maple Leafs'),
('2018-03-07', '17:00', 'Rogers Arena', 3, 6, 'Capitals', 'Canucks'),
('2018-03-08', '17:00', 'Air Canada Centre', 3, 6, 'Coyotes', 'Maple Leafs'),
('2018-03-08', '17:00', 'Rogers Arena', 3, 6, 'Coyotes', 'Canucks'),
('2018-03-09', '17:00', 'Air Canada Centre', 3, 6, 'Devils', 'Maple Leafs'),
('2018-03-09', '17:00', 'Rogers Arena', 3, 6, 'Devils', 'Canucks'),
('2018-03-10', '17:00', 'Air Canada Centre', 3, 6, 'Ducks', 'Maple Leafs'),
('2018-03-10', '17:00', 'Rogers Arena', 3, 6, 'Ducks', 'Canucks'),
('2018-03-11', '17:00', 'Air Canada Centre', 3, 6, 'Flames', 'Maple Leafs'),
('2018-03-11', '17:00', 'Rogers Arena', 3, 6, 'Flames', 'Canucks'),
('2018-03-12', '17:00', 'Air Canada Centre', 3, 6, 'Flyers', 'Maple Leafs'),
('2018-03-13', '17:00', 'Air Canada Centre', 3, 6, 'Golden Knights', 'Maple Leafs'),
('2018-03-13', '17:00', 'Rogers Arena', 3, 6, 'Golden Knights', 'Canucks'),
('2018-03-14', '17:00', 'Rogers Arena', 3, 6, 'Hurricanes', 'Canucks'),
('2018-03-15', '17:00', 'Air Canada Centre', 3, 6, 'Islanders', 'Maple Leafs'),
('2018-03-15', '13:00', 'Gila River Arena', 2, 5, 'Canadiens', 'Coyotes'),
('2018-03-15', '17:00', 'Rogers Arena', 3, 6, 'Islanders', 'Canucks'),
('2018-03-16', '17:00', 'Air Canada Centre', 3, 6, 'Jets', 'Maple Leafs'),
('2018-03-16', '17:00', 'Rogers Arena', 3, 6, 'Maple Leafs', 'Canucks'),
('2018-03-17', '17:00', 'Air Canada Centre', 3, 6, 'Kings', 'Maple Leafs'),
('2018-03-17', '17:00', 'Rogers Arena', 3, 6, 'Kings', 'Canucks'),
('2018-03-18', '17:00', 'Air Canada Centre', 3, 6, 'Lightning', 'Maple Leafs'),
('2018-03-18', '17:00', 'Rogers Arena', 3, 6, 'Lightning', 'Canucks'),
('2018-03-19', '17:00', 'Air Canada Centre', 3, 6, 'Oilers', 'Maple Leafs'),
('2018-03-19', '17:00', 'Rogers Arena', 3, 6, 'Oilers', 'Canucks'),
('2018-03-20', '17:00', 'Air Canada Centre', 3, 6, 'Panthers', 'Maple Leafs'),
('2018-03-20', '17:00', 'Rogers Arena', 3, 6, 'Panthers', 'Canucks'),
('2018-03-21', '17:00', 'Air Canada Centre', 3, 6, 'Penguins', 'Maple Leafs'),
('2018-03-21', '17:00', 'Rogers Arena', 3, 6, 'Penguins', 'Canucks'),
('2018-03-22', '17:00', 'Air Canada Centre', 3, 6, 'Predators', 'Maple Leafs'),
('2018-03-22', '17:00', 'Rogers Arena', 3, 6, 'Predators', 'Canucks'),
('2018-03-23', '17:00', 'Air Canada Centre', 3, 6, 'Rangers', 'Maple Leafs'),
('2018-03-23', '17:00', 'Rogers Arena', 3, 6, 'Rangers', 'Canucks'),
('2018-03-24', '17:00', 'Air Canada Centre', 3, 6, 'Red Wings', 'Maple Leafs'),
('2018-03-24', '17:00', 'Rogers Arena', 3, 6, 'Red Wings', 'Canucks'),
('2018-03-25', '17:00', 'Air Canada Centre', 3, 6, 'Sabres', 'Maple Leafs'),
('2018-03-25', '17:00', 'Rogers Arena', 3, 6, 'Sabres', 'Canucks'),
('2018-03-26', '17:00', 'Air Canada Centre', 3, 6, 'Senators', 'Maple Leafs'),
('2018-03-26', '17:00', 'Rogers Arena', 3, 6, 'Senators', 'Canucks'),
('2018-03-27', '17:00', 'Air Canada Centre', 3, 6, 'Sharks', 'Maple Leafs'),
('2018-03-27', '17:00', 'Rogers Arena', 3, 6, 'Sharks', 'Canucks'),
('2018-03-28', '17:00', 'Air Canada Centre', 3, 6, 'Stars', 'Maple Leafs'),
('2018-03-28', '17:00', 'Rogers Arena', 3, 6, 'Stars', 'Canucks'),
('2018-03-29', '17:00', 'Air Canada Centre', 3, 6, 'Wild', 'Maple Leafs'),
('2018-03-29', '17:00', 'Rogers Arena', 3, 6, 'Wild', 'Canucks');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `date` char(10) NOT NULL,
  `location` char(40) NOT NULL,
  `name` char(200) NOT NULL,
  `assist1` char(200) DEFAULT NULL,
  `assist2` char(200) DEFAULT NULL,
  `goal_time` char(10) NOT NULL,
  `goal_period` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`date`, `location`, `name`, `assist1`, `assist2`, `goal_time`, `goal_period`) VALUES
('2018-02-14', 'Rogers Arena', 'Michael Del Zotto', 'Bo Horvat', 'Sven Baertschi', '0:37', '1'),
('2018-02-14', 'Rogers Arena', 'Jamie McGinn', 'Nick Bjugstad', 'Connor Brickley', '13:01', '1'),
('2018-02-14', 'Rogers Arena', 'Alexander Petrovic', 'Radim Vrbata', 'Jared McCann', '17:25', '1'),
('2018-02-14', 'Rogers Arena', 'Evgenii Dadonov', 'Nick Bjugstad', 'Alexander Markov', '7:36', '1'),
('2018-02-14', 'Rogers Arena', 'Bo Horvat', 'Sven Baertschi', 'Michael Del Zotto', '8:10', '1');

-- --------------------------------------------------------

--
-- Table structure for table `goalie_statistic`
--

CREATE TABLE `goalie_statistic` (
  `name` char(200) NOT NULL,
  `year` int(11) NOT NULL,
  `win` int(11) DEFAULT NULL,
  `loss` int(11) DEFAULT NULL,
  `tie` int(11) DEFAULT NULL,
  `GAA` float DEFAULT NULL,
  `saving_percent` float DEFAULT NULL,
  `SO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goalie_statistic`
--

INSERT INTO `goalie_statistic` (`name`, `year`, `win`, `loss`, `tie`, `GAA`, `saving_percent`, `SO`) VALUES
('Cam Talbot', 2018, 19, 21, 0, 3.2, 0.9, 1),
('Jacob Markstrom', 2018, 16, 20, 0, 2.78, 0.908, 2),
('Marc-Andre Fleury', 2018, 18, 6, 0, 2.03, 0.933, 2),
('Miikka Kiprusoff', 2013, 8, 14, 0, 3.44, 0.882, 0),
('Roberto Luongo', 2018, 6, 6, 0, 2.61, 0.928, 1),
('Toe Knee Shin', 2018, 0, 69, 0, 5, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `date` char(10) NOT NULL,
  `location` char(40) NOT NULL,
  `name` char(200) NOT NULL,
  `type` char(200) NOT NULL,
  `penalty_time` char(10) NOT NULL,
  `penalty_period` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalty`
--

INSERT INTO `penalty` (`date`, `location`, `name`, `type`, `penalty_time`, `penalty_period`) VALUES
('2018-02-14', 'Rogers Arena', 'Aaron Ekblad', 'High Stick', '10:20', '3'),
('2018-02-14', 'Rogers Arena', 'Aaron Ekblad', 'High Stick', '12:34', '3'),
('2018-02-14', 'Rogers Arena', 'Brock Boeser', 'High Stick', '3:55', '1'),
('2018-02-14', 'Rogers Arena', 'Derrick Pouliot', 'Glove off', '0:23', '1'),
('2018-02-14', 'Rogers Arena', 'Michael Haley', 'High Stick', '18:36', '3');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `name` char(200) NOT NULL,
  `position` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`name`, `position`) VALUES
('Aleksander Barkov', 'Centreman'),
('Alex Law', 'Left Wing'),
('Alex Ovechkin', 'Left Wing'),
('Anze Kopitar', 'Centreman'),
('Artemi Panarin', 'Left Wing'),
('Blake Wheeler', 'Right Wing'),
('Brad Marchand', 'Left Wing'),
('Brayden Schenn', 'Centreman'),
('Brendan Gallagher', 'Right Wing'),
('Brendon Chiang', 'Defenseman'),
('Brent Burns', 'Defenseman'),
('Brock Boeser', 'Right Wing'),
('Cam Talbot', 'Goalie'),
('Cam Ward', 'Goalie'),
('Claude Giroux', 'Centreman'),
('Clayton Keller', 'Centreman'),
('Connor McDavid', 'Centreman'),
('Drew Doughty', 'Defenseman'),
('Dylan Larkin', 'Centreman'),
('Dylan Wang', 'Centreman'),
('Eddie Lack', 'Goalie'),
('Eric Staal', 'Centreman'),
('Erik Karlsson', 'Defenseman'),
('Evgeni Malkin', 'Centreman'),
('Jack Eichel', 'Centreman'),
('Jacob Markstrom', 'Goalie'),
('Jaroslav Halak', 'Goalie'),
('John Tavares', 'Centreman'),
('Johnny Gaudreau', 'Left Wing'),
('Jonathan Bernier', 'Goalie'),
('Jonathan Marchessault', 'Centreman'),
('Kari Lehtonen', 'Goalie'),
('Marc-Andre Fleury', 'Goalie'),
('Mark Stone', 'Right Wing'),
('Mats Zuccarello', 'Right Wing'),
('Miikka Kiprusoff', 'Goalie'),
('Mitchell Marner', 'Centreman'),
('Nathan Mackinnon', 'Centreman'),
('Nikita Kucherov', 'Right Wing'),
('Patrick Kane', 'Right Wing'),
('Phil Kessel', 'Right Wing'),
('Rickard Rakell', 'Centreman'),
('Roberto Luongo', 'Goalie'),
('Ron Francis', 'Centreman'),
('Ryan Kamimura', 'Centreman'),
('Sean Monahan', 'Centreman'),
('Sebastian Aho', 'Right Wing'),
('Sid Abel', 'Centreman'),
('Steven Stamkos', 'Centreman'),
('Syl Apps', 'Centreman'),
('Taylor Hall', 'Left Wing'),
('Toe Knee Shin', 'Goalie'),
('Tony Chen', 'Centreman'),
('Tyler Seguin', 'Centreman'),
('Viktor Arvidsson', 'Left Wing'),
('Wayne Gretzky', 'Centreman');

-- --------------------------------------------------------

--
-- Table structure for table `retired`
--

CREATE TABLE `retired` (
  `name` char(200) NOT NULL,
  `year_retired` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retired`
--

INSERT INTO `retired` (`name`, `year_retired`) VALUES
('Miikka Kiprusoff', 2013),
('Ron Francis', 2006),
('Sid Abel', 1995),
('Syl Apps', 1948),
('Wayne Gretzky', 1999);

-- --------------------------------------------------------

--
-- Table structure for table `skater_statistic`
--

CREATE TABLE `skater_statistic` (
  `name` char(200) NOT NULL,
  `year` int(11) NOT NULL,
  `PIM` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `assist` int(11) DEFAULT NULL,
  `goals` int(11) DEFAULT NULL,
  `SOG` int(11) DEFAULT NULL,
  `plusminus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skater_statistic`
--

INSERT INTO `skater_statistic` (`name`, `year`, `PIM`, `points`, `assist`, `goals`, `SOG`, `plusminus`) VALUES
('Aleksander Barkov', 2018, 14, 75, 49, 26, 242, 6),
('Alex Law', 2018, 1048, 11, 5, 6, 10, 0),
('Alex Ovechkin', 2018, 30, 83, 38, 45, 332, 7),
('Anze Kopitar', 2018, 18, 88, 54, 34, 190, 18),
('Artemi Panarin', 2018, 26, 71, 45, 26, 219, 20),
('Blake Wheeler', 2018, 44, 86, 66, 20, 232, 9),
('Brad Marchand', 2018, 55, 82, 49, 33, 165, 31),
('Brayden Schenn', 2018, 56, 64, 39, 25, 194, 17),
('Brendan Gallagher', 2018, 34, 49, 19, 30, 261, -11),
('Brendon Chiang', 2018, 5, 5, 4, 1, 10, 0),
('Brent Burns', 2018, 42, 62, 51, 11, 310, -16),
('Brock Boeser', 2018, 16, 55, 26, 29, 179, -5),
('Claude Giroux', 2018, 20, 92, 66, 26, 180, 17),
('Clayton Keller', 2018, 24, 62, 23, 39, 194, -8),
('Connor McDavid', 2018, 24, 66, 43, 23, 180, 11),
('Drew Doughty', 2018, 36, 40, 32, 8, 152, 18),
('Dylan Larkin', 2018, 59, 56, 44, 12, 214, -12),
('Dylan Wang', 2018, 42, 6, 4, 2, 4, 0),
('Eric Staal', 2018, 36, 73, 33, 40, 219, 13),
('Erik Karlsson', 2018, 30, 39, 34, 5, 138, -26),
('Evgeni Malkin', 2018, 69, 93, 51, 42, 220, 16),
('Jack Eichel', 2018, 32, 56, 32, 24, 224, -21),
('John Tavares', 2018, 26, 79, 46, 33, 240, -9),
('Johnny Gaudreau', 2018, 26, 82, 59, 23, 221, 0),
('Jonathan Marchessault', 2018, 40, 73, 48, 25, 257, 35),
('Mark Stone', 2018, 10, 62, 42, 20, 132, 9),
('Mats Zuccarello', 2018, 36, 51, 35, 16, 173, -8),
('Mitchell Marner', 2018, 22, 67, 46, 21, 182, 22),
('Nathan Mackinnon', 2018, 53, 92, 54, 38, 264, 14),
('Nikita Kucherov', 2018, 40, 96, 58, 38, 267, 17),
('Patrick Kane', 2018, 30, 72, 46, 26, 272, -18),
('Phil Kessel', 2018, 36, 85, 55, 30, 247, -3),
('Rickard Rakell', 2018, 14, 65, 34, 31, 209, 6),
('Sean Monahan', 2018, 20, 52, 25, 27, 156, 18),
('Sebastian Aho', 2018, 24, 63, 36, 27, 188, 6),
('Steven Stamkos', 2018, 53, 86, 59, 27, 206, 22),
('Taylor Hall', 2018, 34, 85, 52, 33, 254, 11),
('Tony Chen', 2018, 1000, 0, 0, 0, 500, -276),
('Tyler Seguin', 2018, 41, 73, 34, 39, 316, 7),
('Viktor Arvidsson', 2018, 36, 58, 30, 28, 235, 18),
('Wayne Gretzky', 1982, 26, 212, 120, 92, 370, 80);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_name` char(200) NOT NULL,
  `city` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_name`, `city`) VALUES
('Avalanche', 'Colorado'),
('Blackhawks', 'Chicago'),
('Blue Jackets', 'Columbus'),
('Blues', 'St. Louis'),
('Bruins', 'Boston'),
('Canadiens', 'Montreal'),
('Canucks', 'Vancouver'),
('Capitals', 'Washington'),
('Coyotes', 'Phoenix'),
('Devils', 'New Jersey'),
('Ducks', 'Anaheim'),
('Flames', 'Calgary'),
('Flyers', 'Philadelphia'),
('Golden Knights', 'Las Vegas'),
('Hurricanes', 'Carolina'),
('Islanders', 'New York'),
('Jets', 'Winnipeg'),
('Kings', 'Los Angeles'),
('Lightning', 'Tampa Bay'),
('Maple Leafs', 'Toronto'),
('Oilers', 'Edmonton'),
('Panthers', 'Florida'),
('Penguins', 'Pittsburgh'),
('Predators', 'Nashville'),
('Rangers', 'New York'),
('Red Wings', 'Detroit'),
('Sabres', 'Buffalo'),
('Senators', 'Ottawa'),
('Sharks', 'San Jose'),
('Stars', 'Dallas'),
('Wild', 'Minnesota');

-- --------------------------------------------------------

--
-- Table structure for table `team_statistic`
--

CREATE TABLE `team_statistic` (
  `team_name` char(200) NOT NULL,
  `year` int(11) NOT NULL,
  `goals_for` int(11) DEFAULT NULL,
  `win` int(11) DEFAULT NULL,
  `loss` int(11) DEFAULT NULL,
  `goals_against` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_statistic`
--

INSERT INTO `team_statistic` (`team_name`, `year`, `goals_for`, `win`, `loss`, `goals_against`) VALUES
('Avalanche', 2017, 165, 22, 56, 276),
('Blackhawks', 2017, 240, 50, 23, 212),
('Blue Jackets', 2017, 247, 50, 24, 193),
('Blues', 2017, 233, 46, 29, 216),
('Bruins', 2017, 232, 44, 31, 209),
('Canadiens', 2017, 223, 47, 26, 198),
('Canucks', 2017, 178, 30, 43, 241),
('Capitals', 2017, 261, 55, 19, 177),
('Coyotes', 2017, 191, 30, 42, 258),
('Devils', 2017, 180, 28, 40, 241),
('Ducks', 2017, 220, 46, 23, 197),
('Flames', 2017, 222, 45, 33, 219),
('Flyers', 2017, 212, 39, 33, 231),
('Hurricanes', 2017, 212, 36, 31, 230),
('Islanders', 2017, 239, 41, 29, 238),
('Jets', 2017, 246, 40, 35, 255),
('Kings', 2017, 199, 39, 35, 201),
('Lightning', 2017, 230, 42, 30, 224),
('Maple Leafs', 2017, 250, 40, 27, 234),
('Oilers', 2017, 243, 47, 26, 207),
('Panthers', 2017, 205, 35, 36, 231),
('Penguins', 2017, 278, 50, 21, 229),
('Predators', 2017, 238, 41, 29, 220),
('Rangers', 2017, 253, 48, 28, 216),
('Red Wings', 2017, 198, 33, 36, 244),
('Sabres', 2017, 199, 33, 37, 231),
('Senators', 2017, 206, 44, 28, 210),
('Sharks', 2017, 219, 46, 29, 200),
('Stars', 2017, 222, 34, 37, 260),
('Wild', 2017, 263, 49, 25, 206),
('Avalanche', 2018, 238, 41, 27, 221),
('Blackhawks', 2018, 216, 31, 36, 236),
('Blue Jackets', 2018, 216, 43, 29, 207),
('Blues', 2018, 209, 43, 28, 198),
('Bruins', 2018, 246, 47, 17, 191),
('Canadiens', 2018, 194, 28, 37, 239),
('Canucks', 2018, 201, 28, 40, 245),
('Capitals', 2018, 240, 46, 21, 224),
('Coyotes', 2018, 201, 28, 40, 245),
('Devils', 2018, 224, 40, 28, 224),
('Ducks', 2018, 214, 38, 25, 201),
('Flames', 2018, 203, 35, 32, 229),
('Flyers', 2018, 230, 38, 25, 224),
('Golden Knights', 2018, 251, 48, 21, 202),
('Hurricanes', 2018, 212, 34, 32, 241),
('Islanders', 2018, 243, 32, 35, 276),
('Jets', 2018, 251, 47, 17, 191),
('Kings', 2018, 222, 42, 28, 189),
('Lightning', 2018, 267, 51, 21, 215),
('Maple Leafs', 2018, 254, 46, 24, 217),
('Oilers', 2018, 220, 34, 37, 249),
('Panthers', 2018, 226, 39, 29, 225),
('Penguins', 2018, 251, 43, 28, 236),
('Predators', 2018, 239, 49, 16, 186),
('Rangers', 2018, 220, 33, 35, 243),
('Red Wings', 2018, 194, 28, 38, 238),
('Sabres', 2018, 176, 24, 40, 248),
('Senators', 2018, 205, 26, 39, 263),
('Sharks', 2018, 233, 44, 23, 206),
('Stars', 2018, 214, 39, 30, 207),
('Wild', 2018, 230, 42, 24, 212);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active`
--
ALTER TABLE `active`
  ADD PRIMARY KEY (`name`),
  ADD KEY `team_name` (`team_name`);

--
-- Indexes for table `free_agent`
--
ALTER TABLE `free_agent`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`date`,`location`),
  ADD KEY `teamA_name` (`teamA_name`),
  ADD KEY `teamB_name` (`teamB_name`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`date`,`location`,`goal_time`);

--
-- Indexes for table `goalie_statistic`
--
ALTER TABLE `goalie_statistic`
  ADD PRIMARY KEY (`name`,`year`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`date`,`location`,`name`,`penalty_time`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `retired`
--
ALTER TABLE `retired`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `skater_statistic`
--
ALTER TABLE `skater_statistic`
  ADD PRIMARY KEY (`name`,`year`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_name`);

--
-- Indexes for table `team_statistic`
--
ALTER TABLE `team_statistic`
  ADD PRIMARY KEY (`year`,`team_name`),
  ADD KEY `team_name` (`team_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active`
--
ALTER TABLE `active`
  ADD CONSTRAINT `active_ibfk_1` FOREIGN KEY (`name`) REFERENCES `players` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `active_ibfk_2` FOREIGN KEY (`team_name`) REFERENCES `team` (`team_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `free_agent`
--
ALTER TABLE `free_agent`
  ADD CONSTRAINT `free_agent_ibfk_1` FOREIGN KEY (`name`) REFERENCES `players` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`teamA_name`) REFERENCES `team` (`team_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`teamB_name`) REFERENCES `team` (`team_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`date`,`location`) REFERENCES `game` (`date`, `location`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goalie_statistic`
--
ALTER TABLE `goalie_statistic`
  ADD CONSTRAINT `goalie_statistic_ibfk_1` FOREIGN KEY (`name`) REFERENCES `players` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penalty`
--
ALTER TABLE `penalty`
  ADD CONSTRAINT `penalty_ibfk_1` FOREIGN KEY (`date`,`location`) REFERENCES `game` (`date`, `location`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retired`
--
ALTER TABLE `retired`
  ADD CONSTRAINT `retired_ibfk_1` FOREIGN KEY (`name`) REFERENCES `players` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skater_statistic`
--
ALTER TABLE `skater_statistic`
  ADD CONSTRAINT `name` FOREIGN KEY (`name`) REFERENCES `players` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_statistic`
--
ALTER TABLE `team_statistic`
  ADD CONSTRAINT `team_statistic_ibfk_1` FOREIGN KEY (`team_name`) REFERENCES `team` (`team_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
