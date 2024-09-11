-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 08:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hpss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2020-06-11 12:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `s_gender` varchar(255) NOT NULL,
  `s_dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `mobile_number` bigint(10) NOT NULL,
  `s_nationality` varchar(100) NOT NULL,
  `s_class` varchar(100) NOT NULL,
  `s_photo` varchar(500) NOT NULL,
  `nationality_photo` varchar(500) NOT NULL,
  `tc_certificate` varchar(500) NOT NULL,
  `s_marksheet` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `s_name`, `f_name`, `m_name`, `s_gender`, `s_dob`, `address`, `e_mail`, `mobile_number`, `s_nationality`, `s_class`, `s_photo`, `nationality_photo`, `tc_certificate`, `s_marksheet`) VALUES
(1, 'Aspen Vasquez', 'Kylynn Gomez', 'Ariel Pope', 'Other', '2058-10-24', 'Mollit est hic ut do', 'fezure@mailinator.com', 9817316003, 'Nepal', '5', 'dashboard/admission/admission-data-upload/Untitled design.jpg', 'dashboard/admission/admission-data-upload/Nagrikta.jpg', 'dashboard/admission/admission-data-upload/Charecter.jpg', 'dashboard/admission/admission-data-upload/20240725_130228.jpg'),
(2, 'Aspen Vasquez', 'Kylynn Gomez', 'Ariel Pope', 'Other', '2058-10-24', 'Mollit est hic ut do', 'fezure@mailinator.com', 9817316003, 'Nepal', '5', 'dashboard/admission/admission-data-upload/Untitled design.jpg', 'dashboard/admission/admission-data-upload/Nagrikta.jpg', 'dashboard/admission/admission-data-upload/Charecter.jpg', 'dashboard/admission/admission-data-upload/20240725_130228.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examnotice`
--

