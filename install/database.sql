-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2022 at 09:12 AM
-- Server version: 10.3.36-MariaDB-log-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nemosofts_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_active_log`
--

CREATE TABLE `tbl_active_log` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'info.nemosofts@gmail.com', '1641207064_16d9f780de73a8d785d6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `bid` int(11) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_info` varchar(500) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_post_id` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favourite`
--

CREATE TABLE `tbl_favourite` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_like`
--

CREATE TABLE `tbl_like` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `like_type` varchar(255) NOT NULL DEFAULT 'like',
  `created_at` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_live`
--

CREATE TABLE `tbl_live` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `live_title` varchar(255) NOT NULL,
  `live_url` text NOT NULL,
  `live_image` varchar(255) NOT NULL,
  `live_type` varchar(255) NOT NULL,
  `live_description` text NOT NULL,
  `isPremium` varchar(20) NOT NULL DEFAULT 'false',
  `rate_avg` int(11) NOT NULL DEFAULT 0,
  `total_rate` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_share` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `notification_msg` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `notification_on` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `device_id` varchar(40) NOT NULL,
  `rate` int(11) NOT NULL,
  `message` text NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_title` varchar(255) NOT NULL,
  `report_msg` text NOT NULL,
  `report_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_name` varchar(100) NOT NULL,
  `app_logo` varchar(200) NOT NULL,
  `app_email` varchar(100) NOT NULL,
  `app_author` varchar(100) NOT NULL,
  `app_contact` varchar(100) NOT NULL,
  `app_website` varchar(150) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(150) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `app_terms` text NOT NULL,
  `account_delete_intruction` text NOT NULL,
  `envato_buyer_name` varchar(100) NOT NULL,
  `envato_purchase_code` text NOT NULL,
  `envato_package_name` varchar(150) NOT NULL,
  `envato_api_key` text NOT NULL,
  `onesignal_app_id` text NOT NULL,
  `onesignal_rest_key` text NOT NULL,
  `home_limit` int(2) NOT NULL DEFAULT 10,
  `api_latest_limit` int(2) NOT NULL DEFAULT 10,
  `api_cat_order_by` varchar(150) NOT NULL DEFAULT 'category_name',
  `api_cat_post_order_by` varchar(150) NOT NULL DEFAULT 'DESC',
  `app_api_key` varchar(150) NOT NULL,
  `ad_network` varchar(30) NOT NULL DEFAULT 'admob',
  `publisher_id` text NOT NULL,
  `start_ads_id` text NOT NULL,
  `unity_ads_id` text NOT NULL,
  `iron_ads_id` text NOT NULL,
  `banner_ad` varchar(10) NOT NULL DEFAULT 'true',
  `banner_ad_id` text NOT NULL,
  `banner_facebook_id` text NOT NULL,
  `banner_applovins_id` text NOT NULL,
  `interstital_ad` varchar(10) NOT NULL DEFAULT 'true',
  `interstital_ad_id` text NOT NULL,
  `interstital_facebook_id` text NOT NULL,
  `interstital_applovins_id` text NOT NULL,
  `interstital_ad_click` int(10) NOT NULL DEFAULT 5,
  `native_ad` varchar(10) NOT NULL DEFAULT 'true',
  `native_ad_id` text NOT NULL,
  `native_facebook_id` text NOT NULL,
  `native_applovins_id` text NOT NULL,
  `native_position` int(10) NOT NULL DEFAULT 5,
  `ads_limits` varchar(10) NOT NULL DEFAULT 'true',
  `ads_count_click` int(10) NOT NULL DEFAULT 20,
  `custom_ads` varchar(10) NOT NULL DEFAULT 'false',
  `custom_ads_img` varchar(200) NOT NULL,
  `custom_ads_link` text NOT NULL,
  `custom_ads_clicks` int(10) NOT NULL DEFAULT 12,
  `isRTL` varchar(10) NOT NULL DEFAULT 'false',
  `isVPN` varchar(10) NOT NULL DEFAULT 'false',
  `isAPK` varchar(10) NOT NULL DEFAULT 'false',
  `isMaintenance` varchar(10) NOT NULL DEFAULT 'false',
  `isScreenshot` varchar(10) NOT NULL DEFAULT 'true',
  `isLogin` varchar(10) NOT NULL DEFAULT 'true',
  `isGoogleLogin` varchar(10) NOT NULL DEFAULT 'true',
  `isDummy_1` varchar(10) NOT NULL DEFAULT 'false',
  `isDummy_2` varchar(10) NOT NULL DEFAULT 'false',
  `isDummy_3` varchar(10) NOT NULL DEFAULT 'false',
  `isDummy_4` varchar(10) NOT NULL DEFAULT 'false',
  `isDummy_5` varchar(10) NOT NULL DEFAULT 'false',
  `app_update_status` varchar(10) NOT NULL DEFAULT 'false',
  `app_new_version` double NOT NULL DEFAULT 1,
  `app_update_desc` text NOT NULL,
  `app_redirect_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_name`, `app_logo`, `app_email`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `app_terms`, `account_delete_intruction`, `envato_buyer_name`, `envato_purchase_code`, `envato_package_name`, `envato_api_key`, `onesignal_app_id`, `onesignal_rest_key`, `home_limit`, `api_latest_limit`, `api_cat_order_by`, `api_cat_post_order_by`, `app_api_key`, `ad_network`, `publisher_id`, `start_ads_id`, `unity_ads_id`, `iron_ads_id`, `banner_ad`, `banner_ad_id`, `banner_facebook_id`, `banner_applovins_id`, `interstital_ad`, `interstital_ad_id`, `interstital_facebook_id`, `interstital_applovins_id`, `interstital_ad_click`, `native_ad`, `native_ad_id`, `native_facebook_id`, `native_applovins_id`, `native_position`, `ads_limits`, `ads_count_click`, `custom_ads`, `custom_ads_img`, `custom_ads_link`, `custom_ads_clicks`, `isRTL`, `isVPN`, `isAPK`, `isMaintenance`, `isScreenshot`, `isLogin`, `isGoogleLogin`, `isDummy_1`, `isDummy_2`, `isDummy_3`, `isDummy_4`, `isDummy_5`, `app_update_status`, `app_new_version`, `app_update_desc`, `app_redirect_url`) VALUES
