CREATE DATABASE ontime;
USE ontime;
CREATE TABLE sectors
(
	Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (Name)
);
CREATE TABLE business
(
	BusinessID VARCHAR(15) NOT NULL,    
    BusinessName VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Telephone VARCHAR(15) NOT NULL,
    Sector VARCHAR(50) NOT NULL,
    
    PRIMARY KEY (BusinessID),
    UNIQUE (Email),
    FOREIGN KEY (Sector) REFERENCES sectors(Name)
);
CREATE TABLE establishments
(
    EstablishmentID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    BusinessID VARCHAR(15) NOT NULL,    
    Location VARCHAR(50) NOT NULL,
    
    FOREIGN KEY (BusinessID) REFERENCES business (BusinessID),
    PRIMARY KEY (EstablishmentID)  
);
CREATE TABLE individuals
(
    Email VARCHAR(50) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Surname VARCHAR(50) NOT NULL,
    Telephone VARCHAR(15) NOT NULL,
    EncryptedPassword VARCHAR(200) NOT NULL,
    BusinessID VARCHAR(15) NULL,
    
    FOREIGN KEY (BusinessID) REFERENCES business(BusinessID),
    PRIMARY KEY (Email)
);
CREATE TABLE appointments
(
	Email VARCHAR(50) NOT NULL,
    BusinessID VARCHAR(15) NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Location INT UNSIGNED NOT NULL,
    
    FOREIGN KEY (Email) REFERENCES individuals(Email),
    FOREIGN KEY (BusinessID) REFERENCES business(BusinessID),
    FOREIGN KEY (Location) REFERENCES establishments(EstablishmentID),
    PRIMARY KEY (Email, BusinessID)
);

