DROP TABLE IF EXISTS CartItem;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Laptops;
DROP TABLE IF EXISTS Categories;
CREATE TABLE Categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(30)
);
INSERT INTO Categories (category)
VALUES ('Datorer');
CREATE TABLE Laptops (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    price INT,
    popularityFactor INT,
    categoryId INT,
    imgUrl VARCHAR(1000),
    description VARCHAR(1000),
    FOREIGN KEY(categoryId) REFERENCES Categories(id)
);
INSERT INTO Laptops (
        name,
        price,
        imgURl,
        categoryId,
        description,
        popularityFactor
    )
VALUES (
        'Silver Samsung Galaxy Book4',
        12000,
        'https://images.pexels.com/photos/18105/pexels-photo.jpg',
        1,
        'Samsung Galaxy Book4 laptop är en kapabel och lätt enhet, utformad för arbete och kreativitet på språng.',
        7
    ),
    (
        'Black Samsung Galaxy Book4',
        11700,
        'https://images.pexels.com/photos/4006143/pexels-photo-4006143.jpeg',
        1,
        'Samsung Galaxy Book4 laptop är en kapabel och lätt enhet, utformad för arbete och kreativitet på språng.',
        10
    ),
    (
        'Black Acer Chromebook 314',
        5200,
        'https://images.unsplash.com/photo-1496181133206-80ce9b88a853',
        1,
        'Acer Chromebook 314 bärbar dator erbjuder smidig vardagsprestanda.',
        12
    ),
    (
        'Black ASUS Vivobook X1504',
        4400,
        'https://images.unsplash.com/photo-1515879218367-8466d910aaa4',
        1,
        'Antireflexbehandlat glas och en praktisk 180° gångjärn erbjuder mångsidig design, smidig drift och effektiv prestanda.',
        2
    ),
    (
        'Lenovo IdeaPad Slim 3',
        6000,
        'https://images.pexels.com/photos/7793662/pexels-photo-7793662.jpeg',
        1,
        'Bärbar dator erbjuder mobilitet och effektivitet med AMD Ryzen 7-processor.',
        13
    ),
    (
        'HP Pavilion 15',
        5200,
        'https://images.pexels.com/photos/205421/pexels-photo-205421.jpeg',
        1,
        'HP Pavilion 15 är en mångsidig laptop med bra prestanda för både arbete och studier.',
        3
    ),
    (
        'Dell Inspiron 14',
        5800,
        'https://images.unsplash.com/photo-1593642634367-d91a135587b5',
        1,
        'Dell Inspiron 14 erbjuder pålitlig prestanda och kompakt design för dagligt bruk.',
        5
    ),
    (
        'Apple MacBook Air M1',
        9500,
        'https://images.unsplash.com/photo-1517336714731-489689fd1ca8',
        1,
        'MacBook Air med M1-chip levererar snabb prestanda och lång batteritid.',
        4
    ),
    (
        'Lenovo ThinkPad E14',
        7200,
        'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed',
        1,
        'Robust affärslaptop med stark prestanda.',
        6
    ),
    (
        'ASUS ZenBook 14',
        8800,
        'https://images.pexels.com/photos/34317747/pexels-photo-34317747.jpeg',
        1,
        'Elegant design med kraftfull prestanda.',
        8
    ),
    (
        'Acer Aspire 5',
        4900,
        'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
        1,
        'Prisvärd laptop med bra balans.',
        9
    ),
    (
        'Microsoft Surface Laptop Go 2',
        8300,
        'https://images.pexels.com/photos/6372894/pexels-photo-6372894.jpeg',
        1,
        'Lätt och stilren laptop perfekt för studier.',
        1
    ),
    (
        'HP Envy x360',
        9100,
        'https://images.unsplash.com/photo-1537498425277-c283d32ef9db',
        1,
        'Flexibel 2-i-1 laptop med pekskärm.',
        11
    ),
    (
        'Dell XPS 13',
        12000,
        'https://images.unsplash.com/photo-1492724441997-5dc865305da7',
        1,
        'Premiumlaptop med högupplöst skärm.',
        14
    ),
    (
        'Acer Swift 3',
        6700,
        'https://images.pexels.com/photos/6598/coffee-desk-laptop-notebook.jpg',
        1,
        'Tunn och lätt laptop med bra batteritid.',
        15
    );
CREATE TABLE Cart (
    cartId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE CartItem (
    cartItemId INT PRIMARY KEY AUTO_INCREMENT,
    cartId INT,
    productId INT,
    quantity INT DEFAULT 1,
    FOREIGN KEY (cartId) REFERENCES cart (cartId),
    FOREIGN KEY (productId) REFERENCES Laptops(id)
);
ALTER TABLE CartItem
ADD UNIQUE (cartId, productId);

-- PHP-Auth (https://github.com/delight-im/PHP-Auth)
-- Copyright (c) delight.im (https://www.delight.im/)
-- Licensed under the MIT License (https://opensource.org/licenses/MIT)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `verified` tinyint unsigned NOT NULL DEFAULT '0',
  `resettable` tinyint unsigned NOT NULL DEFAULT '1',
  `roles_mask` int unsigned NOT NULL DEFAULT '0',
  `registered` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `force_logout` mediumint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users_2fa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `mechanism` tinyint unsigned NOT NULL,
  `seed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int unsigned NOT NULL,
  `expires_at` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_mechanism` (`user_id`,`mechanism`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users_audit_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `event_at` int unsigned NOT NULL,
  `event_type` varchar(128) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `admin_id` int unsigned DEFAULT NULL,
  `ip_address` varchar(49) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_json` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_at` (`event_at`),
  KEY `user_id_event_at` (`user_id`,`event_at`),
  KEY `user_id_event_type_event_at` (`user_id`,`event_type`,`event_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users_confirmations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `email_expires` (`email`,`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users_otps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `mechanism` tinyint unsigned NOT NULL,
  `single_factor` tinyint unsigned NOT NULL DEFAULT '0',
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires_at` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_mechanism` (`user_id`,`mechanism`),
  KEY `selector_user_id` (`selector`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users_remembered` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` int unsigned NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users_resets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` int unsigned NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user_expires` (`user`,`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float NOT NULL,
  `replenished_at` int unsigned NOT NULL,
  `expires_at` int unsigned NOT NULL,
  PRIMARY KEY (`bucket`),
  KEY `expires_at` (`expires_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS UserDetails (
                id INT PRIMARY KEY,
                streetaddress VARCHAR(50),
                name VARCHAR(50),
                postalCode VARCHAR(10),
                city VARCHAR(50)            
                )

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
