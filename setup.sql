-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 08:47 PM
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
-- Database: `housing_waitlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
                            `id` int(11) NOT NULL,
                            `campus_id` int(11) NOT NULL,
                            `building_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                            `available` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                            `available_llc` enum('N','Y') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`id`, `campus_id`, `building_name`, `available`, `available_llc`) VALUES
                                                                                              (1, 1, 'Carter Hall', 'Y', 'Y'),
                                                                                              (2, 1, 'Guesman Hall', 'Y', 'Y'),
                                                                                              (3, 1, 'Johnson Hall', 'Y', 'Y'),
                                                                                              (4, 1, 'Residence Hall E', 'Y', 'Y'),
                                                                                              (5, 1, 'Smith Hall', 'Y', 'Y'),
                                                                                              (6, 2, 'Brooke Trout (Reinhard Villages)', 'Y', 'Y'),
                                                                                              (7, 2, 'Campus View Suites', 'Y', 'Y'),
                                                                                              (8, 2, 'Firefly (Reinhard Villages)', 'Y', 'Y'),
                                                                                              (9, 2, 'Grouse Field (Reinhard Villages)', 'Y', 'Y'),
                                                                                              (10, 2, 'Hemlock Knoll (Reinhard Villages)', 'Y', 'Y'),
                                                                                              (11, 2, 'Laurel Glen (Reinhard Villages)', 'Y', 'Y'),
                                                                                              (12, 2, 'Suites on Main North', 'N', 'Y'),
                                                                                              (13, 2, 'Suites on Main South', 'Y', 'Y'),
                                                                                              (14, 2, 'Valley View Suites', 'Y', 'Y'),
                                                                                              (15, 2, 'Whitetail (Reinhard Villages)', 'Y', 'Y'),
                                                                                              (16, 3, 'Highlands 1', 'Y', 'Y'),
                                                                                              (17, 3, 'Highlands 2', 'Y', 'Y'),
                                                                                              (18, 3, 'Highlands 3', 'Y', 'Y'),
                                                                                              (19, 3, 'Highlands 4', 'Y', 'Y'),
                                                                                              (20, 3, 'Highlands 5', 'Y', 'Y'),
                                                                                              (21, 3, 'Highlands 6', 'Y', 'Y'),
                                                                                              (22, 3, 'Highlands 7', 'Y', 'Y'),
                                                                                              (23, 3, 'Highlands 8', 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `buildings_llcs`
--

CREATE TABLE `buildings_llcs` (
                                  `building_id` int(11) NOT NULL,
                                  `llc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buildings_llcs`
--

INSERT INTO `buildings_llcs` (`building_id`, `llc_id`) VALUES
                                                           (1, 1),
                                                           (1, 2),
                                                           (4, 3),
                                                           (5, 4),
                                                           (5, 5),
                                                           (7, 6),
                                                           (12, 1),
                                                           (12, 2),
                                                           (12, 3),
                                                           (12, 4),
                                                           (13, 1),
                                                           (13, 2),
                                                           (13, 3),
                                                           (13, 4),
                                                           (13, 10),
                                                           (18, 4),
                                                           (19, 7),
                                                           (20, 8),
                                                           (20, 9),
                                                           (22, 1),
                                                           (22, 2),
                                                           (22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `buildings_room_types`
--

CREATE TABLE `buildings_room_types` (
                                        `building_id` int(11) NOT NULL,
                                        `room_type_id` int(11) NOT NULL,
                                        `available` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buildings_room_types`
--

INSERT INTO `buildings_room_types` (`building_id`, `room_type_id`, `available`) VALUES
                                                                                    (1, 1, 'Y'),
                                                                                    (1, 2, 'Y'),
                                                                                    (1, 3, 'Y'),
                                                                                    (1, 4, 'Y'),
                                                                                    (2, 1, 'Y'),
                                                                                    (2, 2, 'Y'),
                                                                                    (2, 4, 'Y'),
                                                                                    (2, 5, 'Y'),
                                                                                    (2, 6, 'Y'),
                                                                                    (3, 1, 'Y'),
                                                                                    (3, 2, 'Y'),
                                                                                    (3, 3, 'Y'),
                                                                                    (3, 4, 'Y'),
                                                                                    (3, 6, 'Y'),
                                                                                    (4, 1, 'Y'),
                                                                                    (4, 2, 'Y'),
                                                                                    (4, 3, 'Y'),
                                                                                    (4, 4, 'Y'),
                                                                                    (4, 6, 'Y'),
                                                                                    (5, 1, 'Y'),
                                                                                    (5, 3, 'Y'),
                                                                                    (5, 4, 'Y'),
                                                                                    (5, 6, 'Y'),
                                                                                    (6, 7, 'Y'),
                                                                                    (6, 8, 'Y'),
                                                                                    (6, 9, 'Y'),
                                                                                    (6, 10, 'Y'),
                                                                                    (7, 6, 'Y'),
                                                                                    (7, 11, 'Y'),
                                                                                    (7, 12, 'Y'),
                                                                                    (8, 7, 'Y'),
                                                                                    (8, 8, 'Y'),
                                                                                    (8, 9, 'Y'),
                                                                                    (8, 10, 'Y'),
                                                                                    (8, 13, 'Y'),
                                                                                    (9, 8, 'Y'),
                                                                                    (9, 9, 'Y'),
                                                                                    (9, 10, 'Y'),
                                                                                    (10, 7, 'Y'),
                                                                                    (10, 8, 'Y'),
                                                                                    (10, 9, 'Y'),
                                                                                    (10, 10, 'Y'),
                                                                                    (11, 7, 'Y'),
                                                                                    (11, 8, 'Y'),
                                                                                    (11, 9, 'Y'),
                                                                                    (11, 10, 'Y'),
                                                                                    (11, 13, 'Y'),
                                                                                    (12, 1, 'Y'),
                                                                                    (12, 2, 'Y'),
                                                                                    (12, 5, 'Y'),
                                                                                    (13, 1, 'Y'),
                                                                                    (13, 2, 'Y'),
                                                                                    (13, 5, 'Y'),
                                                                                    (14, 11, 'Y'),
                                                                                    (14, 12, 'Y'),
                                                                                    (15, 8, 'Y'),
                                                                                    (15, 9, 'Y'),
                                                                                    (15, 10, 'Y'),
                                                                                    (15, 13, 'Y'),
                                                                                    (16, 4, 'Y'),
                                                                                    (16, 12, 'Y'),
                                                                                    (16, 14, 'Y'),
                                                                                    (17, 14, 'Y'),
                                                                                    (17, 15, 'Y'),
                                                                                    (17, 16, 'Y'),
                                                                                    (18, 4, 'Y'),
                                                                                    (18, 12, 'Y'),
                                                                                    (18, 14, 'Y'),
                                                                                    (19, 14, 'Y'),
                                                                                    (19, 15, 'Y'),
                                                                                    (19, 16, 'Y'),
                                                                                    (20, 4, 'Y'),
                                                                                    (20, 12, 'Y'),
                                                                                    (20, 14, 'Y'),
                                                                                    (21, 14, 'Y'),
                                                                                    (21, 15, 'Y'),
                                                                                    (21, 16, 'Y'),
                                                                                    (22, 4, 'Y'),
                                                                                    (22, 6, 'Y'),
                                                                                    (22, 14, 'Y'),
                                                                                    (23, 14, 'Y'),
                                                                                    (23, 16, 'Y'),
                                                                                    (23, 17, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `buildings_room_types_llcs`
--

CREATE TABLE `buildings_room_types_llcs` (
                                             `building_id` int(11) NOT NULL,
                                             `room_type_id` int(11) NOT NULL,
                                             `llc_id` int(11) NOT NULL,
                                             `available` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings_room_types_llcs`
--

INSERT INTO `buildings_room_types_llcs` (`building_id`, `room_type_id`, `llc_id`, `available`) VALUES
                                                                                                   (1, 1, 1, 'Y'),
                                                                                                   (1, 1, 2, 'Y'),
                                                                                                   (1, 2, 1, 'Y'),
                                                                                                   (1, 2, 2, 'Y'),
                                                                                                   (4, 1, 3, 'Y'),
                                                                                                   (4, 3, 3, 'Y'),
                                                                                                   (4, 4, 3, 'Y'),
                                                                                                   (4, 6, 3, 'Y'),
                                                                                                   (5, 1, 4, 'Y'),
                                                                                                   (5, 1, 5, 'Y'),
                                                                                                   (5, 3, 4, 'Y'),
                                                                                                   (5, 3, 5, 'Y'),
                                                                                                   (5, 4, 4, 'Y'),
                                                                                                   (5, 4, 5, 'Y'),
                                                                                                   (5, 6, 5, 'Y'),
                                                                                                   (7, 6, 6, 'Y'),
                                                                                                   (7, 11, 6, 'Y'),
                                                                                                   (7, 12, 6, 'Y'),
                                                                                                   (13, 1, 1, 'Y'),
                                                                                                   (13, 1, 2, 'Y'),
                                                                                                   (13, 1, 3, 'Y'),
                                                                                                   (13, 1, 4, 'Y'),
                                                                                                   (13, 1, 10, 'Y'),
                                                                                                   (13, 2, 2, 'Y'),
                                                                                                   (13, 2, 3, 'Y'),
                                                                                                   (13, 5, 1, 'Y'),
                                                                                                   (13, 5, 2, 'Y'),
                                                                                                   (13, 5, 3, 'Y'),
                                                                                                   (13, 5, 4, 'Y'),
                                                                                                   (13, 5, 10, 'Y'),
                                                                                                   (18, 4, 4, 'Y'),
                                                                                                   (18, 12, 4, 'Y'),
                                                                                                   (18, 14, 4, 'Y'),
                                                                                                   (19, 14, 7, 'Y'),
                                                                                                   (19, 15, 7, 'Y'),
                                                                                                   (19, 16, 7, 'Y'),
                                                                                                   (20, 4, 8, 'Y'),
                                                                                                   (20, 4, 9, 'Y'),
                                                                                                   (20, 12, 8, 'Y'),
                                                                                                   (20, 12, 9, 'Y'),
                                                                                                   (20, 14, 8, 'Y'),
                                                                                                   (20, 14, 9, 'Y'),
                                                                                                   (22, 4, 1, 'Y'),
                                                                                                   (22, 4, 2, 'Y'),
                                                                                                   (22, 4, 3, 'Y'),
                                                                                                   (22, 6, 1, 'Y'),
                                                                                                   (22, 6, 2, 'Y'),
                                                                                                   (22, 6, 3, 'Y'),
                                                                                                   (22, 14, 1, 'Y'),
                                                                                                   (22, 14, 2, 'Y'),
                                                                                                   (22, 14, 3, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
                          `id` int(11) NOT NULL,
                          `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`id`, `name`) VALUES
                                        (1, 'California'),
                                        (2, 'Clarion'),
                                        (3, 'Edinboro');

-- --------------------------------------------------------

--
-- Table structure for table `llc`
--

CREATE TABLE `llc` (
                       `id` int(11) NOT NULL,
                       `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `llc`
--

INSERT INTO `llc` (`id`, `name`) VALUES
                                     (1, 'Cultural Awareness'),
                                     (2, 'Gender Identity and Allies'),
                                     (3, 'Quiet Living'),
                                     (4, 'Honors'),
                                     (5, 'Education'),
                                     (6, 'Health and Human Services'),
                                     (7, 'Art'),
                                     (8, 'Nursing'),
                                     (9, 'STEM'),
                                     (10, 'Leadership'),
                                     (11, 'Outdoors');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_llcs`
--

CREATE TABLE `rooms_llcs` (
                              `room_type_id` int(11) NOT NULL,
                              `llc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rooms_llcs`
--

INSERT INTO `rooms_llcs` (`room_type_id`, `llc_id`) VALUES
                                                        (1, 1),
                                                        (1, 2),
                                                        (1, 3),
                                                        (1, 4),
                                                        (1, 5),
                                                        (1, 10),
                                                        (2, 1),
                                                        (2, 2),
                                                        (2, 3),
                                                        (3, 3),
                                                        (3, 4),
                                                        (3, 5),
                                                        (4, 1),
                                                        (4, 2),
                                                        (4, 3),
                                                        (4, 4),
                                                        (4, 5),
                                                        (4, 8),
                                                        (4, 9),
                                                        (5, 1),
                                                        (5, 2),
                                                        (5, 3),
                                                        (5, 4),
                                                        (5, 10),
                                                        (6, 1),
                                                        (6, 2),
                                                        (6, 3),
                                                        (6, 5),
                                                        (6, 6),
                                                        (11, 6),
                                                        (12, 4),
                                                        (12, 6),
                                                        (12, 8),
                                                        (12, 9),
                                                        (14, 1),
                                                        (14, 2),
                                                        (14, 3),
                                                        (14, 4),
                                                        (14, 7),
                                                        (14, 8),
                                                        (14, 9),
                                                        (15, 7),
                                                        (16, 7);

-- --------------------------------------------------------

--
-- Table structure for table `room_change_request`
--

CREATE TABLE `room_change_request` (
                                       `id` int(11) NOT NULL,
                                       `email` varchar(50) NOT NULL,
                                       `first_name` varchar(50) NOT NULL,
                                       `preferred_name` varchar(25) DEFAULT NULL,
                                       `last_name` varchar(50) NOT NULL,
                                       `campus` varchar(50) NOT NULL,
                                       `building1` varchar(50) NOT NULL,
                                       `room_type1` varchar(50) NOT NULL,
                                       `llc1` varchar(50) DEFAULT NULL,
                                       `building2` varchar(50) DEFAULT NULL,
                                       `room_type2` varchar(50) DEFAULT NULL,
                                       `llc2` varchar(50) DEFAULT NULL,
                                       `building3` varchar(50) DEFAULT NULL,
                                       `room_type3` varchar(50) DEFAULT NULL,
                                       `llc3` varchar(50) DEFAULT NULL,
                                       `roommate1` varchar(50) DEFAULT NULL,
                                       `roommate2` varchar(50) DEFAULT NULL,
                                       `roommate3` varchar(50) DEFAULT NULL,
                                       `reason` varchar(200) NOT NULL,
                                       `email_datetime` datetime DEFAULT NULL,
                                       `completed` enum('N','Y') NOT NULL,
                                       `deleted` enum('N','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
                             `id` int(11) NOT NULL,
                             `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `type`) VALUES
                                           (1, '2 Person Semi-Suite (1 Bath)'),
                                           (2, 'Single Semi-Suite (1 Bath)'),
                                           (3, '2 Single Bedrooms Suite (1 Bath)'),
                                           (4, '4 Single Bedrooms Suite (2 Bath)'),
                                           (5, '2 Single Bedrooms Semi-Suite (1 Bath)'),
                                           (6, '2 Single Bedrooms Suite (2 Bath)'),
                                           (7, '4 Bedroom 2 Bath Loft'),
                                           (8, '4 Bedroom 2 Bath Flat'),
                                           (9, '4 Bedroom 4 Bathroom'),
                                           (10, 'Modified 4 Bedroom 2 Bath Flat (holds 2 students)'),
                                           (11, '2 Person Suite'),
                                           (12, '2 Double Bedrooms Suite (2 Bath)'),
                                           (13, '2 Bedroom 2 Bathroom'),
                                           (14, 'Studio Single'),
                                           (15, '4 Single Bedroom Semi-Suite (1 Bath)'),
                                           (16, '2 Double Bedrooms Semi-Suite (1 Bath)'),
                                           (17, 'Studio Double');

-- --------------------------------------------------------

--
-- Table structure for table `waitlist_request`
--

CREATE TABLE `waitlist_request` (
                                    `id` int(11) NOT NULL,
                                    `email` varchar(50) NOT NULL,
                                    `first_name` varchar(50) NOT NULL,
                                    `preferred_name` varchar(50) DEFAULT NULL,
                                    `last_name` varchar(50) NOT NULL,
                                    `campus` varchar(50) NOT NULL,
                                    `building1` varchar(50) NOT NULL,
                                    `room_type1` varchar(50) NOT NULL,
                                    `llc1` varchar(50) DEFAULT NULL,
                                    `building2` varchar(50) DEFAULT NULL,
                                    `room_type2` varchar(50) DEFAULT NULL,
                                    `llc2` varchar(50) DEFAULT NULL,
                                    `building3` varchar(50) DEFAULT NULL,
                                    `room_type3` varchar(50) DEFAULT NULL,
                                    `llc3` varchar(50) DEFAULT NULL,
                                    `roommate1` varchar(50) DEFAULT NULL,
                                    `roommate2` varchar(50) DEFAULT NULL,
                                    `roommate3` varchar(50) DEFAULT NULL,
                                    `email_datetime` datetime DEFAULT NULL,
                                    `completed` enum('N','Y') NOT NULL,
                                    `deleted` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `building_name` (`building_name`),
  ADD KEY `campus_id` (`campus_id`);

--
-- Indexes for table `buildings_llcs`
--
ALTER TABLE `buildings_llcs`
    ADD PRIMARY KEY (`building_id`,`llc_id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `llc_id` (`llc_id`);

--
-- Indexes for table `buildings_room_types`
--
ALTER TABLE `buildings_room_types`
    ADD PRIMARY KEY (`building_id`,`room_type_id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `buildings_room_types_llcs`
--
ALTER TABLE `buildings_room_types_llcs`
    ADD PRIMARY KEY (`building_id`,`room_type_id`,`llc_id`),
  ADD KEY `room_type_id` (`room_type_id`),
  ADD KEY `llc_id` (`llc_id`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `llc`
--
ALTER TABLE `llc`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms_llcs`
--
ALTER TABLE `rooms_llcs`
    ADD PRIMARY KEY (`room_type_id`,`llc_id`),
  ADD KEY `room_type_id` (`room_type_id`),
  ADD KEY `llc_id` (`llc_id`);

--
-- Indexes for table `room_change_request`
--
ALTER TABLE `room_change_request`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waitlist_request`
--
ALTER TABLE `waitlist_request`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `llc`
--
ALTER TABLE `llc`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room_change_request`
--
ALTER TABLE `room_change_request`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `waitlist_request`
--
ALTER TABLE `waitlist_request`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `building`
--
ALTER TABLE `building`
    ADD CONSTRAINT `building_ibfk_1` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`id`);

--
-- Constraints for table `buildings_llcs`
--
ALTER TABLE `buildings_llcs`
    ADD CONSTRAINT `buildings_llcs_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`id`),
  ADD CONSTRAINT `buildings_llcs_ibfk_2` FOREIGN KEY (`llc_id`) REFERENCES `llc` (`id`);

--
-- Constraints for table `buildings_room_types`
--
ALTER TABLE `buildings_room_types`
    ADD CONSTRAINT `buildings_room_types_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`id`),
  ADD CONSTRAINT `buildings_room_types_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`);

--
-- Constraints for table `buildings_room_types_llcs`
--
ALTER TABLE `buildings_room_types_llcs`
    ADD CONSTRAINT `buildings_room_types_llcs_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `building` (`id`),
  ADD CONSTRAINT `buildings_room_types_llcs_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`),
  ADD CONSTRAINT `buildings_room_types_llcs_ibfk_3` FOREIGN KEY (`llc_id`) REFERENCES `llc` (`id`);

--
-- Constraints for table `rooms_llcs`
--
ALTER TABLE `rooms_llcs`
    ADD CONSTRAINT `rooms_llcs_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`),
  ADD CONSTRAINT `rooms_llcs_ibfk_2` FOREIGN KEY (`llc_id`) REFERENCES `llc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
