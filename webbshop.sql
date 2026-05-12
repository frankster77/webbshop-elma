DROP TABLE IF EXISTS CartIteam;
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
1,'Samsung Galaxy Book4 laptop är en kapabel och lätt enhet, utformad för arbete och kreativitet på språng.',
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