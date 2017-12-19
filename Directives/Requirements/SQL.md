### Database name → OnTime
#### Tables:
  ###### Individuals
Email varchar(50) not null,

Name VARCHAR(50) not null,

Surname VARCHAR(50) not null,

Telephone varchar(15) not null,

EncryptedPassword varchar(200) not null,

BusinessEntity varchar(15) null,

Foreign key (BusinessID) References(BusinessID),

Primary key (Email)

###### Business
BusinessID varchar(15) not null,

BusinessName varchar(50) not null,

Email varchar(50) null,

Telephone varchar (15) null,

Sector varchar (50) not null,

Primary key (BusinessID),

Unique (Email),

Foreign key (Sector) references Sectors (Name)

###### Appoinments
Email varchar (50) not null,

BusinessID varchar (15) not null,

Date date not null,

Time time not null,

Location int unsigned not null,

foreign key (Email) references Individuals (Email),

foreign key 

foreign key (Location) references Establishment (EstablishmentID)

###### Establishments
EstablishmentID int unsigned not null auto_increment

Location varchar (50) not null,

Foreign key (BusinessID) references Business (BusinessID),

Primary key (EstablishmentID)

###### Sectors
Name varchar (50) not null,

Primary key (Name)