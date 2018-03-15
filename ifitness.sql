-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2016 at 01:14 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ifitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `difficultyID` char(2) NOT NULL,
  `difficultyName` char(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`difficultyID`, `difficultyName`) VALUES
('D1', 'Beginner'),
('D2', 'Intermediate'),
('D3', 'Advanced');

-- --------------------------------------------------------

--
-- Table structure for table `end_user`
--

CREATE TABLE `end_user` (
  `userID` char(4) NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `age` smallint(3) NOT NULL,
  `weight` smallint(3) NOT NULL,
  `sex` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `end_user`
--

INSERT INTO `end_user` (`userID`, `firstName`, `lastName`, `age`, `weight`, `sex`) VALUES
('U001', 'Default', 'User', 25, 185, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `exerciseID` char(4) NOT NULL,
  `exerciseName` varchar(35) NOT NULL,
  `difficultyID` char(4) NOT NULL,
  `sets` smallint(30) NOT NULL,
  `reps` smallint(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`exerciseID`, `exerciseName`, `difficultyID`, `sets`, `reps`) VALUES
('E001', 'Treadmill', 'D2', 1, NULL),
('E002', 'Bench Press', 'D2', 4, 12),
('E003', 'Lat Pull Down', 'D2', 4, 12),
('E004', 'Leg Extensions', 'D2', 4, 12),
('E005', 'Hamstring Curls', 'D2', 4, 12),
('E006', 'Crunches', 'D2', 2, 25),
('E007', 'Jump Rope', 'D3', 1, NULL),
('E008', 'Machine Squat', 'D3', 4, 12),
('E009', 'Machine Upward Row', 'D3', 4, 12),
('E010', 'Shoulder Press', 'D3', 4, 12),
('E011', 'Calf Raises', 'D3', 4, 12),
('E012', 'Plank', 'D3', 2, NULL),
('E013', 'Stair Master', 'D1', 1, NULL),
('E014', 'Bicep Barbell Curls', 'D1', 4, 12),
('E015', 'Tricep Rope Extensions', 'D1', 4, 12),
('E016', 'Lateral Shoulder Raises', 'D1', 4, 12),
('E017', 'Lunges', 'D1', 3, 12),
('E018', 'Machine Crunches', 'D1', 3, 12),
('E019', 'Ball Squats', 'D1', 3, 12),
('E020', 'Tripod Rows', 'D2', 4, 12),
('E021', 'Curl To Press', 'D3', 4, 12),
('E022', 'Pec Fly To Tris', 'D1', 4, 12),
('E023', 'Lying March', 'D2', 3, 12),
('E024', 'Sit Backs', 'D1', 3, 12),
('E025', 'Chair Squats', 'D1', 3, 12),
('E026', 'Butterfly Breath', 'D1', 3, 12),
('E027', 'Plie Squats', 'D1', 3, 12),
('E028', 'Wall Push Ups', 'D1', 3, 12),
('E029', 'Reverse Flies', 'D1', 3, 12),
('E030', 'Straight Arm Plank', 'D1', 3, 12),
('E031', 'Side-Lying Push Ups', 'D1', 3, 12),
('E032', 'Bridge', 'D1', 3, 12),
('E033', 'Cat And Cow', 'D1', 3, 12),
('E034', 'Close-Grip Bench Press', 'D2', 2, 10),
('E035', 'Dips', 'D2', 2, 10),
('E036', 'Lying Tricep Extensions', 'D2', 2, 10),
('E037', 'Reverse Grip Tricep Pushdown', 'D2', 2, 10),
('E038', 'Barbell Squat', 'D2', 3, 10),
('E039', 'Leg Press', 'D2', 2, 10),
('E040', 'Lying Leg Curls', 'D2', 2, 10),
('E041', 'Sledgehammer Tire Strike', 'D3', 2, 25),
('E042', 'Landmine Squat And Push', 'D3', 3, 12),
('E043', 'Landmine One-Arm Row', 'D3', 2, 15),
('E044', 'Kettlebell Swing', 'D3', 2, 10),
('E045', 'Exploding Pushup', 'D3', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `workoutID` int(4) NOT NULL,
  `userID` char(4) NOT NULL,
  `workoutName` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout`
--

INSERT INTO `workout` (`workoutID`, `userID`, `workoutName`) VALUES
(6, 'U001', 'Default User :: Intermediate :: Sunday, 2016-12-11, 11:58:10pm'),
(7, 'U001', 'Default User :: Beginner :: Monday, 2016-12-12, 12:13:30am'),
(8, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 12:14:18am'),
(9, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 12:16:38am'),
(10, 'U001', 'Default User :: Beginner :: Monday, 2016-12-12, 12:17:45am'),
(11, 'U001', 'Default User :: Beginner :: Monday, 2016-12-12, 12:18:23am'),
(12, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:04:42am'),
(13, 'U001', 'Default User :: Beginner :: Monday, 2016-12-12, 07:07:16am'),
(14, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:07:44am'),
(15, 'U001', 'Default User :: Advanced :: Monday, 2016-12-12, 07:12:45am'),
(16, 'U001', 'Default User :: Beginner :: Monday, 2016-12-12, 07:22:23am'),
(17, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:26:09am'),
(18, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:27:04am'),
(19, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:29:45am'),
(20, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:32:57am'),
(21, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:34:41am'),
(22, 'U001', 'Default User :: Intermediate :: Monday, 2016-12-12, 07:35:53am'),
(23, 'U001', 'Default User :: Beginner :: Monday, 2016-12-12, 07:36:41am'),
(24, 'U001', 'Default User :: Intermediate :: Tuesday, 2016-12-13, 08:09:26am');

-- --------------------------------------------------------

--
-- Table structure for table `workout_exercise`
--

CREATE TABLE `workout_exercise` (
  `workoutID` int(4) NOT NULL,
  `exerciseID` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_exercise`
--

INSERT INTO `workout_exercise` (`workoutID`, `exerciseID`) VALUES
(17, 'E001'),
(17, 'E002'),
(17, 'E003'),
(17, 'E004'),
(17, 'E005'),
(17, 'E006'),
(18, 'E001'),
(18, 'E002'),
(18, 'E003'),
(18, 'E004'),
(18, 'E005'),
(18, 'E006'),
(19, 'E001'),
(19, 'E002'),
(19, 'E003'),
(19, 'E004'),
(19, 'E005'),
(19, 'E006'),
(20, 'E001'),
(20, 'E002'),
(20, 'E003'),
(20, 'E004'),
(20, 'E005'),
(20, 'E006'),
(21, 'E001'),
(21, 'E002'),
(21, 'E003'),
(21, 'E004'),
(21, 'E005'),
(21, 'E006'),
(22, 'E001'),
(22, 'E002'),
(22, 'E003'),
(22, 'E004'),
(22, 'E005'),
(22, 'E006'),
(23, 'E013'),
(23, 'E014'),
(23, 'E015'),
(23, 'E016'),
(23, 'E017'),
(23, 'E018'),
(24, 'E001'),
(24, 'E002'),
(24, 'E003'),
(24, 'E004'),
(24, 'E005'),
(24, 'E037');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`difficultyID`);

--
-- Indexes for table `end_user`
--
ALTER TABLE `end_user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`exerciseID`),
  ADD KEY `difficultyID` (`difficultyID`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`workoutID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `workout_exercise`
--
ALTER TABLE `workout_exercise`
  ADD PRIMARY KEY (`workoutID`,`exerciseID`),
  ADD KEY `exerciseID` (`exerciseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `workoutID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
