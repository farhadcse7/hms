-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 03:46 PM
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
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Business'),
(3, 'Country'),
(4, 'City'),
(5, 'Big Hotel');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `person_comment` text NOT NULL,
  `person_name` varchar(100) NOT NULL,
  `person_email` varchar(100) NOT NULL,
  `date_and_time` varchar(200) NOT NULL,
  `comment_status` varchar(30) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `person_comment`, `person_name`, `person_email`, `date_and_time`, `comment_status`, `post_id`) VALUES
(1, 'Officia labore magna', 'Sacha Sexton', 'niheteviko@mailinator.com', 'Nov 01, 2024 at 11:25 pm', 'Active', 7),
(2, 'Esse labore error l', 'Amelia Livingston', 'vonahus@mailinator.com', 'Nov 02, 2024 at 05:06 pm', 'Active', 9),
(4, 'Est do eos repellen', 'Signe Olsen', 'xeqebapeq@mailinator.com', 'Nov 02, 2024 at 05:56 pm', 'Inactive', 9);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_phone` varchar(100) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_password` varchar(100) NOT NULL,
  `cust_hash` varchar(200) NOT NULL,
  `cust_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_phone`, `cust_email`, `cust_password`, `cust_hash`, `cust_active`) VALUES
(1, 'farhad', '+1 (448) 681-3573', 'fmfarhad23@gmail.com', 'fab4eeb989c413808d47748b4adc304e', '', 1),
(2, 'mia', '+1 (663) 119-2879', 'miafm6@gmail.com', 'fab4eeb989c413808d47748b4adc304e', '', 1),
(3, 'Nyssa Molina', '+1 (145) 949-1388', 'hevixuku@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '1399a1ec17edda9082b98be4fe400641', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `feature_id` int(11) NOT NULL,
  `feature_title` varchar(200) NOT NULL,
  `feature_text` text NOT NULL,
  `feature_icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`feature_id`, `feature_title`, `feature_text`, `feature_icon`) VALUES
(2, 'Rerum voluptatem ad ', 'Quaerat sit dolor c', 'fa-credit-card'),
(3, 'Voluptas incidunt n', 'Enim dicta porro ess', 'fa-cutlery'),
(4, 'Aliqua Incididunt a', 'Molestiae velit laud', 'fa-facebook'),
(8, 'Numquam recusandae ', 'Numquam recusandae ', 'fa-glass');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `page_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_name`, `page_title`) VALUES
(1, 'feature_add.php', 'Add Feature'),
(2, 'feature_delete.php', 'Delete Feature'),
(3, 'feature_edit.php', 'Edit Feature'),
(4, 'feature_view.php', 'View Feature'),
(5, 'index.php', 'Dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL,
  `photo_name` varchar(100) NOT NULL,
  `photo_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`photo_id`, `photo_name`, `photo_category_id`) VALUES