CREATE TABLE `examnotice` (
  `id` int(11) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examnotice`
--

INSERT INTO `examnotice` (`id`, `main_title`, `title`, `file`) VALUES
(3, 'हाम्रा पुरवजहरुले सिकाएका कुराहरु बिर्सनु हुँदैन।', 'कुराहरु', 'exam-notice/- संगठन - अवधारणा, प्रकृति, प्रकार र संगठनात्मक विकास.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `published_date` date NOT NULL DEFAULT current_timestamp(),
  `title` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `password`) VALUES
(1, 'Sajjaad Ansari', 'sajjubhai212@gmail.com', '$2y$10$bgy/oVzxT0CQsRqC7LoCFOt9d95lhL1CMBFoagUASbJUxT342jm2G'),
(2, 'Sajjad Ansari', 'sajjubhai212@gmail.com', '$2y$10$3VP9sOPJo5.rkgqj0bJ0DuTmXmCAx/VXxya6wNuuFLevq6tKWk7Vu');

-- --------------------------------------------------------

--
-- Table structure for table `stnclasses`
--

CREATE TABLE `stnclasses` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(255) NOT NULL,
  `ClassNameNumeric` int(4) NOT NULL,
  `Section` varchar(4) NOT NULL,
  `CreationDate` date NOT NULL,
  `UpdationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stnclasses`
--

INSERT INTO `stnclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Nine', 9, 'A', '0000-00-00', '0000-00-00'),
(3, 'Nine', 9, 'B', '2024-09-05', '0000-00-00'),
(4, 'Nine', 9, 'C', '2024-09-06', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `stnresult`
--

CREATE TABLE `stnresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `FullMarks` int(11) NOT NULL,
  `PostingDate` date NOT NULL,
  `UpdationDate` date NOT NULL,
  `PassMarks` int(11) NOT NULL,
  `ObtainedMaeks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stnstudents`
--

CREATE TABLE `stnstudents` (
  `id` int(11) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `RollId` varchar(100) NOT NULL,
  `StudentEmail` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `RegDate` date NOT NULL,
  `UpdationDate` date NOT NULL,
  `Status` int(5) NOT NULL,
  `FatherName` varchar(255) NOT NULL,
  `ExamYear` int(11) NOT NULL,
  `ExaminationTerms` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stnstudents`
--

INSERT INTO `stnstudents` (`id`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`, `FatherName`, `ExamYear`, `ExaminationTerms`) VALUES
(3, 'Sajjad Ansari', '978', 'sajjubhai212@gmail.com', 'Male', '2058-10-24', 1, '2024-09-07', '0000-00-00', 0, 'Jalal Ansari', 2080, '1st Term'),
(4, 'Jaheed Ansari', '978', 'siquwucybe@mailinator.com', 'Male', '2059-10-13', 3, '2024-09-08', '0000-00-00', 1, 'Jamal Ansari', 2080, '1st Term'),
(5, 'Gufran Ansari', '979', 'gufran.gn@gmail.com', 'Male', '2059-10-20', 1, '2024-09-08', '0000-00-00', 1, 'Irfan Ansari', 2080, '1st Term');

-- --------------------------------------------------------

--
-- Table structure for table `stnsubjectcombination`
--

CREATE TABLE `stnsubjectcombination` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `status` int(5) NOT NULL,
  `CreationDate` date NOT NULL,
  `Updationdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stnsubjectcombination`
--

INSERT INTO `stnsubjectcombination` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(4, 1, 3, 1, '0000-00-00', '0000-00-00'),
(5, 1, 4, 1, '0000-00-00', '0000-00-00'),
(6, 1, 5, 1, '0000-00-00', '0000-00-00'),
(7, 1, 6, 1, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `stnsubjects`
--

CREATE TABLE `stnsubjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(255) NOT NULL,
  `SubjectCode` varchar(255) NOT NULL,
  `Creationdate` date NOT NULL,
  `UpdationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stnsubjects`
--

INSERT INTO `stnsubjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(3, 'Nepali', 'N-01', '2024-09-07', '0000-00-00'),
(4, 'English', 'E-02', '2024-09-08', '0000-00-00'),
(5, 'Math', 'M-03', '2024-09-08', '0000-00-00'),
(6, 'Social', 'S-04', '2024-09-08', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tblquery`
--

CREATE TABLE `tblquery` (
  `id` int(11) NOT NULL,
  `teacherId` int(11) DEFAULT NULL,
  `fName` varchar(200) DEFAULT NULL,
  `emailId` varchar(200) DEFAULT NULL,
  `mobileNumber` bigint(10) DEFAULT NULL,
  `Query` mediumtext DEFAULT NULL,
  `queryDate` timestamp NULL DEFAULT current_timestamp(),
  `teacherNote` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblquery`
--

INSERT INTO `tblquery` (`id`, `teacherId`, `fName`, `emailId`, `mobileNumber`, `Query`, `queryDate`, `teacherNote`) VALUES
(2, 1, 'Amit Kumar', 'amitk43@gmail.com', 1122336655, 'This is for testing purpose. Test Query', '2022-03-12 10:03:49', 'This is for testing. Test notes');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `RollId` varchar(100) NOT NULL,
  `StudentEmail` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `ID` int(10) NOT NULL,
  `Subject` varchar(120) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`ID`, `Subject`, `CreationDate`) VALUES
(1, 'Mathmetics', '2019-10-07 06:11:06'),
(2, 'Physics', '2019-10-07 06:11:19'),
(3, 'Chemistry', '2019-10-07 06:11:32'),
(4, 'Biology', '2019-10-07 06:11:41'),
(5, 'Hindi', '2019-10-07 06:11:49'),
(6, 'English', '2019-10-07 06:11:56'),
(7, 'Science', '2019-10-07 06:12:06'),
(8, 'Social Science', '2019-10-07 06:12:19'),
(9, 'Accounts', '2019-10-07 06:12:32'),
(10, 'Arts', '2019-10-07 06:12:44'),
(13, 'Operating System (OS)', '2019-10-13 19:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `ID` int(10) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Picture` varchar(200) NOT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Qualifications` varchar(120) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `TeacherSub` varchar(120) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `teachingExp` varchar(10) DEFAULT NULL,
  `JoiningDate` varchar(120) DEFAULT NULL,
  `RegDate` date NOT NULL DEFAULT current_timestamp(),
  `isPublic` int(1) DEFAULT NULL,
  `nationality` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`ID`, `Name`, `Picture`, `Email`, `MobileNumber`, `password`, `Qualifications`, `Address`, `TeacherSub`, `description`, `teachingExp`, `JoiningDate`, `RegDate`, `isPublic`, `nationality`) VALUES
(3, 'Sajjad Ansari', 'fefacd820a895bb9613b5a3837fdfec31725465332.jpg', 'sajjubhai212@gmail.com', 9817316003, NULL, 'SEE, Diploma in Computer Engineering', 'Harinagara-6, sunsari', 'Operating System (OS)', 'The teacher is a way of lights Because going better students future life...', '2', '2058-10-25', '2024-09-04', 1, ''),
(4, 'Faisal Alam', '516dbc5596bf462e3ebddf2acdff2ce31725469106.jpg', 'siquwucybe@mailinator.com', 9810101010, NULL, 'SEE, +2 Science', 'Harinagara-06, Sunsari', 'Science', 'Honest Teacher', '3', '2060-05-15', '2024-09-04', 1, 'Nepal'),
(5, 'Prawej Alam', 'b36902a57babf110205fba2eaae926f31725471386.jpg', 'zihe@mailinator.com', 9800000000, NULL, 'SEE, HA', 'Ipsa nisi exercitat', 'Biology', 'Laudantium doloribu', '3', '2056-10-03', '2024-09-04', 1, 'Nepal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examnotice`
--
ALTER TABLE `examnotice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stnclasses`
--
ALTER TABLE `stnclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stnresult`
--
ALTER TABLE `stnresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stnstudents`
--
ALTER TABLE `stnstudents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stnsubjectcombination`
--
ALTER TABLE `stnsubjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stnsubjects`
--
ALTER TABLE `stnsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblquery`
--
ALTER TABLE `tblquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `examnotice`
--
ALTER TABLE `examnotice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stnclasses`
--
ALTER TABLE `stnclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stnresult`
--
ALTER TABLE `stnresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stnstudents`
--
ALTER TABLE `stnstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stnsubjectcombination`
--
ALTER TABLE `stnsubjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stnsubjects`
--
ALTER TABLE `stnsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblquery`
--
ALTER TABLE `tblquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblteacher`
--
ALTER TABLE `tblteacher`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
