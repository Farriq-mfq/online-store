-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 12:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$h1InPwVr0s.tldsWWRoZXuzo2DjJWxqprlMzmbHsMHgpHBD4wsZ8K');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `image_name` varchar(150) NOT NULL,
  `banner_location` enum('BOTTOM_SLIDER','BOTTOM_OFFER','LONG_BANNER') NOT NULL DEFAULT 'BOTTOM_SLIDER',
  `title` varchar(150) DEFAULT NULL,
  `paragraph` varchar(200) DEFAULT NULL,
  `link_label` varchar(20) DEFAULT NULL,
  `link` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `image`, `image_name`, `banner_location`, `title`, `paragraph`, `link_label`, `link`) VALUES
(3, 'http://localhost:8080/uploads/banners/1671781568_486371bf26299651dc0f.jpg', '1671781568_486371bf26299651dc0f.jpg', 'BOTTOM_SLIDER', 'asfdsfd', 'fds', 'fsd', 'http://localhost:8080/index.php/DEV_ADMIN/slider'),
(4, 'http://localhost:8080/uploads/banners/1671782180_0eca84a5139b4aa4971c.jpg', '1671782180_0eca84a5139b4aa4971c.jpg', 'LONG_BANNER', 'Buy 3. Get Free 1.', '50% off for selected products in Pustok.', 'See More', 'http://localhost:8080/index.php/DEV_ADMIN/slider'),
(6, 'http://localhost:8080/uploads/banners/1671782335_274d17c05bebdbc8aab4.jpg', '1671782335_274d17c05bebdbc8aab4.jpg', 'BOTTOM_SLIDER', '', '', '', 'http://localhost:8080/index.php/DEV_ADMIN/slider'),
(8, 'http://localhost:8080/uploads/banners/1671782405_dae81fa9f9b234d343d8.jpg', '1671782405_dae81fa9f9b234d343d8.jpg', 'BOTTOM_OFFER', '', '', '', 'http://localhost:8080/index.php/DEV_ADMIN/slider'),
(11, 'http://localhost:8080/uploads/banners/1671839954_bdf4c654934efad206d3.jpg', '1671839954_bdf4c654934efad206d3.jpg', 'BOTTOM_OFFER', '', '', '', 'http://localhost:8080/index.php/DEV_ADMIN/slider');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand`) VALUES
(1, 'Benjamin okhlahoma'),
(2, 'coba');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES
(1, NULL, 'sfd'),
(2, NULL, 'ARTS & PHOTOGRAPHY BOOKS'),
(3, 6, 'Funny'),
(4, NULL, 'sfdafasdf'),
(5, 3, 'new'),
(6, 2, 'Children\'s'),
(7, 2, 'Horor'),
(8, NULL, 'BIOGRAPHIES BOOKS'),
(9, NULL, ' CHILDREN’S BOOKS ');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-12-01-075204', 'App\\Database\\Migrations\\Tags', 'default', 'App', 1671767970, 1),
(2, '2022-12-02-103421', 'App\\Database\\Migrations\\ProductBrands', 'default', 'App', 1671767970, 1),
(3, '2022-12-02-112331', 'App\\Database\\Migrations\\ProductCategories', 'default', 'App', 1671767971, 1),
(4, '2022-12-02-112332', 'App\\Database\\Migrations\\Products', 'default', 'App', 1671767972, 1),
(5, '2022-12-02-112646', 'App\\Database\\Migrations\\ProductMeta', 'default', 'App', 1671767972, 1),
(6, '2022-12-02-120919', 'App\\Database\\Migrations\\ProductImages', 'default', 'App', 1671767972, 1),
(7, '2022-12-02-124836', 'App\\Database\\Migrations\\ProductTags', 'default', 'App', 1671767973, 1),
(8, '2022-12-02-130330', 'App\\Database\\Migrations\\Users', 'default', 'App', 1671767974, 1),
(9, '2022-12-02-132225', 'App\\Database\\Migrations\\SessionCart', 'default', 'App', 1671767974, 1),
(10, '2022-12-02-132538', 'App\\Database\\Migrations\\Slider', 'default', 'App', 1671767975, 1),
(11, '2022-12-03-010134', 'App\\Database\\Migrations\\ProductsComments', 'default', 'App', 1671767975, 1),
(12, '2022-12-03-010748', 'App\\Database\\Migrations\\ProductReviews', 'default', 'App', 1671767976, 1),
(14, '2022-12-03-051155', 'App\\Database\\Migrations\\ProductOrders', 'default', 'App', 1671767976, 1),
(15, '2022-12-03-104659', 'App\\Database\\Migrations\\OrdersRequestCenceled', 'default', 'App', 1671767977, 1),
(16, '2022-12-11-042245', 'App\\Database\\Migrations\\SessionEmoney', 'default', 'App', 1671767978, 1),
(17, '2022-12-11-233010', 'App\\Database\\Migrations\\PaymentProvider', 'default', 'App', 1671767978, 1),
(18, '2022-12-11-233046', 'App\\Database\\Migrations\\Payment', 'default', 'App', 1671767979, 1),
(19, '2022-12-15-110055', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1671767980, 1),
(20, '2022-12-15-111911', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1671767980, 1),
(22, '2022-12-22-235037', 'App\\Database\\Migrations\\UniqueVisitor', 'default', 'App', 1671767982, 1),
(25, '2022-12-23-054538', 'App\\Database\\Migrations\\Banner', 'default', 'App', 1671776663, 2),
(26, '2022-12-23-222608', 'App\\Database\\Migrations\\ProductDiscount', 'default', 'App', 1671834565, 3),
(28, '2022-12-24-012621', 'App\\Database\\Migrations\\SpecialOffer', 'default', 'App', 1671850634, 4),
(29, '2022-12-19-120942', 'App\\Database\\Migrations\\UserAddress', 'default', 'App', 1672104678, 5),
(31, '2022-12-03-050156', 'App\\Database\\Migrations\\Orders', 'default', 'App', 1672116536, 6);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `offer_start` datetime NOT NULL,
  `offer_end` datetime NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `offer_start`, `offer_end`, `product_id`, `created_at`) VALUES
(18, '2022-12-25 00:00:00', '2022-12-25 11:30:00', 1, '2022-12-24 10:39:00'),
(19, '2022-12-24 00:00:00', '2022-12-24 13:00:00', 3, '2022-12-24 11:02:36'),
(20, '2022-12-24 00:00:00', '2022-12-26 23:00:00', 10, '2022-12-24 11:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `midtrans_id` varchar(100) NOT NULL,
  `token` varchar(30) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `courier` varchar(100) NOT NULL,
  `shipping_tracking` varchar(100) DEFAULT NULL,
  `shipping_service` varchar(30) NOT NULL,
  `origin` int(11) DEFAULT NULL,
  `destination_origin` int(11) DEFAULT NULL,
  `status` enum('WAITING','PROCESS','SHIPPED','DONE','REJECT') NOT NULL DEFAULT 'WAITING',
  `discount` double DEFAULT NULL,
  `is_cencel` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `shipping_total` bigint(20) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `user_address_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'a6aa0b0d-ebce-4c42-aabc-2c1a6395b28f', '263aa7940829c0', 2, 'jne', NULL, 'REG', 349, 4, 'WAITING', NULL, 0, '', 0, 90560, 'bank_transfer', 2, '2022-12-27 11:49:26', '2022-12-27 11:49:26', '2022-12-27 11:49:26'),
