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
('Black Acer Chromebook 314',120,'Beverages',1, 'Acer Chromebook 314 bärbar dator erbjuder smidig vardagsprestanda.');

