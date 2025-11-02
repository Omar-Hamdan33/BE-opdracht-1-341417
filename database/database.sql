

DROP DATABASE IF EXISTS backendl2;


CREATE DATABASE IF NOT EXISTS backendl2;

USE backendl2;

DROP TABLE IF EXISTS Product;

CREATE TABLE Product (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Barcode VARCHAR(20) NOT NULL UNIQUE,
    IsActief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250) NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    
    CONSTRAINT PK_Product_Id PRIMARY KEY (Id)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS Magazijn;

CREATE TABLE Magazijn (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ProductId INT UNSIGNED NOT NULL,
    VerpakkingsEenheid DECIMAL(8,2) NOT NULL,
    AantalAanwezig INT NULL,
    IsActief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250) NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    
    CONSTRAINT PK_Magazijn_Id PRIMARY KEY (Id),
    CONSTRAINT FK_Magazijn_ProductId_Product_Id FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE
) ENGINE=InnoDB;


DROP TABLE IF EXISTS Allergeen;

CREATE TABLE Allergeen (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(50) NOT NULL,
    Omschrijving VARCHAR(100) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250) NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    
    CONSTRAINT PK_Allergeen_Id PRIMARY KEY (Id)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS ProductPerAllergeen;

CREATE TABLE ProductPerAllergeen (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ProductId INT UNSIGNED NOT NULL,
    AllergeenId INT UNSIGNED NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250) NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    
    CONSTRAINT PK_ProductPerAllergeen_Id PRIMARY KEY (Id),
    CONSTRAINT FK_ProductPerAllergeen_ProductId_Product_Id FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE,
    CONSTRAINT FK_ProductPerAllergeen_AllergeenId_Allergeen_Id FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id) ON DELETE CASCADE,
    CONSTRAINT UK_ProductPerAllergeen_ProductId_AllergeenId UNIQUE (ProductId, AllergeenId)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS Leverancier;

CREATE TABLE Leverancier (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    ContactPersoon VARCHAR(100) NOT NULL,
    LeverancierNummer VARCHAR(20) NOT NULL UNIQUE,
    Mobiel VARCHAR(15) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250) NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    
    CONSTRAINT PK_Leverancier_Id PRIMARY KEY (Id)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS ProductPerLeverancier;

CREATE TABLE ProductPerLeverancier (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    LeverancierId INT UNSIGNED NOT NULL,
    ProductId INT UNSIGNED NOT NULL,
    DatumLevering DATE NOT NULL,
    Aantal INT NOT NULL,
    DatumEerstVolgendeLevering DATE NULL,
    IsActief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250) NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    
    CONSTRAINT PK_ProductPerLeverancier_Id PRIMARY KEY (Id),
    CONSTRAINT FK_ProductPerLeverancier_LeverancierId_Leverancier_Id FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id) ON DELETE CASCADE,
    CONSTRAINT FK_ProductPerLeverancier_ProductId_Product_Id FOREIGN KEY (ProductId) REFERENCES Product(Id) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO Product (Id, Naam, Barcode) VALUES
(1, 'Mintnopjes', '8719587231278'),
(2, 'Schoolkrijt', '8719587326713'),
(3, 'Honingdrop', '8719587327836'),
(4, 'Zure Beren', '8719587321441'),
(5, 'Cola Flesjes', '8719587321237'),
(6, 'Turtles', '8719587322245'),
(7, 'Witte Muizen', '8719587328256'),
(8, 'Reuzen Slangen', '8719587325641'),
(9, 'Zoute Rijen', '8719587322739'),
(10, 'Winegums', '8719587327527'),
(11, 'Drop Munten', '8719587322345'),
(12, 'Kruis Drop', '8719587322265'),
(13, 'Zoute Ruitjes', '8719587323256');

INSERT INTO Magazijn (Id, ProductId, VerpakkingsEenheid, AantalAanwezig) VALUES
(1, 1, 5.00, 453),
(2, 2, 2.50, 400),
(3, 3, 5.00, 1),
(4, 4, 1.00, 800),
(5, 5, 3.00, 234),
(6, 6, 2.00, 345),
(7, 7, 1.00, 795),
(8, 8, 10.00, 233),
(9, 9, 2.50, 123),
(10, 10, 3.00, NULL),
(11, 11, 2.00, 367),
(12, 12, 1.00, 467),
(13, 13, 5.00, 20);

INSERT INTO Allergeen (Id, Naam, Omschrijving) VALUES
(1, 'Gluten', 'Dit product bevat gluten'),
(2, 'Gelatine', 'Dit product bevat gelatine'),
(3, 'AZO-Kleurstof', 'Dit product bevat AZO-kleurstoffen'),
(4, 'Lactose', 'Dit product bevat lactose'),
(5, 'Soja', 'Dit product bevat soja');