(2, '9c0ffc38-3f81-4267-96ca-f48f656a87d9', '263aa7c423b264', 2, 'jne', NULL, 'REG', 349, 4, 'WAITING', NULL, 0, '', 69000, 90560, 'qris', 2, '2022-12-27 12:01:55', '2022-12-27 12:01:55', '2022-12-27 12:01:55'),
(3, '677f6e92-f574-4137-8816-d7518464ca33', '163aa7f43b2067', 1, 'jne', '123', 'OKE', 349, 177, 'SHIPPED', NULL, 0, '', 13000, 56126, 'bank_transfer', 5, '2022-12-27 12:15:05', '2022-12-27 12:15:05', '2022-12-28 10:23:23'),
(4, 'a7ba5953-5df1-4a46-9c27-5c43799088ba', '163aa80d79a333', 1, 'jne', NULL, 'OKE', 349, 250, 'WAITING', NULL, 0, '', 9000, 37500, 'bank_transfer', 6, '2022-12-27 12:21:28', '2022-12-27 12:21:28', '2022-12-27 12:21:28'),
(5, 'b771caac-c770-4e1c-b460-ebf2c3360309', '163aa81bf21be3', 1, 'jne', NULL, 'OKE', 349, 250, 'WAITING', NULL, 0, '', 9000, 51360, 'bank_transfer', 6, '2022-12-27 12:25:40', '2022-12-27 12:25:40', '2022-12-27 12:25:40'),
(6, 'bf68d251-273f-402b-9819-e033db0dca64', '163abb6df98966', 1, 'pos', NULL, 'Pos Reguler', 349, 39, 'WAITING', NULL, 0, '', 10000, 31560, 'qris', 7, '2022-12-28 10:24:16', '2022-12-28 10:24:16', '2022-12-28 10:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_cencel_request`
--

CREATE TABLE `order_cencel_request` (
  `order_cencel_request_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` double DEFAULT NULL,
  `total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES
(1, 4, 1, 2, NULL, 57000),
(2, 4, 3, 1, NULL, 10400),
(3, 4, 2, 1, NULL, 21560),
(4, 1, 2, 1, NULL, 21560),
(5, 2, 2, 1, NULL, 21560),
(6, 3, 12, 1, NULL, 6),
(7, 3, 2, 2, NULL, 43120),
(8, 4, 1, 1, NULL, 28500),
(9, 5, 3, 2, NULL, 20800),
(10, 5, 2, 1, NULL, 21560),
(11, 6, 2, 1, NULL, 21560);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `payment_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_provider`
--

CREATE TABLE `payment_provider` (
  `payment_provider_id` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `weight` int(11) NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `new_label` tinyint(1) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'addidas New Hammer sole for Sp', 'addidas-New-Hammer-sole-for-Sp', 'sfdsdfsfd', 'Capple', NULL, 9, 30000, 23, 1, 0, '                                                                                                                                                                Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;                                                                                                                                            ', 1, 12, '42', 1, '2022-12-23 15:02:16', '2022-12-24 07:50:53', NULL),
(2, 'Beats EP Wired On-Ear Headphone-Black', 'Beats-EP-Wired-On-Ear-Headphone-Black', 'Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman\'s wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!', 'Long printed dress with thin adjustable straps. V-neckline and wiring under the Dust with ruffles at the bottom of the dress.', NULL, 2, 22000, 12, 1, 1, '                                                                Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;                                                        ', 1, 12, '12', 1, '2022-12-24 05:01:01', '2022-12-24 07:50:25', NULL),
(3, 'addidas New Hammer sole for Sports person', 'addidas-New-Hammer-sole-for-Sports-person', 'adsasdasdads', '', NULL, 2, 13000, 213, 1, 0, '                                                                                                                                Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;                                                                                                                ', 1, 123, '123', 1, '2022-12-24 07:23:51', '2022-12-24 07:50:36', NULL),
(4, 'Distinctio cumque.', 'Distinctio-cumque', 'Aliquid architecto quos rerum laboriosam magni. Ullam aut eveniet amet saepe qui. Et omnis deleniti eligendi voluptatem saepe accusantium.', 'Et maxime et enim molestiae quaerat.', NULL, 1, 10000, 6, 1, 0, 'hallo bang', 1, 0, '1', 1, '2022-12-24 07:59:14', '2022-12-25 11:43:07', NULL),
(5, 'Eos vero.', 'Eos-vero', 'Sit perferendis et qui nulla. Necessitatibus id suscipit minima. Repellat quia ea et qui sapiente aut. Corrupti expedita eos nostrum debitis.', 'Eum deserunt doloribus voluptatem nulla nobis.', NULL, 2, 12000, 7, 1, 0, 'hallo bang', 1, 0, '1', 1, '2022-12-24 08:01:27', '2022-12-25 11:43:13', NULL),
(6, 'Qui ipsum eveniet.', 'Qui-ipsum-eveniet', 'Odit veritatis veniam in ut. Numquam ullam enim quam sed ab quod iusto. Eos voluptate non ea dolor.', 'Aperiam occaecati labore nihil.', NULL, 7, 50000, 6, 0, 0, 'hallo bang', 1, 0, '1', 1, '2022-12-24 08:01:27', '2022-12-25 11:43:18', NULL),
(7, 'Adipisci quia.', 'Adipisci-quia', 'Officia dolorum quos sint at rerum. Molestiae rerum tenetur qui et. Quia velit voluptas minus quo enim. Praesentium quod illo sit dicta.', 'Modi ad quisquam optio earum rerum.', NULL, 4, 8, 4, 1, 0, '&lt;p&gt;&lt;img style=&quot;width: 700px;&quot; src=&quot;data:image/jpeg;base64,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&quot; data-filename=&quot;product-3.jpg&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Arial&amp;quot;;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: &amp;quot;Arial&amp;quot;;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;table class=&quot;table table-bordered&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;berat&lt;br&gt;&lt;/td&gt;&lt;td&gt;sfd&lt;br&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;ringan&lt;br&gt;&lt;/td&gt;&lt;td&gt;sfd&lt;br&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;', 1, 1, '1', 2, '2022-12-24 08:01:27', '2022-12-26 09:10:34', NULL),
(8, 'Iure blanditiis id.', 'Iure-blanditiis-id', 'In nostrum corporis suscipit minima. Libero et ullam corporis omnis.', 'Non et soluta odit et architecto quibusdam.', NULL, 3, 1, 1, 1, 0, 'hallo bang', 1, 0, '1', NULL, '2022-12-24 08:01:27', '2022-12-24 08:17:36', NULL),
(9, 'Dolores et et aut.', 'Dolores-et-et-aut', 'Magni earum laborum odio dignissimos. Est enim ea non porro. Illo et aut sapiente rerum voluptatem. Modi et eum dolore et nobis.', 'Quam nulla aut unde sunt minus porro.', NULL, 7, 1, 4, 1, 0, 'hallo bang', 1, 0, '1', NULL, '2022-12-24 08:01:27', '2022-12-24 08:06:18', NULL),
(10, 'Officia ullam.', 'Officia-ullam', 'Sed porro placeat aliquam rem et at facilis. Quos quasi sed porro ducimus ut est. Commodi optio voluptatibus ut tempora corrupti et.', 'Et atque qui nisi omnis ullam nostrum accusamus.', NULL, 3, 15000, 0, 1, 0, '                                hallo bang                            ', 1, 0, '1', 1, '2022-12-24 08:01:27', '2022-12-24 12:03:23', NULL),
(11, 'Vero qui quas.', 'Vero-qui-quas', 'Error ducimus aut numquam mollitia. Dolor voluptate maiores voluptatum. Qui aspernatur itaque ea dolorem qui quia. Vel quo excepturi sunt aut sit.', 'Laboriosam sint dignissimos minus aut.', NULL, 7, 1, 1, 1, 0, 'hallo bang', 1, 0, '1', NULL, '2022-12-24 08:01:27', '2022-12-24 08:07:54', NULL),
(12, 'Non est est quas.', 'Non-est-est-quas', 'Sed odit quia quas eos ullam mollitia repellat. Aut consequatur labore culpa sint voluptatem repudiandae reiciendis.', 'Earum dicta aut inventore.', NULL, 9, 6, 4, 1, 1, 'hallo bang', 1, 0, '1', NULL, '2022-12-24 08:01:28', '2022-12-24 08:18:00', NULL),
(13, 'Qui id consequatur.', 'Qui-id-consequatur', 'Quis quis cupiditate voluptas reiciendis. Quos accusamus dolore reprehenderit nostrum. Impedit iste aperiam reiciendis sequi.', 'Aut consequatur est harum molestiae modi.', NULL, 4, 6, 8, 1, 0, 'hallo bang', 1, 0, '1', NULL, '2022-12-24 08:01:28', '2022-12-24 08:09:03', NULL),
(14, 'Animi quasi sint ea.', 'Animi-quasi-sint-ea', 'Similique maiores quisquam beatae aut. Omnis ea voluptatem velit error delectus. Nisi quia sit quia reprehenderit id sit et consequatur.', 'Qui dicta est error distinctio eveniet.', NULL, 1, 2, 0, 1, 0, 'hallo bang', 1, 0, '1', NULL, '2022-12-24 08:01:28', '2022-12-24 08:06:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `comment_id` int(11) NOT NULL,
  `replay_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

CREATE TABLE `product_discount` (
  `discount_id` int(11) NOT NULL,
  `discount_type` enum('PERCENTAGE','VALUE') NOT NULL DEFAULT 'PERCENTAGE',
  `discount_value` double NOT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_discount`
--

INSERT INTO `product_discount` (`discount_id`, `discount_type`, `discount_value`, `product_id`) VALUES
(2, 'PERCENTAGE', 2, 2),
(6, 'PERCENTAGE', 5, 1),
(7, 'PERCENTAGE', 20, 3),
(8, 'VALUE', 5000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mime` varchar(20) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES
(1, 'http://localhost:8080/uploads/products/1671782536_6cb6b9cf0b0cada1db61.jpg', '1671782536_6cb6b9cf0b0cada1db61.jpg', 'image/jpeg', 0, 1),
(2, 'http://localhost:8080/uploads/products/1671782571_67f8a987e75c91dceead.jpg', '1671782571_67f8a987e75c91dceead.jpg', 'image/jpeg', 1, 1),
(4, 'http://localhost:8080/uploads/products/1671832468_24bd68bed8254f887be3.jpg', '1671832468_24bd68bed8254f887be3.jpg', 'image/jpeg', 0, 1),
(5, 'http://localhost:8080/uploads/products/1671832861_e155a2ee2a1da7bba312.jpg', '1671832861_e155a2ee2a1da7bba312.jpg', 'image/jpeg', 1, 2),
(6, 'http://localhost:8080/uploads/products/1671841431_07040eccc78370c83e78.jpg', '1671841431_07040eccc78370c83e78.jpg', 'image/jpeg', 1, 3),
(7, 'http://localhost:8080/uploads/products/1671843092_2d0c49d3c36cf28f69fd.jpg', '1671843092_2d0c49d3c36cf28f69fd.jpg', 'image/jpeg', 0, 3),
(8, 'http://localhost:8080/uploads/products/1671843596_251fded0dff2b58b2542.jpg', '1671843596_251fded0dff2b58b2542.jpg', 'image/jpeg', 1, 4),
(9, 'http://localhost:8080/uploads/products/1671843716_6e0aec272e2bceda067f.jpg', '1671843716_6e0aec272e2bceda067f.jpg', 'image/jpeg', 1, 7),
(10, 'http://localhost:8080/uploads/products/1671843734_6e12df0c5e66d749ea4c.jpg', '1671843734_6e12df0c5e66d749ea4c.jpg', 'image/jpeg', 1, 14),
(11, 'http://localhost:8080/uploads/products/1671843754_9a811e572b34aba752af.jpg', '1671843754_9a811e572b34aba752af.jpg', 'image/jpeg', 1, 9),
(12, 'http://localhost:8080/uploads/products/1671843766_2c2b7940260903be4564.jpg', '1671843766_2c2b7940260903be4564.jpg', 'image/jpeg', 1, 8),
(13, 'http://localhost:8080/uploads/products/1671843780_124782418ad976cf044f.jpg', '1671843780_124782418ad976cf044f.jpg', 'image/jpeg', 1, 5),
(14, 'http://localhost:8080/uploads/products/1671843793_137e081ba6221382cffa.jpg', '1671843793_137e081ba6221382cffa.jpg', 'image/jpeg', 1, 12),
(15, 'http://localhost:8080/uploads/products/1671843803_cc31a2420c51e62f15da.jpg', '1671843803_cc31a2420c51e62f15da.jpg', 'image/jpeg', 1, 10),
(16, 'http://localhost:8080/uploads/products/1671843825_974bd30899a2374a5eca.jpg', '1671843825_974bd30899a2374a5eca.jpg', 'image/jpeg', 1, 13),
(17, 'http://localhost:8080/uploads/products/1671843842_bec5dc232945d94d0b79.jpg', '1671843842_bec5dc232945d94d0b79.jpg', 'image/jpeg', 1, 6),
(18, 'http://localhost:8080/uploads/products/1671843882_8293137bcda164e35cf1.jpg', '1671843882_8293137bcda164e35cf1.jpg', 'image/jpeg', 1, 11),
(19, 'http://localhost:8080/uploads/products/1671870575_34082d22d78f5dc59cc8.jpg', '1671870575_34082d22d78f5dc59cc8.jpg', 'image/jpeg', 0, 10),
(20, 'http://localhost:8080/uploads/products/1671943930_74f3ae794dfcacb3f778.jpg', '1671943930_74f3ae794dfcacb3f778.jpg', 'image/jpeg', 0, 10),
(21, 'http://localhost:8080/uploads/products/1671943940_80a7190789d054cb018b.jpg', '1671943940_80a7190789d054cb018b.jpg', 'image/jpeg', 0, 10),
(22, 'http://localhost:8080/uploads/products/1671943963_67bd6021b576cdb76b36.jpg', '1671943963_67bd6021b576cdb76b36.jpg', 'image/jpeg', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_meta`
--

CREATE TABLE `product_meta` (
  `meta_id` bigint(20) NOT NULL,
  `key` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_meta`
--

INSERT INTO `product_meta` (`meta_id`, `key`, `content`, `product_id`) VALUES
(2, 'meta-title', '&lt;p&gt;                                &lt;/p&gt;&lt;p&gt;Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;                            &lt;/p&gt;', 1),
(3, 'meta-description', '                                Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;                            ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'dfgdfgdfg', 3, 1, 1, '2022-12-24 14:55:57', '2022-12-24 15:02:27'),
(2, 'sfdsfsdfdsfsdf', 3, 1, 7, '2022-12-24 17:26:39', '2022-12-24 17:26:39'),
(10, 'dfgdfgdfgdfgdfgdf', 2, 1, 1, '2022-12-24 17:35:35', '2022-12-24 17:39:23'),
(11, 'bagus banget', 4, 1, 10, '2022-12-25 13:07:58', '2022-12-25 13:07:58'),
(16, 'keren', 5, 1, 1, '2022-12-26 06:27:27', '2022-12-26 06:27:27'),
(17, 'ok lah but \r\n', 2, 1, 6, '2022-12-26 06:27:40', '2022-12-26 06:27:40'),
(18, 'bagus\r\n', 4, 1, 5, '2022-12-26 06:29:53', '2022-12-26 06:29:53'),
(19, 'review products', 3, 1, 3, '2022-12-26 06:37:58', '2022-12-26 06:37:58'),
(20, 'ok\r\n', 3, 1, 2, '2022-12-26 08:17:52', '2022-12-26 08:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `products_tags_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 2, 3),
(5, 4, 7),
(6, 4, 7),
(7, 2, 4),
(8, 4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(200) NOT NULL,
  `admin_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session_cart`
--

CREATE TABLE `session_cart` (
  `session_cart_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `content` text DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_cart`
--

INSERT INTO `session_cart` (`session_cart_id`, `user_id`, `product_id`, `content`, `discount`, `quantity`, `price`, `total`, `product_img`) VALUES
(129, 2, 13, NULL, NULL, 1, 6, 6, 'http://localhost:8080/uploads/products/1671843825_974bd30899a2374a5eca.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `session_emoney`
--

CREATE TABLE `session_emoney` (
  `session_emoney_id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `method` varchar(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_emoney`
--

INSERT INTO `session_emoney` (`session_emoney_id`, `name`, `method`, `url`, `user_id`, `expired`) VALUES
(1, 'generate-qr-code', 'GET', 'https://api.sandbox.midtrans.com/v2/qris/9c0ffc38-3f81-4267-96ca-f48f656a87d9/qr-code', 2, '2022-12-27 12:16:53'),
(2, 'generate-qr-code', 'GET', 'https://api.sandbox.midtrans.com/v2/qris/bf68d251-273f-402b-9819-e033db0dca64/qr-code', 1, '2022-12-28 10:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `slider_id` bigint(20) NOT NULL,
  `image` varchar(200) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `title` varchar(50) NOT NULL,
  `subtitle` varchar(50) NOT NULL,
  `subtitle_color` varchar(50) DEFAULT NULL,
  `short_description` varchar(100) NOT NULL,
  `link_label` varchar(20) NOT NULL,
  `link` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slider_id`, `image`, `image_name`, `title`, `subtitle`, `subtitle_color`, `short_description`, `link_label`, `link`) VALUES
(5, 'http://localhost:8080/uploads/sliders/1671780769_da0b3633f418a68b7266.jpg', '1671780769_da0b3633f418a68b7266.jpg', 'HARD COVER', 'Book Mockup', '#61ab00', 'Cover up front of book and leave summary', 'Shop Now', 'http://localhost:8080/index.php/DEV_ADMIN/slider'),
(6, 'http://localhost:8080/uploads/sliders/1671803484_a426a5ea7fe3694f31ee.jpg', '1671803484_a426a5ea7fe3694f31ee.jpg', 'Big Promo', 'Promo Beneran', '#80ff00', 'Menangkan Berbagai hadiah unik', 'Shop Now', 'http://localhost:8080/index.php/DEV_ADMIN/slider'),
(9, 'http://localhost:8080/uploads/sliders/1671804055_2e55a2e9bcf3d198e368.png', '1671804055_2e55a2e9bcf3d198e368.png', 'Testing', 'Testing banner work', '#000000', 'Testing banner when work', 'Shop Now', 'http://localhost:8080/index.php/DEV_ADMIN/slider');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag`) VALUES
(2, 'tags'),
(3, 'tag2'),
(4, 'tag gue');

-- --------------------------------------------------------

--
-- Table structure for table `unique_visitor`
--

CREATE TABLE `unique_visitor` (
  `visit_id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'farriq', 'user@gmail.com', '$2y$10$8RMAc.n2XX7aFOG8GWk5PuFsix72/NSOaS3C0/I4ypx/EwviID4K6'),
(2, 'jalak', 'jalak@mail.com', '$2y$10$1YLbzLiFypzFuEI0f8Wzwug8W05./HS36eykhiowJcVIgmoZkWU4m');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_address_id` int(11) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address1` text NOT NULL,
  `address2` text DEFAULT NULL,
  `province` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `postcode_zip` int(11) NOT NULL,
  `address_notes` text DEFAULT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_address_id`, `firstname`, `lastname`, `phone`, `address1`, `address2`, `province`, `city`, `postcode_zip`, `address_notes`, `primary`, `user_id`) VALUES
(2, 'fds', 'sfd', '243', '234', '', 15, 4, 234, '', 1, 2),
(6, 'user1', 'Aji', '089692107175', 'jl.selat karimata bandengan', '', 6, 189, 5453, '', 0, 1),
(7, 'farriq', 'names', '08122108', '132123', '', 5, 39, 123123, '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `categories_parent_category_foreign` (`parent_category`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `offers_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `midtrans_id` (`midtrans_id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_cencel_request`
--
ALTER TABLE `order_cencel_request`
  ADD PRIMARY KEY (`order_cencel_request_id`),
  ADD KEY `order_cencel_request_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_payment_provider_id_foreign` (`payment_provider_id`);

--
-- Indexes for table `payment_provider`
--
ALTER TABLE `payment_provider`
  ADD PRIMARY KEY (`payment_provider_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `product_comments_user_id_foreign` (`user_id`),
  ADD KEY `product_comments_product_id_foreign` (`product_id`),
  ADD KEY `product_comments_replay_id_foreign` (`replay_id`);

--
-- Indexes for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `product_discount_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_meta`
--
ALTER TABLE `product_meta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `product_meta_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`products_tags_id`),
  ADD KEY `product_tags_tag_id_foreign` (`tag_id`),
  ADD KEY `product_tags_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `roles_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `session_cart`
--
ALTER TABLE `session_cart`
  ADD PRIMARY KEY (`session_cart_id`),
  ADD KEY `session_cart_user_id_foreign` (`user_id`),
  ADD KEY `session_cart_product_id_foreign` (`product_id`);

--
-- Indexes for table `session_emoney`
--
ALTER TABLE `session_emoney`
  ADD PRIMARY KEY (`session_emoney_id`),
  ADD KEY `session_emoney_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `unique_visitor`
--
ALTER TABLE `unique_visitor`
  ADD PRIMARY KEY (`visit_id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_address_id`),
  ADD KEY `user_address_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_cencel_request`
--
ALTER TABLE `order_cencel_request`
  MODIFY `order_cencel_request_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_provider`
--
ALTER TABLE `payment_provider`
  MODIFY `payment_provider_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_meta`
--
ALTER TABLE `product_meta`
  MODIFY `meta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `products_tags_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_cart`
--
ALTER TABLE `session_cart`
  MODIFY `session_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `session_emoney`
--
ALTER TABLE `session_emoney`
  MODIFY `session_emoney_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `slider_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unique_visitor`
--
ALTER TABLE `unique_visitor`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `user_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_category_foreign` FOREIGN KEY (`parent_category`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_cencel_request`
--
ALTER TABLE `order_cencel_request`
  ADD CONSTRAINT `order_cencel_request_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_payment_provider_id_foreign` FOREIGN KEY (`payment_provider_id`) REFERENCES `payment_provider` (`payment_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD CONSTRAINT `product_comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_comments_replay_id_foreign` FOREIGN KEY (`replay_id`) REFERENCES `product_comments` (`comment_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD CONSTRAINT `product_discount_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_meta`
--
ALTER TABLE `product_meta`
  ADD CONSTRAINT `product_meta_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_cart`
--
ALTER TABLE `session_cart`
  ADD CONSTRAINT `session_cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_emoney`
--
ALTER TABLE `session_emoney`
  ADD CONSTRAINT `session_emoney_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