(1, 'Online Live TV', '93839_logo.jpg', 'info.nemosofts@gmail.com', 'nemosofts', '0356525684', 'nemosofts.com', 'Love this app? Let us Know in the Google Play Store how we can make it even better', 'thivakaran', '', '', '', '', '', '', '', '', '', 20, 50, 'cid', 'DESC', '', 'admob', 'ca-app-pub-3940256099942544~3347511713', '2347511713', '0047511713', '3747511700', 'true', 'ca-app-pub-3940256099942544/6300978111', '3347511713', '54353153486156', 'true', 'ca-app-pub-3940256099942544/1033173712', '3347511713', '54353153486156', 5, 'true', 'ca-app-pub-3940256099942544/2247696110', '3347511713', '54353153486156', 6, 'true', 20, 'true', 'https://camo.envatousercontent.com/47d826c1e095bc24a744c5f014330a03318ae300/68747470733a2f2f646f776e6c6f61642e6e656d6f736f6674732e636f6d2f656e7661746f2f72657364657369676e2e706e67', 'https://codecanyon.net/user/nemosofts', 12, 'false', 'false', 'false', 'false', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp_settings`
--

CREATE TABLE `tbl_smtp_settings` (
  `id` int(5) NOT NULL,
  `smtp_type` varchar(20) NOT NULL DEFAULT 'server',
  `smtp_host` varchar(150) NOT NULL,
  `smtp_email` varchar(150) NOT NULL,
  `smtp_password` text NOT NULL,
  `smtp_secure` varchar(20) NOT NULL,
  `port_no` varchar(10) NOT NULL,
  `smtp_ghost` varchar(150) NOT NULL,
  `smtp_gemail` varchar(150) NOT NULL,
  `smtp_gpassword` text NOT NULL,
  `smtp_gsecure` varchar(20) NOT NULL,
  `gport_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_smtp_settings`
--

INSERT INTO `tbl_smtp_settings` (`id`, `smtp_type`, `smtp_host`, `smtp_email`, `smtp_password`, `smtp_secure`, `port_no`, `smtp_ghost`, `smtp_gemail`, `smtp_gpassword`, `smtp_gsecure`, `gport_no`) VALUES
(1, 'server', '', '', '', 'ssl', '465', '', '', '', 'tls', 587);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE `tbl_subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `duration` text NOT NULL,
  `price` text NOT NULL,
  `currency_code` text NOT NULL,
  `subscription_id` text NOT NULL,
  `base_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_subscription`
--

INSERT INTO `tbl_subscription` (`id`, `name`, `duration`, `price`, `currency_code`, `subscription_id`, `base_key`) VALUES
(1, 'Starter', '30', '10', 'USD', 'test', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyMvYRe'),
(2, 'Advanced', '365', '50', 'USD', 'test', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyMvYRe'),
(4, 'Super Premium', '366', '99', 'USD', 'test', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyMvYRe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suggest`
--

CREATE TABLE `tbl_suggest` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `suggest_title` varchar(500) NOT NULL,
  `suggest_image` varchar(255) DEFAULT NULL,
  `suggest_message` text DEFAULT NULL,
  `suggest_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `end_date_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'Normal',
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(70) NOT NULL,
  `user_password` text NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT '0',
  `auth_id` varchar(255) NOT NULL DEFAULT '0',
  `registered_on` varchar(200) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_like`
--
ALTER TABLE `tbl_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_live`
--
ALTER TABLE `tbl_live`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_suggest`
--
ALTER TABLE `tbl_suggest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_like`
--
ALTER TABLE `tbl_like`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_live`
--
ALTER TABLE `tbl_live`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_suggest`
--
ALTER TABLE `tbl_suggest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;