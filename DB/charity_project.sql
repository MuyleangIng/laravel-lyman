-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 03, 2024 at 07:25 AM
-- Server version: 8.2.0
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Morshedul Arefin', 'admin@gmail.com', NULL, '$2y$10$CRhsxQj8E3J4RDxdOFsGLeAby4TRfRLb.qy.f20nqaswgb8AIVn8y', '1698647869.jpg', NULL, '2023-10-30 00:36:49', '2023-12-20 07:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

CREATE TABLE `causes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goal` int NOT NULL,
  `raised` int DEFAULT NULL,
  `is_featured` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `name`, `slug`, `short_description`, `description`, `featured_photo`, `goal`, `raised`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'Child Support', 'child-support', 'Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum.', '<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores, vis et semper minimum forensibus. Simul semper vivendo no eam, alienum iracundia constituam in quo. An eius dicta impetus his, atqui graeco vel eu.<br /><br />Eros omnis recusabo eu vim, et mandamus vulputate his. Detracto torquatos sit id, nec eu alienum disputando. Augue putant ex vis, case inermis comprehensam mei id. Eu percipit platonem vis, cum ea dolore utroque volumus.<br /><br />Minim gubergren moderatius et quo, augue quidam in sea. In duo movet sanctus omittam, fabulas forensibus no sed. Sed tation noluisse id, mei alii platonem ea, fuisset deseruisse an has. Nemore ancillae disputando at mei, ei his melius epicuri, vim democritum elaboraret concludaturque an. Ut quidam euismod molestiae usu. Eum commune mediocritatem at, ignota repudiare vituperatoribus et est.</p>', 'cause_featured_photo_1703771328.jpg', 500, 325, 'Yes', '2023-12-28 07:48:48', '2024-01-01 08:37:15'),
