-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2023 at 12:51 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20728324_webio`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `name`, `comment`, `created_at`) VALUES
(91, 130, 39, 'admin', 'asdasd', '2023-06-05 19:18:55'),
(95, 134, 40, 'test', 'test', '2023-06-06 12:19:25'),
(99, 130, 41, 'test', 'test', '2023-06-17 21:43:08'),
(100, 134, 40, 'asd', 'sad', '2023-06-20 01:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `userEmail` varchar(100) NOT NULL,
  `subject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `userEmail`, `subject`) VALUES
(8, NULL, 'Pitanje kao guest', 'Neko pitanje... ?'),
(9, 100, 'Pitanje kao test korisnik', 'Drugo pitanje... ?'),
(18, NULL, 'neki naslov', 'bla bla'),
(19, NULL, 'neki naslov opet', 'userski odg'),
(20, 105, 'aj opet', 'aksdflksflsdf'),
(21, NULL, 'Naslov', 'lalala'),
(22, 125, 'asd@gmail.com', 'asd'),
(23, 125, 'asd@gmail.com', 'sdfsdfsdf'),
(24, 125, 'asd@gmail.com', 'asd'),
(25, 125, 'asd@gmail.com', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

CREATE TABLE `galerija` (
  `id` int(11) NOT NULL,
  `putanja` text NOT NULL,
  `alt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `galerija`
--

INSERT INTO `galerija` (`id`, `putanja`, `alt`) VALUES
(1, 'event.jpg', 'Event Website'),
(2, 'commerc.jpg', 'eCommerce Website'),
(3, 'business.jpg', 'Business Website'),
(4, 'personal.jpg', 'Personal Website');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(185, 1, 41),
(186, 1, 41),
(187, 1, 41),
(188, 1, 41),
(189, 1, 41),
(190, 1, 41),
(191, 1, 41),
(192, 1, 41),
(193, 1, 41),
(194, 1, 41),
(195, 1, 41),
(196, 1, 41),
(197, 1, 41),
(198, 1, 41),
(199, 1, 41),
(219, 1, 40),
(220, 1, 40),
(221, 1, 40),
(222, 1, 40),
(223, 1, 40),
(224, 1, 40),
(225, 1, 40),
(226, 1, 40),
(256, 1, 39),
(257, 1, 39),
(258, 1, 39),
(259, 1, 39),
(260, 1, 39),
(261, 1, 39),
(262, 1, 39),
(263, 1, 39),
(264, 1, 39),
(265, 1, 39);

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `href` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `title`, `href`) VALUES
(10, 'Home', 'index'),
(11, 'Contact', 'contact'),
(12, 'More', 'more'),
(13, 'Gallery', 'gallery'),
(14, 'Author', 'author');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `published` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `topic_id`, `title`, `image`, `content`, `likes`, `published`, `created_at`) VALUES
(39, 130, 30, 'Business website', '1686013695_business.jpg', 'No longer feasible to run a business, even a brick-and-mortar one, without a web presence. Consumers turn to the internet for everything from product research to location and operating hours. Even just a simple, well-designed website can give you an edge in your field, and if you have products to sell, your site can open up new markets and expand your business cheaply and easily. \r\n\r\nWebsite design software has evolved to be easy for anyone to use. You don&amp;amp;rsquo;t need to know coding to develop an attractive and functional site. No matter what program you use, you just need to follow some basic rules and tips to give your website a professional look, make it easy to find, and show your company in the best light.\r\n', 4, 1, '2023-06-05 19:01:44'),
(40, 130, 26, 'eCommerce website', '1686013848_ecommerce-website.png', 'An e-commerce website is one that allows people to buy and sell physical goods, services, and digital products over the internet rather than at a brick-and-mortar location. Through an e-commerce website, a business can process orders, accept payments, manage shipping and logistics, and provide customer service.\r\n\r\nIt&amp;amp;rsquo;s tough to imagine daily life without e-commerce. We order food, clothes, and furniture; we register for classes and other online services; we download books, music, and movies; and so much more. E-commerce has taken root and is here to stay.\r\n\r\nThe term &amp;amp;ldquo;e-commerce&amp;amp;rdquo; simply means the sale of goods or services on the internet. In its most basic form, e-commerce involves electronically transferring funds and data between 2 or more parties. This form of business has evolved quite a bit since its beginnings in the electronic data interchange of the 1960s and the inception of online shopping in the 1990s.\r\n\r\nIn recent years, e-commerce has enjoyed a massive boost from the rise of smartphones, which allow consumers to shop from nearly anywhere.\r\n', 23, 1, '2023-06-05 19:03:34'),
(41, 130, 29, 'Membership website', '1686013680_memebrship.png', 'What is a Membership Website? In its simplest form, a membership website is a gated site that includes members-only content. They\'re used by nonprofits, clubs, associations and even businesses to &ldquo;gate&rdquo; content that only members have access to in order to provide additional value.', 24, 1, '2023-06-06 01:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `answer`) VALUES
(1, 'Very good'),
(2, 'Good'),
(3, 'Mediocre'),
(4, 'Bad'),
(5, 'Very bad');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(26, 'eCommerce', 'An e-commerce website is one that allows people to buy and sell physical goods, services, and digital products \r\nover the internet rather than at a brick-and-mortar location.'),
(27, 'Personal', 'A personal website or portfolio is an opportunity to reach more people with your work.'),
(28, 'Event', 'One of the most important parts of your event website is the event description! Focus on making your description informative and succinct!\r\n'),
(29, 'Membership', 'One of the most important parts of your event website is the event description! Focus on making your d\r\nescription informative and succinct!'),
(30, 'Business', 'A business website can be as simple as a page with your business\'s brand and contact details to a complete online store.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `failed_login_attempts` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `last_failed_login` datetime DEFAULT NULL,
  `lock_reset_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `email`, `password`, `failed_login_attempts`, `created_at`, `locked`, `last_failed_login`, `lock_reset_time`) VALUES
(130, 1, 'admin', 'admin@gmail.com', '$2y$10$AkeAaXlsPbDe0KVwo4/AN.2LMP7rvx683dVfZDg8sRdQ3E3tU3oAW', 1, '2023-06-05 18:45:07', 0, NULL, NULL),
(134, 0, 'user', 'user1@gmail.com', '$2y$10$xaHiu6sD3MsvihgLewjS8eXt8.YCO7CIP3wym5GmKbyCoZw0AV1F6', 1, '2023-06-06 00:09:34', 1, NULL, '2023-06-20 01:13:40'),
(139, 0, 'novi', 'novi@gmail.com', '$2y$10$4D0WgqSSxEnE7Sp4xyi/oe8SsOC8QtewFwUOuA9q8Hj4X73JMU/Jm', 2, '2023-06-06 15:12:37', 1, NULL, '2023-06-06 15:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_answer`
--

INSERT INTO `user_answer` (`id`, `user_id`, `answer_id`) VALUES
(6, 100, 3),
(7, 100, 5),
(8, 100, 5),
(9, 100, 1),
(10, 100, 4),
(11, 100, 3),
(12, 100, 1),
(13, 125, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galerija`
--
ALTER TABLE `galerija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `galerija`
--
ALTER TABLE `galerija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
