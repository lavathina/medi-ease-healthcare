-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 04:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medi ease`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `team` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `vision` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `heading`, `content`, `team`, `mission`, `vision`) VALUES
(1, 'Welcome to Medi EASE', 'Medi EASE is a modern healthcare platform that simplifies health management through technology. We     focus on accessibility, affordability, and awareness for everyone.', 'Our dedicated team includes certified doctors, passionate developers, and healthcare advocates.', 'To provide streamlined, patient-first healthcare using intelligent tools and real-time services.', 'To become the most trusted virtual healthcare platform in the region.');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_logs`
--

CREATE TABLE `chatbot_logs` (
  `id` int(11) NOT NULL,
  `user_message` text NOT NULL,
  `bot_reply` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot_logs`
--

INSERT INTO `chatbot_logs` (`id`, `user_message`, `bot_reply`, `timestamp`) VALUES
(1, 'i have headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 10:57:42'),
(2, 'i have headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 11:08:26'),
(3, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 11:08:33'),
(4, 'Emergency help', 'If this is an emergency, please call your local emergency number immediately.', '2025-05-31 11:08:42'),
(5, 'Emergency help', 'If this is an emergency, please call your local emergency number immediately.', '2025-05-31 11:18:11'),
(6, 'What to do for cold?', 'Rest, drink warm fluids, and use a humidifier to relieve cold symptoms.', '2025-05-31 11:18:21'),
(7, 'WDWE', 'Sorry, you can only ask the following questions:<ul><li>i have a headache</li><li>what to do for fever?</li><li>how to book an appointment?</li><li>i feel dizzy</li><li>can i donate blood?</li><li>tell me about covid</li><li>flu symptoms</li><li>talk to doctor</li><li>what if allergy?</li><li>what to do for cold?</li><li>emergency help</li></ul>', '2025-05-31 11:18:31'),
(8, 'Flu symptoms', 'Flu symptoms include fever, cough, sore throat. Rest and hydrate well.', '2025-05-31 11:18:57'),
(9, 'Flu symptoms', 'Flu symptoms include fever, cough, sore throat. Rest and hydrate well.', '2025-05-31 11:42:22'),
(10, 'Flu symptoms', 'Flu symptoms include fever, cough, sore throat. Rest and hydrate well.', '2025-05-31 11:43:42'),
(11, 'Flu symptoms', 'Flu symptoms include fever, cough, sore throat. Rest and hydrate well.', '2025-05-31 11:45:20'),
(12, 'aaaaa', '🤖 Sorry, I can only answer specific health questions listed below. Please try again.', '2025-05-31 11:45:28'),
(13, 'aaaaa', '❗ Sorry, I can only answer specific health questions listed below.', '2025-05-31 11:47:29'),
(14, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 11:49:11'),
(15, 'I have COVID', 'For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.', '2025-05-31 11:49:22'),
(16, 'I have COVID', 'For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.', '2025-05-31 11:50:10'),
(17, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 11:50:15'),
(18, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 11:53:26'),
(19, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 11:53:33'),
(20, 'What to do for COVID?', 'For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.', '2025-05-31 11:53:39'),
(21, 'I have a sore throat', 'Drink warm fluids and avoid cold drinks. Gargle with salt water.', '2025-05-31 11:53:43'),
(22, 'What to do for fever?', 'Take fluids, rest, and monitor your temperature. See a doctor if it worsens.', '2025-05-31 11:54:25'),
(23, 'How to book an appointment?', 'You can book an appointment on the \'Appointment\' page of Medi EASE.', '2025-05-31 11:54:30'),
(24, 'Can I consult a doctor?', '🤖 Sorry, I can only respond to predefined health questions. Please try again.', '2025-05-31 11:54:37'),
(25, 'Can I consult a doctor?', '🤖 Sorry, I can only respond to predefined health questions. Please try again.', '2025-05-31 11:54:43'),
(26, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 11:57:34'),
(27, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 11:57:41'),
(28, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 11:57:44'),
(29, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:00:25'),
(30, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:00:50'),
(31, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:08:37'),
(32, 'Can I consult a doctor?', '🤖 Sorry, I can only respond to predefined health questions. Please try again.', '2025-05-31 12:15:06'),
(33, 'Can I consult a doctor?', '🤖 Sorry, I can only respond to predefined health questions. Please try again.', '2025-05-31 12:15:16'),
(34, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:16:23'),
(35, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:16:31'),
(36, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 12:21:01'),
(37, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:21:08'),
(38, 'AAA', '🤖 Sorry, I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 12:21:13'),
(39, 'AAA', '🤖 Sorry, I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 12:23:08'),
(40, 'AAA', '🤖 Sorry, I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 12:27:26'),
(41, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 12:27:33'),
(42, 'How do I reset my password?', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:27:37'),
(43, 'How do I reset my password?', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:29:35'),
(44, 'How do I reset my password?', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:31:39'),
(45, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 12:31:52'),
(46, 'How to consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:31:57'),
(47, 'COVID-19 symptoms', 'For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.', '2025-05-31 12:32:03'),
(48, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:32:09'),
(49, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:32:15'),
(50, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:32:20'),
(51, 'Reset my password', '🤖 Sorry, I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 12:34:28'),
(52, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 12:34:35'),
(53, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:34:42'),
(54, 'How to become organ donor?', 'Visit our Organ Donation page and fill out the form. Thank you for saving lives!', '2025-05-31 12:34:48'),
(55, 'How to book an appointment?', 'You can book an appointment on the \'Appointment\' page of Medi EASE.', '2025-05-31 12:34:52'),
(56, 'How to book an appointment?', 'You can book appointments through the \'Appointment\' page on Medi EASE.', '2025-05-31 12:36:38'),
(57, 'Can I consult a doctor?', 'Use the Live Chat or Appointment feature to talk to a doctor.', '2025-05-31 12:36:44'),
(58, 'Can I consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:37:17'),
(59, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:37:21'),
(60, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:38:09'),
(61, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:38:09'),
(62, 'What to do for flu?', 'Flu symptoms include fever, cough, sore throat. Rest and hydrate well.', '2025-05-31 12:40:19'),
(63, 'What to do for flu?', 'Flu symptoms include fever, cough, sore throat. Rest and hydrate well.', '2025-05-31 12:41:00'),
(64, 'What to do for flu?', 'Flu symptoms include fever, cough, sore throat. Rest and hydrate well.', '2025-05-31 12:45:00'),
(65, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 12:45:11'),
(66, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:45:15'),
(67, 'How to consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:45:19'),
(68, 'How to consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:45:59'),
(69, 'How to consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:47:28'),
(70, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 12:47:33'),
(71, 'How to consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-05-31 12:47:36'),
(72, 'Organ donation info', 'Visit our Organ Donation page and fill out the form. Thank you for saving lives!', '2025-05-31 12:47:39'),
(73, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:47:43'),
(74, 'What to do for fever?', 'Take fluids, rest, and monitor your temperature. See a doctor if it worsens.', '2025-05-31 12:47:45'),
(75, 'COVID-19 symptoms', 'For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.', '2025-05-31 12:47:47'),
(76, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:47:49'),
(77, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:49:08'),
(78, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-05-31 12:50:13'),
(79, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 12:59:10'),
(80, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 13:00:36'),
(81, 'de', '🤖 Sorry, I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 13:01:34'),
(82, 'mm', '🤖 Sorry, Only the provided questions can be asked.I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 13:05:41'),
(83, 'mm', '🤖 Sorry, Only the provided questions can be asked. \r\n               I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 13:06:18'),
(84, 'mm', '🤖 Sorry, I don\'t understand that yet. Please rephrase or contact support.', '2025-05-31 13:16:49'),
(85, 'mm', '🤖 Sorry, orry, only the provided questions can be asked here. Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-05-31 13:17:41'),
(86, 'mm', '🤖 Sorry,only the provided questions can be asked here. Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-05-31 13:18:14'),
(87, 'mm', '🤖 Sorry,only the provided questions can be asked here. \r\n                Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-05-31 13:18:42'),
(88, 'mm', '🤖 Sorry,only the provided questions can be asked here. \r\n                Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-05-31 13:18:59'),
(89, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-05-31 13:42:04'),
(90, 'm', '🤖 Sorry,only the provided questions can be asked here. \r\n                Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-05-31 13:42:21'),
(91, 's', '🤖 Sorry,only the provided questions can be asked here. \r\n                Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-05-31 13:42:59'),
(92, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-06-01 10:58:43'),
(93, 'Organ donation info', 'Visit our Organ Donation page and fill out the form. Thank you for saving lives!', '2025-06-01 10:58:47'),
(94, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-06-01 10:58:50'),
(95, 'What to do for fever?', 'Take fluids, rest, and monitor your temperature. See a doctor if it worsens.', '2025-06-01 10:59:01'),
(96, 'hi', '🤖 Sorry,only the provided questions can be asked here. \r\n                Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-06-01 10:59:08'),
(97, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-06-03 11:04:05'),
(98, 'Reset my password', 'To reset your password, go to the Login page and click \'Forgot Password\'. Follow the instructions sent to your registered email.', '2025-06-03 11:04:13'),
(99, 'How to consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-06-03 11:04:19'),
(100, 'hi', '🤖 Sorry,only the provided questions can be asked here. \r\n                Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-06-03 11:04:32'),
(101, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-06-03 12:31:17'),
(102, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-06-03 13:15:15'),
(103, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-06-03 13:17:55'),
(104, 'Emergency contact?', 'Call 123-456-7890 for emergency medical assistance anytime.', '2025-06-03 13:18:06'),
(105, 'Blood donation eligibility?', 'You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood.', '2025-06-03 13:18:13'),
(106, 'hi', '🤖 Sorry, only the provided questions can be asked here. Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-06-03 13:18:24'),
(107, 'How to book an appointment?', 'You can book an appointment on the \'Appointment\' page of Medi EASE.', '2025-06-03 13:18:35'),
(108, 'Organ donation info', 'Visit our Organ Donation page and fill out the form. Thank you for saving lives!', '2025-06-03 13:18:49'),
(109, 'Symptoms checker?', 'Use the Symptoms Checker feature to get possible conditions based on your symptoms.', '2025-06-03 13:22:00'),
(110, 'Blood donation eligibility?', 'You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood.', '2025-06-03 13:22:04'),
(111, 'Blood donation eligibility?', 'You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood.', '2025-06-03 13:30:04'),
(112, 'Blood donation eligibility?', 'You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood.', '2025-06-03 13:35:45'),
(113, 'How to register?', 'Click on the Signup button on the homepage and fill in your details to register.', '2025-06-04 12:25:56'),
(114, 'How to book an appointment?', 'You can book an appointment on the \'Appointment\' page of Medi EASE.', '2025-06-04 12:37:24'),
(115, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-06-04 13:12:29'),
(116, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-06-06 10:47:31'),
(117, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-07-09 10:44:20'),
(118, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-07-09 10:44:29'),
(119, 'What to do for fever?', 'Take fluids, rest, and monitor your temperature. See a doctor if it worsens.', '2025-07-09 10:44:30'),
(120, 'Emergency contact?', 'Call 123-456-7890 for emergency medical assistance anytime.', '2025-07-09 10:44:34'),
(121, 'Organ donation info', 'Visit our Organ Donation page and fill out the form. Thank you for saving lives!', '2025-07-09 10:44:44'),
(122, 'What is Medi EASE?', 'Medi EASE is your friendly healthcare assistant website to book appointments, get health tips, and consult doctors.', '2025-07-09 10:44:54'),
(123, 'Blood donation eligibility?', 'You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood.', '2025-07-09 10:45:02'),
(124, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-08-12 07:58:49'),
(125, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-09-04 03:27:23'),
(126, 'Blood donation eligibility?', 'You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood.', '2025-09-04 03:27:30'),
(127, 'Emergency contact?', 'Call 123-456-7890 for emergency medical assistance anytime.', '2025-09-04 03:27:35'),
(128, 'hi', '🤖 Sorry, only the provided questions can be asked here. Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-09-04 03:27:41'),
(129, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-09-12 04:12:52'),
(130, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-09-13 05:08:18'),
(131, 'COVID-19 symptoms', 'For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.', '2025-09-13 05:08:22'),
(132, 'Blood donation eligibility?', 'You must be between 18 and 65 years, healthy, and weigh over 50 kg to donate blood.', '2025-09-16 14:08:24'),
(133, 'fever', '🤖 Sorry, only the provided questions can be asked here. Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-09-16 14:08:32'),
(134, 'how are you ?', '🤖 Sorry, only the provided questions can be asked here. Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-09-23 15:23:23'),
(135, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-09-23 15:23:55'),
(136, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-09-23 15:24:02'),
(137, 'I have a headache', 'Try to rest, stay hydrated, and avoid screen time. If pain persists, consult a doctor.', '2025-09-24 14:49:41'),
(138, 'What to do for fever?', 'Take fluids, rest, and monitor your temperature. See a doctor if it worsens.', '2025-09-24 14:50:16'),
(139, 'How to consult a doctor?', 'You can consult a doctor via our \'Live Chat\' or \'Appointment\' feature on Medi EASE.', '2025-09-24 14:50:21'),
(140, 'hi', '🤖 Sorry, only the provided questions can be asked here. Please use the \'Chat Now\' button to talk directly with a doctor.', '2025-09-24 14:50:30'),
(141, 'COVID-19 symptoms', 'For COVID-19, isolate yourself and monitor symptoms. Contact your doctor if severe.', '2025-10-02 02:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `web_user_id` int(11) DEFAULT NULL,
  `telegram_chat_id` bigint(20) DEFAULT NULL,
  `sender` enum('web','telegram','doctor') NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `donation_type` enum('Blood','Organ') NOT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `organ_name` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `donation_type` varchar(50) NOT NULL,
  `blood_type` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `email`, `donation_type`, `blood_type`, `phone`, `created_at`) VALUES
(1, 'lava', 'lavathina14@gmail.com', 'Blood', 'O-', '0105611403', '2025-05-30 06:32:03'),
(2, 'lava', 'lavathina14@gmail.com', 'Blood', 'O+', '0105611403', '2025-05-30 11:25:47'),
(3, 'lava', 'lavathina14@gmail.com', 'Blood', 'O-', '0105611403', '2025-06-03 11:05:12'),
(4, 'lava', 'lavathina14@gmail.com', 'Blood', 'A+', '0105611403', '2025-07-09 10:46:36'),
(5, 'lava', 'lavathina14@gmail.com', 'Blood', 'A+', '0105611403', '2025-08-12 07:59:36'),
(6, 'lava', 'lavathina14@gmail.com', 'Blood', 'A+', '0105611403', '2025-09-17 06:30:27'),
(7, 'lava', 'lavathina14@gmail.com', 'Blood', 'A+', '0105611403', '2025-09-23 15:34:35'),
(8, 'lava', 'lavathina14@gmail.com', 'Blood', 'A+', '0105611403', '2025-09-24 14:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `helpful` int(11) DEFAULT 0,
  `not_helpful` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `username`, `comment`, `rating`, `created_at`) VALUES
(1, 'Guest_634', 'HI', 5, '2025-10-15 15:29:42'),
(2, 'Guest_634', 'GOOD WEBSITE', 4, '2025-10-15 15:30:44'),
(3, 'Guest_634', 'GOOD WEBSITE', 5, '2025-10-15 15:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_votes`
--

CREATE TABLE `feedback_votes` (
  `id` int(11) NOT NULL,
  `feedback_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vote_type` enum('up','down') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_news`
--

CREATE TABLE `health_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_news`
--

INSERT INTO `health_news` (`id`, `title`, `content`, `image_url`, `created_at`, `user_id`) VALUES
(1, 'Heatwave Health Alert: Stay Hydrated!', 'Meteorologists warn of an upcoming heatwave. Drink plenty of water, avoid direct sun, and check on the elderly.', 'https://tse2.mm.bing.net/th?id=OIP.u2gAkt2a_Atm0--LBqUIPgHaD4&pid=Api&P=0&h=220', '2025-05-30 05:14:25', 0),
(2, 'Beware of Dengue Fever: Tips to Prevent', 'Standing water breeds mosquitoes. Keep surroundings clean, wear long sleeves, and use repellents.', 'https://tse4.mm.bing.net/th?id=OIP.C5L4avDk8eR6rERRbchjMQHaFq&pid=Api&P=0&h=220', '2025-05-30 05:14:25', 0),
(3, 'Heatwave Health Alert: Stay Hydrated!', 'Meteorologists warn of an upcoming heatwave. Drink plenty of water, avoid direct sun, and check on the elderly.', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80', '2025-05-30 05:16:31', 0),
(4, 'Beware of Dengue Fever: Tips to Prevent', 'Standing water breeds mosquitoes. Keep surroundings clean, wear long sleeves, and use repellents.', 'https://images.unsplash.com/photo-1556745757-8d76bdb6984b?auto=format&fit=crop&w=800&q=80', '2025-05-30 05:16:31', 0),
(5, 'New Advances in COVID-19 Vaccines', 'Scientists announce improved vaccines that offer broader protection against variants.', 'https://tse3.mm.bing.net/th?id=OIP.e_qCgttnbZ4mZlp2CMicFwHaEK&pid=Api&P=0&h=220', '2025-05-30 05:16:31', 0),
(6, 'Mental Health Awareness: Breaking Stigma', 'Programs and campaigns are helping reduce stigma and improve mental health access worldwide.', 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=800&q=80', '2025-05-30 05:16:31', 0),
(7, 'Healthy Eating Tips for a Better Life', 'Nutritionists recommend balanced diets rich in vegetables, fruits, and whole grains.', 'https://tse1.mm.bing.net/th?id=OIP.IOXmarnmzUeoNBzMgZt0QQHaEp&pid=Api&P=0&h=220', '2025-05-30 05:16:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `health_tips`
--

CREATE TABLE `health_tips` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `category` enum('Disease & Conditions','Nutrition & Diet','Mental Health & Wellness') NOT NULL,
  `posted_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk`
--

CREATE TABLE `helpdesk` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `helpdesk`
--

INSERT INTO `helpdesk` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(7, 'lava', 'lavathina14@gmail.com', 'technical issue', 'NO', '2025-05-30 13:38:48'),
(8, 'lava', 'lavathina14@gmail.com', 'technical issue', 'NO', '2025-05-30 13:38:48'),
(9, 'lava', 'lavathina14@gmail.com', 'technical issue', 'NO', '2025-05-30 13:38:50'),
(10, 'lava', 'lavathina14@gmail.com', 'technical issue', 'NO', '2025-05-30 13:38:50'),
(11, 'lava', 'lavathina14@gmail.com', 'technical issue', 'NO', '2025-05-30 13:48:02'),
(12, 'lava', 'lavathina14@gmail.com', 'technical issue', 'NO', '2025-05-30 13:48:15'),
(13, 'lava', 'lavathina14@gmail.com', 'technical issue', 'no connection', '2025-06-03 11:06:45'),
(14, 'lava', 'lavathina14@gmail.com', 'technical issue', 'technical issue', '2025-08-12 08:00:39'),
(15, 'lava', 'lavathina14@gmail.com', 'technical issue', 'no connection', '2025-09-24 17:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`) VALUES
(1, 1, 'Hello from test user', '2025-09-13 12:56:43'),
(2, 2, 'Hello from test user', '2025-09-13 13:14:10'),
(3, 1, 'Test from phpMyAdmin', '2025-09-13 13:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_consent`
--

CREATE TABLE `privacy_consent` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `consent_given` tinyint(1) NOT NULL,
  `consent_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privacy_consent`
--

INSERT INTO `privacy_consent` (`id`, `name`, `email`, `consent_given`, `consent_time`) VALUES
(1, 'lava', 'lavathina14@gmail.com', 1, '2025-05-30 12:27:07'),
(2, 'lava', 'lavathina14@gmail.com', 1, '2025-05-30 12:43:11'),
(3, '', '', 0, '2025-05-31 12:13:51'),
(4, 'lava', 'lavathina14@gmail.com', 1, '2025-06-03 11:07:16'),
(5, 'lava', 'lavathina14@gmail.com', 1, '2025-09-24 17:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `survey_feedback`
--

CREATE TABLE `survey_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `q1_rating` int(11) DEFAULT NULL,
  `q2_recommend` enum('Yes','No') DEFAULT NULL,
  `q3_suggestion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_feedback`
--

INSERT INTO `survey_feedback` (`id`, `user_id`, `q1_rating`, `q2_recommend`, `q3_suggestion`, `created_at`) VALUES
(1, NULL, 2, 'Yes', 'nothing', '2025-09-17 04:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `symptom_checker`
--

CREATE TABLE `symptom_checker` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `symptoms` text NOT NULL,
  `probable_diagnosis` text DEFAULT NULL,
  `checked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `password_hash`) VALUES
(1, 'demo', 'demo123', 'demo@example.com', ''),
(19, 'lavathina14@gmail.com', '$2y$10$o4CMap3iQouK4U5nzd3hReFRTuDMNjNhEJ9IOkJADWBrwkIJDegeW', '', ''),
(20, 'lavathina14@gmail.com', '$2y$10$UnAa3VANw1H0GKtGKZmjGuwV8idYlhcXiyLKbg16lb9b2dJcxDBdG', '', ''),
(21, 'lavathina14@gmail.com', '$2y$10$4PHzyy/b9bYIzi8KnAZAkuj2ToRdS4E7B55OqpN.KiUuP2cZvGrvy', '', ''),
(22, 'lava', '', 'lavathina14@gmail.com', '$2y$10$XFDDGENAz8fQFe2ZFc8lmuxBDK2MxspijKJKjrVk6LIp2OYm33mVq'),
(23, 'lavathina14@gmail.com', '$2y$10$pC11bdQbsLGvs6AkSoBi5eqW5TD14twz5GMaV4rqQQVZyFhmzfsa.', '', ''),
(24, 'lavathina14@gmail.com', '$2y$10$mcnii1f9g4RAFn3bl508W.2ooQjxXnN0wWJg3/nla2XHlDuRqhc5e', '', ''),
(25, 'lavathina14@gmail.com', '$2y$10$VgEItFQTGlb05SvEYl7EduVsEBhzRjpQUxhR6pJ/X/bd9m7GfRZ2u', '', ''),
(26, 'lavathina14@gmail.com', '$2y$10$Rl92gA4VOvkPCpo6P1XSpeTu4lWyaRqmuI3FbsqyqJ5uWsj8WwsmS', '', ''),
(27, 'lava', '$2y$10$n4NoedvfKKhvRDO25FTX..5O3x3Fr8WbaSfaS5KQ3KHtD5lhnnbim', '', ''),
(28, 'vaishu', '$2y$10$.ZWG1pvcx4aQUlt04ckp0eRhIyCMp4qZiBpp1ovQCtQHTJPEs.d7q', '', ''),
(29, 'doctor@gmail.com', '', 'doctor1@gmail.com', '$2y$10$7W7vKNySOBULT5iqXlcrOOQ/UOk8928/dsMkqxnXAf3r97znx6N0G'),
(30, 'patient', '', 'patient1@gmail.com', '$2y$10$VZLq8vF5VnXT1UeGq4TZAeje4vycKrmn2D5heSEXR/MCPYixwfGOO'),
(31, 'vaishu', '$2y$10$N94Mbb6rWy/wXJvvr5gCYusyN8uXLgRXMVPfnmZLf9fg219qd7bru', '', ''),
(32, 'vaishu', '$2y$10$JhYXViTV6mZIqmjwwiKIROBWPoglMd/qb8xwEJA9/y206KjksWlaG', '', ''),
(33, 'patient', '$2y$10$Bi4xRd0MeB01FMIha0NAK.f7pXcS6/d0kfwI5BrCccdi5iHQdxxim', '', ''),
(34, 'patient', '$2y$10$2.KWBAYnUPmLd7YQgzYWw.jHmjovjL.GGzuw5KrQEBDlt5h0iv9Si', '', ''),
(35, 'patient1', '$2y$10$Dcghd32Ck//RJUYKkPX4Fuear0OAwKJ/RNeMdWJVX2zKmcBoWxE7S', '', ''),
(36, 'doctor1@gmail.com', '$2y$10$r1ONaaW.wjhrR3sBfJvqhu5nZc378ap6WeLIsMjomMxkHMJv2inoi', '', ''),
(37, 'doctor@gmail.com', '', 'doctor@gmail.com', '$2y$10$NJqF4r0CVs0i6Q2vPsSfnObXWLJ17ubK6s5v4wLRf1udWFJW1zVoO'),
(38, 'patient1', '$2y$10$1A0f.qi2SFj.gt9jJGqqX.p9MZDFYsbfHsz7YK0zhiIT6X5ISP6RG', '', ''),
(39, 'doctor@gmail.com', '$2y$10$Jfaalb9l8.JWxvjqVLM3CeBniGfxlO1BEPx.hepe2lUUQ7Av5mYaO', '', ''),
(40, 'patient1', '$2y$10$uu2pNKRgFGUEbjmVFXI8dObbDMimMVdYf2MECxShSj8fXkqEM0LkG', '', ''),
(41, 'doctor@gmail.com', '$2y$10$fr.mSZ.5ODAO7yfUDv519un4HzXZC90Stf41vZdIi3.VK.ZgVehr2', '', ''),
(42, 'doctor@gmail.com', '$2y$10$xupQ1Xbu4Qaq4ki7YgNtxOE86SgG3uF7urvITvzUi24X5DNB0OyAC', '', ''),
(43, 'doctor@gmail.com', '$2y$10$oY3tT3uxvU2KWPLKure2X.xhFizj8zBYTTosX/q9TP66Xg1538CM2', '', ''),
(44, 'patient1', '$2y$10$/JYhHoIkU234wFfBpZmJ6.Vx9IUozFeAPF7UuEqSD4QBdTNsYKXZK', '', ''),
(45, 'doctor@gmail.com', '$2y$10$VzEDnpvjD5Mu86C522MrqOF63SXksDoMD2FX5dhvKdsLeJgEuuz9S', '', ''),
(46, 'doctor@gmail.com', '$2y$10$jHXWpgECwlj4LaDLRWIMs.e7Nr2QcRsOxGkXopxy4PDquKgZrll4a', '', ''),
(47, 'lavathina14@gmail.com', '$2y$10$cWR3N72HgrxfgGLOtQXJFuX6rWJCU9SxpSh8klvFCmXAAz8uWt2HG', '', ''),
(48, 'doctor@gmail.com', '$2y$10$vs3lz5IMsB56W8xmW4CAs.ibC4AC371AEln.5g9OeadT8j7Rwkyiu', '', ''),
(49, 'doctor', '$2y$10$f/1kyu2j7Buvrq1XW9im0OeaNKX6YyOKv1SGVMfRUarl3FVeNi632', '', ''),
(50, 'patient1@gmail.com', '$2y$10$yuSw8fAwtSWQtvBhkOsmcumW2ez4LldCNpy0W8xlEToL1PzBiec5e', '', ''),
(51, 'doctor@gmail.com', '$2y$10$CZovvVB1jAM27a4oGP5nq.LHAloRTOAQ4J.QmrjGAVJMs36aoAw.6', '', ''),
(52, 'doctor@gmail.com', '$2y$10$ZZCASI6ijg3ztkTm2A3Q/uLeoUg0SxMkShE682HeIzLnFgibvoyJy', '', ''),
(53, 'patient1@gmail.com', '$2y$10$czf0VF.Nd0vm8gI1QYS5o.CbhEPKRzP0YXroBiap0gFVspiTqkgzm', '', ''),
(54, 'doctor@gmail.com', '$2y$10$x.O9.4w4tgj7CuJSokXqrOAcReu44sTgELBYUA9By/vo9xnTNgXdi', '', ''),
(55, 'doctor1@gmail.com', '$2y$10$i2dKuMPy6VJXIrJBZm2jSeHMfjzZkYzGCzp1ZCxToBYnPPiRnaa26', '', ''),
(56, 'doctor@gmail.com', '$2y$10$3jcbh5W6nUAWx8h5VeM5yuFtf7rdNSSKLbobsng..dSlGk38VO5am', '', ''),
(57, 'doctor@gmail.com', '$2y$10$Vm8OCrmYt9AohUeZ8JrwnefkTkrCUa0JnXJIm0rTHy0h4EEkLxRdG', '', ''),
(58, 'doctor@gmail.com', '$2y$10$TLd/u/kdE2dn6JWfdCm7tOCP6lRnuyJNgmPDW/Ej0zedhfR89pguq', '', ''),
(59, 'doctor@gmail.com', '$2y$10$lM7s7ceju/D2A27J0HNoOuSoN9Ntq7oGozlH9I872iIX1c9qOe6Jm', '', ''),
(60, 'doctor@gmail.com', '$2y$10$yxvLKjxskygehIxjC4/oSe29UMk4ZrFYX78U7rcp8VSF/GrUOoxeu', '', ''),
(61, 'doctor@gmail.com', '$2y$10$fSGKZ4.0NNEx2I8bXVgHkeBubPGBZkkmR18bTI2YIZ4/cOfGFQB8q', '', ''),
(62, 'doctor@gmail.com', '$2y$10$fJkFYYkPmzJgr2msWHNjpuXys.6H/DH1ZN0C.EM2Lnojff4ajYcFe', '', ''),
(63, 'doctor@gmail.com', '$2y$10$gxv6v2ETlnFpEwDpJBoWWutaQfWRNjiBphJW4wuUUdyNjI7qpa.2W', '', ''),
(64, 'doctor@gmail.com', '$2y$10$a8cGwf6.HaeZocxEgiWFDOb5paELU1n1GSIfIbjjT5fqt4.fITHpe', '', ''),
(65, 'doctor@gmail.com', '$2y$10$wh1qlFQf7nfG3pDq9m8TQedQrCGQuUU5b2qm.x3QTktbc/EiUKtbi', '', ''),
(66, 'doctor@gmail.com', '$2y$10$VFjJ5quhssD1iEGtYIvCb.IXLMYFDy7LF9Qa.j/3Zz.mVukO6UvsW', '', ''),
(67, 'doctor@gmail.com', '$2y$10$O0GMLpcwvLVgN.8o2ofYNOVgxKIUMdNyc9/sL57t.HNm36IPfz.V6', '', ''),
(68, 'doctor@gmail.com', '$2y$10$fq4TI69eyGn3ID4RewZT8uWil5dVWYSj8LvOKlgvTVDKSTXHJNu82', '', ''),
(69, 'doctor@gmail.com', '$2y$10$P5pkFn4FxfpJOeIHL2y8pOIFFD7Z0c/FTf9mm1AVcTMgN8bQ9HAvS', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointment_user` (`user_id`),
  ADD KEY `fk_appointment_doctor` (`doctor_id`);

--
-- Indexes for table `chatbot_logs`
--
ALTER TABLE `chatbot_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_votes`
--
ALTER TABLE `feedback_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feedback_id` (`feedback_id`,`user_id`);

--
-- Indexes for table `health_news`
--
ALTER TABLE `health_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_tips`
--
ALTER TABLE `health_tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tip_user` (`posted_by`);

--
-- Indexes for table `helpdesk`
--
ALTER TABLE `helpdesk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_consent`
--
ALTER TABLE `privacy_consent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_feedback`
--
ALTER TABLE `survey_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptom_checker`
--
ALTER TABLE `symptom_checker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_symptom_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatbot_logs`
--
ALTER TABLE `chatbot_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback_votes`
--
ALTER TABLE `feedback_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_news`
--
ALTER TABLE `health_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `health_tips`
--
ALTER TABLE `health_tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `helpdesk`
--
ALTER TABLE `helpdesk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privacy_consent`
--
ALTER TABLE `privacy_consent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `survey_feedback`
--
ALTER TABLE `survey_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `symptom_checker`
--
ALTER TABLE `symptom_checker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointment_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_appointment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `health_tips`
--
ALTER TABLE `health_tips`
  ADD CONSTRAINT `fk_tip_user` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `symptom_checker`
--
ALTER TABLE `symptom_checker`
  ADD CONSTRAINT `fk_symptom_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
