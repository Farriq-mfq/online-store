#
# TABLE STRUCTURE FOR: admin
#

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('DEV','ADMIN') NOT NULL DEFAULT 'ADMIN',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `email_verification`, `role`) VALUES (1, `admin`, `admin@gmail`.`com`, `$2y$10$h1InPwVr0s`.`tldsWWRoZXuzo2DjJWxqprlMzmbHsMHgpHBD4wsZ8K`, 1, `DEV`);
INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `email_verification`, `role`) VALUES (3, `farriq` `muw`, `farriq@gmail`.`com`, `$2y$10$V3NkMtUuu`.`1fG8XzbOQaYObLqsydTpFYDDE5ztOmQGZCWrpy4vTsi`, 0, `ADMIN`);
INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `email_verification`, `role`) VALUES (4, `james`, `jame@yahoo`.`com`, `$2y$10$oc/4oXDUSFXxdD3aoFwlV`.`EIVEQzRr8IZGJEd0d96Ee9Aa/l0vXA6`, 0, `ADMIN`);
INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `email_verification`, `role`) VALUES (8, `james`, `bonjames020@gmail`.`com`, `$2y$10$xM0oaQrG6YakJKCWeSrsqeYn3CdUvXZYibS`.`XVeN7UipQMK2Cikpe`, 1, `ADMIN`);
INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `email_verification`, `role`) VALUES (9, `farriq`, `farriqtamvan22@gmail`.`com`, `$2y$10$sQ5SzTwJELCNBOcpFlYoD`..`5X4mDeIe`.`P8Y47q2bVFxhAbPPFKR1W`, 1, `ADMIN`);


