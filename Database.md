Database opzet

CREATE DATABASE OccasionDatabase;

USE OccasionDatabase;

CREATE TABLE Users (
UserID INT AUTO_INCREMENT PRIMARY KEY,
Email VARCHAR(100) UNIQUE NOT NULL,
PasswordHash VARCHAR(255) NOT NULL,
RegistrationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
LastLogin DATETIME
);

CREATE TABLE Favorites (
FavoriteID INT AUTO_INCREMENT PRIMARY KEY,
UserID INT,
AutoID INT,
DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (UserID) REFERENCES Users(UserID),
FOREIGN KEY (AutoID) REFERENCES Autos(AutoID)
);


CREATE TABLE Auto (
ID INT AUTO_INCREMENT PRIMARY KEY,
Brand VARCHAR(50),
Model VARCHAR(100),
Price DECIMAL(10, 2),
HorsePower INT,
Mileage DECIMAL(10, 2),
Year INT,
Color VARCHAR(50),
FuelType VARCHAR(20),
Interior VARCHAR(50),
Transmission VARCHAR(50),
Seats INT,
Specifications VARCHAR(100)
);

INSERT INTO Auto (Brand, Model, Price, HorsePower, Mileage, Year, Color, FuelType, Interior, Transmission, Seats, Specifications) VALUES
('Audi', 'RS6 ABT Legacy Edition', 150000, 760, 3100, 2023, 'Nardogrijs', 'Benzine', 'Zwart leder', 'Automaat/Tiptronic', 5, 'Full Option'),
('Audi', 'RSQ8', 189900, 600, 13190, 2022, 'Mythoszwart metallic', 'Benzine', 'Zwart leder', 'Automaat/Tiptronic', 5, 'Full Option'),
('Porsche', '992 Carrera 4 GTS', 208880, 480, 10870, 2022, 'Kreide', 'Benzine', 'Zwart leder', 'Automaat/PDK', 4, 'Full Option'),
('Porsche', '992 GT3 RS', 250000, 520, 3250, 2022, 'Haaiblauw', 'Benzine', 'Race-Tex (haaiblauw)', 'Automaat/PDK', 2, 'Full Option'),
('Porsche', '911 Dakar', 409900, 480, 78, 2023, 'Wit / Gentiaanblauw', 'Benzine', 'Race-Tex Rallye (haaiblauw)', 'Automaat/PDK', 2, 'Full Option'),
('BMW', 'M3', 120000, 450, 50000, 2018, 'Black', 'Benzine', 'Zwart leder', 'Automatic/Steptronic', 5, 'Full Option'),
('BMW', 'M5 Competition', 183500, 625, 10000, 2022, 'Donington Grijs Metallic', 'Benzine', 'Zwart leder', 'Automatic/Steptronic', 5, 'Full Option'),
('BMW', 'M3 Competition Touring', 151800, 510, 10000, 2022, 'Isle of Man groen metallic', 'Benzine', 'Zwart leder', 'Automatic/Steptronic', 5, 'Full Option'),
('Audi', 'S6', 65000, 200, 100000, 2018, 'Zwart', 'Benzine', 'Zwart leder', 'Automatic/Tiptronic', 5, 'Full Option'),
('Audi', 'R8 V10 Performance', 182000, 620, 5000, 2023, 'Suzuka Gray', 'Benzine', 'Zwart leder', 'Automaat/S-Tronic', 2, 'Full Option'),
('Porsche', '911 Turbo S', 230000, 640, 25330, 2023, 'GT Silver', 'Benzine', 'Zwart leder', 'Automaat/PDK', 4, 'Full Option'),
('Porsche', 'Cayman GT4 RS', 142000, 493, 5500, 2023, 'Racing Yellow', 'Benzine', 'Zwart leder', 'Automaat/PDK', 2, 'Full Option'),
('Aston Martin', 'Vantage', 150000, 503, 25000, 2022, 'Magnetic Silver', 'Benzine', 'Zwart leder', 'Automaat', 2, 'Full Option'),
('Aston Martin', 'DB11', 200000, 600, 38400, 2023, 'Onyx Black', 'Benzine', 'Zwart leder', 'Automaat', 4, 'Full Option'),
('BMW', 'M4 Competition', 130000, 510, 40000, 2023, 'Sao Paulo Yellow', 'Benzine', 'Zwart leder', 'Automaat', 4, 'Full Option'),
('Ferrari', '488 Pista', 300000, 710, 3000, 2023, 'Rosso Corsa', 'Benzine', 'Zwart leder', 'Automaat/DCT', 2, 'Full Option'),
('Ferrari', '458 Speciale', 350000, 597, 1500, 2023, 'Rossa Corsa', 'Benzine', 'Zwart leder', 'Automaat/DCT', 2, 'Full Option'),
('Ford', 'GT', 400000, 660, 2000, 2022, 'Liquid Blue', 'Benzine', 'Zwart leder', 'Automaat/DCT', 2, 'Full Option');


