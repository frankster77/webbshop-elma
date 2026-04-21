DROP TABLE IF EXISTS Laptops;
DROP TABLE IF EXISTS Categories;

CREATE TABLE Categories (
id INT PRIMARY KEY AUTO_INCREMENT,
category VARCHAR(30)
);

INSERT INTO Categories ( category)
VALUES
('Datorer');

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

INSERT INTO Laptops ( name, price, imgURl, categoryId, description)
VALUES
('Silver Samsung Galaxy Book4',120,'Beverages', 1,'Samsung Galaxy Book4 laptop är en kapabel och lätt enhet, utformad för arbete och kreativitet på språng.'),
('Black Samsung Galaxy Book4',17,'Beverages',1,'Samsung Galaxy Book4 laptop är en kapabel och lätt enhet, utformad för arbete och kreativitet på språng.'),
('Black Acer Chromebook 314',120,'Beverages',1, 'Acer Chromebook 314 bärbar dator erbjuder smidig vardagsprestanda.'),
('Black ASUS Vivobook X1504', 4400, 'some', 1, 'antireflexbehandlat glas och en praktisk 180° gångjärn erbjuder mångsidig design, smidig drift och effektiv prestanda.'),
('Lenovo IdeaPad Slim 3', 6000, 'some', 1, 'bärbar dator erbjuder mobilitet och effektivitet med AMD Ryzen 7-processor, en levande IPS-skärm, 180-graders gångjärn och snabbladdande batteri.'),
('HP Pavilion 15', 5200, 'some', 1, 'HP Pavilion 15 är en mångsidig laptop med bra prestanda för både arbete och studier.'),
('Dell Inspiron 14', 5800, 'some', 1, 'Dell Inspiron 14 erbjuder pålitlig prestanda och kompakt design för dagligt bruk.'),
('Apple MacBook Air M1', 9500, 'some', 1, 'MacBook Air med M1-chip levererar snabb prestanda och lång batteritid i en tunn design.'),
('Lenovo ThinkPad E14', 7200, 'some', 1, 'ThinkPad E14 är en robust affärslaptop med stark prestanda och bekvämt tangentbord.'),
('ASUS ZenBook 14', 8800, 'some', 1, 'ASUS ZenBook 14 kombinerar elegant design med kraftfull prestanda och låg vikt.'),
('Acer Aspire 5', 4900, 'some', 1, 'Acer Aspire 5 är en prisvärd laptop med bra balans mellan prestanda och funktionalitet.'),
('Microsoft Surface Laptop Go 2', 8300, 'some', 1, 'Surface Laptop Go 2 är en lätt och stilren laptop perfekt för studier och arbete på språng.'),
('HP Envy x360', 9100, 'some', 1, 'HP Envy x360 är en flexibel 2-i-1 laptop med pekskärm och stark prestanda.'),
('Dell XPS 13', 12000, 'some', 1, 'Dell XPS 13 är en premiumlaptop med högupplöst skärm och kraftfull prestanda.'),
('Acer Swift 3', 6700, 'some', 1, 'Acer Swift 3 är en tunn och lätt laptop med bra batteritid och stabil prestanda.');