(2, 'Help to Mothers', 'help-mothers', 'Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum.', '<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores.</p>\r\n<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores.</p>\r\n<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores.</p>', 'cause_featured_photo_1703771403.jpg', 3500, 900, 'Yes', '2023-12-28 07:50:03', '2024-01-01 08:38:49'),
(3, 'Water for All', 'water-for-all', 'Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum.', '<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores.</p>\r\n<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores.</p>\r\n<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores.</p>', 'cause_featured_photo_1703771440.jpg', 2400, 0, 'Yes', '2023-12-28 07:50:40', '2024-01-01 08:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `cause_donations`
--

CREATE TABLE `cause_donations` (
  `id` bigint UNSIGNED NOT NULL,
  `cause_id` int NOT NULL,
  `user_id` int NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cause_donations`
--

INSERT INTO `cause_donations` (`id`, `cause_id`, `user_id`, `price`, `currency`, `payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '25', 'USD', '0T5814417C081113B', 'PayPal', 'COMPLETED', '2023-12-31 20:32:58', '2023-12-31 20:32:58'),
(2, 1, 1, '300', 'USD', '61L16207UC947504T', 'PayPal', 'COMPLETED', '2023-12-31 20:33:49', '2023-12-31 20:33:49'),
(3, 2, 1, '100', 'usd', 'cs_test_a1DAveyMygCBjI5FCJ8PHivrY3tpJSAAsbY2lL8mseVsiBgDppfsecVaiE', 'Stripe', 'COMPLETED', '2023-12-31 20:57:09', '2023-12-31 20:57:09'),
(4, 2, 2, '800', 'usd', 'cs_test_a12mqK3YKAnGrc2RADP9CwhIU0IFJHJBrLKXtll4RsQD9wQrzJVVA9aXnt', 'Stripe', 'COMPLETED', '2023-12-31 21:00:16', '2023-12-31 21:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `cause_faqs`
--

CREATE TABLE `cause_faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `cause_id` int NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cause_faqs`
--

INSERT INTO `cause_faqs` (`id`, `cause_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'What is Child-Support Charity?', 'Omnis recusabo eu vim, et mandamus vulputate his. Detracto torquatos sit id, nec eu alienum disputando. Augue putant ex vis, case inermis comprehensam mei id. Eu percipit platonem vis, cum ea dolore utroque volumus.', '2023-12-31 19:34:27', '2023-12-31 19:56:22'),
(2, 1, 'How can I get involved with Child Support Charity?', 'Minim gubergren moderatius et quo, augue quidam in sea. In duo movet sanctus omittam, fabulas forensibus no sed. Sed tation noluisse id, mei alii platonem ea, fuisset deseruisse an has. Nemore ancillae disputando at mei, ei his melius epicuri, vim democritum elaboraret concludaturque an. Ut quidam euismod molestiae usu. Eum commune mediocritatem at, ignota repudiare vituperatoribus et est.', '2023-12-31 19:34:54', '2023-12-31 19:34:54'),
(3, 1, 'Where does the money donated to Child Support Charity go?', 'Ad quem maluisset cum, audiam tritani ne mei. Id has inani eloquentiam, his virtute eloquentiam ut, ad duo modus commune. Et eam consul pericula necessitatibus. Sit ei enim exerci blandit.', '2023-12-31 19:35:08', '2023-12-31 19:35:08'),
(4, 1, 'Can I make a one-time donation, or do you offer recurring donation options?', 'Euripidis definitionem in pri, an pro fuisset tincidunt. Ius at aperiam fabulas, ocurreret voluptatibus ad pri. Homero iuvaret luptatum ius no. Ea eam enim laudem adversarium, dico errem sed ea.', '2023-12-31 19:35:23', '2023-12-31 19:35:23'),
(5, 2, 'What is Child Support Charity?', 'Eros omnis recusabo eu vim, et mandamus vulputate his. Detracto torquatos sit id, nec eu alienum disputando. Augue putant ex vis, case inermis comprehensam mei id. Eu percipit platonem vis, cum ea dolore utroque volumus.', '2023-12-31 19:35:46', '2023-12-31 19:35:46'),
(6, 2, 'How can I get involved with Child Support Charity?', 'Minim gubergren moderatius et quo, augue quidam in sea. In duo movet sanctus omittam, fabulas forensibus no sed. Sed tation noluisse id, mei alii platonem ea, fuisset deseruisse an has. Nemore ancillae disputando at mei, ei his melius epicuri, vim democritum elaboraret concludaturque an. Ut quidam euismod molestiae usu. Eum commune mediocritatem at, ignota repudiare vituperatoribus et est.', '2023-12-31 19:35:55', '2023-12-31 19:35:55'),
(7, 2, 'Where does the money donated to Child Support Charity go?', 'Ad quem maluisset cum, audiam tritani ne mei. Id has inani eloquentiam, his virtute eloquentiam ut, ad duo modus commune. Et eam consul pericula necessitatibus. Sit ei enim exerci blandit.', '2023-12-31 19:36:05', '2023-12-31 19:36:05'),
(8, 3, 'What is Child Support Charity?', 'Euripidis definitionem in pri, an pro fuisset tincidunt. Ius at aperiam fabulas, ocurreret voluptatibus ad pri. Homero iuvaret luptatum ius no. Ea eam enim laudem adversarium, dico errem sed ea.', '2023-12-31 19:36:26', '2023-12-31 19:36:26'),
(9, 3, 'How can I get involved with Child Support Charity?', 'Ad quem maluisset cum, audiam tritani ne mei. Id has inani eloquentiam, his virtute eloquentiam ut, ad duo modus commune. Et eam consul pericula necessitatibus. Sit ei enim exerci blandit.', '2023-12-31 19:36:32', '2023-12-31 19:36:32'),
(10, 3, 'Are my donations tax-deductible?', 'Ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores, vis et semper minimum forensibus. Simul semper vivendo no eam, alienum iracundia constituam in quo. An eius dicta impetus his, atqui graeco vel eu.', '2023-12-31 19:36:48', '2023-12-31 19:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `cause_photos`
--

CREATE TABLE `cause_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `cause_id` int NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cause_photos`
--

INSERT INTO `cause_photos` (`id`, `cause_id`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'cause_photo_1704072103.jpg', '2023-12-31 19:21:43', '2023-12-31 19:21:43'),
(3, 1, 'cause_photo_1704072116.jpg', '2023-12-31 19:21:56', '2023-12-31 19:21:56'),
(4, 1, 'cause_photo_1704072157.jpg', '2023-12-31 19:22:37', '2023-12-31 19:22:37'),
(5, 2, 'cause_photo_1704072167.jpg', '2023-12-31 19:22:47', '2023-12-31 19:22:47'),
(6, 2, 'cause_photo_1704072171.jpg', '2023-12-31 19:22:51', '2023-12-31 19:22:51'),
(7, 2, 'cause_photo_1704072175.jpg', '2023-12-31 19:22:55', '2023-12-31 19:22:55'),
(8, 3, 'cause_photo_1704072182.jpg', '2023-12-31 19:23:02', '2023-12-31 19:23:02'),
(9, 3, 'cause_photo_1704072185.jpg', '2023-12-31 19:23:05', '2023-12-31 19:23:05'),
(10, 3, 'cause_photo_1704072191.jpg', '2023-12-31 19:23:11', '2023-12-31 19:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `cause_videos`
--

CREATE TABLE `cause_videos` (
  `id` bigint UNSIGNED NOT NULL,
  `cause_id` int NOT NULL,
  `youtube_video_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cause_videos`
--

INSERT INTO `cause_videos` (`id`, `cause_id`, `youtube_video_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'rgZssMf18eM', '2023-12-31 19:23:54', '2023-12-31 19:23:54'),
(2, 1, 'fX2ZmeUjwfc', '2023-12-31 19:24:09', '2023-12-31 19:24:09'),
(4, 1, 'P1VH7JQzXDE', '2023-12-31 19:25:04', '2023-12-31 19:25:04'),
(5, 2, 'rgZssMf18eM', '2023-12-31 19:25:21', '2023-12-31 19:25:21'),
(6, 2, 'fX2ZmeUjwfc', '2023-12-31 19:25:26', '2023-12-31 19:25:26'),
(7, 2, 'P1VH7JQzXDE', '2023-12-31 19:25:31', '2023-12-31 19:25:31'),
(8, 3, 'P1VH7JQzXDE', '2023-12-31 19:25:44', '2023-12-31 19:25:44'),
(9, 3, 'fX2ZmeUjwfc', '2023-12-31 19:25:51', '2023-12-31 19:25:51'),
(10, 3, 'rgZssMf18eM', '2023-12-31 19:25:56', '2023-12-31 19:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post_id`, `name`, `email`, `status`, `created_at`, `updated_at`) VALUES
(5, 'This is a very nice website. I love it.', 6, 'Smith', 'smith@gmail.com', 'Active', '2023-12-20 05:24:03', '2024-01-03 01:00:05'),
(6, 'I want to make a same website like this. So please contact me in this email address that I give you.', 6, 'Peter Smith', 'peter@gmail.com', 'Active', '2023-12-20 06:03:00', '2023-12-20 06:03:16'),
(7, 'I love the template of this website very much. Please sell one piece to me.', 6, 'Arefin', 'arefin2k@gmail.com', 'Active', '2023-12-20 06:16:18', '2023-12-20 06:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint UNSIGNED NOT NULL,
  `counter1_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter1_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter2_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter2_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter3_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter3_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter4_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter4_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `counter1_number`, `counter1_name`, `counter2_number`, `counter2_name`, `counter3_number`, `counter3_name`, `counter4_number`, `counter4_name`, `status`, `created_at`, `updated_at`) VALUES
(1, '1120', 'Donations', '300', 'Volunteers', '130', 'Projects', '160', 'Events Organized', 'Show', NULL, '2023-12-18 12:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int DEFAULT NULL,
  `total_seat` int DEFAULT NULL,
  `booked_seat` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `slug`, `short_description`, `description`, `featured_photo`, `date`, `time`, `location`, `map`, `price`, `total_seat`, `booked_seat`, `created_at`, `updated_at`) VALUES
(1, 'Abled Child Cancer', 'abled-child-cancer', 'To provide food, shelter, clothing, education and medical assistance to homeless children and their families.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.</p>\r\n<p>Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.</p>\r\n<p>Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>', 'event_featured_photo_1703295575.jpg', '2024-02-16', '14:45', '937 Jamajo Blvd, Orlando FL 32803, USA', NULL, 9, 10, 10, '2023-12-20 20:04:49', '2024-01-01 19:04:53'),
(2, 'Contribute for Recovery', 'Contribute-for-Recovery', 'To help the mothers who are homeless & helpless, we provide them food, shelter & medical assistance.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.</p>\r\n<p>Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.</p>\r\n<p>Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>\r\n<p>&nbsp;</p>', 'event_featured_photo_1703295164.jpg', '2024-01-18', '09:00', '937 Jamajo Blvd, Orlando FL 32803, USA', NULL, 19, NULL, 3, '2023-12-22 19:32:44', '2023-12-25 06:36:40'),
(4, 'Playing For World', 'Playing-For-World', 'To provide food, shelter, clothing, education and medical assistance to homeless children and their families.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.</p>\r\n<p>Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.</p>\r\n<p>Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>\r\n<p>&nbsp;</p>', 'event_featured_photo_1703295564.jpg', '2024-03-28', '07:00', '937 Jamajo Blvd, Orlando FL 32803, USA', NULL, 0, NULL, 7, '2023-12-22 19:39:24', '2024-01-01 19:05:10'),
(5, 'Attaining in a Special Ceremony', 'Attaining-Special-Ceremony', 'To provide food, shelter, clothing, education and medical assistance to homeless children and their families.', '<p style=\"text-align: left;\">Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.</p>\r\n<p>Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.</p>\r\n<p>Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>\r\n<p>&nbsp;</p>', 'event_featured_photo_1703295688.jpg', '2023-12-30', '11:00', '937 Jamajo Blvd, Orlando FL 32803, USA', NULL, 0, 5, 3, '2023-12-22 19:41:28', '2023-12-25 06:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `event_photos`
--

CREATE TABLE `event_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` int NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_photos`
--

INSERT INTO `event_photos` (`id`, `event_id`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'event_photo_1703297335.jpg', '2023-12-22 20:08:55', '2023-12-22 20:08:55'),
(2, 1, 'event_photo_1703297349.jpg', '2023-12-22 20:09:09', '2023-12-22 20:09:09'),
(3, 1, 'event_photo_1703297370.jpg', '2023-12-22 20:09:30', '2023-12-22 20:09:30'),
(4, 2, 'event_photo_1703297387.jpg', '2023-12-22 20:09:47', '2023-12-22 20:09:47'),
(5, 2, 'event_photo_1703297391.jpg', '2023-12-22 20:09:51', '2023-12-22 20:09:51'),
(6, 2, 'event_photo_1703297399.jpg', '2023-12-22 20:09:59', '2023-12-22 20:09:59'),
(7, 4, 'event_photo_1703297406.jpg', '2023-12-22 20:10:06', '2023-12-22 20:10:06'),
(8, 4, 'event_photo_1703297409.jpg', '2023-12-22 20:10:09', '2023-12-22 20:10:09'),
(9, 4, 'event_photo_1703297414.jpg', '2023-12-22 20:10:14', '2023-12-22 20:10:14'),
(10, 5, 'event_photo_1703297423.jpg', '2023-12-22 20:10:23', '2023-12-22 20:10:23'),
(11, 5, 'event_photo_1703297427.jpg', '2023-12-22 20:10:27', '2023-12-22 20:10:27'),
(12, 5, 'event_photo_1703297429.jpg', '2023-12-22 20:10:29', '2023-12-22 20:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `event_tickets`
--

CREATE TABLE `event_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `unit_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_tickets` int NOT NULL,
  `total_price` int NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_tickets`
--

INSERT INTO `event_tickets` (`id`, `event_id`, `user_id`, `unit_price`, `number_of_tickets`, `total_price`, `currency`, `payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '9', 3, 27, 'USD', '53P39821G9668651B', 'PayPal', 'COMPLETED', '2023-12-23 20:59:48', '2023-12-23 20:59:48'),
(3, 1, 1, '9', 4, 36, 'USD', '018900973P749605S', 'PayPal', 'COMPLETED', '2023-12-24 09:06:23', '2023-12-24 09:06:23'),
(4, 1, 1, '9', 2, 18, 'USD', '84G179354H581025S', 'PayPal', 'COMPLETED', '2023-12-24 09:11:26', '2023-12-24 09:11:26'),
(5, 1, 1, '9', 1, 9, 'usd', 'cs_test_a19EhImC6QqSl6LXqLiKFrqqDvgjvjMX6tnQdZMSxquXX0rds4LdtFBkCK', 'Stripe', 'COMPLETED', '2023-12-25 05:46:43', '2023-12-25 05:46:43'),
(6, 2, 1, '19', 5, 95, 'USD', '2X43291189611073R', 'PayPal', 'COMPLETED', '2023-12-25 06:12:43', '2023-12-25 06:12:43'),
(13, 4, 1, '0', 4, 0, '', 'payment_no_1703507492', 'Free', 'COMPLETED', '2023-12-25 06:31:32', '2023-12-25 06:31:32'),
(14, 4, 1, '0', 3, 0, '', 'payment_no_1703507497', 'Free', 'COMPLETED', '2023-12-25 06:31:37', '2023-12-25 06:31:37'),
(15, 5, 1, '0', 3, 0, '', 'payment_no_1703507550', 'Free', 'COMPLETED', '2023-12-25 06:32:30', '2023-12-25 06:32:30'),
(17, 2, 1, '19', 3, 57, 'USD', '65V71620RB9993153', 'PayPal', 'COMPLETED', '2023-12-25 06:36:40', '2023-12-25 06:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `event_videos`
--

CREATE TABLE `event_videos` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` int NOT NULL,
  `youtube_video_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_videos`
--

INSERT INTO `event_videos` (`id`, `event_id`, `youtube_video_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'EGh1wY4CJl0', '2023-12-22 20:26:38', '2023-12-22 20:26:38'),
(2, 1, 'ruZ9HgozGUU', '2023-12-22 20:27:37', '2023-12-22 20:27:37'),
(3, 1, '5_kfZ7yEnPU', '2023-12-22 20:27:46', '2023-12-22 20:27:46'),
(4, 2, 'mPRXhNFPgwo', '2023-12-22 20:28:31', '2023-12-22 20:28:31'),
(5, 2, 'fxnd3O4YC6k', '2023-12-22 20:28:50', '2023-12-22 20:28:50'),
(6, 2, 'RQu7jpcNUWI', '2023-12-22 20:28:55', '2023-12-22 20:28:55'),
(7, 4, 'E1xkXZs0cAQ', '2023-12-22 20:29:25', '2023-12-22 20:29:25'),
(8, 4, 'eA_Xq7HGWos', '2023-12-22 20:29:36', '2023-12-22 20:29:36'),
(9, 4, 'nEFCxs7SZsM', '2023-12-22 20:29:42', '2023-12-22 20:29:42'),
(10, 5, 'bdBG5VO01e0', '2023-12-22 20:30:19', '2023-12-22 20:30:19'),
(11, 5, 'aYVsy1pv-mo', '2023-12-22 20:30:26', '2023-12-22 20:30:26'),
(12, 5, 'xHegpKx61eE', '2023-12-22 20:30:33', '2023-12-22 20:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'What is your charity\'s mission and focus?', 'Our charity\'s mission is to make a positive impact in the lives of those in need. We focus on providing support in areas such as education, healthcare, disaster relief, and addressing hunger and homelessness. We also raise awareness about critical social and environmental issues.', '2023-12-18 19:28:50', '2023-12-18 19:28:50'),
(2, 'How can I make a donation to support your charity?', 'Making a donation to support our charity is easy and greatly appreciated. You can donate online through our secure website by clicking on the \"Donate Now\" button. We also accept donations through various other methods, such as bank transfers, checks, or in-kind contributions. Visit our \"Donate\" page for more details on the various donation options.', '2023-12-18 19:29:17', '2023-12-18 19:29:17'),
(3, 'Is my donation tax-deductible, and will I receive a receipt for tax purposes?', 'Yes, your donation is tax-deductible to the extent allowed by law. After making a donation, you will receive a receipt via email or mail, depending on your preference. This receipt will contain all the necessary information you need for tax purposes, including our charity\'s tax ID number.', '2023-12-18 19:29:31', '2023-12-18 19:29:31'),
(4, 'How can I get involved as a volunteer or participate in your charity\'s programs?', 'We welcome volunteers and individuals interested in participating in our programs. To get involved, please visit our \"Volunteer Opportunities\" page for information on upcoming events, projects, and how to apply. You can also sign up for our newsletter to stay informed about volunteer opportunities and programs.', '2023-12-18 19:29:44', '2023-12-18 19:29:44'),
(5, 'Can I designate my donation to a specific program or project within your charity?', 'Yes, you can often designate your donation to a specific program, project, or cause that aligns with your passion and interests. During the donation process, you will have the option to specify where you\'d like your contribution to be directed. If you have questions about specific designations, please contact our support team for further assistance.', '2023-12-18 19:29:59', '2023-12-18 19:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint UNSIGNED NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `icon`, `heading`, `text`, `created_at`, `updated_at`) VALUES
(1, 'fas fa-briefcase', 'Become a Volunteer', 'In order to become a volunteer, you need to fill out the form and send us. We will review your form and contact you.', '2023-12-17 19:36:20', '2023-12-17 20:21:07'),
(2, 'fas fa-search', 'Foundation & Events', 'We organize many events for fund raising. You can also organize events and help us to raise fund for the poor people.', '2023-12-17 19:37:35', '2023-12-17 19:37:35'),
(3, 'fas fa-share-alt', 'Make a Donation', 'You can also donate us. We will use your donation to help the poor people. You can donate us by PayPal or Stripe.', '2023-12-17 19:37:59', '2023-12-17 19:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_items`
--

CREATE TABLE `home_page_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cause_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cause_subheading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cause_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_subheading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonial_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_subheading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_items`
--

INSERT INTO `home_page_items` (`id`, `cause_heading`, `cause_subheading`, `cause_status`, `feature_background`, `feature_status`, `event_heading`, `event_subheading`, `event_status`, `testimonial_heading`, `testimonial_background`, `testimonial_status`, `blog_heading`, `blog_subheading`, `blog_status`, `created_at`, `updated_at`) VALUES
(1, 'Featured Causes', 'Our organization focuses on providing services to the homeless peoples.', 'Show', 'feature_background_1704118837.jpg', 'Show', 'Upcoming Events', 'You can organize events and help us to raise fund for the poor people.', 'Show', 'Our Happy Clients', 'testimonial_background_1704118881.jpg', 'Show', 'Latest News', 'Check out the latest news and updates from our blog post', 'Show', NULL, '2024-01-01 19:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_25_025642_create_admins_table', 1),
(7, '2023_10_30_082935_create_sliders_table', 2),
(8, '2023_10_30_143652_create_specials_table', 3),
(9, '2023_12_18_012545_create_features_table', 4),
(10, '2023_12_18_022815_create_feature_section_items_table', 5),
(11, '2023_12_18_092400_create_testimonials_table', 6),
(12, '2023_12_18_122923_create_testimonial_section_items_table', 7),
(13, '2023_12_18_174537_create_counters_table', 8),
(14, '2023_12_19_011946_create_faqs_table', 9),
(15, '2023_12_19_054702_create_volunteers_table', 10),
(16, '2023_12_19_085139_create_photo_categories_table', 11),
(17, '2023_12_19_094426_create_photos_table', 12),
(18, '2023_12_19_152009_create_video_categories_table', 13),
(19, '2023_12_19_173657_create_videos_table', 14),
(20, '2023_12_20_010842_create_post_categories_table', 15),
(21, '2023_12_20_024713_create_posts_table', 16),
(22, '2023_12_20_104933_create_comments_table', 17),
(23, '2023_12_20_105413_create_replies_table', 18),
(24, '2023_12_21_012747_create_events_table', 19),
(25, '2023_12_23_020127_create_event_photos_table', 20),
(26, '2023_12_23_022142_create_event_videos_table', 21),
(27, '2023_12_24_015803_create_event_tickets_table', 22),
(28, '2023_12_28_133200_create_causes_table', 23),
(29, '2024_01_01_011427_create_cause_photos_table', 24),
(30, '2024_01_01_011434_create_cause_videos_table', 24),
(31, '2024_01_01_012821_create_cause_faqs_table', 25),
(32, '2024_01_01_022624_create_cause_donations_table', 26),
(33, '2024_01_01_063218_create_home_page_items_table', 27),
(34, '2024_01_02_011608_create_settings_table', 28),
(35, '2024_01_03_015900_create_other_page_items_table', 29),
(36, '2024_01_03_022800_create_subscribers_table', 30);

-- --------------------------------------------------------

--
-- Table structure for table `other_page_items`
--

CREATE TABLE `other_page_items` (
  `id` bigint UNSIGNED NOT NULL,
  `terms_content` text COLLATE utf8mb4_unicode_ci,
  `privacy_content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_page_items`
--

INSERT INTO `other_page_items` (`id`, `terms_content`, `privacy_content`, `created_at`, `updated_at`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, cum ei ponderum mandamus, ei altera quidam sapientem eum. Iriure timeam perpetua ut cum, quando melius ad ius. Qui populo elaboraret te, eam ei prima dolores, vis et semper minimum forensibus. Simul semper vivendo no eam, alienum iracundia constituam in quo. An eius dicta impetus his, atqui graeco vel eu.<br /><br />Eros omnis recusabo eu vim, et mandamus vulputate his. Detracto torquatos sit id, nec eu alienum disputando. Augue putant ex vis, case inermis comprehensam mei id. Eu percipit platonem vis, cum ea dolore utroque volumus.<br /><br />Minim gubergren moderatius et quo, augue quidam in sea. In duo movet sanctus omittam, fabulas forensibus no sed. Sed tation noluisse id, mei alii platonem ea, fuisset deseruisse an has. Nemore ancillae disputando at mei, ei his melius epicuri, vim democritum elaboraret concludaturque an. Ut quidam euismod molestiae usu. Eum commune mediocritatem at, ignota repudiare vituperatoribus et est.<br /><br />Ad quem maluisset cum, audiam tritani ne mei. Id has inani eloquentiam, his virtute eloquentiam ut, ad duo modus commune. Et eam consul pericula necessitatibus. Sit ei enim exerci blandit.<br /><br />Euripidis definitionem in pri, an pro fuisset tincidunt. Ius at aperiam fabulas, ocurreret voluptatibus ad pri. Homero iuvaret luptatum ius no. Ea eam enim laudem adversarium, dico errem sed ea.</p>', '<p>Mei te amet neglegentur. Pri in nulla molestiae, quo ut melius discere moderatius, ut mel falli delectus definiebas. Ius an mazim verear copiosae. Has eu omnes praesent consequuntur, pri ut sonet putant ancillae, perpetua facilisis in usu. Cu pro natum aliquip dissentiunt, no erant numquam suscipit mei.<br /><br />Mea ut dicunt eligendi accusamus, ex aliquando signiferumque duo. At pro unum timeam commodo, reque pertinacia incorrupte vix an, quis eligendi atomorum no ius. Vim tota commune ei, vis everti propriae eu. Eu etiam persius est, porro voluptaria mei et, vis at explicari sententiae disputando.<br /><br />Putent volutpat persecuti ad eam. Mea ridens timeam ei, cu usu posse deserunt. Vix ut aperiri corrumpit laboramus. Sit movet percipit an, qui magna volumus cu, mei errem voluptatum ea. At vim essent latine.<br /><br />Te maiorum philosophia vituperatoribus duo. Sea ad utroque deleniti adipiscing, sed porro fugit errem ex. Qui wisi reprimique honestatis in. Putent possim evertitur mei no, cu errem dolore interpretaris mea. Id graecis corpora duo, ad saperet percipit incorrupte eam, ea modus hendrerit posidonium sea.<br /><br />Ei cum autem ubique nostro, cu usu nostrud theophrastus. At velit aperiri honestatis qui, sit ei suas assentior interpretaris, mazim virtute voluptatum pro cu. Eu vis imperdiet reprimique, in mel utinam verear. Alterum vituperata has et.</p>', NULL, '2024-01-02 20:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint UNSIGNED NOT NULL,
  `photo_category_id` int NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo_category_id`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'photo_1702980613.jpg', '2023-12-19 04:10:13', '2023-12-19 04:10:13'),
(2, 2, 'photo_1702981715.jpg', '2023-12-19 04:28:35', '2023-12-19 04:28:35'),
(3, 2, 'photo_1702996730.jpg', '2023-12-19 08:38:05', '2023-12-19 08:38:50'),
(4, 1, 'photo_1702996753.jpg', '2023-12-19 08:39:13', '2023-12-19 08:39:13'),
(5, 1, 'photo_1702996767.jpg', '2023-12-19 08:39:27', '2023-12-19 08:39:27'),
(6, 1, 'photo_1702996774.jpg', '2023-12-19 08:39:34', '2023-12-19 08:39:34'),
(7, 2, 'photo_1702996790.jpg', '2023-12-19 08:39:50', '2023-12-19 08:39:50'),
(8, 2, 'photo_1702996802.jpg', '2023-12-19 08:40:02', '2023-12-19 08:40:02'),
(12, 1, 'photo_1702998381.jpg', '2023-12-19 09:06:21', '2023-12-19 09:06:21'),
(13, 1, 'photo_1702998409.jpg', '2023-12-19 09:06:49', '2023-12-19 09:06:49'),
(14, 1, 'photo_1702998422.jpg', '2023-12-19 09:07:02', '2023-12-19 09:07:02'),
(15, 1, 'photo_1702998441.jpg', '2023-12-19 09:07:21', '2023-12-19 09:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `photo_categories`
--

CREATE TABLE `photo_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo_categories`
--

INSERT INTO `photo_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'University Event', '2023-12-19 03:02:29', '2023-12-19 03:02:29'),
(2, 'School Event', '2023-12-19 03:02:49', '2023-12-19 03:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `post_category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_category_id`, `title`, `slug`, `short_description`, `description`, `photo`, `tags`, `created_at`, `updated_at`) VALUES
(1, 3, 'Education Material for the Poor Children', 'education-material-poor-children', 'Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.<br /><br />Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.<br /><br />Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>', 'post_1703043634.jpg', 'child,school,poor', '2023-12-19 21:12:51', '2023-12-20 02:18:20'),
(5, 3, 'Partnering to create a strong community', 'partnering-create-strong-community', 'Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.<br /><br />Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.<br /><br />Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>', 'post_1703059910.jpg', 'education,school,charity,city', '2023-12-20 02:11:50', '2023-12-20 04:09:05'),
(6, 5, 'Turning your emergency donation into instant aid', 'turning-emergency-donation-into-instant-aid', 'Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.<br /><br />Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.<br /><br />Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>', 'post_1703059968.jpg', 'fund,education,school', '2023-12-20 02:12:48', '2023-12-20 02:18:31'),
(7, 2, 'Charity provides educational boost for children', 'charity-provides-educational-boost-for-children', 'Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.<br /><br />Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.<br /><br />Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>', 'post_1703060022.jpg', 'charity,school,children', '2023-12-20 02:13:42', '2023-12-20 04:09:48'),
(8, 4, 'Directly Support Individuals for the Charity', 'directly-support-individuals', 'Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.<br /><br />Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.<br /><br />Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>', 'post_1703060068.jpg', 'health,doctor,education,child', '2023-12-20 02:14:28', '2023-12-20 02:19:03'),
(9, 1, 'Poor Children Education Facility in City', 'poor-children-education-facility-in-city', 'Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo.', '<p>Lorem ipsum dolor sit amet, no unum senserit constituam has, has an enim recusabo, dolorum consequuntur ad quo. Nisl nonumes ea eam, at pro eleifend partiendo, alii summo ex nam. Eam impetus efficiantur ullamcorper no, ad est meliore patrioque sententiae, no eam atqui possit. An iriure meliore maiorum sed, quo an altera numquam. Nam eu commodo persecuti. Eu eos tibique delectus disputando, ei purto wisi euripidis mei, vis augue electram iudicabit ea.<br /><br />Eum id legimus rationibus, aeque eligendi ullamcorper mel et. Habeo officiis id usu, eu intellegat voluptatum definiebas nec, cu his error solet voluptua. Nec in wisi labore expetendis. His hinc verear ne, pri dignissim sententiae percipitur no, mel mollis ceteros gubergren in.<br /><br />Cu cum tota summo vulputate, ullum recusabo neglegentur per ex. Velit deleniti facilisi an usu, vim ludus prompta probatus ne. Ad eum ferri liber, sea no virtute facilisi. Id ius dico consectetuer. Te animal facilisis his, est ipsum putent te.</p>', 'post_1703060129.jpg', 'charity,learning,education,school,child', '2023-12-20 02:15:29', '2023-12-20 04:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Donation', 'donation', '2023-12-19 19:16:54', '2023-12-20 03:43:27'),
(2, 'Charity', 'charity', '2023-12-19 19:17:03', '2023-12-20 03:43:31'),
(3, 'Education', 'education', '2023-12-19 19:17:07', '2023-12-20 03:44:24'),
(4, 'Health', 'health', '2023-12-19 19:17:15', '2023-12-20 03:44:31'),
(5, 'Fundraising', 'fundraising', '2023-12-19 19:17:23', '2023-12-20 03:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint UNSIGNED NOT NULL,
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `reply`, `comment_id`, `name`, `email`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Yes, I agree, this is a nice website.', 5, 'David', 'david@gmail.com', 'Visitor', 'Active', '2023-12-20 06:33:30', '2023-12-20 06:34:30'),
(3, 'I also want a same website like this.', 6, 'Pat Flynn', 'pay_flynn@gmail.com', 'Visitor', 'Active', '2023-12-20 06:34:09', '2023-12-20 06:34:30'),
(4, 'Yes, Excellent item!', 5, 'Brent Grundy', 'brent@gmail.com', 'Visitor', 'Active', '2023-12-20 06:45:28', '2023-12-20 06:45:37'),
(6, 'Thank you everyone!', 5, NULL, NULL, 'Admin', 'Active', '2023-12-20 07:40:23', '2023-12-20 07:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cta_button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_button_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `banner`, `top_phone`, `top_email`, `cta_heading`, `cta_text`, `cta_button_text`, `cta_button_url`, `cta_status`, `footer_address`, `footer_phone`, `footer_email`, `copyright`, `map`, `facebook`, `twitter`, `youtube`, `linkedin`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'logo_1704244791.png', 'favicon_1704244725.png', 'banner_1704244961.jpg', '111-222-3333', 'contact@example.com', 'Become Donate Partner', 'Help the individuals giving financing support and providing food', 'Contact Us', '#', 'Show', '34 Antiger Lane, USA, 12937', '122-222-1212', 'contact@example.com', 'Copyright © 2023, CharityBig. All Rights Reserved.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799198932!2d-74.25987701513004!3d40.69767006272707!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1645362221879!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border: 0\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '#', '#', '#', '#', '#', NULL, '2024-01-02 19:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `heading`, `text`, `photo`, `button_text`, `button_link`, `created_at`, `updated_at`) VALUES
(1, 'Help the Child in need', '<p>We should support kids who are having a tough time. It\'s about being kind and giving a hand to children facing problems like being poor, sick, or in trouble. When we help, we show them that they\'re not alone and that things can get better.</p>\r\n<p>&nbsp;</p>', '1698671272.jpg', 'Read More', '#', '2023-10-30 02:56:01', '2023-10-30 07:08:20'),
(2, 'Fight for right causes', '<p>We work hard to support and raise awareness for important issues that need attention and action. Our goal is to make the world a better place by advocating for justice, equality, and positive change. Your support and involvement can help a lot.</p>\r\n<p>&nbsp;</p>', '1698671262.jpg', 'Read More', '#', '2023-10-30 02:57:39', '2023-10-30 07:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

CREATE TABLE `specials` (
  `id` bigint UNSIGNED NOT NULL,
  `heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_heading` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specials`
--

INSERT INTO `specials` (`id`, `heading`, `sub_heading`, `text`, `button_text`, `button_link`, `photo`, `video_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What We Do', 'Our Mission', '<p>At our charity, we are committed to making a positive impact in the lives of those in need. We provide vital support in areas such as education, healthcare, disaster relief, and addressing hunger and homelessness. We collaborate with local partners and volunteers to directly help individuals and families.</p>\r\n<p>We also focus on raising awareness about critical social and environmental issues. Our efforts include campaigns, events, and partnerships with like-minded organizations to promote awareness and advocate for change. Join us in making the world a better place through fundraising, volunteering, or simply spreading the word. Together, we can be a force for good and contribute to a more compassionate and equitable society.</p>', 'Read More', '#', '1698728077.jpg', 'TklWRCSM4SA', 'Show', NULL, '2023-12-18 12:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `token`, `status`, `created_at`, `updated_at`) VALUES
(3, 'subs1@gmail.com', '', 1, '2024-01-02 20:52:40', '2024-01-02 20:52:54'),
(4, 'subs2@gmail.com', '', 1, '2024-01-02 20:53:20', '2024-01-02 20:53:59'),
(5, 'subs3@gmail.com', '2e2252979c17c8dfbfea77d1c07c1218', 0, '2024-01-02 20:53:31', '2024-01-02 20:53:31'),
(6, 'subs4@gmail.com', '', 1, '2024-01-02 20:53:42', '2024-01-02 20:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `photo`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'testimonial_1702892153.jpg', 'Robert Krol', 'CEO, ABC Company', 'Volunteering with this charity has been a transformative experience. Their unwavering dedication to helping those in need is truly inspiring. I\'m proud to be part of their mission, witnessing the remarkable impact they make. I\'m grateful for the opportunity to contribute to their efforts.', '2023-12-18 03:35:53', '2023-12-18 03:35:53'),
(2, 'testimonial_1702901976.jpg', 'Patrick Henderson', 'Director, AHN Company', 'As a long-time donor, I\'m consistently impressed by this charity\'s transparency and life-changing impact. They provide real support to those in need, making a meaningful difference in various communities. I\'m proud to be a part of their mission and will continue to support their efforts.', '2023-12-18 03:36:58', '2023-12-18 06:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Smith Robertson', 'smith@gmail.com', '2023-10-30 00:41:37', '$2y$10$bFObENCXsB.lXF/e5davw.AJJ670kDl/jtMDxMHsg.iuSUZMu.Zg2', '1698648372.jpg', NULL, '2023-10-30 00:38:16', '2023-12-28 05:06:08'),
(2, 'Milton E. Fessler', 'milton@gmail.com', '2023-12-31 20:59:01', '$2y$10$6jlHeeKOKFEqmO14R35KBuVL/zTANQxPKVLQEnPFed5b8K6Ntp5si', NULL, NULL, '2023-12-31 20:58:50', '2023-12-31 20:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL,
  `video_category_id` int NOT NULL,
  `youtube_video_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_category_id`, `youtube_video_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'FIIWfOjJ3Ig', '2023-12-19 11:48:23', '2023-12-19 11:48:23'),
(2, 1, 'uemObN8_dcw', '2023-12-19 11:50:49', '2023-12-19 11:50:49'),
(3, 1, 'bfAzi6D5FpM', '2023-12-19 11:50:58', '2023-12-19 11:50:58'),
(4, 1, 'CE3LLDKXkz4', '2023-12-19 11:51:08', '2023-12-19 11:51:08'),
(5, 2, 'voF1plqqZJA', '2023-12-19 11:51:23', '2023-12-19 11:51:23'),
(6, 2, 'ky5vlOgfnQ8', '2023-12-19 11:51:35', '2023-12-19 11:51:35'),
(7, 2, 'BOJWRINtueQ', '2023-12-19 11:51:47', '2023-12-19 11:51:47'),
(8, 2, '9sPAkS7cHHw', '2023-12-19 11:51:56', '2023-12-19 11:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `video_categories`
--

CREATE TABLE `video_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_categories`
--

INSERT INTO `video_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Charity Event on University', '2023-12-19 09:27:35', '2023-12-19 09:27:35'),
(2, 'Charity Event on School', '2023-12-19 09:27:47', '2023-12-19 09:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `profession`, `photo`, `facebook`, `twitter`, `linkedin`, `instagram`, `address`, `email`, `phone`, `website`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'Pat Flynn', 'Volunteer', 'volunteer_1702965964.jpg', '#', '#', '#', '#', '932 Pine Tree Lane, Chevy Chase, MD 20815', 'patflynn@gmail.com', '111-222-3333', 'https://www.example.com', 'Passionate about making a difference in the world, Pat Flynn is a dedicated volunteer with a heart for animal welfare and environmental conservation. Born on January 15, 2000, in the vibrant city of Chevy Chase, Pat\'s journey into the world of volunteering began with his love for animals and his desire to protect our planet.\r\n\r\nWith a background in marketing and social media management, Pat has leveraged his skills to amplify the voices of the organizations and causes she cares deeply about. She holds a Bachelor\'s degree in Marketing and has worked as a Marketing Coordinator at XYZ Company, where she honed his expertise in brand promotion.\r\n\r\nDuring 2021-2022, Pat devoted his weekends to volunteer work at a local animal shelter, providing care and support to shelter animals in need. His dedication, empathy, and relentless spirit for animal welfare left a lasting impact on the shelter and the furry friends she cared for.\r\n\r\nPat is fluent in both English and Spanish, making his a versatile communicator with a wide range of potential collaborators. She has also undergone a background check, ensuring that she is a reliable and trustworthy addition to any volunteer team.\r\n\r\nIn addition to his commitment to animals, Pat is a strong advocate for environmental conservation. his motivation to volunteer comes from his belief that every small effort counts in the grand scheme of protecting our environment and its inhabitants.\r\n\r\nWith his own car and a willingness to travel within a 20-mile radius, Pat is ready to embark on his next volunteer adventure. You can connect with Pat through his LinkedIn profile to learn more about his professional background and achievements.\r\n\r\nPat Smith is not just a volunteer; she\'s a passionate changemaker, driven to create a better world for all living creatures.', '2023-12-19 00:06:04', '2023-12-19 00:40:24'),
(2, 'David Beckham', 'Volunteer', 'volunteer_1702966730.jpg', '#', '#', '#', '#', '932 Pine Tree Lane, Chevy Chase, MD 20815', 'david@gmail.com', '111-222-3333', NULL, 'Lorem ipsum dolor sit amet, ad vim ludus sapientem hendrerit, reque minimum ex eam. Vix dolorem vocibus adversarium eu, pro no fabulas nusquam. Has nisl paulo ea, sed propriae repudiare ad, eam postea placerat eu. Sit apeirian invenire adolescens no. Dictas aliquip viderer ut ius, ex magna eligendi expetenda mea.\r\n\r\nQuas prompta eruditi in mea, an his omnes suavitate efficiantur. Esse nonumes adversarium vim ex, facete patrioque at mel. In dicit eripuit est, natum invidunt ut est. Mea ea diceret appareat temporibus. Ad nam affert laudem vulputate. Eu decore suscipit qui.\r\n\r\nPersecuti efficiendi mel cu, nonumes maiestatis sit ad. Ne nam soleat fuisset. Pri et odio verterem eloquentiam. Altera consulatu percipitur per cu, et debet oporteat nec. Tantas laboramus est ei, mea aliquid ornatus ne.', '2023-12-19 00:18:50', '2023-12-19 00:40:29'),
(3, 'Peter Smith', 'Volunteer', 'volunteer_1702966766.jpg', '#', '#', '#', '#', '932 Pine Tree Lane, Chevy Chase, MD 20815', 'peter@gmail.com', '111-222-3333', NULL, 'Impetus docendi phaedrum ut est, errem patrioque vituperata mei ei, vis ad homero invenire. Qui habeo ridens albucius at, quo diam aperiri theophrastus no. Pro prima novum explicari no, sit et case liberavisse. Et ius saepe feugait.\r\n\r\nCum tota eripuit dissentias eu. Eam in amet hendrerit constituam, mazim altera vix ei. Id mel viderer utroque debitis, agam concludaturque eam ad. Cum justo meliore fabellas ei, te pri affert mucius. Est purto debet error an, vel ludus argumentum in.\r\n\r\nIn eos choro erroribus, tota simul pri ei. Quis eros no duo, sit et quod saperet constituam. Ut affert omnium debitis quo, has debet impedit eu. Unum senserit et mel, sea in menandri mandamus. In vim oblique mentitum, mea veri deleniti ei, ex nam probo dicam periculis.', '2023-12-19 00:19:26', '2023-12-19 00:19:26'),
(4, 'Brent Grundy', 'Volunteer', 'volunteer_1702966803.jpg', '#', '#', '#', '#', '932 Pine Tree Lane, Chevy Chase, MD 20815', 'brent@gmail.com', '111-222-3333', NULL, 'Quo ubique graece tacimates in, viderer voluptatum voluptatibus no has. Constituto interpretaris ut nec, eam te possim postulant. Idque eruditi labores quo id. At lucilius consequat constituam vix. Duo oblique urbanitas et, ex eum affert euismod delicatissimi. Ut cum discere verterem reformidans, eu mea hinc aliquam salutatus.\r\n\r\nQuodsi albucius salutatus cum ea, duo ea option deleniti. Ne eam luptatum neglegentur, ut liber quaestio tractatos pri. Ad his purto recusabo quaestio, ex per agam laboramus, ad mel saperet repudiare. Per idque legere utroque ut, ne ignota eruditi nominavi vis. Te eros porro evertitur nam, id aperiri persius dolorem nec, sed at nostro integre. Recteque voluptatum ad per, possim iuvaret laboramus cu vel.', '2023-12-19 00:20:03', '2023-12-19 00:20:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cause_donations`
--
ALTER TABLE `cause_donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cause_faqs`
--
ALTER TABLE `cause_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cause_photos`
--
ALTER TABLE `cause_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cause_videos`
--
ALTER TABLE `cause_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_photos`
--
ALTER TABLE `event_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tickets`
--
ALTER TABLE `event_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_videos`
--
ALTER TABLE `event_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_items`
--
ALTER TABLE `home_page_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_page_items`
--
ALTER TABLE `other_page_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_categories`
--
ALTER TABLE `photo_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_post_category_id_foreign` (`post_category_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specials`
--
ALTER TABLE `specials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_categories`
--
ALTER TABLE `video_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cause_donations`
--
ALTER TABLE `cause_donations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cause_faqs`
--
ALTER TABLE `cause_faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cause_photos`
--
ALTER TABLE `cause_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cause_videos`
--
ALTER TABLE `cause_videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_photos`
--
ALTER TABLE `event_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event_tickets`
--
ALTER TABLE `event_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `event_videos`
--
ALTER TABLE `event_videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_page_items`
--
ALTER TABLE `home_page_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `other_page_items`
--
ALTER TABLE `other_page_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `photo_categories`
--
ALTER TABLE `photo_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specials`
--
ALTER TABLE `specials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `video_categories`
--
ALTER TABLE `video_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_post_category_id_foreign` FOREIGN KEY (`post_category_id`) REFERENCES `post_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