INSERT INTO ProductPerAllergeen (Id, ProductId, AllergeenId) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 3),
(4, 3, 4),
(5, 6, 5),
(6, 9, 2),
(7, 9, 5),
(8, 10, 2),
(9, 12, 4),
(10, 13, 1),
(11, 13, 4),
(12, 13, 5);

INSERT INTO Leverancier (Id, Naam, ContactPersoon, LeverancierNummer, Mobiel) VALUES
(1, 'Venco', 'Bert van Linge', 'L1029384719', '06-28493827'),
(2, 'Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734'),
(3, 'Haribo', 'Sven Stalman', 'L1029324748', '06-24383291'),
(4, 'Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823'),
(5, 'De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234');

INSERT INTO ProductPerLeverancier (Id, LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering) VALUES
(1, 1, 1, '2024-10-09', 23, '2024-10-16'),
(2, 1, 1, '2024-10-18', 21, '2024-10-25'),
(3, 1, 2, '2024-10-09', 12, '2024-10-16'),
(4, 1, 3, '2024-10-10', 11, '2024-10-17'),
(5, 2, 4, '2024-10-14', 16, '2024-10-21'),
(6, 2, 4, '2024-10-21', 23, '2024-10-28'),
(7, 2, 5, '2024-10-14', 45, '2024-10-21'),
(8, 2, 6, '2024-10-14', 30, '2024-10-21'),
(9, 3, 7, '2024-10-12', 12, '2024-10-19'),
(10, 3, 7, '2024-10-19', 23, '2024-10-26'),
(11, 3, 8, '2024-10-10', 12, '2024-10-17'),
(12, 3, 9, '2024-10-11', 1, '2024-10-18'),
(13, 4, 10, '2024-10-16', 24, '2024-10-30'),
(14, 5, 11, '2024-10-10', 47, '2024-10-17'),
(15, 5, 11, '2024-10-19', 60, '2024-10-26'),
(16, 5, 12, '2024-10-11', 45, NULL),
(17, 5, 13, '2024-10-12', 23, NULL);

DROP PROCEDURE IF EXISTS GetProductMagazijnOverzicht;

DELIMITER $$

CREATE PROCEDURE GetProductMagazijnOverzicht()
BEGIN
    SELECT 
        p.Id,
        p.Naam,
        p.Barcode,
        m.VerpakkingsEenheid,
        m.AantalAanwezig,
        p.IsActief,
        p.DatumAangemaakt,
        p.DatumGewijzigd
    FROM Product p
	JOIN Magazijn m ON p.Id = m.ProductId
    WHERE p.IsActief = 1
    ORDER BY p.Barcode ASC;
END$$
DELIMITER ;

CALL GetProductMagazijnOverzicht();


DROP PROCEDURE IF EXISTS GetProductAllergeenInfo;

DELIMITER $$

CREATE PROCEDURE GetProductAllergeenInfo(IN productId INT)
BEGIN
    DECLARE product_count INT DEFAULT 0;
    
    SELECT 
        p.Id,
        p.Naam,
        p.Barcode
    FROM Product p
    WHERE p.Id = productId;
    
    SELECT 
        a.Id,
        a.Naam,
        a.Omschrijving,
        ppa.Id as KoppelingId
    FROM ProductPerAllergeen ppa
	JOIN Allergeen a ON ppa.AllergeenId = a.Id
    WHERE ppa.ProductId = productId 
    AND ppa.IsActief = 1
    AND a.IsActief = 1
    ORDER BY a.Naam ASC;
END$$
DELIMITER ;

CALL GetProductAllergeenInfo(1);

DROP PROCEDURE IF EXISTS GetLeverancierByProduct;
DROP PROCEDURE IF EXISTS GetProductLeveringGegevens;

DELIMITER $$
CREATE PROCEDURE GetLeverancierByProduct(IN productId INT)
BEGIN
    SELECT DISTINCT
        l.Id,
        l.Naam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel,
        l.DatumAangemaakt
    FROM Leverancier l
	JOIN ProductPerLeverancier ppl ON l.Id = ppl.LeverancierId
    WHERE ppl.ProductId = productId;
END$$

CREATE PROCEDURE GetProductLeveringGegevens(IN productId INT)
BEGIN
    SELECT 
        p.Id,
        p.Naam,
        ppl.DatumLevering,
        ppl.Aantal,
        ppl.DatumEerstVolgendeLevering
    FROM Product p
	JOIN ProductPerLeverancier ppl ON p.Id = ppl.ProductId
    WHERE ppl.ProductId = productId;
END$$

DELIMITER ;

CALL GetLeverancierByProduct(1);
CALL GetProductLeveringGegevens(1);