(1, 'gallery_photo_1.jpg', 1),
(2, 'gallery_photo_2.jpg', 3),
(3, 'gallery_photo_3.jpg', 3),
(4, 'gallery_photo_4.jpg', 2),
(5, 'gallery_photo_5.jpg', 3),
(6, 'gallery_photo_6.jpg', 2),
(7, 'gallery_photo_7.jpg', 2),
(8, 'gallery_photo_8.jpg', 3),
(9, 'gallery_photo_9.jpg', 1),
(10, 'gallery_photo_10.jpg', 2),
(11, 'gallery_photo_11.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `photo_category`
--

CREATE TABLE `photo_category` (
  `photo_category_id` int(11) NOT NULL,
  `photo_category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_category`
--

INSERT INTO `photo_category` (`photo_category_id`, `photo_category_name`) VALUES
(1, 'Restaurant'),
(2, 'Swimming Pool'),
(3, 'Rooms');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_short_description` text NOT NULL,
  `post_description` text NOT NULL,
  `post_photo` varchar(200) NOT NULL,
  `post_day` varchar(2) NOT NULL,
  `post_month` varchar(2) NOT NULL,
  `post_year` varchar(4) NOT NULL,
  `total_view` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_short_description`, `post_description`, `post_photo`, `post_day`, `post_month`, `post_year`, `total_view`, `user_id`) VALUES
(2, 'room best', 'Est necessitatibus ', '<p>aa</p>\r\n\r\n<p><a href=\"http://localhost/hms/blog-post.html\"><img alt=\"image\" src=\"http://localhost/hms/images/blog/slide2.jpg\" style=\"height:200px; width:547px\" /></a></p>\r\n\r\n<p>Apr14</p>\r\n\r\n<h2>&nbsp;</h2>\r\n', 'post_2.jpg', '16', '10', '2024', 25, 1),
(5, 'car', 'aa', '<p>adf</p>\r\n', 'post_5.jpg', '01', '10', '2024', 10, 1),
(6, 'honda', 'Debitis dolor aspern', '<p>Debitis dolor aspern Debitis dolor aspern Debitis dolor aspern Debitis dolor aspernDebitis dolor aspern</p>\r\n', 'post_6.jpg', '02', '10', '2024', 7, 2),
(7, 'nice bed', 'Non vel et tenetur m', '<p>fargad</p>\r\n', 'post_7.jpg', '06', '11', '2024', 6, 2),
(9, 'adf', 'Dolore quia voluptat', 'Dolore repellendus ', 'post_9.jpg', '06', '11', '2024', 31, 2),
(10, 'posts posts ', 'Odit impedit in mag', '<p>ad</p>\r\n', 'post_10.jpg', '02', '11', '2024', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`post_category_id`, `post_id`, `category_id`) VALUES
(4, 2, 5),
(5, 2, 2),
(6, 2, 4),
(7, 3, 5),
(8, 3, 2),
(9, 3, 3),
(11, 4, 5),
(12, 4, 3),
(23, 5, 5),
(24, 5, 2),
(25, 5, 3),
(26, 6, 5),
(27, 6, 2),
(28, 7, 5),
(29, 7, 2),
(30, 7, 4),
(32, 9, 4),
(33, 9, 3),
(34, 10, 5),
(35, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_tag_id`, `post_id`, `tag_name`) VALUES
(4, 2, 'hotel'),
(5, 2, 'restaturant'),
(16, 5, 'mia'),
(19, 5, 'hotel'),
(20, 6, 'mia'),
(22, 5, 'car'),
(23, 6, 'honda'),
(24, 7, 'bed'),
(26, 10, 'hotel'),
(27, 10, 'bad');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `person_comment` text NOT NULL,
  `person_name` varchar(100) NOT NULL,
  `person_email` varchar(100) NOT NULL,
  `date_and_time` varchar(200) NOT NULL,
  `reply_status` varchar(30) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `person_comment`, `person_name`, `person_email`, `date_and_time`, `reply_status`, `comment_id`) VALUES
(1, 'Nulla quae quasi qui', 'Kelsie Jenkins', 'zyfygo@mailinator.com', 'Nov 02, 2024 at 05:55 pm', 'Inactive', 2),
(2, 'Nulla quae quasi qui', 'Kelsie Jenkins', 'zyfygo@mailinator.com', 'Nov 02, 2024 at 05:55 pm', 'Inactive', 2),
(3, 'Et labore voluptatum', 'Gail Knapp', 'hifyk@mailinator.com', 'Nov 02, 2024 at 05:55 pm', 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Developer'),
(2, 'Admin'),
(3, 'Blogger'),
(4, 'Manager'),
(6, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `role_access`
--

CREATE TABLE `role_access` (
  `role_access_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `access_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_access`
--

INSERT INTO `role_access` (`role_access_id`, `role_id`, `page_id`, `access_status`) VALUES
(6, 4, 5, 1),
(7, 4, 1, 1),
(8, 4, 2, 0),
(9, 4, 3, 1),
(10, 4, 4, 1),
(11, 3, 1, 1),
(12, 3, 2, 0),
(13, 3, 3, 0),
(14, 3, 4, 0),
(15, 3, 5, 1),
(16, 6, 1, 0),
(17, 6, 2, 0),
(18, 6, 3, 0),
(19, 6, 4, 1),
(20, 6, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_title` varchar(200) NOT NULL,
  `service_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_title`, `service_text`) VALUES
(1, 'Our Menus', 'Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1 Service 1'),
(2, 'Events', 'Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2 Service 2'),
(3, 'Kids', 'Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3 Service 3'),
(4, 'Ambulance', 'Our ambulance are always ready for you. When you will need, you can call in this number +122 999 3322. We will reach at your room as early as possible.'),
(14, 'sadsdf', '<p><a href=\"https://bikroy.com/bn/ad/full-furnished-apartment-rent-in-gulshan-1-for-rent-dhaka-2\"><img alt=\"Full Furnished Apartment Rent in Gulshan 1\" src=\"https://i.bikroy-st.com/full-furnished-apartment-rent-in-gulshan-1-for-rent-dhaka-2/90aee208-cc0d-416b-92a3-323b88bfb4ee/142/107/cropped.webp\" /></a></p>\r\n\r\n<h2><a href=\"https://bikroy.com/bn/ad/full-furnished-apartment-rent-in-gulshan-1-for-rent-dhaka-2\">Full Furnished Apartment Rent in Gulshan 1</a></h2>\r\n\r\n<p><a href=\"https://bikroy.com/bn/ad/full-furnished-apartment-rent-in-gulshan-1-for-rent-dhaka-2\">বেড: ৩, বাথ: ৩</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"https://bikroy.com/bn/ad/full-furnished-apartment-rent-in-gulshan-1-for-rent-dhaka-2\">সদস্য</a></p>\r\n\r\n<p><a href=\"https://bikroy.com/bn/ad/full-furnished-apartment-rent-in-gulshan-1-for-rent-dhaka-2\">ঢাকা, ফ্ল্যাট ভাড়া</a></p>\r\n\r\n<p><a href=\"https://bikroy.com/bn/ad/full-furnished-apartment-rent-in-gulshan-1-for-rent-dhaka-2\">৳ ৮০,০০০ প্রতি মাসে</a></p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(200) NOT NULL,
  `slider_subtitle` varchar(200) NOT NULL,
  `slider_button_text` varchar(100) NOT NULL,
  `slider_button_url` varchar(100) NOT NULL,
  `slider_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_subtitle`, `slider_button_text`, `slider_button_url`, `slider_photo`) VALUES
(5, 'Architecto in qui ac', 'Illo maiores eligend', 'Qui velit nisi moles', 'Vitae minim occaecat', 'slider_5.jpg'),
(6, 'Et non id molestiae', 'Laborum nulla dolore', 'Temporibus corporis ', 'Quae unde itaque vol', 'slider_6.jpg'),
(7, 'Duis dolor id possim', 'Omnis ullam laborum ', 'Hic non sint unde ut', 'Et numquam a enim as', 'slider_7.jpg'),
(8, 'Itaque ex quos non a', 'Suscipit est nulla ', 'Error eum sit pariat', 'Voluptas neque volup', 'slider_8.jpg'),
(9, 'Sint dolorem dolor e', 'Eveniet nihil dolor', 'Corrupti ut asperna', 'Tempor provident il', 'slider_9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `testimonial_id` int(11) NOT NULL,
  `person_name_designation` varchar(200) NOT NULL,
  `person_comment` text NOT NULL,
  `person_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `person_name_designation`, `person_comment`, `person_photo`) VALUES
(1, 'Lavinia Cleveland', 'Minima blanditiis mo', 'person_1.jpg'),
(2, 'Jamalia Mills', 'Sequi vel beatae ips', 'person_2.jpg'),
(3, 'Jerome Johnston', 'Nostrud et sequi inv', 'person_3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_hash` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_full_name`, `user_email`, `user_password`, `user_hash`, `role_id`) VALUES
(1, 'Farhad Mia', 'developer@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 1),
(2, 'Admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 2),
(5, 'manager@gmail.com', 'manager@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 4),
(6, 'blogger', 'blogger@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 3),
(7, 'user', 'user@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `photo_category`
--
ALTER TABLE `photo_category`
  ADD PRIMARY KEY (`photo_category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`post_category_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_tag_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_access`
--
ALTER TABLE `role_access`
  ADD PRIMARY KEY (`role_access_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `photo_category`
--
ALTER TABLE `photo_category`
  MODIFY `photo_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `post_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `post_tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_access`
--
ALTER TABLE `role_access`
  MODIFY `role_access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
