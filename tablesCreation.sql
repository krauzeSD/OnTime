CREATE DATABASE OnTime;
USE OnTime;
CREATE TABLE Sectors
(
	Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (Name)
);
CREATE TABLE Business
(
	BusinessID VARCHAR(15) NOT NULL,    
    BusinessName VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Telephone VARCHAR(15) NOT NULL,
    Sector VARCHAR(50) NOT NULL,
    
    PRIMARY KEY (BusinessID),
    UNIQUE (Email),
    FOREIGN KEY (Sector) REFERENCES Sectors(Name)
);
CREATE TABLE Establishments
(
    EstablishmentID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    BusinessID VARCHAR(15) NOT NULL,    
    Location VARCHAR(50) NOT NULL,
    
    FOREIGN KEY (BusinessID) REFERENCES Business (BusinessID),
    PRIMARY KEY (EstablishmentID)  
);
CREATE TABLE Individuals
(
    Email VARCHAR(50) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Surname VARCHAR(50) NOT NULL,
    Telephone VARCHAR(15) NOT NULL,
    EncryptedPassword VARCHAR(200) NOT NULL,
    BusinessID VARCHAR(15) NULL,
    
    FOREIGN KEY (BusinessID) REFERENCES Business(BusinessID),
    PRIMARY KEY (Email)
);
CREATE TABLE Appointments
(
	Email VARCHAR(50) NOT NULL,
    BusinessID VARCHAR(15) NOT NULL,
    Date DATE NOT NULL,
    Time TIME NOT NULL,
    Location INT UNSIGNED NOT NULL,
    
    FOREIGN KEY (Email) REFERENCES Individuals(Email),
    FOREIGN KEY (BusinessID) REFERENCES Business(BusinessID),
    FOREIGN KEY (Location) REFERENCES Establishments(EstablishmentID),
    PRIMARY KEY (Email, BusinessID)
);