#
# TABLE STRUCTURE FOR: banners
#

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(150) NOT NULL,
  `image_name` varchar(150) NOT NULL,
  `banner_location` enum('BOTTOM_SLIDER','BOTTOM_OFFER','LONG_BANNER') NOT NULL DEFAULT 'BOTTOM_SLIDER',
  `title` varchar(150) DEFAULT NULL,
  `paragraph` varchar(200) DEFAULT NULL,
  `link_label` varchar(20) DEFAULT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `banners` (`banner_id`, `image`, `image_name`, `banner_location`, `title`, `paragraph`, `link_label`, `link`) VALUES (3, `http://localhost:8080/uploads/banners/1671781568_486371bf26299651dc0f`.`jpg`, `1671781568_486371bf26299651dc0f`.`jpg`, `BOTTOM_SLIDER`, `asfdsfd`, `fds`, `fsd`, `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);
INSERT INTO `banners` (`banner_id`, `image`, `image_name`, `banner_location`, `title`, `paragraph`, `link_label`, `link`) VALUES (4, `http://localhost:8080/uploads/banners/1671782180_0eca84a5139b4aa4971c`.`jpg`, `1671782180_0eca84a5139b4aa4971c`.`jpg`, `LONG_BANNER`, `Buy 3`.` Get Free` `1`., `50% off for selected products in` `Pustok`., `See` `More`, `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);
INSERT INTO `banners` (`banner_id`, `image`, `image_name`, `banner_location`, `title`, `paragraph`, `link_label`, `link`) VALUES (6, `http://localhost:8080/uploads/banners/1671782335_274d17c05bebdbc8aab4`.`jpg`, `1671782335_274d17c05bebdbc8aab4`.`jpg`, `BOTTOM_SLIDER`, , , , `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);
INSERT INTO `banners` (`banner_id`, `image`, `image_name`, `banner_location`, `title`, `paragraph`, `link_label`, `link`) VALUES (8, `http://localhost:8080/uploads/banners/1671782405_dae81fa9f9b234d343d8`.`jpg`, `1671782405_dae81fa9f9b234d343d8`.`jpg`, `BOTTOM_OFFER`, , , , `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);
INSERT INTO `banners` (`banner_id`, `image`, `image_name`, `banner_location`, `title`, `paragraph`, `link_label`, `link`) VALUES (11, `http://localhost:8080/uploads/banners/1671839954_bdf4c654934efad206d3`.`jpg`, `1671839954_bdf4c654934efad206d3`.`jpg`, `BOTTOM_OFFER`, , , , `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);


#
# TABLE STRUCTURE FOR: brands
#

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `brands` (`brand_id`, `brand`) VALUES (1, `Benjamin` `okhlahoma`);
INSERT INTO `brands` (`brand_id`, `brand`) VALUES (2, `coba`);


#
# TABLE STRUCTURE FOR: categories
#

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_category` int(11) DEFAULT NULL,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `categories_parent_category_foreign` (`parent_category`),
  CONSTRAINT `categories_parent_category_foreign` FOREIGN KEY (`parent_category`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (2, NULL, `ARTS & PHOTOGRAPHY` `BOOKS`);
INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (3, 6, `Funny`);
INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (4, 2, `sfdafasdf`);
INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (5, 3, `new`);
INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (6, 2, Children's);
INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (7, 2, `Horor`);
INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (8, NULL, `BIOGRAPHIES` `BOOKS`);
INSERT INTO `categories` (`category_id`, `parent_category`, `category`) VALUES (9, NULL, `CHILDREN’S` `BOOKS`);


#
# TABLE STRUCTURE FOR: email_template
#

DROP TABLE IF EXISTS `email_template`;

CREATE TABLE `email_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_name` varchar(150) NOT NULL,
  `from_email` varchar(150) NOT NULL,
  `recipients` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `type` enum('RESET_PASSWORD_USER','ORDER_RECEIVED','ORDER_PROCESS','ORDER_SHIPPED','ORDER_DONE','ORDER_REJECT','CONFIRM_EMAIL_USER','CONFIRM_EMAIL_ADMIN','PROMO') NOT NULL,
  PRIMARY KEY (`template_id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (2, `pustok`, `pustok@service`.`com`, ,     &lt;table style=&quot;@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: &#039;Open Sans&#039;, sans-serif;&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
        &lt;tbody&gt;&lt;tr&gt;
            &lt;td&gt;
                &lt;table style=&quot;background-color: #f2f3f8; max-width:670px;  margin:0 auto;&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                    &lt;tbody&gt;&lt;tr&gt;
                        &lt;td style=&quot;height:80px;&quot;&gt;&amp;nbsp;&lt;/td&gt;
                    &lt;/tr&gt;
                    &lt;tr&gt;
                        &lt;td style=&quot;text-align:center;&quot;&gt;
                          &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                            &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                          &lt;/a&gt;
                        &lt;/td&gt;
                    &lt;/tr&gt;
                    &lt;tr&gt;
                        &lt;td style=&quot;height:20px;&quot;&gt;&amp;nbsp;&lt;/td&gt;
                    &lt;/tr&gt;
                    &lt;tr&gt;
                        &lt;td&gt;
                            &lt;table style=&quot;max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);&quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                                &lt;tbody&gt;&lt;tr&gt;
                                    &lt;td style=&quot;height:40px;&quot;&gt;&amp;nbsp;&lt;/td&gt;
                                &lt;/tr&gt;
                                &lt;tr&gt;
                                    &lt;td style=&quot;padding:0 35px;&quot;&gt;
                                        &lt;h1 style=&quot;color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:&#039;Rubik&#039;,sans-serif;&quot;&gt;You have
                                            requested to reset your password&lt;/h1&gt;
                                        &lt;span style=&quot;display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;&quot;&gt;&lt;/span&gt;
                                        &lt;p style=&quot;color:#455056; font-size:15px;line-height:24px; margin:0;&quot;&gt;
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        &lt;/p&gt;
                                        &lt;a href=&quot;%link%&quot; style=&quot;background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;&quot;&gt;Reset
                                            Password&lt;/a&gt;
                                    &lt;/td&gt;
                                &lt;/tr&gt;
                                &lt;tr&gt;
                                    &lt;td style=&quot;height:40px;&quot;&gt;&amp;nbsp;&lt;/td&gt;
                                &lt;/tr&gt;
                            &lt;/tbody&gt;&lt;/table&gt;
                        &lt;/td&gt;
                    &lt;/tr&gt;&lt;tr&gt;
                        &lt;td style=&quot;height:20px;&quot;&gt;&amp;nbsp;&lt;/td&gt;
                    &lt;/tr&gt;
                    &lt;tr&gt;
                        &lt;td style=&quot;height:80px;&quot;&gt;&amp;nbsp;&lt;/td&gt;
                    &lt;/tr&gt;
                &lt;/tbody&gt;&lt;/table&gt;
            &lt;/td&gt;
        &lt;/tr&gt;
    &lt;/tbody&gt;&lt;/table&gt;

, `RESET_PASSWORD_USER`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (4, `pustok`, `pustok@service`.`com`, , `&lt;p&gt;&lt;strong&gt;HALLO %user%&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;new Product` `here&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;%link%&lt;/strong&gt;&lt;/p&gt;`, `PROMO`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (5, `pustok`, `pustok@service`.`com`, ,     &lt;table style=&quot;
        @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);
        font-family: &#039;Open Sans&#039;, sans-serif;
      &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
      &lt;tbody&gt;
        &lt;tr&gt;
          &lt;td&gt;
            &lt;table style=&quot;
                background-color: #f2f3f8;
                max-width: 670px;
                margin: 0 auto;
              &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
              &lt;tbody&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;text-align: center&quot;&gt;
                    &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                      &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                    &lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;table style=&quot;
                        max-width: 670px;
                        background: #fff;
                        border-radius: 3px;
                        text-align: center;
                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                      &quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                      &lt;tbody&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;padding: 0 35px&quot;&gt;
                            &lt;h1 style=&quot;
                                color: #1e1e2d;
                                font-weight: 500;
                                margin: 0;
                                font-size: 32px;
                                font-family: &#039;Rubik&#039;, sans-serif;
                              &quot;&gt;
                              Confirm Your Email
                            &lt;/h1&gt;
                            &lt;span style=&quot;
                                display: inline-block;
                                vertical-align: middle;
                                margin: 29px 0 26px;
                                border-bottom: 1px solid #cecece;
                                width: 100px;
                              &quot;&gt;&lt;/span&gt;
                            &lt;p style=&quot;
                                color: #455056;
                                font-size: 15px;
                                line-height: 24px;
                                margin: 0;
                              &quot;&gt;
                            &lt;/p&gt;&lt;p&gt;Hi,%user%&lt;/p&gt;
                              You are just one step away
                            &lt;p&gt;&lt;/p&gt;
                            &lt;a href=&quot;%link%&quot; style=&quot;
                                background: #20e277;
                                text-decoration: none !important;
                                font-weight: 500;
                                margin-top: 35px;
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                                padding: 10px 24px;
                                display: inline-block;
                                border-radius: 50px;
                              &quot;&gt;Confirm Email&lt;/a&gt;
                          &lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                      &lt;/tbody&gt;
                    &lt;/table&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
              &lt;/tbody&gt;
            &lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;
    &lt;/table&gt;, `CONFIRM_EMAIL_USER`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (6, `pustok`, `pustok@service`.`com`, ,    &lt;table style=&quot;
        @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);
        font-family: &#039;Open Sans&#039;, sans-serif;
      &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
      &lt;tbody&gt;
        &lt;tr&gt;
          &lt;td&gt;
            &lt;table style=&quot;
                background-color: #f2f3f8;
                max-width: 670px;
                margin: 0 auto;
              &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
              &lt;tbody&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;text-align: center&quot;&gt;
                    &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                      &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                    &lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;table style=&quot;
                        max-width: 670px;
                        background: #fff;
                        border-radius: 3px;
                        text-align: center;
                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                      &quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                      &lt;tbody&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;padding: 0 35px&quot;&gt;
                            &lt;h1 style=&quot;
                                color: #1e1e2d;
                                font-weight: 500;
                                margin: 0;
                                font-size: 32px;
                                font-family: &#039;Rubik&#039;, sans-serif;
                              &quot;&gt;
                            &lt;/h1&gt;&lt;h1&gt;Thank you !&lt;/h1&gt;
                            
                            &lt;span style=&quot;
                                display: inline-block;
                                vertical-align: middle;
                                margin: 29px 0 26px;
                                border-bottom: 1px solid #cecece;
                                width: 100px;
                              &quot;&gt;&lt;/span&gt;
                            &lt;p style=&quot;
                                color: #455056;
                                font-size: 15px;
                                line-height: 24px;
                                margin: 0;
                              &quot;&gt;
                            &lt;/p&gt;&lt;p&gt;Hi,%user%&lt;/p&gt;
                            &lt;p&gt;Your order has been received.&lt;/p&gt;
                            &lt;ul style=&quot;list-style: none;text-align: center;&quot;&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Order id: &lt;strong&gt;%token%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Date: &lt;strong&gt;%date%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Total: &lt;strong&gt;%total%&lt;/strong&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                            &lt;p&gt;&lt;/p&gt;
                            &lt;a href=&quot;%link%&quot; style=&quot;
                                background: #20e277;
                                text-decoration: none !important;
                                font-weight: 500;
                                margin-top: 35px;
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                                padding: 10px 24px;
                                display: inline-block;
                                border-radius: 50px;
                              &quot;&gt;View Order&lt;/a&gt;
                          &lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                      &lt;/tbody&gt;
                    &lt;/table&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
              &lt;/tbody&gt;
            &lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;
    &lt;/table&gt;, `ORDER_RECEIVED`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (7, `pustok`, `pustok@service`.`com`, ,    &lt;table style=&quot;
        @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);
        font-family: &#039;Open Sans&#039;, sans-serif;
      &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
      &lt;tbody&gt;
        &lt;tr&gt;
          &lt;td&gt;
            &lt;table style=&quot;
                background-color: #f2f3f8;
                max-width: 670px;
                margin: 0 auto;
              &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
              &lt;tbody&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;text-align: center&quot;&gt;
                    &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                      &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                    &lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;table style=&quot;
                        max-width: 670px;
                        background: #fff;
                        border-radius: 3px;
                        text-align: center;
                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                      &quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                      &lt;tbody&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;padding: 0 35px&quot;&gt;
                            &lt;h1 style=&quot;
                                color: #1e1e2d;
                                font-weight: 500;
                                margin: 0;
                                font-size: 32px;
                                font-family: &#039;Rubik&#039;, sans-serif;
                              &quot;&gt;
                            &lt;/h1&gt;&lt;h1&gt;Order Process !&lt;/h1&gt;
                            
                            &lt;span style=&quot;
                                display: inline-block;
                                vertical-align: middle;
                                margin: 29px 0 26px;
                                border-bottom: 1px solid #cecece;
                                width: 100px;
                              &quot;&gt;&lt;/span&gt;
                            &lt;p style=&quot;
                                color: #455056;
                                font-size: 15px;
                                line-height: 24px;
                                margin: 0;
                              &quot;&gt;
                            &lt;/p&gt;&lt;p&gt;Hi,%user%&lt;/p&gt;
                            &lt;p&gt;Your order has been Process.&lt;/p&gt;
                            &lt;ul style=&quot;list-style: none;text-align: center;&quot;&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Order id: &lt;strong&gt;%token%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Date: &lt;strong&gt;%date%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Total: &lt;strong&gt;%total%&lt;/strong&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                            &lt;p&gt;&lt;/p&gt;
                            &lt;a href=&quot;%link%&quot; style=&quot;
                                background: #20e277;
                                text-decoration: none !important;
                                font-weight: 500;
                                margin-top: 35px;
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                                padding: 10px 24px;
                                display: inline-block;
                                border-radius: 50px;
                              &quot;&gt;View Order&lt;/a&gt;
                          &lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                      &lt;/tbody&gt;
                    &lt;/table&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
              &lt;/tbody&gt;
            &lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;
    &lt;/table&gt;, `ORDER_PROCESS`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (8, `pustok`, `pustok@service`.`com`, ,    &lt;table style=&quot;
        @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);
        font-family: &#039;Open Sans&#039;, sans-serif;
      &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
      &lt;tbody&gt;
        &lt;tr&gt;
          &lt;td&gt;
            &lt;table style=&quot;
                background-color: #f2f3f8;
                max-width: 670px;
                margin: 0 auto;
              &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
              &lt;tbody&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;text-align: center&quot;&gt;
                    &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                      &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                    &lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;table style=&quot;
                        max-width: 670px;
                        background: #fff;
                        border-radius: 3px;
                        text-align: center;
                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                      &quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                      &lt;tbody&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;padding: 0 35px&quot;&gt;
                            &lt;h1 style=&quot;
                                color: #1e1e2d;
                                font-weight: 500;
                                margin: 0;
                                font-size: 32px;
                                font-family: &#039;Rubik&#039;, sans-serif;
                              &quot;&gt;
                            &lt;/h1&gt;&lt;h1&gt;Order Shipped !&lt;/h1&gt;
                            
                            &lt;span style=&quot;
                                display: inline-block;
                                vertical-align: middle;
                                margin: 29px 0 26px;
                                border-bottom: 1px solid #cecece;
                                width: 100px;
                              &quot;&gt;&lt;/span&gt;
                            &lt;p style=&quot;
                                color: #455056;
                                font-size: 15px;
                                line-height: 24px;
                                margin: 0;
                              &quot;&gt;
                            &lt;/p&gt;&lt;p&gt;Hi,%user%&lt;/p&gt;
                            &lt;p&gt;Your order has been Shipped.&lt;/p&gt;
                            &lt;ul style=&quot;list-style: none;text-align: center;&quot;&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Order id: &lt;strong&gt;%token%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Date: &lt;strong&gt;%date%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Total: &lt;strong&gt;%total%&lt;/strong&gt;&lt;/li&gt;
  &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Tracking Number: &lt;strong&gt;%tracking%&lt;/strong&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                            &lt;p&gt;&lt;/p&gt;
                            &lt;a href=&quot;%link%&quot; style=&quot;
                                background: #20e277;
                                text-decoration: none !important;
                                font-weight: 500;
                                margin-top: 35px;
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                                padding: 10px 24px;
                                display: inline-block;
                                border-radius: 50px;
                              &quot;&gt;View Order&lt;/a&gt;
                          &lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                      &lt;/tbody&gt;
                    &lt;/table&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
              &lt;/tbody&gt;
            &lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;
    &lt;/table&gt;, `ORDER_SHIPPED`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (9, `pustok`, `pustok@service`.`com`, ,    &lt;table style=&quot;
        @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);
        font-family: &#039;Open Sans&#039;, sans-serif;
      &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
      &lt;tbody&gt;
        &lt;tr&gt;
          &lt;td&gt;
            &lt;table style=&quot;
                background-color: #f2f3f8;
                max-width: 670px;
                margin: 0 auto;
              &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
              &lt;tbody&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;text-align: center&quot;&gt;
                    &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                      &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                    &lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;table style=&quot;
                        max-width: 670px;
                        background: #fff;
                        border-radius: 3px;
                        text-align: center;
                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                      &quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                      &lt;tbody&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;padding: 0 35px&quot;&gt;
                            &lt;h1 style=&quot;
                                color: #1e1e2d;
                                font-weight: 500;
                                margin: 0;
                                font-size: 32px;
                                font-family: &#039;Rubik&#039;, sans-serif;
                              &quot;&gt;
                            &lt;/h1&gt;&lt;h1&gt;Thank you for your order !&lt;/h1&gt;
                            
                            &lt;span style=&quot;
                                display: inline-block;
                                vertical-align: middle;
                                margin: 29px 0 26px;
                                border-bottom: 1px solid #cecece;
                                width: 100px;
                              &quot;&gt;&lt;/span&gt;
                            &lt;p style=&quot;
                                color: #455056;
                                font-size: 15px;
                                line-height: 24px;
                                margin: 0;
                              &quot;&gt;
                            &lt;/p&gt;&lt;p&gt;Hi,%user%&lt;/p&gt;
                            &lt;p&gt;Your order has been done.&lt;/p&gt;
                            &lt;ul style=&quot;list-style: none;text-align: center;&quot;&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Order id: &lt;strong&gt;%token%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Date: &lt;strong&gt;%date%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Total: &lt;strong&gt;%total%&lt;/strong&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                            &lt;p&gt;&lt;/p&gt;
                            &lt;a href=&quot;%link%&quot; style=&quot;
                                background: #20e277;
                                text-decoration: none !important;
                                font-weight: 500;
                                margin-top: 35px;
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                                padding: 10px 24px;
                                display: inline-block;
                                border-radius: 50px;
                              &quot;&gt;View Order&lt;/a&gt;
                          &lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                      &lt;/tbody&gt;
                    &lt;/table&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
              &lt;/tbody&gt;
            &lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;
    &lt;/table&gt;, `ORDER_DONE`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (10, `pustok`, `pustok@service`.`com`, ,    &lt;table style=&quot;
        @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);
        font-family: &#039;Open Sans&#039;, sans-serif;
      &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
      &lt;tbody&gt;
        &lt;tr&gt;
          &lt;td&gt;
            &lt;table style=&quot;
                background-color: #f2f3f8;
                max-width: 670px;
                margin: 0 auto;
              &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
              &lt;tbody&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;text-align: center&quot;&gt;
                    &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                      &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                    &lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;table style=&quot;
                        max-width: 670px;
                        background: #fff;
                        border-radius: 3px;
                        text-align: center;
                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                      &quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                      &lt;tbody&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;padding: 0 35px&quot;&gt;
                            &lt;h1 style=&quot;
                                color: #1e1e2d;
                                font-weight: 500;
                                margin: 0;
                                font-size: 32px;
                                font-family: &#039;Rubik&#039;, sans-serif;
                              &quot;&gt;
                            &lt;/h1&gt;&lt;h1&gt;Order Cancel !&lt;/h1&gt;
                            
                            &lt;span style=&quot;
                                display: inline-block;
                                vertical-align: middle;
                                margin: 29px 0 26px;
                                border-bottom: 1px solid #cecece;
                                width: 100px;
                              &quot;&gt;&lt;/span&gt;
                            &lt;p style=&quot;
                                color: #455056;
                                font-size: 15px;
                                line-height: 24px;
                                margin: 0;
                              &quot;&gt;
                            &lt;/p&gt;&lt;p&gt;Hi,%user%&lt;/p&gt;
                            &lt;p&gt;Your order has been cancel.&lt;/p&gt;
                            &lt;ul style=&quot;list-style: none;text-align: center;&quot;&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Order id: &lt;strong&gt;%token%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Date: &lt;strong&gt;%date%&lt;/strong&gt;&lt;/li&gt;
                                &lt;li style=&quot;margin-bottom: 5px;&quot;&gt;Total: &lt;strong&gt;%total%&lt;/strong&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                            &lt;p&gt;&lt;/p&gt;
                            &lt;a href=&quot;%link%&quot; style=&quot;
                                background: #20e277;
                                text-decoration: none !important;
                                font-weight: 500;
                                margin-top: 35px;
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                                padding: 10px 24px;
                                display: inline-block;
                                border-radius: 50px;
                              &quot;&gt;View Order&lt;/a&gt;
                          &lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                      &lt;/tbody&gt;
                    &lt;/table&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
              &lt;/tbody&gt;
            &lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;
    &lt;/table&gt;, `ORDER_REJECT`);
INSERT INTO `email_template` (`template_id`, `from_name`, `from_email`, `recipients`, `content`, `type`) VALUES (11, `pustok`, `pustok@admin`.`com`, ,  &lt;table style=&quot;
        @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700);
        font-family: &#039;Open Sans&#039;, sans-serif;
      &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; bgcolor=&quot;#f2f3f8&quot;&gt;
      &lt;tbody&gt;
        &lt;tr&gt;
          &lt;td&gt;
            &lt;table style=&quot;
                background-color: #f2f3f8;
                max-width: 670px;
                margin: 0 auto;
              &quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
              &lt;tbody&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;text-align: center&quot;&gt;
                    &lt;a href=&quot;#&quot; title=&quot;logo&quot; target=&quot;_blank&quot;&gt;
                      &lt;img src=&quot;%logo%&quot; width=&quot;60&quot;&gt;
                    &lt;/a&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td&gt;
                    &lt;table style=&quot;
                        max-width: 670px;
                        background: #fff;
                        border-radius: 3px;
                        text-align: center;
                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                      &quot; width=&quot;95%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot; align=&quot;center&quot;&gt;
                      &lt;tbody&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;padding: 0 35px&quot;&gt;
                            &lt;h1 style=&quot;
                                color: #1e1e2d;
                                font-weight: 500;
                                margin: 0;
                                font-size: 32px;
                                font-family: &#039;Rubik&#039;, sans-serif;
                              &quot;&gt;
                              ADMIN CONFIRM EMAIL
                            &lt;/h1&gt;
                            &lt;span style=&quot;
                                display: inline-block;
                                vertical-align: middle;
                                margin: 29px 0 26px;
                                border-bottom: 1px solid #cecece;
                                width: 100px;
                              &quot;&gt;&lt;/span&gt;
                            &lt;p style=&quot;
                                color: #455056;
                                font-size: 15px;
                                line-height: 24px;
                                margin: 0;
                              &quot;&gt;
                            &lt;/p&gt;&lt;p&gt;Hi,%user%&lt;/p&gt;
                              You are just one step away
                            &lt;p&gt;&lt;/p&gt;
                            &lt;a href=&quot;%link%&quot; style=&quot;
                                background: #20e277;
                                text-decoration: none !important;
                                font-weight: 500;
                                margin-top: 35px;
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                                padding: 10px 24px;
                                display: inline-block;
                                border-radius: 50px;
                              &quot;&gt;Confirm Email&lt;/a&gt;
                          &lt;/td&gt;
                        &lt;/tr&gt;
                        &lt;tr&gt;
                          &lt;td style=&quot;height: 40px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                        &lt;/tr&gt;
                      &lt;/tbody&gt;
                    &lt;/table&gt;
                  &lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 20px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
                &lt;tr&gt;
                  &lt;td style=&quot;height: 80px&quot;&gt;&amp;nbsp;&lt;/td&gt;
                &lt;/tr&gt;
              &lt;/tbody&gt;
            &lt;/table&gt;
          &lt;/td&gt;
        &lt;/tr&gt;
      &lt;/tbody&gt;
    &lt;/table&gt;, `CONFIRM_EMAIL_ADMIN`);


#
# TABLE STRUCTURE FOR: migrations
#

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (1, `2022-12-01-075204`, `App\Database\Migrations\Tags`, `default`, `App`, 1671767970, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (2, `2022-12-02-103421`, `App\Database\Migrations\ProductBrands`, `default`, `App`, 1671767970, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (3, `2022-12-02-112331`, `App\Database\Migrations\ProductCategories`, `default`, `App`, 1671767971, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (4, `2022-12-02-112332`, `App\Database\Migrations\Products`, `default`, `App`, 1671767972, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (5, `2022-12-02-112646`, `App\Database\Migrations\ProductMeta`, `default`, `App`, 1671767972, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (6, `2022-12-02-120919`, `App\Database\Migrations\ProductImages`, `default`, `App`, 1671767972, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (7, `2022-12-02-124836`, `App\Database\Migrations\ProductTags`, `default`, `App`, 1671767973, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (9, `2022-12-02-132225`, `App\Database\Migrations\SessionCart`, `default`, `App`, 1671767974, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (10, `2022-12-02-132538`, `App\Database\Migrations\Slider`, `default`, `App`, 1671767975, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (11, `2022-12-03-010134`, `App\Database\Migrations\ProductsComments`, `default`, `App`, 1671767975, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (12, `2022-12-03-010748`, `App\Database\Migrations\ProductReviews`, `default`, `App`, 1671767976, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (14, `2022-12-03-051155`, `App\Database\Migrations\ProductOrders`, `default`, `App`, 1671767976, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (20, `2022-12-15-111911`, `App\Database\Migrations\Roles`, `default`, `App`, 1671767980, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (25, `2022-12-23-054538`, `App\Database\Migrations\Banner`, `default`, `App`, 1671776663, 2);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (26, `2022-12-23-222608`, `App\Database\Migrations\ProductDiscount`, `default`, `App`, 1671834565, 3);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (28, `2022-12-24-012621`, `App\Database\Migrations\SpecialOffer`, `default`, `App`, 1671850634, 4);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (29, `2022-12-19-120942`, `App\Database\Migrations\UserAddress`, `default`, `App`, 1672104678, 5);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (33, `2022-12-03-050156`, `App\Database\Migrations\Orders`, `default`, `App`, 1672267881, 8);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (34, `2022-12-11-042245`, `App\Database\Migrations\SessionEmoney`, `default`, `App`, 1672273163, 9);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (40, `2022-12-29-152723`, `App\Database\Migrations\Website`, `default`, `App`, 1672359538, 12);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (41, `2022-12-22-235037`, `App\Database\Migrations\UniqueVisitor`, `default`, `App`, 1672440407, 13);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (46, `2023-01-01-001659`, `App\Database\Migrations\Smtp`, `default`, `App`, 1672538735, 15);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (52, `2023-01-01-034807`, `App\Database\Migrations\ResetLink`, `default`, `App`, 1672546224, 16);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (53, `2022-12-02-130330`, `App\Database\Migrations\Users`, `default`, `App`, 1672574914, 17);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (54, `2023-01-01-012712`, `App\Database\Migrations\EmailTemplate`, `default`, `App`, 1672620053, 18);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (55, `2022-12-15-110055`, `App\Database\Migrations\Admin`, `default`, `App`, 1672622901, 19);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (58, `2023-01-04-054726`, `App\Database\Migrations\Page`, `default`, `App`, 1672871773, 20);


#
# TABLE STRUCTURE FOR: offers
#

DROP TABLE IF EXISTS `offers`;

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_start` datetime NOT NULL,
  `offer_end` datetime NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`offer_id`),
  KEY `offers_product_id_foreign` (`product_id`),
  CONSTRAINT `offers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO `offers` (`offer_id`, `offer_start`, `offer_end`, `product_id`, `created_at`) VALUES (18, `2022-12-30` `07:00:00`, `2022-12-30` `23:59:00`, 1, `2022-12-24` `10:39:00`);
INSERT INTO `offers` (`offer_id`, `offer_start`, `offer_end`, `product_id`, `created_at`) VALUES (19, `2022-12-24` `00:00:00`, `2022-12-24` `13:00:00`, 3, `2022-12-24` `11:02:36`);


#
# TABLE STRUCTURE FOR: order_items
#

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `order_items_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` double DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  PRIMARY KEY (`order_items_id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (17, 1, 1, 3, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (18, 2, 2, 1, NULL, 21560);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (19, 3, 5, 1, NULL, 12000);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (20, 4, 5, 2, NULL, 12000);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (21, 5, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (22, 6, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (23, 7, 3, 3, NULL, 31200);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (24, 8, 2, 1, NULL, 21560);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (25, 8, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (26, 9, 2, 1, NULL, 21560);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (27, 10, 2, 1, NULL, 21560);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (28, 11, 3, 1, NULL, 10400);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (29, 12, 2, 1, NULL, 21560);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (30, 13, 5, 1, NULL, 12000);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (31, 14, 2, 1, NULL, 21560);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (32, 15, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (33, 16, 1, 4, NULL, 114000);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (34, 17, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (35, 18, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (36, 19, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (37, 20, 1, 1, NULL, 28500);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (38, 21, 6, 1, NULL, 50000);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (39, 21, 3, 1, NULL, 10400);
INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `discount`, `total`) VALUES (40, 22, 1, 1, NULL, 28500);


#
# TABLE STRUCTURE FOR: orders
#

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `user_address_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `midtrans_id` (`midtrans_id`),
  UNIQUE KEY `token` (`token`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_user_address_id_foreign` (`user_address_id`),
  CONSTRAINT `orders_user_address_id_foreign` FOREIGN KEY (`user_address_id`) REFERENCES `user_address` (`user_address_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (1, `f7f7a832-0a15-4b58-9abb-392fec6e0ac8`, `163acc88d7d419`, 1, `jne`, 12, `OKE`, 349, 39, `SHIPPED`, NULL, 0, , 9000, 37500, `bank_transfer`, 7, `2021-12-10` `00:00:00`, `2022-12-29` `05:52:01`, `2022-12-29` `17:21:24`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (2, `7c65ce5c-6b92-43e5-87f5-f3f24fc8c2ec`, `163acdb6b26954`, 1, `jne`, NULL, `OKE`, 349, 39, `SHIPPED`, NULL, 1, `dsfasdf`, 9000, 30560, `bank_transfer`, 7, `2022-11-16` `07:12:28`, `2022-12-29` `07:12:28`, `2022-12-29` `16:53:24`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (3, `112c8bda-e2d7-483c-96dd-ce8009e5b268`, `163acdd923cfdc`, 1, `jne`, NULL, `OKE`, 349, 39, `REJECT`, NULL, 1, , 9000, 21000, `qris`, 7, `2022-12-29` `07:21:39`, `2022-12-29` `07:21:39`, `2022-12-29` `09:07:22`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (4, `8f78efd8-0b7a-4ebf-b41b-d958dec34b5a`, `163aceeb98ec56`, 1, `jne`, 1212, `OKE`, 349, 39, `DONE`, NULL, 0, `notes`, 9000, 21000, `bank_transfer`, 7, `2022-12-29` `08:34:50`, `2022-12-29` `08:34:50`, `2022-12-29` `08:47:15`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (5, `96ccc96e-2d15-4521-a6b5-c8d131200404`, `163acf3f96ccdd`, 1, `jne`, NULL, `OKE`, 349, 39, `REJECT`, NULL, 1, , 9000, 37500, `bank_transfer`, 7, `2022-12-29` `08:57:14`, `2022-12-29` `08:57:14`, `2022-12-29` `08:57:50`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (6, `d0f58da1-31cf-491f-a025-ea75c211d40f`, `163ad6aa7108b7`, 1, `jne`, `sum_sales_this_month`, `OKE`, 349, 39, `SHIPPED`, NULL, 0, , 9000, 37500, `bank_transfer`, 7, `2022-12-29` `17:23:37`, `2022-12-29` `17:23:37`, `2022-12-31` `12:37:05`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (7, `cd6d5bad-bd0b-4bcc-bc8c-50ebbb351ffc`, `163ae2d154b0bf`, 1, `pos`, NULL, `Pos` `Reguler`, 153, 189, `REJECT`, NULL, 1, , 17000, 48200, `bank_transfer`, 6, `2022-12-30` `07:13:11`, `2022-12-30` `07:13:11`, `2022-12-30` `07:13:56`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (8, `381ed34e-89f4-45e0-835c-44883bbd08b0`, `163af79e82322f`, 1, `tiki`, NULL, `REG`, 349, 189, `PROCESS`, NULL, 0, , 15000, 65060, `bank_transfer`, 6, `2022-01-02` `08:07:16`, `2022-12-31` `06:53:13`, `2023-01-02` `08:07:28`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (9, `2538402c-128d-492a-ae5f-4a2601e17298`, `163b0bf1ae5266`, 1, `tiki`, NULL, `REG`, 349, 189, `PROCESS`, NULL, 0, , 15000, 36560, `bank_transfer`, 6, `2023-01-01` `06:00:44`, `2023-01-01` `06:00:44`, `2023-01-01` `06:01:16`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (10, `8e9cdad9-3688-4dd7-930c-fb23566bb3dd`, `1463b218d8b6abf`, 14, `jne`, 011650006582922, `OKE`, 349, 156, `DONE`, NULL, 0, , 35000, 56560, `bank_transfer`, 10, `2023-01-02` `06:35:53`, `2023-01-02` `06:35:53`, `2023-01-02` `07:36:20`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (11, `789fff9c-1fec-461f-8354-c99040a4a07c`, `1463b21951355b4`, 14, `tiki`, 123, `ECO`, 349, 156, `SHIPPED`, NULL, 0, , 33000, 43400, `echannel`, 10, `2023-01-02` `06:37:53`, `2023-01-02` `06:37:53`, `2023-01-02` `07:09:31`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (12, `5334b7c1-2c0a-4bd7-8cde-4b66f343e2cb`, `1463b219c99ef3d`, 14, `jne`, NULL, `REG`, 349, 156, `REJECT`, NULL, 1, , 38000, 59560, `echannel`, 10, `2023-01-02` `06:39:54`, `2023-01-02` `06:39:54`, `2023-01-02` `07:08:01`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (13, `64df43cb-ae14-4c7a-883a-39b3695e08f0`, `1463b21a0861fe6`, 14, `jne`, 21312, `REG`, 349, 156, `SHIPPED`, NULL, 0, , 38000, 50000, `bank_transfer`, 10, `2023-01-02` `06:40:57`, `2023-01-02` `06:40:57`, `2023-01-02` `07:01:34`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (14, `93322ba8-d460-4ee8-a931-485c8ea33879`, `1463b21fad944f7`, 14, `jne`, 1212, `OKE`, 349, 156, `DONE`, NULL, 0, , 35000, 56560, `bank_transfer`, 10, `2023-01-02` `07:05:02`, `2023-01-02` `07:05:02`, `2023-01-02` `07:23:27`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (15, `f203a4e7-8a9e-45a7-bdbd-d6d40d52ff9d`, `1463b220f608ad8`, 14, `jne`, 21, `OKE`, 349, 156, `DONE`, NULL, 0, , 35000, 63500, `bank_transfer`, 10, `2023-01-02` `07:10:30`, `2023-01-02` `07:10:30`, `2023-01-02` `07:34:21`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (16, `cda54769-3e12-4973-bd09-da9c6990a131`, `1463b221f5ce62d`, 14, `jne`, 12, `REG`, 349, 156, `SHIPPED`, NULL, 0, , 38000, 152000, `bank_transfer`, 10, `2023-01-02` `07:14:49`, `2023-01-02` `07:14:49`, `2023-01-13` `14:31:45`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (17, `5bdddec4-1abe-4a96-885f-2cdba54040c0`, `1463b22876dd517`, 14, `tiki`, NULL, `ECO`, 349, 156, `REJECT`, NULL, 1, , 33000, 61500, `bank_transfer`, 10, `2023-01-02` `07:42:31`, `2023-01-02` `07:42:31`, `2023-01-02` `07:42:59`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (18, `566099c5-d00f-40d4-b957-9ba19ed07abb`, `1463b228ed01fd4`, 14, `jne`, NULL, `OKE`, 349, 156, `REJECT`, NULL, 1, , 35000, 63500, `bank_transfer`, 10, `2023-01-02` `07:44:29`, `2023-01-02` `07:44:29`, `2023-01-02` `07:45:36`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (19, `2dedf160-cd02-483e-ba6d-21f64c7bfd89`, `1463b22a19ef255`, 14, `jne`, NULL, `OKE`, 349, 156, `REJECT`, NULL, 1, , 35000, 63500, `bank_transfer`, 10, `2023-01-02` `07:49:30`, `2023-01-02` `07:49:30`, `2023-01-02` `07:50:10`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (20, `b1295e89-3116-4706-bda1-48903a75dcf8`, `1463b50b3f1851b`, 14, `jne`, NULL, `OKE`, 349, 156, `REJECT`, NULL, 1, , 35000, 63500, `bank_transfer`, 10, `2023-01-04` `12:14:39`, `2023-01-04` `12:14:39`, `2023-01-04` `12:14:55`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (21, `e79f460a-3b2d-4782-8a7e-84a21e6c545f`, `1563c1092aeaa95`, 15, `jne`, NULL, `OKE`, 349, 44, `REJECT`, NULL, 1, , 45000, 105400, `bank_transfer`, 11, `2023-01-13` `14:33:20`, `2023-01-13` `14:33:20`, `2023-01-13` `14:37:18`);
INSERT INTO `orders` (`order_id`, `midtrans_id`, `token`, `user_id`, `courier`, `shipping_tracking`, `shipping_service`, `origin`, `destination_origin`, `status`, `discount`, `is_cencel`, `notes`, `shipping_total`, `subtotal`, `payment_method`, `user_address_id`, `created_at`, `deleted_at`, `updated_at`) VALUES (22, `967dd6e7-367a-4350-bc8d-6d51be5c1e86`, `1563c10e0d0a3af`, 15, `tiki`, `1563c10e0d0a3af`, `ECO`, 349, 44, `SHIPPED`, NULL, 0, , 51000, 79500, `bank_transfer`, 11, `2023-01-13` `14:54:10`, `2023-01-13` `14:54:10`, `2023-01-13` `14:58:50`);


#
# TABLE STRUCTURE FOR: pages
#

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `pages` (`page_id`, `page_title`, `path`, `status`, `content`) VALUES (8, `Contact`, `contact`, 1, `&lt;div class=&quot;row mt--60 &quot;&gt; &lt;div class=&quot;col-lg-5 col-md-5 col-12&quot;&gt; &lt;div class=&quot;contact_adress&quot;&gt; &lt;div class=&quot;ct_address&quot;&gt; &lt;h3 class=&quot;ct_title&quot;&gt;Location &amp;amp; Details&lt;/h3&gt; &lt;p&gt;It is a long established fact that readewill be distracted by the readable content of a page when looking at ilayout`.`&lt;/p&gt; &lt;/div&gt; &lt;div class=&quot;address_wrapper&quot;&gt; &lt;div class=&quot;address&quot;&gt; &lt;div class=&quot;icon&quot;&gt; &lt;i class=&quot;fas fa-map-marker-alt&quot;&gt;&lt;/i&gt; &lt;/div&gt; &lt;div class=&quot;contact-info-text&quot;&gt; &lt;p&gt;&lt;span&gt;Address:&lt;/span&gt; Jl`.`selat kraimata bandengan pekalongan&lt;br&gt;&lt;/p&gt; &lt;/div&gt; &lt;/div&gt; &lt;div class=&quot;address&quot;&gt; &lt;div class=&quot;icon&quot;&gt; &lt;i class=&quot;far fa-envelope&quot;&gt;&lt;/i&gt; &lt;/div&gt; &lt;div class=&quot;contact-info-text&quot;&gt; &lt;p&gt;&lt;span&gt;Email:&lt;/span&gt;pustok@support`.`com&lt;/p&gt; &lt;/div&gt; &lt;/div&gt; &lt;div class=&quot;address&quot;&gt; &lt;div class=&quot;icon&quot;&gt; &lt;i class=&quot;fas fa-mobile-alt&quot;&gt;&lt;/i&gt; &lt;/div&gt; &lt;div class=&quot;contact-info-text&quot;&gt; &lt;p&gt;&lt;span&gt;Phone:&lt;/span&gt; 089672323232&lt;/p&gt; &lt;/div&gt; &lt;/div&gt; &lt;/div&gt; &lt;/div&gt; &lt;/div&gt;` `&lt;/div&gt;`);
INSERT INTO `pages` (`page_id`, `page_title`, `path`, `status`, `content`) VALUES (10, `Faq`, `faq`, 1, &lt;!-- faq Page Start --&gt;
		&lt;div class=&quot;faq-area inner-page-sec-padding-bottom&quot;&gt;
			&lt;div class=&quot;container&quot;&gt;
				&lt;div class=&quot;row&quot;&gt;
					&lt;div class=&quot;col-lg-12&quot;&gt;
						&lt;div class=&quot;inner text-center&quot;&gt;
							&lt;h1&gt;GENERAL QUESTION&lt;/h1&gt;
						&lt;/div&gt;
					&lt;/div&gt;
				&lt;/div&gt;
				&lt;div class=&quot;row mbn-30&quot;&gt;
					
					&lt;div class=&quot;col-lg-6 col-12&quot;&gt;
						&lt;!--FAQ (Accordion) Start--&gt;
						&lt;div class=&quot;accordion&quot; id=&quot;gq-faqs-1&quot;&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-1&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipisc ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-1&quot; class=&quot;collapse show&quot; data-parent=&quot;#gq-faqs-1&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-2&quot;&gt;Vivamus feugiat, eros pretium porta ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-2&quot; class=&quot;collapse&quot; data-parent=&quot;#gq-faqs-1&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-3&quot;&gt;Donec molestie vitae turpis a efficitur ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-3&quot; class=&quot;collapse&quot; data-parent=&quot;#gq-faqs-1&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-4&quot;&gt;Nullam dignissim lectus diam, vitae elementum ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-4&quot; class=&quot;collapse&quot; data-parent=&quot;#gq-faqs-1&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
						&lt;/div&gt;&lt;!--FAQ (Accordion) End--&gt;
					&lt;/div&gt;
					
					&lt;div class=&quot;col-lg-6 col-12 accordion-2&quot;&gt;
						&lt;!--FAQ (Accordion) Start--&gt;
						&lt;div class=&quot;accordion&quot; id=&quot;gq-faqs-2&quot;&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-5&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipisc ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-5&quot; class=&quot;collapse show&quot; data-parent=&quot;#gq-faqs-2&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-6&quot;&gt;Vivamus feugiat, eros pretium porta ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-6&quot; class=&quot;collapse&quot; data-parent=&quot;#gq-faqs-2&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-7&quot;&gt;Donec molestie vitae turpis a efficitur ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-7&quot; class=&quot;collapse&quot; data-parent=&quot;#gq-faqs-2&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
							&lt;!--Cart Start--&gt;
							&lt;div class=&quot;card&quot;&gt;
								&lt;div class=&quot;card-header&quot;&gt;
									&lt;h5 class=&quot;mb-0&quot;&gt;&lt;button class=&quot;collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#gq-faq-8&quot;&gt;Nullam dignissim lectus diam, vitae elementum ?&lt;/button&gt;&lt;/h5&gt;
								&lt;/div&gt;
								&lt;div id=&quot;gq-faq-8&quot; class=&quot;collapse&quot; data-parent=&quot;#gq-faqs-2&quot;&gt;
									&lt;div class=&quot;card-body&quot;&gt;
										&lt;p&gt;Proin libero tellus, interdum ac pellentesque ac, malesuada a velit. Nullam fermentum massa nec sem condimentum, fermentum commodo felis accumsan.&lt;/p&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							&lt;/div&gt;&lt;!--Cart End--&gt;
							
						&lt;/div&gt;&lt;!--FAQ (Accordion) End--&gt;
					&lt;/div&gt;
					
				&lt;/div&gt;
			&lt;/div&gt;
		&lt;/div&gt;
		&lt;!-- faq Page End --&gt;);


#
# TABLE STRUCTURE FOR: product_comments
#

DROP TABLE IF EXISTS `product_comments`;

CREATE TABLE `product_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `replay_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`comment_id`),
  KEY `product_comments_user_id_foreign` (`user_id`),
  KEY `product_comments_product_id_foreign` (`product_id`),
  KEY `product_comments_replay_id_foreign` (`replay_id`),
  CONSTRAINT `product_comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_comments_replay_id_foreign` FOREIGN KEY (`replay_id`) REFERENCES `product_comments` (`comment_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `product_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: product_discount
#

DROP TABLE IF EXISTS `product_discount`;

CREATE TABLE `product_discount` (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_type` enum('PERCENTAGE','VALUE') NOT NULL DEFAULT 'PERCENTAGE',
  `discount_value` double NOT NULL,
  `product_id` bigint(20) NOT NULL,
  PRIMARY KEY (`discount_id`),
  KEY `product_discount_product_id_foreign` (`product_id`),
  CONSTRAINT `product_discount_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `product_discount` (`discount_id`, `discount_type`, `discount_value`, `product_id`) VALUES (2, `PERCENTAGE`, 2, 2);
INSERT INTO `product_discount` (`discount_id`, `discount_type`, `discount_value`, `product_id`) VALUES (6, `PERCENTAGE`, 5, 1);
INSERT INTO `product_discount` (`discount_id`, `discount_type`, `discount_value`, `product_id`) VALUES (7, `PERCENTAGE`, 20, 3);
INSERT INTO `product_discount` (`discount_id`, `discount_type`, `discount_value`, `product_id`) VALUES (8, `VALUE`, 5000, 10);


#
# TABLE STRUCTURE FOR: product_images
#

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mime` varchar(20) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (1, `http://localhost:8080/uploads/products/1671782536_6cb6b9cf0b0cada1db61`.`jpg`, `1671782536_6cb6b9cf0b0cada1db61`.`jpg`, `image/jpeg`, 0, 1);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (2, `http://localhost:8080/uploads/products/1671782571_67f8a987e75c91dceead`.`jpg`, `1671782571_67f8a987e75c91dceead`.`jpg`, `image/jpeg`, 1, 1);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (4, `http://localhost:8080/uploads/products/1671832468_24bd68bed8254f887be3`.`jpg`, `1671832468_24bd68bed8254f887be3`.`jpg`, `image/jpeg`, 0, 1);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (5, `http://localhost:8080/uploads/products/1671832861_e155a2ee2a1da7bba312`.`jpg`, `1671832861_e155a2ee2a1da7bba312`.`jpg`, `image/jpeg`, 1, 2);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (6, `http://localhost:8080/uploads/products/1671841431_07040eccc78370c83e78`.`jpg`, `1671841431_07040eccc78370c83e78`.`jpg`, `image/jpeg`, 1, 3);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (7, `http://localhost:8080/uploads/products/1671843092_2d0c49d3c36cf28f69fd`.`jpg`, `1671843092_2d0c49d3c36cf28f69fd`.`jpg`, `image/jpeg`, 0, 3);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (8, `http://localhost:8080/uploads/products/1671843596_251fded0dff2b58b2542`.`jpg`, `1671843596_251fded0dff2b58b2542`.`jpg`, `image/jpeg`, 1, 4);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (9, `http://localhost:8080/uploads/products/1671843716_6e0aec272e2bceda067f`.`jpg`, `1671843716_6e0aec272e2bceda067f`.`jpg`, `image/jpeg`, 1, 7);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (10, `http://localhost:8080/uploads/products/1671843734_6e12df0c5e66d749ea4c`.`jpg`, `1671843734_6e12df0c5e66d749ea4c`.`jpg`, `image/jpeg`, 1, 14);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (11, `http://localhost:8080/uploads/products/1671843754_9a811e572b34aba752af`.`jpg`, `1671843754_9a811e572b34aba752af`.`jpg`, `image/jpeg`, 1, 9);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (12, `http://localhost:8080/uploads/products/1671843766_2c2b7940260903be4564`.`jpg`, `1671843766_2c2b7940260903be4564`.`jpg`, `image/jpeg`, 1, 8);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (13, `http://localhost:8080/uploads/products/1671843780_124782418ad976cf044f`.`jpg`, `1671843780_124782418ad976cf044f`.`jpg`, `image/jpeg`, 1, 5);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (14, `http://localhost:8080/uploads/products/1671843793_137e081ba6221382cffa`.`jpg`, `1671843793_137e081ba6221382cffa`.`jpg`, `image/jpeg`, 1, 12);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (15, `http://localhost:8080/uploads/products/1671843803_cc31a2420c51e62f15da`.`jpg`, `1671843803_cc31a2420c51e62f15da`.`jpg`, `image/jpeg`, 1, 10);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (16, `http://localhost:8080/uploads/products/1671843825_974bd30899a2374a5eca`.`jpg`, `1671843825_974bd30899a2374a5eca`.`jpg`, `image/jpeg`, 1, 13);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (17, `http://localhost:8080/uploads/products/1671843842_bec5dc232945d94d0b79`.`jpg`, `1671843842_bec5dc232945d94d0b79`.`jpg`, `image/jpeg`, 1, 6);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (18, `http://localhost:8080/uploads/products/1671843882_8293137bcda164e35cf1`.`jpg`, `1671843882_8293137bcda164e35cf1`.`jpg`, `image/jpeg`, 1, 11);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (19, `http://localhost:8080/uploads/products/1671870575_34082d22d78f5dc59cc8`.`jpg`, `1671870575_34082d22d78f5dc59cc8`.`jpg`, `image/jpeg`, 0, 10);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (20, `http://localhost:8080/uploads/products/1671943930_74f3ae794dfcacb3f778`.`jpg`, `1671943930_74f3ae794dfcacb3f778`.`jpg`, `image/jpeg`, 0, 10);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (21, `http://localhost:8080/uploads/products/1671943940_80a7190789d054cb018b`.`jpg`, `1671943940_80a7190789d054cb018b`.`jpg`, `image/jpeg`, 0, 10);
INSERT INTO `product_images` (`image_id`, `image`, `name`, `mime`, `is_primary`, `product_id`) VALUES (22, `http://localhost:8080/uploads/products/1671943963_67bd6021b576cdb76b36`.`jpg`, `1671943963_67bd6021b576cdb76b36`.`jpg`, `image/jpeg`, 0, 10);


#
# TABLE STRUCTURE FOR: product_meta
#

DROP TABLE IF EXISTS `product_meta`;

CREATE TABLE `product_meta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `product_id` bigint(20) NOT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `product_meta_product_id_foreign` (`product_id`),
  CONSTRAINT `product_meta_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `product_meta` (`meta_id`, `key`, `content`, `product_id`) VALUES (2, `meta-title`, `&lt;p&gt; &lt;/p&gt;&lt;p&gt;Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;` `&lt;/p&gt;`, 1);
INSERT INTO `product_meta` (`meta_id`, `key`, `content`, `product_id`) VALUES (3, `meta-description`, `Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt;` `&lt;strong&gt;here&lt;/strong&gt;`, 2);


#
# TABLE STRUCTURE FOR: product_reviews
#

DROP TABLE IF EXISTS `product_reviews`;

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`review_id`),
  KEY `product_reviews_user_id_foreign` (`user_id`),
  KEY `product_reviews_product_id_foreign` (`product_id`),
  CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (1, `dfgdfgdfg`, 3, 1, 1, `2022-12-24` `14:55:57`, `2022-12-24` `15:02:27`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (2, `sfdsfsdfdsfsdf`, 3, 1, 7, `2022-12-24` `17:26:39`, `2022-12-24` `17:26:39`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (10, `dfgdfgdfgdfgdfgdf`, 2, 1, 1, `2022-12-24` `17:35:35`, `2022-12-24` `17:39:23`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (11, `bagus` `banget`, 4, 1, 10, `2022-12-25` `13:07:58`, `2022-12-25` `13:07:58`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (16, `keren`, 5, 1, 1, `2022-12-26` `06:27:27`, `2022-12-26` `06:27:27`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (17, `ok lah` `but`, 2, 1, 6, `2022-12-26` `06:27:40`, `2022-12-26` `06:27:40`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (18, `bagus`, 4, 1, 5, `2022-12-26` `06:29:53`, `2022-12-26` `06:29:53`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (19, `review` `products`, 3, 1, 3, `2022-12-26` `06:37:58`, `2022-12-26` `06:37:58`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (20, `ok`, 3, 1, 2, `2022-12-26` `08:17:52`, `2022-12-26` `08:17:52`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (21, `bagus` `banget`, 3, 1, 3, `2022-12-29` `22:20:03`, `2022-12-29` `22:20:03`);
INSERT INTO `product_reviews` (`review_id`, `review`, `rating`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES (22, `bagus` `banget`, 4, 7, 3, `2022-12-29` `22:21:11`, `2022-12-29` `22:21:11`);


#
# TABLE STRUCTURE FOR: product_tags
#

DROP TABLE IF EXISTS `product_tags`;

CREATE TABLE `product_tags` (
  `products_tags_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  PRIMARY KEY (`products_tags_id`),
  KEY `product_tags_tag_id_foreign` (`tag_id`),
  KEY `product_tags_product_id_foreign` (`product_id`),
  CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES (1, 2, 1);
INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES (2, 3, 2);
INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES (3, 2, 3);
INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES (5, 4, 7);
INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES (6, 4, 7);
INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES (7, 2, 4);
INSERT INTO `product_tags` (`products_tags_id`, `tag_id`, `product_id`) VALUES (8, 4, 14);


#
# TABLE STRUCTURE FOR: products
#

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, `addidas New Hammer sole for` `Sp`, `addidas-New-Hammer-sole-for-Sp`, `sfdsdfsfd`, `Capple`, NULL, 9, 30000, 23, 1, 0, `Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt;` `&lt;strong&gt;here&lt;/strong&gt;`, 1, 2, 42, 1, `2022-12-23` `15:02:16`, `2023-01-13` `14:58:25`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, `Beats EP Wired On-Ear` `Headphone-Black`, `Beats-EP-Wired-On-Ear-Headphone-Black`, Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!, `Long printed dress with thin adjustable straps`.` V-neckline and wiring under the Dust with ruffles at the bottom of the` `dress`., NULL, 2, 22000, 12, 1, 1, `Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt;` `&lt;strong&gt;here&lt;/strong&gt;`, 1, 5, 12, 1, `2022-12-24` `05:01:01`, `2023-01-02` `07:05:54`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, `addidas New Hammer sole for Sports` `person`, `addidas-New-Hammer-sole-for-Sports-person`, `adsasdasdads`, , NULL, 2, 13000, 213, 1, 0, `Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;content&lt;/u&gt;` `&lt;strong&gt;here&lt;/strong&gt;`, 1, 121, 123, 1, `2022-12-24` `07:23:51`, `2023-01-02` `06:59:05`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, `Distinctio` `cumque`., `Distinctio-cumque`, `Aliquid architecto quos rerum laboriosam magni`.` Ullam aut eveniet amet saepe qui`.` Et omnis deleniti eligendi voluptatem saepe` `accusantium`., `Et maxime et enim molestiae` `quaerat`., NULL, NULL, 10000, 6, 1, 0, `hallo` `bang`, 1, 0, 1, 1, `2022-12-24` `07:59:14`, `2022-12-25` `11:43:07`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, `Eos` `vero`., `Eos-vero`, `Sit perferendis et qui nulla`.` Necessitatibus id suscipit minima`.` Repellat quia ea et qui sapiente aut`.` Corrupti expedita eos nostrum` `debitis`., `Eum deserunt doloribus voluptatem nulla` `nobis`., NULL, 2, 12000, 7, 1, 0, `hallo` `bang`, 1, 10, 1, 1, `2022-12-24` `08:01:27`, `2023-01-02` `07:00:25`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, `Qui ipsum` `eveniet`., `Qui-ipsum-eveniet`, `Odit veritatis veniam in ut`.` Numquam ullam enim quam sed ab quod iusto`.` Eos voluptate non ea` `dolor`., `Aperiam occaecati labore` `nihil`., NULL, 7, 50000, 6, 0, 0, `hallo` `bang`, 1, 12, 1, 1, `2022-12-24` `08:01:27`, `2022-12-29` `05:35:44`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, `Adipisci` `quia`., `Adipisci-quia`, `Officia dolorum quos sint at rerum`.` Molestiae rerum tenetur qui et`.` Quia velit voluptas minus quo enim`.` Praesentium quod illo sit` `dicta`., `Modi ad quisquam optio earum` `rerum`., NULL, 4, 8, 4, 1, 0, `&lt;p&gt;&lt;img style=&quot;width: 700px;&quot; src=&quot;data:image/jpeg;base64,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&quot; data-filename=&quot;product-3`.`jpg&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Arial&amp;quot;;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: &amp;quot;Arial&amp;quot;;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;table class=&quot;table` `table-bordered&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;berat&lt;br&gt;&lt;/td&gt;&lt;td&gt;sfd&lt;br&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;ringan&lt;br&gt;&lt;/td&gt;&lt;td&gt;sfd&lt;br&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;`, 1, 1, 1, 2, `2022-12-24` `08:01:27`, `2022-12-26` `09:10:34`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, `Iure blanditiis` `id`., `Iure-blanditiis-id`, `In nostrum corporis suscipit minima`.` Libero et ullam corporis` `omnis`., `Non et soluta odit et architecto` `quibusdam`., NULL, 3, 1, 1, 1, 0, `hallo` `bang`, 1, 0, 1, NULL, `2022-12-24` `08:01:27`, `2022-12-24` `08:17:36`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, `Dolores et et` `aut`., `Dolores-et-et-aut`, `Magni earum laborum odio dignissimos`.` Est enim ea non porro`.` Illo et aut sapiente rerum voluptatem`.` Modi et eum dolore et` `nobis`., `Quam nulla aut unde sunt minus` `porro`., NULL, 7, 1, 4, 1, 0, `hallo` `bang`, 1, 0, 1, NULL, `2022-12-24` `08:01:27`, `2022-12-24` `08:06:18`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, `Officia` `ullam`., `Officia-ullam`, `Sed porro placeat aliquam rem et at facilis`.` Quos quasi sed porro ducimus ut est`.` Commodi optio voluptatibus ut tempora corrupti` `et`., `Et atque qui nisi omnis ullam nostrum` `accusamus`., NULL, 3, 15000, 0, 1, 0, `hallo` `bang`, 1, 0, 1, 1, `2022-12-24` `08:01:27`, `2022-12-24` `12:03:23`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, `Vero qui` `quas`., `Vero-qui-quas`, `Error ducimus aut numquam mollitia`.` Dolor voluptate maiores voluptatum`.` Qui aspernatur itaque ea dolorem qui quia`.` Vel quo excepturi sunt aut` `sit`., `Laboriosam sint dignissimos minus` `aut`., NULL, 7, 1, 1, 1, 0, `hallo` `bang`, 1, 0, 1, NULL, `2022-12-24` `08:01:27`, `2022-12-24` `08:07:54`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (12, `Non est est` `quas`., `Non-est-est-quas`, `Sed odit quia quas eos ullam mollitia repellat`.` Aut consequatur labore culpa sint voluptatem repudiandae` `reiciendis`., `Earum dicta aut` `inventore`., NULL, 9, 6, 4, 1, 1, `hallo` `bang`, 1, -2, 1, NULL, `2022-12-24` `08:01:28`, `2022-12-29` `05:29:36`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (13, `Qui id` `consequatur`., `Qui-id-consequatur`, `Quis quis cupiditate voluptas reiciendis`.` Quos accusamus dolore reprehenderit nostrum`.` Impedit iste aperiam reiciendis` `sequi`., `Aut consequatur est harum molestiae` `modi`., NULL, 4, 6, 8, 1, 0, `hallo` `bang`, 1, 0, 1, NULL, `2022-12-24` `08:01:28`, `2022-12-24` `08:09:03`, NULL);
INSERT INTO `products` (`product_id`, `title`, `slug`, `description`, `short_description`, `discount`, `category_id`, `price`, `weight`, `featured`, `new_label`, `content`, `status`, `stock`, `sku`, `brand_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (14, `Animi quasi sint` `ea`., `Animi-quasi-sint-ea`, `Similique maiores quisquam beatae aut`.` Omnis ea voluptatem velit error delectus`.` Nisi quia sit quia reprehenderit id sit et` `consequatur`., `Qui dicta est error distinctio` `eveniet`., NULL, NULL, 2, 0, 1, 0, `hallo` `bang`, 1, 0, 1, NULL, `2022-12-24` `08:01:28`, `2022-12-24` `08:06:11`, NULL);


#
# TABLE STRUCTURE FOR: reset_link
#

DROP TABLE IF EXISTS `reset_link`;

CREATE TABLE `reset_link` (
  `reset_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `expired` datetime NOT NULL,
  `type` enum('RESET_PASSWORD_USER','CONFIRM_EMAIL_USER','CONFIRM_EMAIL_ADMIN') NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`reset_id`),
  KEY `reset_link_user_id_foreign` (`user_id`),
  CONSTRAINT `reset_link_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `reset_link` (`reset_id`, `code`, `expired`, `type`, `user_id`) VALUES (11, `63b1905fe7717246`, `2023-01-02` `20:53:35`, `CONFIRM_EMAIL_USER`, 2);
INSERT INTO `reset_link` (`reset_id`, `code`, `expired`, `type`, `user_id`) VALUES (12, `63b190a7b0ee01770`, `2023-01-02` `20:54:47`, `CONFIRM_EMAIL_USER`, 1);


#
# TABLE STRUCTURE FOR: roles
#

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(200) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  PRIMARY KEY (`role_id`),
  KEY `roles_admin_id_foreign` (`admin_id`),
  CONSTRAINT `roles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`role_id`, `role`, `admin_id`) VALUES (5, `\App\Controllers\Admin\WebsiteController::index`, 3);
INSERT INTO `roles` (`role_id`, `role`, `admin_id`) VALUES (6, `\App\Controllers\Admin\ProductController::index`, 3);
INSERT INTO `roles` (`role_id`, `role`, `admin_id`) VALUES (7, `\App\Controllers\Admin\ProductController::create`, 3);
INSERT INTO `roles` (`role_id`, `role`, `admin_id`) VALUES (10, `\App\Controllers\Admin\MailController::promo`, 3);
INSERT INTO `roles` (`role_id`, `role`, `admin_id`) VALUES (12, `\App\Controllers\Admin\ReportController::visitor_perweek`, 4);


#
# TABLE STRUCTURE FOR: session_cart
#

DROP TABLE IF EXISTS `session_cart`;

CREATE TABLE `session_cart` (
  `session_cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `content` text DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  PRIMARY KEY (`session_cart_id`),
  KEY `session_cart_user_id_foreign` (`user_id`),
  KEY `session_cart_product_id_foreign` (`product_id`),
  CONSTRAINT `session_cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `session_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

INSERT INTO `session_cart` (`session_cart_id`, `user_id`, `product_id`, `content`, `discount`, `quantity`, `price`, `total`, `product_img`) VALUES (129, 2, 13, NULL, NULL, 1, 6, 6, `http://localhost:8080/uploads/products/1671843825_974bd30899a2374a5eca`.`jpg`);
INSERT INTO `session_cart` (`session_cart_id`, `user_id`, `product_id`, `content`, `discount`, `quantity`, `price`, `total`, `product_img`) VALUES (150, 7, 6, NULL, NULL, 1, 50000, 50000, `http://localhost:8080/uploads/products/1671843842_bec5dc232945d94d0b79`.`jpg`);
INSERT INTO `session_cart` (`session_cart_id`, `user_id`, `product_id`, `content`, `discount`, `quantity`, `price`, `total`, `product_img`) VALUES (151, 6, 1, NULL, NULL, 1, 28500, 28500, `http://localhost:8080/uploads/products/1671782536_6cb6b9cf0b0cada1db61`.`jpg`);
INSERT INTO `session_cart` (`session_cart_id`, `user_id`, `product_id`, `content`, `discount`, `quantity`, `price`, `total`, `product_img`) VALUES (169, 14, 1, NULL, NULL, 1, 28500, 28500, `http://localhost:8080/uploads/products/1671782536_6cb6b9cf0b0cada1db61`.`jpg`);


#
# TABLE STRUCTURE FOR: session_emoney
#

DROP TABLE IF EXISTS `session_emoney`;

CREATE TABLE `session_emoney` (
  `session_emoney_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `method` varchar(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `expired` datetime NOT NULL,
  PRIMARY KEY (`session_emoney_id`),
  KEY `session_emoney_user_id_foreign` (`user_id`),
  CONSTRAINT `session_emoney_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `session_emoney` (`session_emoney_id`, `name`, `method`, `url`, `order_id`, `user_id`, `expired`) VALUES (1, `generate-qr-code`, `GET`, `https://api`.`sandbox`.`midtrans`.`com/v2/qris/b968b908-3b9f-4fd2-a483-3b9e562c5b8b/qr-code`, `asd`, 1, `2022-12-29` `07:34:37`);
INSERT INTO `session_emoney` (`session_emoney_id`, `name`, `method`, `url`, `order_id`, `user_id`, `expired`) VALUES (2, `generate-qr-code`, `GET`, `https://api`.`sandbox`.`midtrans`.`com/v2/qris/112c8bda-e2d7-483c-96dd-ce8009e5b268/qr-code`, `163acdd923cfdc`, 1, `2022-12-29` `07:36:37`);


#
# TABLE STRUCTURE FOR: sliders
#

DROP TABLE IF EXISTS `sliders`;

CREATE TABLE `sliders` (
  `slider_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `title` varchar(50) NOT NULL,
  `subtitle` varchar(50) NOT NULL,
  `subtitle_color` varchar(50) DEFAULT NULL,
  `short_description` varchar(100) NOT NULL,
  `link_label` varchar(20) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `sliders` (`slider_id`, `image`, `image_name`, `title`, `subtitle`, `subtitle_color`, `short_description`, `link_label`, `link`) VALUES (5, `http://localhost:8080/uploads/sliders/1671780769_da0b3633f418a68b7266`.`jpg`, `1671780769_da0b3633f418a68b7266`.`jpg`, `HARD` `COVER`, `Book` `Mockup`, `#61ab00`, `Cover up front of book and leave` `summary`, `Shop` `Now`, `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);
INSERT INTO `sliders` (`slider_id`, `image`, `image_name`, `title`, `subtitle`, `subtitle_color`, `short_description`, `link_label`, `link`) VALUES (6, `http://localhost:8080/uploads/sliders/1671803484_a426a5ea7fe3694f31ee`.`jpg`, `1671803484_a426a5ea7fe3694f31ee`.`jpg`, `Big` `Promo`, `Promo` `Beneran`, `#80ff00`, `Menangkan Berbagai hadiah` `unik`, `Shop` `Now`, `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);
INSERT INTO `sliders` (`slider_id`, `image`, `image_name`, `title`, `subtitle`, `subtitle_color`, `short_description`, `link_label`, `link`) VALUES (9, `http://localhost:8080/uploads/sliders/1671804055_2e55a2e9bcf3d198e368`.`png`, `1671804055_2e55a2e9bcf3d198e368`.`png`, `Banner` 770, `Banner 770 x` 550, `#000000`, `banner`, `Shop` `Now`, `http://localhost:8080/index`.`php/DEV_ADMIN/slider`);


#
# TABLE STRUCTURE FOR: smtp
#

DROP TABLE IF EXISTS `smtp`;

CREATE TABLE `smtp` (
  `protocol` varchar(50) DEFAULT NULL,
  `host` varchar(200) DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `crypto` varchar(50) DEFAULT NULL,
  `type` enum('text','html') NOT NULL DEFAULT 'text',
  `useragent` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `smtp` (`protocol`, `host`, `user`, `password`, `port`, `crypto`, `type`, `useragent`) VALUES (`smtp`, `smtp`.`googlemail`.`com`, `farriqmuwaffaq100@gmail`.`com`, `whonugpepoidvnwo`, 465, `ssl`, `html`, );


#
# TABLE STRUCTURE FOR: tags
#

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `tags` (`tag_id`, `tag`) VALUES (2, `tags` 2);
INSERT INTO `tags` (`tag_id`, `tag`) VALUES (3, `tag2`);
INSERT INTO `tags` (`tag_id`, `tag`) VALUES (4, `tag` `gue`);


#
# TABLE STRUCTURE FOR: unique_visitor
#

DROP TABLE IF EXISTS `unique_visitor`;

CREATE TABLE `unique_visitor` (
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `unique_visitor` (`visit_id`, `ip`, `created_at`) VALUES (1, `::1`, `2023-01-06` `14:00:47`);
INSERT INTO `unique_visitor` (`visit_id`, `ip`, `created_at`) VALUES (2, `::1`, `2023-01-13` `14:06:01`);


#
# TABLE STRUCTURE FOR: user_address
#

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address` (
  `user_address_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`user_address_id`),
  KEY `user_address_user_id_foreign` (`user_id`),
  CONSTRAINT `user_address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `user_address` (`user_address_id`, `firstname`, `lastname`, `phone`, `address1`, `address2`, `province`, `city`, `postcode_zip`, `address_notes`, `primary`, `user_id`) VALUES (2, `fds`, `sfd`, 243, 234, , 15, 4, 234, , 1, 2);
INSERT INTO `user_address` (`user_address_id`, `firstname`, `lastname`, `phone`, `address1`, `address2`, `province`, `city`, `postcode_zip`, `address_notes`, `primary`, `user_id`) VALUES (6, `user1`, `Aji`, 089692107175, `jl`.`selat karimata` `bandengan`, , 6, 189, 5453, , 1, 1);
INSERT INTO `user_address` (`user_address_id`, `firstname`, `lastname`, `phone`, `address1`, `address2`, `province`, `city`, `postcode_zip`, `address_notes`, `primary`, `user_id`) VALUES (7, `farriq`, `names`, 08122108, 132123, , 5, 39, 123123, , 0, 1);
INSERT INTO `user_address` (`user_address_id`, `firstname`, `lastname`, `phone`, `address1`, `address2`, `province`, `city`, `postcode_zip`, `address_notes`, `primary`, `user_id`) VALUES (10, `farriq`, `bonjames`, 089692107175, `jl`.`selat karimata` `bandengan`, , 8, 156, 51143, , 1, 14);
INSERT INTO `user_address` (`user_address_id`, `firstname`, `lastname`, `phone`, `address1`, `address2`, `province`, `city`, `postcode_zip`, `address_notes`, `primary`, `user_id`) VALUES (11, `farriq`, `bonjames`, 089692107172, 132123, , 14, 44, 51143, 123, 1, 15);


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verification`, `password`, `created_at`, `updated_at`) VALUES (1, `farriq`, `user@gmail`.`com`, 0, `$2y$10$8RMAc`.`n2XX7aFOG8GWk5PuFsix72/NSOaS3C0/I4ypx/EwviID4K6`, `2022-12-29` `19:05:29`, `2022-12-29` `19:05:29`);
INSERT INTO `users` (`user_id`, `name`, `email`, `email_verification`, `password`, `created_at`, `updated_at`) VALUES (2, `jalak`, `jalak@mail`.`com`, 0, `$2y$10$1YLbzLiFypzFuEI0f8Wzwug8W05`.`/HS36eykhiowJcVIgmoZkWU4m`, `2022-11-29` `19:05:29`, `2022-12-31` `06:37:33`);
INSERT INTO `users` (`user_id`, `name`, `email`, `email_verification`, `password`, `created_at`, `updated_at`) VALUES (6, `farriq`, `farriq@yahoo`.`com`, 0, `$2y$10$wDCaAFy1o7tuDx`.`nEZu3SemS6D8t0yf370mJ9RXH6MYLkp2LxtXAy`, `2022-11-24` `19:22:25`, `2022-12-31` `06:37:30`);
INSERT INTO `users` (`user_id`, `name`, `email`, `email_verification`, `password`, `created_at`, `updated_at`) VALUES (7, `james`, `james@yahoo`.`com`, 0, `$2y$10$degB0cnkkHStnZJxCIYwYeej1/H5yaAq4/SMCa7xAEbMJxRcY8ngy`, `2022-11-22` `00:00:00`, `2022-12-31` `06:36:19`);
INSERT INTO `users` (`user_id`, `name`, `email`, `email_verification`, `password`, `created_at`, `updated_at`) VALUES (14, `bon` `james`, `bonjames020@gmail`.`com`, 1, `$2y$10$cDZimaQFFhFcgyd8rfNX2egvnPED1p2WByOgGV`.`IXiezoasUKrIu`., `2023-01-01` `20:31:07`, `2023-01-06` `14:25:07`);
INSERT INTO `users` (`user_id`, `name`, `email`, `email_verification`, `password`, `created_at`, `updated_at`) VALUES (15, `farriq`, `farriqtamvan22@gmail`.`com`, 1, `$2y$10$2Btq1Tavjj/PsdVWxF`.`baOmBtU4A`.`4rD388IIY`.`1GF8vH86Ma8MzG`, `2023-01-01` `20:33:22`, `2023-01-01` `21:03:07`);


#
# TABLE STRUCTURE FOR: website
#

DROP TABLE IF EXISTS `website`;

CREATE TABLE `website` (
  `title_separator` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `favicon_name` varchar(255) DEFAULT NULL,
  `logo_name` varchar(100) DEFAULT NULL,
  `support_content` text DEFAULT NULL,
  `information_content` text DEFAULT NULL,
  `extras_content` text DEFAULT NULL,
  `footer_content` text DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `company_phone` int(11) DEFAULT NULL,
  `company_email` varchar(150) DEFAULT NULL,
  `shipping_origin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `website` (`title_separator`, `logo`, `favicon`, `favicon_name`, `logo_name`, `support_content`, `information_content`, `extras_content`, `footer_content`, `company_address`, `company_phone`, `company_email`, `shipping_origin`) VALUES (`Pustok`, `http://localhost:8080/uploads/website/1672359772_e0afa4ea9cbc67fc6120`.`png`, `http://localhost:8080/uploads/website/1672359772_b810443572734cd2bf82`.`ico`, `1672359772_b810443572734cd2bf82`.`ico`, `1672359772_e0afa4ea9cbc67fc6120`.`png`, `&lt;div class=&quot;text&quot;&gt; &lt;p&gt;Free Support 24/7&lt;/p&gt; &lt;p class=&quot;font-weight-bold number&quot;&gt;WA : +62091392137&lt;/p&gt;` `&lt;/div&gt;&lt;p&gt;&lt;/p&gt;`, `&lt;ul class=&quot;footer-list normal-list&quot;&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Prices drop&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;New products&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Best sales&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Contact us&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Sitemap&lt;/a&gt;&lt;/li&gt;` `&lt;/ul&gt;`, `&lt;ul class=&quot;footer-list normal-list&quot;&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Delivery&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;About Us&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Stores&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Contact us&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Sitemap&lt;/a&gt;&lt;/li&gt;` `&lt;/ul&gt;`, `&lt;p align=&quot;center&quot;&gt;&lt;img style=&quot;width: 181px;&quot; src=&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALUAAAAnCAMAAAB+I/nTAAAC9FBMVEVMaXEuUAAYKgBZnAAWJwADBQAkQAAFCABSjwAfNgA+awAuUABJgAASIQANGAA6ZgA5YwBTkQAPGgBBcgBPiQAOGAAhOgANFwA/bQBVlABJfwAZKwBfpQANFwA3YABOiABfpgASHwBGegAoRQBRjgBlsAAeNQAVJABqugAvUgAVJQAXJwBptwBZnABOiABruwA/bwBdowAqSwAcMQBmsgBJfwBtvgAqSQBnswBAcABtvgBMhgAkPwAxVgBsvABZnABiqwBtvgBirAAkPwAyWABkrwBtvgBAcABDdQBiqwBquQBrvABXmAAwVABsvgA+bABAcABiqwBepAAwVQBptwBtvgBKggBiqwBQiwA/bwBSjwBtvgAkQABjrABotwBcoQAuUABotwBiqwBsvQBptwBRjgBZnQA8aQBiqwA2XwBDdQBsvQBiqwBntABOiABAbwBAcABtvgBotwA2XwBpuABGegBepABiqwAwVABrugBkrwBiqwBtvgBlsABAcABdowBiqwBnswBiqwBsvABpuABZnABsvQBiqwBtvgBNhgBAcABlsABcoABpuABtvgBiqwBSjwBpuABAcABanQBiqwBNhgBsvABTkgBVlABiqwBDdQBotwBtvgBAcABiqwBotwBNhwBtvgBotgBOiABtvgBcoABhqQBquQBpuABnswBtvgBiqwBRjgBpuABDdgBNhwBiqwBsvABlsgBiqwBmsgBcoABpuABiqwBiqwBlsQBSjwBiqwBsvABZnABiqwBOiABbngBmswBiqwBptwBruwBiqwBSjwBtvgBkrwBotgBquQBiqwBlsQBruwBiqwBotQBrvABjrABksABsvABsvgBlsQBotgBiqwBiqwBquQBotgBrvABiqwBiqwBlsABsvQBjrABiqwBlsQBotgBruwBjrABtvQBpuABirABotgBquQBirABkrgBiqwBlsQBirABiqwBotgBiqwBqugBjrABiqwBkrwBlsABnswBotgBrvABtvgDLqkw1AAAA9XRSTlMAAgQEBwgJCQkKCw0NDhAQERETFBQXGBkZGhsbHB0eICAhISIjJCUmJygoKSouLjAwMDEyNjY3ODk6Ojs7PDw9QEFCQkRERkZJSktPT09SUlRVVllaW1tbXF1f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&quot; data-filename=&quot;logo`.`png&quot;&gt;&lt;/p&gt;&lt;h3 class=&quot;&quot; align=&quot;center&quot;&gt;&lt;font color=&quot;#FFFFFF&quot;&gt;&lt;span style=&quot;font-weight: normal;&quot;&gt;Buy Your Favorite Book` `here&lt;/span&gt;&lt;/font&gt;&lt;br&gt;&lt;/h3&gt;`, `Bandengan,Pekalongan`, 2147483647, `pustok-helper@yahoo`.`com`, 349);


