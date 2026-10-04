-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2018 at 02:49 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pncifs`
--
-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `AnswersId` int(11) NOT NULL AUTO_INCREMENT,
  `AnswerText` varchar(800) DEFAULT NULL,
  `Isreturn` tinyint(1) DEFAULT NULL,
  `Question_Id` int(11) NOT NULL,
  `Users_Id` int(11) NOT NULL,
  PRIMARY KEY (`AnswersId`),
  KEY `fk_Answers_Question1_idx` (`Question_Id`),
  KEY `fk_Answers_Users1_idx` (`Users_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`AnswersId`, `AnswerText`, `Isreturn`, `Question_Id`, `Users_Id`) VALUES
(1, 'For this week, I have learn about laravel which is the new language for me.', 1, 1, 3),
(2, 'The difficulties for me are: the environment  of the work place is new for me so i have to well-prepared to work with new people.', 1, 2, 3),
(3, 'I try to communicate with all my team work and ask some advice from my supervisor', 1, 3, 3),
(4, 'My plan for next week is I am going to create one website using Laravel with is the new lauguage that i have just learn for last week', 1, 4, 3),
(5, 'I don''t have any comment or sugeestion', 1, 5, 3),
(6, 'I''m fine.', NULL, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `InternshipStartDate` date NOT NULL,
  `InternshipEndDate` date NOT NULL,
  `FinalReportTemplateFileName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FinalPresTemplateFileName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FinalPres_UploadDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FinalReport_UploadDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Year` (`Year`,`Code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`Id`, `Year`, `InternshipStartDate`, `InternshipEndDate`, `FinalReportTemplateFileName`, `FinalPresTemplateFileName`, `FinalPres_UploadDate`, `FinalReport_UploadDate`, `Code`) VALUES
(1, '2017', '2017-06-05', '2017-11-30', 'How to Use Wing.jpg', 'Brilliant Advertising(Cambodia)co.,ltd650248755.pdf', '2018-01-17 16:55:29', '2018-01-17 16:55:29', '9bbf5cfa'),
(2, '2018', '2018-05-06', '2018-11-30', 'Chart of Account.xlsx', NULL, '2018-01-17 16:45:07', '2018-01-17 16:45:07', '83b174ed');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `QuestionId` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionTitle` varchar(500) DEFAULT NULL,
  `Order` int(11) DEFAULT NULL,
  `Ismandatory` tinyint(1) NOT NULL,
  `SurveyId` int(11) NOT NULL,
  PRIMARY KEY (`QuestionId`),
  KEY `fk_Questiion_Survey1_idx` (`SurveyId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QuestionId`, `QuestionTitle`, `Order`, `Ismandatory`, `SurveyId`) VALUES
(1, 'What did you learn for this week?', 1, 0, 1),
(2, 'What are your difficulties or issue you meet during this week?', 2, 0, 1),
(3, 'What is your solution to solve your problem or issue?', 3, 0, 1),
(4, 'What are your plan to do for next week?', 4, 0, 1),
(5, 'Do you have any comment or suggestion to ERO or your company?', 5, 0, 1),
(6, 'How many task you got for this month?', 1, 1, 2),
(7, 'Can you list down all those task?', 2, 0, 2),
(8, 'Are you complete those task before deadline or over deadline?', 3, 0, 2),
(9, 'If over deadline, what did you do to solve this problem?', 4, 0, 2),
(10, 'Does your supervisor complaint you when you don''t complete the task on time?', 5, 0, 2),
(11, 'Does your company give you a computer to work?', 1, 0, 3),
(12, 'If doesn''t, Have you ever ask to your supervisor about this?', 2, 0, 3),
(13, 'If you have, does it run smooth or work properly?', 3, 0, 3),
(14, 'Do you have any complain about your work related to computer?', 4, 0, 3),
(15, 'What do you feel when you first arrive in company in first day?', 1, 0, 4),
(16, 'Do you feel comfortable with the environment of your company?', 2, 0, 4),
(17, 'Do you know new people or staff in there?', 3, 0, 4),
(18, 'Do feel free to communicate with people in your office', 4, 0, 4),
(19, 'a', 1, 0, 5),
(20, 'b', 2, 0, 5),
(21, 'adsf', 1, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `reminId` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `sendDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stuId` int(11) NOT NULL,
  `message` text NOT NULL,
  `isReminder` tinyint(1) NOT NULL DEFAULT '0',
  `isRemove` tinyint(1) NOT NULL DEFAULT '0',
  `sender` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`reminId`),
  KEY `stuId` (`stuId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminId`, `subject`, `sendDate`, `stuId`, `message`, `isReminder`, `isRemove`, `sender`) VALUES
(1, '', '2018-01-17 17:56:18', 3, '', 1, 0, 'Benoit  Pitet'),
(2, '', '2018-01-17 17:56:18', 4, '', 1, 0, 'Benoit  Pitet'),
(3, '', '2018-01-17 17:56:18', 5, '', 1, 0, 'Benoit  Pitet'),
(4, '', '2018-01-17 17:56:18', 6, '', 1, 0, 'Benoit  Pitet'),
(5, '', '2018-01-17 17:56:18', 7, '', 1, 0, 'Benoit  Pitet');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `ReportsId` int(11) NOT NULL AUTO_INCREMENT,
  `ReportsText` varchar(800) DEFAULT NULL,
  `IsReport` tinyint(1) NOT NULL,
  `Answers_Id` int(11) NOT NULL,
  PRIMARY KEY (`ReportsId`),
  KEY `fk_Reports_Answers1_idx` (`Answers_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`ReportsId`, `ReportsText`, `IsReport`, `Answers_Id`) VALUES
(1, 'You are working hard student.', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `UsersId` int(11) NOT NULL,
  `EmailPersonal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Major` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IsSend` tinyint(11) NOT NULL DEFAULT '0',
  `BatchId` int(11) NOT NULL,
  `SupervisorId` int(11) DEFAULT NULL,
  `TutorsId` int(11) DEFAULT NULL,
  PRIMARY KEY (`UsersId`),
  KEY `BatchId` (`BatchId`),
  KEY `TutorsId` (`TutorsId`),
  KEY `SupervisorId` (`SupervisorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`UsersId`, `EmailPersonal`, `Major`, `IsSend`, `BatchId`, `SupervisorId`, `TutorsId`) VALUES
(3, 'seavmeng.chham97@gmail.com', 'WEP', 1, 1, NULL, 2),
(4, 'heng.loem@gmail.com', 'WEP', 1, 1, NULL, 2),
(5, 'makara.ngom@gmail.com', 'WEP', 1, 1, NULL, 2),
(6, 'sreyleang.seak@gmail.com', 'WEP', 1, 2, NULL, NULL),
(7, 'vin.touch@gmail.com', 'WEP', 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `UsersId` int(11) NOT NULL,
  `Companyname` varchar(45) NOT NULL,
  `Position` varchar(45) DEFAULT NULL,
  `Departmentname` varchar(100) DEFAULT NULL,
  `Emailpersonal` varchar(100) DEFAULT NULL,
  `PhoneNumber` char(20) DEFAULT NULL,
  PRIMARY KEY (`UsersId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
  `Survey_Id` int(11) NOT NULL AUTO_INCREMENT,
  `SurveyTitle` varchar(100) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Deadline` timestamp NULL DEFAULT NULL,
  `IsPublish` tinyint(1) NOT NULL,
  `IsAnswer` tinyint(1) NOT NULL,
  `IsSave` tinyint(1) NOT NULL,
  `IsCheck` tinyint(1) NOT NULL,
  `BatchId` int(11) NOT NULL,
  `SurveyTypesId` int(11) NOT NULL,
  PRIMARY KEY (`Survey_Id`),
  KEY `fk_Survey_Batch1_idx` (`BatchId`),
  KEY `fk_Survey_SurveyTypes1_idx` (`SurveyTypesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`Survey_Id`, `SurveyTitle`, `Description`, `Deadline`, `IsPublish`, `IsAnswer`, `IsSave`, `IsCheck`, `BatchId`, `SurveyTypesId`) VALUES
(1, 'Internship weekly Work log', 'ERO want to know what are daily task of all you that you work everyday in your company. You have to answer to this survey which make us easy to know more about your work.', '2017-06-04 17:00:00', 1, 1, 1, 0, 1, 2),
(2, 'total monthly task', 'The objective of this survey is to know what are task for you for this month.', '2017-06-04 17:00:00', 1, 1, 0, 0, 1, 2),
(3, 'Computer for work survey', 'We would like to do whether you have your own computer to work at the company or not?', '2017-06-04 17:00:00', 1, 0, 0, 0, 2, 2),
(4, 'First week of internship survey', 'we would like to know your feeling of your first week  of internship?', '2017-05-31 17:00:00', 1, 0, 0, 0, 2, 2),
(5, 'Test', 'Test', '0000-00-00 00:00:00', 0, 0, 0, 0, 1, 2),
(6, 'asdf', 'adsf', '2018-01-10 17:00:00', 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `surveytypes`
--

CREATE TABLE IF NOT EXISTS `surveytypes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `surveytypes`
--

INSERT INTO `surveytypes` (`Id`, `Name`) VALUES
(1, 'Tutor Follow-up'),
(2, 'Weekly Follow-up');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE IF NOT EXISTS `tutors` (
  `UsersId` int(11) NOT NULL,
  `Specialization` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`UsersId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`UsersId`, `Specialization`) VALUES
(1, 'WEP'),
(2, 'ENGLISH'),
(8, 'ENGLISH'),
(9, 'WEP'),
(10, 'WEP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `EmailPN` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LastConnection` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `IsAdministrator` tinyint(1) NOT NULL,
  `SkypeID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IsSuspended` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `EmailPN` (`EmailPN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `EmailPN`, `LastConnection`, `Password`, `FirstName`, `LastName`, `IsAdministrator`, `SkypeID`, `IsSuspended`) VALUES
(1, 'benoit.pitet@passerellesnumeriques.org', '2018-01-18 07:47:20', '$2y$10$jlipu24y7sA79rx3tyc/1ehNlcQl10G.tjlFC0aJlUJchTpPfck6q', 'Benoit', 'Pitet', 1, 'beniot.pitet', 0),
(2, 'sopheak.huy@passerellesnumeriques.org', '2018-01-17 08:09:04', '$2y$10$XbPqdUHzEV0R.hYeJw9AE.zFPOt8oZS7xVBCmGcAkUqIv6SrDWHDu', 'Sopheak', 'Huy', 0, 'sopheak.huy', 0),
(3, 'seavmeang.chham@student.passerellesnumeriques.org', '2017-05-31 03:16:57', '$2y$10$ISvyb6uwFWxyz//dh/bcl.E71sbB3qWyuIeJZh2dm2e3oBIqTG5Cy', 'Seavmeng', 'Chham', 0, 'seavmeng', 0),
(4, 'heng.loem@student.passerellesnumeriques.org', '2018-01-17 08:07:39', '$2y$10$SXXSf/odTf2ROJu0UqUaruuCPUJ30.pNU6dUsRR3aCpzZGOdGxQPW', 'heng', 'loem', 0, 'heng loem', 0),
(5, 'makara.ngom@student.passerellesnumeriques.org', '2017-05-31 01:46:15', '$2y$10$oxVGh6HRZn.nFI4LiZdkLONlfaWm4Fl5BeF3CV6hSioiOJHo5TJKu', 'makara', 'ngom', 0, 'makara ngom', 0),
(6, 'sreyleang.seak@students.passerellesnumeriques.org', '2017-05-31 01:49:10', '$2y$10$3.XCQPuy5cz07KvqgAKQvOtiJNBTY/4T2CR5/pzorXuODOAQMRwRm', 'sreyleang', 'seak', 0, 'sreyleangseak', 0),
(7, 'vin.touch@student.passerellesnumeriques.org', '2017-05-31 01:51:22', '$2y$10$15Lff/qDPdRIeh2nFS6bBem8qYX4v9UOYDanyd8ymAbzCRAzkZEfK', 'vin', 'touch', 0, 'vin touch', 0),
(8, 'sokkhom.hean@passerellesnumeriques.org', '2017-05-31 08:57:16', '$2y$10$1j5fI1aV.jzIG3dRk5gqpeH4DeXYiVhNLmpwNFEMaU2DeNPOefwA2', 'sokkhom', 'heang', 0, 'sokkhom hean', 0),
(9, 'darith.pen@passerellesnumeriques.org', '2017-05-31 08:58:23', '$2y$10$YTEIM2PC6Cv/MwYQkb7kDe6sd0ArQvXP8ZaGGcIPCJkLHrRHVUCq6', ' Darith', 'pen', 0, 'darith pen', 0),
(10, 'rady.y@student.passerellesnumeriques.org', '2017-05-31 08:59:23', '$2y$10$e0prltPqilsSrSjw.Oxa.edkK7COabDmHGFI.c7X0TYEDkpbW3wWG', ' rady', 'y', 0, 'rady y', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_Questiion_Survey1` FOREIGN KEY (`SurveyId`) REFERENCES `survey` (`Survey_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `reminder_ibfk_1` FOREIGN KEY (`stuId`) REFERENCES `students` (`UsersId`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_Reports_Answers1` FOREIGN KEY (`Answers_Id`) REFERENCES `answers` (`AnswersId`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`BatchId`) REFERENCES `batch` (`Id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`UsersId`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`TutorsId`) REFERENCES `tutors` (`UsersId`),
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`SupervisorId`) REFERENCES `supervisor` (`UsersId`);

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `fk_supervisor_users1` FOREIGN KEY (`UsersId`) REFERENCES `users` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `fk_Survey_Batch1` FOREIGN KEY (`BatchId`) REFERENCES `batch` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Survey_SurveyTypes1` FOREIGN KEY (`SurveyTypesId`) REFERENCES `surveytypes` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tutors`
--
ALTER TABLE `tutors`
  ADD CONSTRAINT `tutors_ibfk_1` FOREIGN KEY (`UsersId`) REFERENCES `users` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
