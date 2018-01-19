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
    
    PRIMARY KEY (BusinessName),
    UNIQUE (Email),
    FOREIGN KEY (Sector) REFERENCES sectors(Name)
);
CREATE TABLE establishments
(
    EstablishmentID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Owner VARCHAR(15) NOT NULL,    
    Location VARCHAR(50) NOT NULL,
    
    FOREIGN KEY (Owner) REFERENCES business (BusinessName),
    PRIMARY KEY (EstablishmentID)  
);
CREATE TABLE individuals
(
    Email VARCHAR(50) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Surname VARCHAR(50) NOT NULL,
    Telephone VARCHAR(15) NOT NULL,
    EncryptedPassword VARCHAR(200) NOT NULL,
    BusinessName VARCHAR(15) NULL,
    
    FOREIGN KEY (BusinessName) REFERENCES business(BusinessName),
    PRIMARY KEY (Email)
);
CREATE TABLE appointments
(
	Email VARCHAR(50) NOT NULL,
    BusinessName VARCHAR(15) NOT NULL,
    start VARCHAR(50) NOT NULL,
    end VARCHAR(50) NOT NULL,
    Location INT UNSIGNED NOT NULL,
    Accepted BIT NOT NULL DEFAULT 0, 
    
    FOREIGN KEY (Email) REFERENCES individuals(Email),
    FOREIGN KEY (BusinessName) REFERENCES business(BusinessName),
    FOREIGN KEY (Location) REFERENCES establishments(EstablishmentID),
    PRIMARY KEY (Email, BusinessName, start, end)
);
CREATE TABLE settings
(
    UserEmail VARCHAR(50) NOT NULL,
    AccountIMG VARCHAR(100) NOT NULL DEFAULT '../IMG/ontime_logo.png',
    MainColor VARCHAR(7) NOT NULL DEFAULT '#6060B9',
    SecondColor VARCHAR(7) NOT NULL DEFAULT '#FFFFFF',
    FOREIGN KEY (UserEmail) REFERENCES individuals(Email),
    PRIMARY KEY (UserEmail)
);
